@extends('frontend.app')

@section('content')
<main>
    <section style="margin-top:100px; margin-bottom:40px;" class="section-padding">
        <div class="container mx-auto px-6">
            <!-- Hero -->
            <div class="relative text-center mb-16 bg-cover bg-center rounded-2xl overflow-hidden"
                style="background-image: url('https://images.fresha.com/locations/location-profile-images/796214/4204575/f4305513-4827-4aa1-865e-08ab29813491-GroomedbyElerekaIkoyi-NG-Lagos-Lagos-Ikoyi-Fresha.jpg');">
                <div class="absolute inset-0 bg-black/50"></div>
                <div class="relative z-10 py-20 px-6">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 text-white">
                        Get In <span class="gradient-text">Touch</span>
                    </h2>
                    <p class="text-lg text-gray-200 max-w-3xl mx-auto">
                        Have questions or ready to book? Reach out through any of the channels below.
                    </p>
                </div>
            </div>

            <!-- Contact Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-14">
                <div class="bg-white rounded-2xl p-8 shadow hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-full gold-bg flex items-center justify-center mb-5">
                        <i class="fas fa-phone text-white text-xl"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-2">Call Us</h4>
                    <p class="text-lg mb-1">+1 (437) 733-1946</p>
                    <p class="text-gray-600 text-sm">Available 9am–9pm</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-full pink-bg flex items-center justify-center mb-5">
                        <i class="fas fa-envelope text-white text-xl"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-2">Email Us</h4>
                    <p class="text-lg mb-1">cutishhair@gmail.com</p>
                    <p class="text-gray-600 text-sm">Response within 24 hours</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-full gold-bg flex items-center justify-center mb-5">
                        <i class="fab fa-instagram text-white text-xl"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-2">Follow Us</h4>
                    <p class="text-lg mb-1">@cutish.ca</p>
                    <p class="text-gray-600 text-sm">Style inspiration & updates</p>
                </div>
            </div>

            <!-- Service Areas -->
            <div class="bg-gradient-to-r from-gold-50 to-pink-50 p-8 rounded-2xl">
                <h4 class="font-bold text-2xl mb-4">Service Areas</h4>
                <p class="text-gray-700 mb-6">We serve all of Toronto and the GTA including:</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt gold-text mr-2"></i>
                        <span>Downtown Toronto</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt gold-text mr-2"></i>
                        <span>North York</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt gold-text mr-2"></i>
                        <span>Scarborough</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt gold-text mr-2"></i>
                        <span>Mississauga</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
