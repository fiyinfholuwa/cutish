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
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                             alt="Wig Installation" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                             alt="Silk Press" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                             alt="Bridal Styling" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                             alt="Wig Installation" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                             alt="Silk Press" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                             alt="Bridal Styling" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    </div>
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