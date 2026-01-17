
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
    <p class="text-gray-600">View all users</p>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <div class="px-6 py-4 border-b flex items-center space-x-4">
        <div class="relative w-full md:w-1/3">
            <input id="searchInput" type="text" placeholder="Search users..." 
                   class="pl-10 pr-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-gold">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table id="usersTable" class="w-full">
            <thead class="bg-light">
                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">First Name</th>
                    <th class="p-4 text-left">Last Name</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Phone</th>
                </tr>
            </thead>
            <tbody id="usersBody">
                @foreach($users as $user)
                <tr class="border-b hover:bg-cream">
                    <td class="p-4">{{ $user->id }}</td>
                    <td class="p-4">{{ $user->first_name }}</td>
                    <td class="p-4">{{ $user->last_name }}</td>
                    <td class="p-4">{{ $user->email }}</td>
                    <td class="p-4">{{ $user->phone }}</td>
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
    const tbody = document.getElementById('usersBody');
    const pagination = document.getElementById('pagination');
    const searchInput = document.getElementById('searchInput');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const rowsPerPage = 10;
    let currentPage = 1;
    let filteredRows = rows;

    function renderTable() {
        tbody.innerHTML = '';
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const pageRows = filteredRows.slice(start, end);
        pageRows.forEach(row => tbody.appendChild(row));

        // Render pagination buttons
        pagination.innerHTML = '';
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.className = `px-3 py-1 border rounded ${i === currentPage ? 'bg-gold text-white' : 'bg-white'}`;
            btn.addEventListener('click', () => {
                currentPage = i;
                renderTable();
            });
            pagination.appendChild(btn);
        }
    }

    function filterRows() {
        const searchText = searchInput.value.toLowerCase();
        filteredRows = rows.filter(row => {
            const firstName = row.cells[1].textContent.toLowerCase();
            const lastName = row.cells[2].textContent.toLowerCase();
            const email = row.cells[3].textContent.toLowerCase();
            return firstName.includes(searchText) || lastName.includes(searchText) || email.includes(searchText);
        });
        currentPage = 1;
        renderTable();
    }

    searchInput.addEventListener('input', filterRows);

    // initial render
    renderTable();
});
</script>
                    
                </div>
            </div>
        </div>
    </section>
</main>


@endsection