

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
        <p class="text-gray-600">Add, edit, and delete testimonials</p>
    </div>
    <button onclick="openAddModal()" 
            class="bg-gold text-black px-4 py-2 rounded-lg hover:bg-opacity-90">
        <i class="fas fa-plus mr-2"></i> Add Testimonial
    </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($testimonials as $testimonial)
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center">
                @if($testimonial->image)
                <img src="{{ asset($testimonial->image) }}" 
                     alt="{{ $testimonial->name }}" 
                     class="w-12 h-12 rounded-full object-cover mr-3">
                @else
                <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-user text-gray-400"></i>
                </div>
                @endif
                <div>
                    <h3 class="font-bold text-dark">{{ $testimonial->name }}</h3>
                    <div class="flex text-yellow-400">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                </div>
            </div>
            <span class="px-2 py-1 text-xs rounded-full 
                {{ $testimonial->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ ucfirst($testimonial->status) }}
            </span>
        </div>
        <h4 class="font-semibold text-dark mb-2">{{ $testimonial->title }}</h4>
        <p class="text-gray-600 text-sm mb-4">{{ $testimonial->description }}</p>
        <div class="flex justify-end space-x-2">
            <button 
                class="text-blue-600 hover:text-blue-800 text-sm edit-btn"
                data-show-url="{{ route('admin.testimonials.show', $testimonial->id) }}">
                <i class="fas fa-edit mr-1"></i> Edit
            </button>
            <button 
                class="text-red-600 hover:text-red-800 text-sm delete-btn"
                data-delete-url="{{ route('admin.testimonials.destroy', $testimonial->id) }}">
                <i class="fas fa-trash mr-1"></i> Delete
            </button>
        </div>
    </div>
    @endforeach
</div>

<!-- Testimonial Modal -->
<div id="testimonialModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl mx-4">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-dark" id="modalTitle">Add Testimonial</h2>
        </div>
        <form id="testimonialForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="testimonial_id" name="id">
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" id="title" 
                           class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rating (1-5)</label>
                        <select name="rating" id="rating" 
                                class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold">
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
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
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    <input type="file" name="image" id="image" accept="image/*" 
                           class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold">
                    <div id="imagePreview" class="mt-2 hidden">
                        <img id="previewImage" class="w-32 h-32 object-cover rounded-lg">
                    </div>
                </div>
            </div>
            <div class="p-6 border-t flex justify-end space-x-3">
                <button type="button" onclick="closeModal()" 
                        class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-gold text-dark rounded-lg hover:bg-opacity-90">
                    Save Testimonial
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script>
let currentAction = 'add';

function openAddModal() {
    currentAction = 'add';
    $('#modalTitle').text('Add Testimonial');
    $('#testimonialForm')[0].reset();
    $('#testimonial_id').val('');
    $('#imagePreview').addClass('hidden');
    $('#testimonialModal').removeClass('hidden').addClass('flex');
}

$(document).on('click', '.edit-btn', function() {
    currentAction = 'edit';
    $('#modalTitle').text('Edit Testimonial');

    const url = $(this).data('show-url');

    $.ajax({
        url: url,
        type: 'GET',
        success: function(testimonial) {
            $('#testimonial_id').val(testimonial.id);
            $('#title').val(testimonial.title);
            $('#name').val(testimonial.name);
            $('#description').val(testimonial.description);
            $('#rating').val(testimonial.rating);
            $('#status').val(testimonial.status);

            if(testimonial.image) {
                $('#imagePreview').removeClass('hidden');
$('#previewImage').attr('src', "{{ asset('') }}" + testimonial.image);
            } else {
                $('#imagePreview').addClass('hidden');
            }

            $('#testimonialModal').removeClass('hidden').addClass('flex');
        }
    });
});

function closeModal() {
    $('#testimonialModal').removeClass('flex').addClass('hidden');
}

$(document).on('click', '.delete-btn', function() {
    const url = $(this).data('delete-url');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#D1AE6C',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'POST',
                data: { _method: 'DELETE' },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => location.reload());
                }
            });
        }
    });
});

$('#testimonialForm').submit(function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    let url;
    if (currentAction === 'add') {
        url = "{{ route('admin.testimonials.store') }}";
    } else {
        url = "{{ route('admin.testimonials.update', '__id__') }}"
            .replace('__id__', $('#testimonial_id').val());

        formData.append('_method', 'PUT');
    }
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            }).then(() => location.reload());
        }
    });
});
</script>
                    
                </div>
            </div>
        </div>
    </section>
</main>


@endsection
