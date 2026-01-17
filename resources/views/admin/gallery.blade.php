@extends('frontend.app')

@section('content')
<main>
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
                        <h2 class="text-2xl font-bold">Manage Gallery</h2>
                        <p class="text-gray-600">You can upload up to 6 images. Click 'Add Image' multiple times to add more.</p>
                    </div>

                    <form action="{{ route('admin.gallery.update') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
                        @csrf

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6" id="galleryGrid">
                            @foreach($galleryImages ?? [] as $image)
                                <div class="relative group gallery-item">
                                    <img src="{{ asset($image->path) }}" class="w-full h-40 object-cover rounded-xl preview-img">

                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-3 rounded-xl">
                                        <label class="bg-white px-3 py-1 rounded cursor-pointer text-sm">
                                            Replace
                                            <input type="file" name="replace[{{ $image->id }}]" class="hidden replace-input" accept="image/*">
                                        </label>
                                        <button type="button" class="bg-red-500 text-white px-3 py-1 rounded text-sm remove-btn" data-id="{{ $image->id }}">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <button type="button" id="addImageBtn" class="gold-bg text-white px-4 py-2 rounded-lg">
                                Add Image
                            </button>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="gold-bg text-white px-6 py-2 rounded-lg">
                                Save Changes
                            </button>
                        </div>
                    </form>

                    <script>
                        const maxImages = 6;
                        const galleryGrid = document.getElementById('galleryGrid');
                        const addBtn = document.getElementById('addImageBtn');
                        const galleryForm = document.getElementById('galleryForm');

                        function currentImageCount() {
                            return document.querySelectorAll('.gallery-item').length;
                        }

                        function createPreview(file) {
                            const reader = new FileReader();
                            const container = document.createElement('div');
                            container.className = 'relative group gallery-item';

                            reader.onload = function(e) {
                                container.innerHTML = `
                                    <img src="${e.target.result}" class="w-full h-40 object-cover rounded-xl preview-img">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-3 rounded-xl">
                                        <button type="button" class="bg-red-500 text-white px-3 py-1 rounded text-sm remove-preview">Remove</button>
                                    </div>
                                `;
                            };
                            reader.readAsDataURL(file);
                            return container;
                        }

                        // Add new image
                        addBtn.addEventListener('click', () => {
                            if (currentImageCount() >= maxImages) {
                                alert('You can only have up to 6 images.');
                                return;
                            }

                            const input = document.createElement('input');
                            input.type = 'file';
                            input.name = 'new_images[]';
                            input.accept = 'image/*';
                            input.className = 'hidden dynamic-add';
                            galleryForm.appendChild(input); // must append BEFORE click
                            input.click();

                            input.addEventListener('change', function() {
                                if (!this.files[0]) return;

                                if (this.files[0].size > 5 * 1024 * 1024) {
                                    alert('File is too big! Max 5MB allowed.');
                                    this.remove();
                                    return;
                                }

                                const preview = createPreview(this.files[0]);
                                galleryGrid.appendChild(preview);
                                checkAddBtn();
                            });
                        });

                        // Remove existing or preview images
                        galleryGrid.addEventListener('click', function(e) {
                            if (e.target.classList.contains('remove-btn')) {
                                const id = e.target.dataset.id;
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'remove[]';
                                input.value = id;
                                galleryForm.appendChild(input);
                                e.target.closest('.gallery-item').remove();
                                checkAddBtn();
                            }

                            if (e.target.classList.contains('remove-preview')) {
                                const container = e.target.closest('.gallery-item');
                                // remove associated dynamic-add input
                                const inputs = galleryForm.querySelectorAll('input.dynamic-add');
                                if (inputs.length) inputs[inputs.length - 1].remove();
                                container.remove();
                                checkAddBtn();
                            }
                        });

                        // Replace preview
                        galleryGrid.addEventListener('change', function(e) {
                            if (e.target.classList.contains('replace-input')) {
                                const file = e.target.files[0];
                                if (!file) return;
                                if (file.size > 5 * 1024 * 1024) {
                                    alert('File is too big! Max 5MB allowed.');
                                    e.target.value = '';
                                    return;
                                }

                                const img = e.target.closest('.gallery-item').querySelector('img');
                                const reader = new FileReader();
                                reader.onload = function(ev) {
                                    img.src = ev.target.result;
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        function checkAddBtn() {
                            addBtn.disabled = currentImageCount() >= maxImages;
                        }

                        checkAddBtn();
                    </script>

                </div>
            </div>
        </div>
    </section>
</main>
@endsection
