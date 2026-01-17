@extends('frontend.app')

@section('content')


    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section id="home" class="hero-section active-section">
            <div class="container mx-auto px-6 py-20">
                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <div class="lg:w-1/2 mb-16 lg:mb-0">
                        <div class="hero-badge">
                            <span class="text-white text-sm font-medium">✨ Premium Mobile Hairstyling</span>
                        </div>
                        
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                            Luxury Hair <span class="gradient-text">Services</span> At Your Doorstep
                        </h1>
                        
                        <p class="text-xl text-gray-200 mb-8 leading-relaxed max-w-2xl">
                            Experience salon-quality hairstyling in the comfort of your home. Cutish Hair brings professional wig installations, silk presses, bridal styling, and more to Toronto and the GTA.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 mb-12">
                            <a href="{{ route('dashboard') }}" class="btn-primary inline-flex items-center justify-center" >
                                <span>Book Now</span>
                                <i class="fas fa-arrow-right ml-3"></i>
                            </a>
                            <a href="{{ route('contact') }}" class="btn-secondary inline-flex items-center justify-center">
                                <i class="fas fa-play-circle mr-3"></i>
                                <span>Contact Us</span>
                            </a>
                        </div>
                        
                        <div class="flex flex-wrap gap-8">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full gold-bg flex items-center justify-center mr-4">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold">Certified Stylists</h4>
                                    <p class="text-gray-300 text-sm">Professional Expertise</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full pink-bg flex items-center justify-center mr-4">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold">Flexible Hours</h4>
                                    <p class="text-gray-300 text-sm">7 Days a Week</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="lg:w-1/2">
                        <div class="hero-image-container relative">
                            <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                                 alt="Professional hairstyling service" 
                                 class="hero-image w-full max-w-lg">
                            
                            <div class="floating-badge floating-badge-1">
                                <div class="w-12 h-12 rounded-full gold-bg flex items-center justify-center mr-4">
                                    <i class="fas fa-star text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">4.9/5</h4>
                                    <p class="text-gray-600 text-sm">Client Rating</p>
                                </div>
                            </div>
                            
                            <div class="floating-badge floating-badge-2">
                                <div class="w-12 h-12 rounded-full pink-bg flex items-center justify-center mr-4">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">500+</h4>
                                    <p class="text-gray-600 text-sm">Happy Clients</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>

        <!-- Features Section -->
        <section  class="section-padding light-bg">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 dark-text">
                        Why Choose <span class="gradient-text">Cutish Hair</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        We've reimagined the salon experience to bring you unparalleled convenience without compromising on quality.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center fade-in delay-1">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-home"></i>
                        </div>
                        <h4 class="text-xl font-bold mb-4">At Your Doorstep</h4>
                        <p class="text-gray-600">We come to your home, office, or venue with all professional equipment. No travel, no waiting rooms.</p>
                    </div>
                    
                    <div class="text-center fade-in delay-2">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-award"></i>
                        </div>
                        <h4 class="text-xl font-bold mb-4">Expert Stylists</h4>
                        <p class="text-gray-600">Our certified hairstylists have 5+ years of experience with all hair types and textures.</p>
                    </div>
                    
                    <div class="text-center fade-in delay-3">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-spa"></i>
                        </div>
                        <h4 class="text-xl font-bold mb-4">Premium Products</h4>
                        <p class="text-gray-600">We use only professional-grade, high-quality products that are safe for your hair and scalp.</p>
                    </div>
                    
                    <div class="text-center fade-in delay-4">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h4 class="text-xl font-bold mb-4">Flexible Scheduling</h4>
                        <p class="text-gray-600">Book appointments that fit your life, including evenings, weekends, and last-minute requests.</p>
                    </div>
                </div>
            </div>
        </section>

         <!-- Services Section -->
        <!-- Services Section -->
<section id="services" class="section-padding  cream-bg">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 dark-text">
                Our <span class="gradient-text">Premium Services</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                From everyday glam to special occasion transformations, discover our comprehensive range of professional hairstyling services.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <!-- Service cards will be populated by JavaScript -->
        </div>

        <div class="text-center">
            <a href="{{ route('dashboard') }}" class="btn-pink px-12" data-section="booking">
                <span>Make A Booking</span>
                <i class="fas fa-arrow-right ml-3"></i>
            </a>
        </div>
    </div>
</section>

