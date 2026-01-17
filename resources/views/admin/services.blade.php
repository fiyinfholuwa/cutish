




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
        <p class="text-gray-600">Add, edit, and delete available services</p>
    </div>
    <button onclick="openAddModal()" 
            class="bg-gold text-black px-4 py-2 rounded-lg hover:bg-opacity-90">
        <i class="fas fa-plus mr-2"></i> Add New Service
    </button>
</div>

{{-- Success message --}}
@if(session('success'))
<div class="mb-4 p-3 rounded bg-green-100 text-green-800">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-light">
                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Service Name</th>
                    <th class="p-4 text-left">Description</th>
                    <th class="p-4 text-left">Duration</th>
                    <th class="p-4 text-left">Price</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr class="border-b hover:bg-cream">
                    <td class="p-4">#{{ $service->id }}</td>
                    <td class="p-4 font-medium">{{ $service->name }}</td>
                    <td class="p-4">{{ Str::limit($service->description, 50) }}</td>
                    <td class="p-4">{{ $service->duration }}</td>
                    <td class="p-4 font-semibold text-gold">${{ $service->price }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-sm
                            {{ $service->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($service->status) }}
                        </span>
                    </td>
                    <td class="p-4 flex space-x-2">
                        {{-- Edit button --}}
                        <button class="text-blue-600 hover:text-blue-800" 
                                onclick="openEditModal({{ $service->id }}, '{{ addslashes($service->name) }}', '{{ addslashes($service->description) }}', '{{ $service->duration }}', {{ $service->price }}, '{{ $service->status }}')">
                            <i class="fas fa-edit"></i>
                        </button>

                        {{-- Delete form --}}
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="p-4">
        {{ $services->links() }}
    </div>
</div>

<!-- Add/Edit Modal -->
<div id="serviceModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl mx-4">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-dark" id="modalTitle">Add New Service</h2>
        </div>
        <form id="serviceForm" method="POST">
            @csrf
            <input type="hidden" name="id" id="service_id">
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Service Name</label>
                    <input type="text" name="name" id="name" 
                           class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold" required></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                        <input type="text" name="duration" id="duration" 
                               class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                        <input type="number" step="0.01" name="price" id="price" 
                               class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" 
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="p-6 border-t flex justify-end space-x-3">
                <button type="button" onclick="closeModal()" 
                        class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue text-black rounded-lg hover:bg-opacity-90">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('modalTitle').innerText = 'Add New Service';
    document.getElementById('serviceForm').action = "{{ route('admin.services.store') }}";
    document.getElementById('serviceForm').method = 'POST';
    document.getElementById('service_id').value = '';
    document.getElementById('name').value = '';
    document.getElementById('description').value = '';
    document.getElementById('duration').value = '';
    document.getElementById('price').value = '';
    document.getElementById('status').value = 'active';
    document.getElementById('serviceModal').classList.remove('hidden');
    document.getElementById('serviceModal').classList.add('flex');

    // Remove any previous PUT method
    const methodInput = document.querySelector('#serviceForm input[name="_method"]');
    if (methodInput) methodInput.remove();
}

function openEditModal(id, name, description, duration, price, status) {
    document.getElementById('modalTitle').innerText = 'Edit Service';
    document.getElementById('serviceForm').action = `/admin/services/${id}`;
    document.getElementById('serviceForm').method = 'POST';

    // Add PUT method for Laravel
    let methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'PUT';
    document.getElementById('serviceForm').appendChild(methodInput);

    document.getElementById('service_id').value = id;
    document.getElementById('name').value = name;
    document.getElementById('description').value = description;
    document.getElementById('duration').value = duration;
    document.getElementById('price').value = price;
    document.getElementById('status').value = status;

    document.getElementById('serviceModal').classList.remove('hidden');
    document.getElementById('serviceModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('serviceModal').classList.remove('flex');
    document.getElementById('serviceModal').classList.add('hidden');

    // Remove PUT method input if exists
    const methodInput = document.querySelector('#serviceForm input[name="_method"]');
    if (methodInput) methodInput.remove();
}
</script>
                    
                </div>
            </div>
        </div>
    </section>
</main>


@endsection