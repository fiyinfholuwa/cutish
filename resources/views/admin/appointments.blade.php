



@extends('frontend.app')

@section('content')
<main>
    <!-- Dashboard Section -->
    <section id="dashboard" class="section-padding light-bg">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <div class="w-24 h-1 gold-bg mx-auto mb-8"></div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                @include('frontend.sidebar')
                <!-- Main Content -->
                <div class="lg:col-span-3">

<div class="flex justify-between items-center mb-6">
    <div>
        <p class="text-gray-600">Manage all appointments and update their status</p>
    </div>
</div>

{{-- Success message --}}
@if(session('success'))
    <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow overflow-hidden">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input id="searchInput" type="text" placeholder="Search appointments..." 
                       class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gold">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <select id="statusFilter" class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gold">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full" id="appointmentsTable">
            <thead class="bg-light">
                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Customer</th>
                    <th class="p-4 text-left">Service</th>
                    <th class="p-4 text-left">Date & Time</th>
                    <th class="p-4 text-left">Location</th>
                    <th class="p-4 text-left">Price</th>
                    <th class="p-4 text-left">Status</th>
                </tr>
            </thead>
            <tbody id="appointmentsBody">
                @foreach($appointments as $appointment)
                <tr class="border-b hover:bg-cream" data-id="{{ $appointment->id }}">
                    <td class="p-4">#{{ $appointment->id }}</td>
                    <td class="p-4">
                        <div class="font-medium">{{ $appointment->user->first_name ?? 'Guest' }} {{ $appointment->user->last_name ?? '' }}</div>
                        <div class="text-gray-500 text-sm">{{ $appointment->user->email ?? 'N/A' }}</div>
                    </td>
                    <td class="p-4">{{ optional($appointment->service)->name ?? 'N/A' }}</td>
                    <td class="p-4">
                        {{ $appointment->appointment_date }}<br>
                        <span class="text-gray-500 text-sm">{{ $appointment->appointment_time }}</span>
                    </td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-sm 
                            {{ $appointment->location_type == 'home' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                            {{ ucfirst($appointment->location_type) }}
                        </span>
                        @if($appointment->address)
                        <div class="text-gray-500 text-sm mt-1">{{ Str::limit($appointment->address, 30) }}</div>
                        @endif
                    </td>
                    <td class="p-4 font-semibold text-gold">${{ $appointment->price }}</td>
                    <td class="p-4">
                        <select name="status" class="status-select border rounded-lg px-3 py-1 text-sm
                            @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-800
                            @elseif($appointment->status == 'completed') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            
                            <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </td>
                    <td class="p-4">
                        <button class="bg-gold text-white px-3 py-1 rounded hover:bg-yellow-600 view-details-btn"
                                data-appointment='@json($appointment)'>View</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination container --}}
    <div id="pagination" class="mt-4 flex space-x-2"></div>
</div>

{{-- Modal --}}
<div id="appointmentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6 relative">
        <button id="modalClose" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
        <h2 class="text-xl font-bold mb-4">Appointment Details</h2>
        <div id="modalContent"></div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const tableBody = document.getElementById('appointmentsBody');

    const modal = document.getElementById('appointmentModal');
    const modalClose = document.getElementById('modalClose');
    const modalContent = document.getElementById('modalContent');

    const rowsPerPage = 200;
    let currentPage = 1;
    let filteredRows = Array.from(tableBody.rows);

    /* ---------------- FILTER ---------------- */
    function filterRows() {
        const search = searchInput.value.toLowerCase();
        const status = statusFilter.value.toLowerCase();

        filteredRows = Array.from(tableBody.rows).filter(row => {
            const textMatch = row.textContent.toLowerCase().includes(search);
            const rowStatus = row.querySelector('.status-select').value.toLowerCase();
            return textMatch && (status === '' || rowStatus === status);
        });

        currentPage = 1;
        renderTable();
        renderPagination();
    }

    /* ---------------- RENDER TABLE ---------------- */
    function renderTable() {
        tableBody.innerHTML = '';
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        filteredRows.slice(start, end).forEach(row => tableBody.appendChild(row));

        addModalListeners();
        addStatusListeners(); // 🔥 IMPORTANT
    }

    /* ---------------- PAGINATION ---------------- */
    function renderPagination() {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.className = `px-3 py-1 rounded ${i === currentPage ? 'bg-gold text-white' : 'bg-gray-100'}`;
            btn.onclick = () => {
                currentPage = i;
                renderTable();
                renderPagination();
            };
            pagination.appendChild(btn);
        }
    }

    /* ---------------- MODAL ---------------- */
    function addModalListeners() {
        document.querySelectorAll('.view-details-btn').forEach(btn => {
            btn.onclick = () => {
                const data = JSON.parse(btn.dataset.appointment);
                modalContent.innerHTML = `
                    <p><strong>ID:</strong> #${data.id}</p>
                    <p><strong>Customer:</strong> ${data.user?.first_name ?? 'Guest'} ${data.user?.last_name ?? ''}</p>
                    <p><strong>Email:</strong> ${data.user?.email ?? 'N/A'}</p>
                    <p><strong>Service:</strong> ${data.service?.name ?? 'N/A'}</p>
                    <p><strong>Date:</strong> ${data.appointment_date} ${data.appointment_time}</p>
                    <p><strong>Status:</strong> ${data.status}</p>
                `;
                modal.classList.remove('hidden');
            };
        });
    }

    modalClose.onclick = () => modal.classList.add('hidden');
    modal.onclick = e => e.target === modal && modal.classList.add('hidden');

    /* ---------------- STATUS UPDATE ---------------- */
    function addStatusListeners() {
        document.querySelectorAll('.status-select').forEach(select => {
            select.onchange = handleStatusChange;
        });
    }

    function handleStatusChange(e) {
        const select = e.target;
        const row = select.closest('tr');
        const appointmentId = row.dataset.id;
        const status = select.value;

        fetch("{{ route('admin.appointments.update-status') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                appointment_id: appointmentId,
                status: status
            })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                alert('Failed to update status');
                return;
            }

            // update UI color
            select.className = `status-select border rounded-lg px-3 py-1 text-sm
                ${status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                  status === 'confirmed' ? 'bg-blue-100 text-blue-800' :
                  status === 'completed' ? 'bg-green-100 text-green-800' :
                  'bg-gray-100 text-gray-800'}`;
        })
        .catch(() => alert('Network error'));
    }

    /* ---------------- INIT ---------------- */
    filterRows();

    searchInput.addEventListener('input', filterRows);
    statusFilter.addEventListener('change', filterRows);

});
</script>



                    
                </div>
            </div>
        </div>
    </section>
</main>


@endsection