<script>
    // Application Data
    const appData = {
        user: null,
        services: [
            {
                id: 1,
                name: "Wig Installation",
                description: "Professional glueless, closure, frontal & 360 wig installations for a flawless, natural look. Customized to your hair type and desired style.",
                duration: "2-3 hours",
                price: "$120+",
                icon: "fas fa-user-tie",
                popular: true,
                category: "wigs"
            },
            {
                id: 2,
                name: "Silk Press",
                description: "Transform your natural hair with our lightweight, bouncy silk press. Achieve straight, shiny hair without harsh chemicals or damage.",
                duration: "2 hours",
                price: "$90+",
                icon: "fas fa-wind",
                popular: true,
                category: "natural"
            },
            {
                id: 3,
                name: "Bridal Hair Styling",
                description: "Custom hair looks for brides on their special day. Includes trial run, day-of styling, and complementary bridesmaid consultations.",
                duration: "2-3 hours",
                price: "$200+",
                icon: "fas fa-heart",
                popular: true,
                category: "special"
            },
            {
                id: 4,
                name: "Sew-In Weaves",
                description: "Flawless sew-in installations with seamless blending for added volume, length, and versatility. We prioritize hair health and comfort.",
                duration: "3-4 hours",
                price: "$150+",
                icon: "fas fa-layer-group",
                popular: false,
                category: "weaves"
            },
            {
                id: 5,
                name: "Sleek Ponytails",
                description: "Elegant, polished ponytails that hold all day. Perfect for both casual and formal occasions with flawless edges and smooth finish.",
                duration: "1 hour",
                price: "$80+",
                icon: "fas fa-arrows-alt-v",
                popular: true,
                category: "styling"
            },
            {
                id: 6,
                name: "Wig Revamp & Restoration",
                description: "Restore your favorite wigs to their original glory. Includes washing, conditioning, styling, and customization to refresh your unit.",
                duration: "1-2 hours",
                price: "$60+",
                icon: "fas fa-spa",
                popular: false,
                category: "wigs"
            },
            {
                id: 7,
                name: "Bridesmaid & Wedding Party",
                description: "Coordinated, polished styles for your entire bridal party. We ensure everyone looks cohesive and camera-ready for your celebration.",
                duration: "1-2 hours",
                price: "$85+",
                icon: "fas fa-users",
                popular: false,
                category: "special"
            },
            {
                id: 8,
                name: "Haircut & Styling",
                description: "Professional haircuts and styling for all hair types. From trims to transformative cuts, we create looks that complement your features.",
                duration: "1-2 hours",
                price: "$70+",
                icon: "fas fa-cut",
                popular: false,
                category: "styling"
            }
        ],
        bookings: [],
        payments: []
    };

    function generateServices() {
        const servicesContainer = document.querySelector('#services .grid');
        if (!servicesContainer) return;

        servicesContainer.innerHTML = '';

        appData.services.forEach(service => {
            const serviceCard = document.createElement('div');
            serviceCard.className = 'service-card fade-in';
            serviceCard.innerHTML = `
                <div class="p-8 h-full flex flex-col">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-16 h-16 rounded-full gold-bg flex items-center justify-center">
                            <i class="${service.icon} text-white text-2xl"></i>
                        </div>
                        ${service.popular ? `
                            <div class="bg-gradient-to-r from-gold-500 to-pink-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                Popular
                            </div>
                        ` : ''}
                    </div>
                    <h3 class="text-2xl font-bold mb-4 dark-text">${service.name}</h3>
                    <p class="text-gray-600 mb-6 flex-grow">${service.description}</p>
                    <div class="flex justify-between items-center pt-6 border-t border-gray-100">
                       
                    </div>
                    
                </div>
            `;
            servicesContainer.appendChild(serviceCard);
        });
    }

    function showBookingModal(serviceName) {
        alert('Booking: ' + serviceName);
    }

    // Init
    document.addEventListener('DOMContentLoaded', generateServices);
