@extends('frontend.app')

@section('content')
<main>

    <!-- Gallery Section -->
    <section style="margin-top:100px; margin-bottom:40px;" class="section-padding">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 dark-text">
                    Our <span class="gradient-text">Work Gallery</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Browse through our portfolio of stunning hair transformations and style creations.
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($galleries as $image)
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <img src="{{ asset($image->path) }}" 
                             alt="{{ $image->alt ?? 'Gallery Image' }}" 
                             class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-3">No images available yet.</p>
                @endforelse
            </div>
            
            <div class="text-center mt-12">
                <a href="https://instagram.com/cutish.ca" target="_blank" class="btn-secondary inline-flex items-center">
                    <i class="fab fa-instagram mr-3"></i>
                    <span>View More on Instagram</span>
                </a>
            </div>
        </div>
    </section>

</main>
@endsection
