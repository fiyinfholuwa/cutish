@extends('frontend.app')

@section('content')


    <!-- Main Content -->
    <main>
      

        <!-- About Section -->
        <section style="margin:50px 0" id="about" class="section-padding">
            <div class="container mx-auto px-6">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="lg:w-1/2">
                        <div class="relative">
                            <img src="https://blog.withsplice.com/wp-content/uploads/2024/06/woman-getting-her-hair-done-salon-1024x819.jpg" 
                                 alt="Professional hairstylist at work" 
                                 class="rounded-2xl shadow-2xl w-full">
                            <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-2xl shadow-xl hidden lg:block w-64">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-full gold-bg flex items-center justify-center mr-4">
                                        <i class="fas fa-heart text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold gold-text">98%</h4>
                                        <p class="text-gray-600">Client Satisfaction</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="lg:w-1/2">
                        <div class="mb-6">
                            <span class="text-gold-600 font-semibold">ABOUT US</span>
                            <h2 class="text-4xl md:text-5xl font-bold mb-6 dark-text">
                                Redefining <span class="gradient-text">Hair Luxury</span>
                            </h2>
                            <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                                Cutish Hair is Toronto's premier mobile hairstyling service, dedicated to bringing salon-quality transformations directly to you. Founded on the principles of convenience, quality, and artistry, we've revolutionized how clients experience professional hairstyling.
                            </p>
                            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                                Our team of certified stylists specializes in a comprehensive range of services, from intricate wig installations to elegant bridal styling. We believe that every client deserves personalized attention and exceptional results, which is why we tailor each service to your unique style and preferences.
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
                            <div class="stat-box">
                                <div class="stat-number">1,000+</div>
                                <p class="font-medium text-gray-700">Clients Served</p>
                            </div>
                            <div class="stat-box">
                                <div class="stat-number">5+</div>
                                <p class="font-medium text-gray-700">Years Experience</p>
                            </div>
                            <div class="stat-box">
                                <div class="stat-number">24/7</div>
                                <p class="font-medium text-gray-700">Booking Support</p>
                            </div>
                        </div>
                        
                        <a href="#" class="btn-primary inline-flex items-center" data-section="booking">
                            <span>Book Consultation</span>
                            <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

  

  

    </main>

    @endsection