</script>


 <section id="process" class="section-padding">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 dark-text">
                        Simple <span class="gradient-text">4-Step Process</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Getting your perfect hairstyle has never been easier. Here's how our seamless booking process works.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div>
                        <div class="process-step step-1">
                            <h3 class="text-2xl font-bold mb-4">Book Your Appointment</h3>
                            <p class="text-gray-600">Schedule online or call us directly. Choose your service, preferred date, time, and location—we come to you anywhere in Toronto & GTA.</p>
                        </div>
                        
                        <div class="process-step step-2">
                            <h3 class="text-2xl font-bold mb-4">Personal Consultation</h3>
                            <p class="text-gray-600">We'll contact you to discuss your hair needs, style preferences, and any special requirements. We customize every service to you.</p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="process-step step-3">
                            <h3 class="text-2xl font-bold mb-4">Professional Service</h3>
                            <p class="text-gray-600">Our stylist arrives at your location with all equipment and premium products. Relax while we work our magic in a clean, organized setup.</p>
                        </div>
                        
                        <div class="process-step step-4">
                            <h3 class="text-2xl font-bold mb-4">Perfect Results</h3>
                            <p class="text-gray-600">Walk away with stunning, camera-ready hair. We provide aftercare tips and maintenance advice to keep your style looking fresh.</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-16 text-center">
                    <div class="bg-gradient-to-r from-gold-50 to-pink-50 p-8 rounded-2xl max-w-3xl mx-auto">
                        <h3 class="text-2xl font-bold mb-4">Ready to Transform Your Hair?</h3>
                        <p class="text-gray-600 mb-6">Book your appointment today and experience the Cutish Hair difference.</p>
                        <a href="{{ route('dashboard') }}" class="btn-primary px-12">Start Booking</a>
                    </div>
                </div>
            </div>
        </section>


        <!-- About Section -->
        <section id="about" class="section-padding hidden-section">
            <div class="container mx-auto px-6">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="lg:w-1/2">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
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

       
        <!-- Process Section -->
        <section id="process" class="section-padding hidden-section">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 dark-text">
                        Simple <span class="gradient-text">4-Step Process</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Getting your perfect hairstyle has never been easier. Here's how our seamless booking process works.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div>
                        <div class="process-step step-1">
                            <h3 class="text-2xl font-bold mb-4">Book Your Appointment</h3>
                            <p class="text-gray-600">Schedule online or call us directly. Choose your service, preferred date, time, and location—we come to you anywhere in Toronto & GTA.</p>
                        </div>
                        
                        <div class="process-step step-2">
                            <h3 class="text-2xl font-bold mb-4">Personal Consultation</h3>
                            <p class="text-gray-600">We'll contact you to discuss your hair needs, style preferences, and any special requirements. We customize every service to you.</p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="process-step step-3">
                            <h3 class="text-2xl font-bold mb-4">Professional Service</h3>
                            <p class="text-gray-600">Our stylist arrives at your location with all equipment and premium products. Relax while we work our magic in a clean, organized setup.</p>
                        </div>
                        
                        <div class="process-step step-4">
                            <h3 class="text-2xl font-bold mb-4">Perfect Results</h3>
                            <p class="text-gray-600">Walk away with stunning, camera-ready hair. We provide aftercare tips and maintenance advice to keep your style looking fresh.</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-16 text-center">
                    <div class="bg-gradient-to-r from-gold-50 to-pink-50 p-8 rounded-2xl max-w-3xl mx-auto">
                        <h3 class="text-2xl font-bold mb-4">Ready to Transform Your Hair?</h3>
                        <p class="text-gray-600 mb-6">Book your appointment today and experience the Cutish Hair difference.</p>
                        <a href="{{ route('dashboard') }}" class="btn-primary px-12">Start Booking</a>
                    </div>
                </div>
            </div>
        </section>

@if (count($testimonials) > 0)
<section id="testimonials" class="section-padding light-bg">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 dark-text">
                What Our <span class="gradient-text">Clients Say</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Don't just take our word for it—hear from our satisfied clients who have experienced the Cutish Hair difference.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($testimonials as $testimonial)
                <div class="testimonial-card fade-in">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 rounded-full overflow-hidden mr-4 border-2 border-gold-200">
                            <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">{{ $testimonial->name }}</h4>
                            <p class="text-gold-600">{{ $testimonial->title ?? 'Client' }}</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">
                        "{{ $testimonial->description }}"
                    </p>
                    <div class="flex">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $testimonial->rating)
                                <i class="fas fa-star gold-text mr-1"></i>
                            @else
                                <i class="far fa-star gold-text mr-1"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
        
       

        <!-- Booking Section -->
        <section id="booking" class="section-padding hidden-section cream-bg">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 dark-text">
                        Book Your <span class="gradient-text">Appointment</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Ready to experience premium mobile hairstyling? Schedule your appointment today in just a few clicks.
                    </p>
                </div>
                
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                            <div>
                                <h3 class="text-2xl font-bold mb-6">Quick Booking</h3>
                                <div class="space-y-6">
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 rounded-full gold-bg flex items-center justify-center mr-4 flex-shrink-0">
                                            <i class="fas fa-calendar-check text-white"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold mb-2">Choose Your Service</h4>
                                            <p class="text-gray-600">Select from our range of premium hairstyling services.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 rounded-full pink-bg flex items-center justify-center mr-4 flex-shrink-0">
                                            <i class="fas fa-clock text-white"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold mb-2">Pick Date & Time</h4>
                                            <p class="text-gray-600">Select your preferred appointment slot.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 rounded-full gold-bg flex items-center justify-center mr-4 flex-shrink-0">
                                            <i class="fas fa-map-marker-alt text-white"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold mb-2">Enter Location</h4>
                                            <p class="text-gray-600">Tell us where to meet you in Toronto or GTA.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <h4 class="font-bold text-xl mb-4">Popular Services</h4>
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                            <span class="font-medium">Wig Installation</span>
                                            <span class="font-bold gold-text">From $120</span>
                                        </div>
                                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                            <span class="font-medium">Silk Press</span>
                                            <span class="font-bold gold-text">From $90</span>
                                        </div>
                                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                            <span class="font-medium">Bridal Styling</span>
                                            <span class="font-bold gold-text">From $200</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-8">
                                        <a href="#" class="btn-primary w-full text-center" onclick="showBookingModal()">
                                            <span>Book Now</span>
                                            <i class="fas fa-arrow-right ml-3"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

      
    </main>

    @endsection