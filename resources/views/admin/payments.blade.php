






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


<div class="mb-6">
    <p class="text-gray-600">View all payment transactions</p>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <div class="px-6 py-4 border-b">
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input id="searchInput" type="text" placeholder="Search payments..." 
                       class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gold">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <select id="statusFilter" class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gold">
                <option value="">All Status</option>
                <option value="completed">Completed</option>
                <option value="pending">Pending</option>
                <option value="failed">Failed</option>
            </select>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table id="paymentsTable" class="w-full">
            <thead class="bg-light">
                <tr>
                    <th class="p-4 text-left">Payment ID</th>
                    <th class="p-4 text-left">User</th>
                    <th class="p-4 text-left">Gateway</th>
                    <th class="p-4 text-left">Amount</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Date</th>
                </tr>
            </thead>
            <tbody id="paymentsBody">
                @foreach($payments as $payment)
                <tr class="border-b hover:bg-cream">
                    <td class="p-4">{{ $payment->id }}</td>
                    <td class="p-4 font-medium">{{ $payment->user->first_name }} {{ $payment->user->last_name }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800">
                            {{ ucfirst($payment->gateway) }}
                        </span>
                    </td>
                    <td class="p-4 font-semibold text-gold">${{ $payment->amount }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-sm
                            @if($payment->status == 'completed') bg-green-100 text-green-800
                            @elseif($payment->status == 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td class="p-4">{{ $payment->created_at->format('M d, Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-4 flex justify-end space-x-2" id="pagination"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const table = document.getElementById('paymentsTable');
    const tbody = document.getElementById('paymentsBody');
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const pagination = document.getElementById('pagination');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const rowsPerPage = 10;
    let currentPage = 1;

    function renderTable(filteredRows) {
        tbody.innerHTML = '';
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const pageRows = filteredRows.slice(start, end);
        pageRows.forEach(row => tbody.appendChild(row));

        // Pagination buttons
        pagination.innerHTML = '';
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        for(let i=1; i<=totalPages; i++){
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.className = `px-3 py-1 border rounded ${i===currentPage ? 'bg-gold text-white' : 'bg-white'}`;
            btn.addEventListener('click', () => {
                currentPage = i;
                renderTable(filteredRows);
            });
            pagination.appendChild(btn);
        }
    }

    function filterRows() {
        const searchText = searchInput.value.toLowerCase();
        const statusText = statusFilter.value.toLowerCase();
        const filtered = rows.filter(row => {
            const userName = row.cells[1].textContent.toLowerCase();
            const status = row.cells[4].textContent.toLowerCase();
            return userName.includes(searchText) && (statusText === '' || status === statusText);
        });
        currentPage = 1;
        renderTable(filtered);
    }

    searchInput.addEventListener('input', filterRows);
    statusFilter.addEventListener('change', filterRows);

    // initial render
    renderTable(rows);
});
</script>
                    
                </div>
            </div>
        </div>
    </section>
</main>


@endsection