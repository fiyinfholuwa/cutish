@extends('frontend.app')

@section('content')


    <main>
    

        <section style="margin-top:100px; margin-bottom:40px;" class="section-padding">
            <div class="container mx-auto px-6">
                <div class="relative text-center mb-16 bg-cover bg-center rounded-2xl overflow-hidden"
     style="background-image: url('https://images.fresha.com/locations/location-profile-images/796214/4204575/f4305513-4827-4aa1-865e-08ab29813491-GroomedbyElerekaIkoyi-NG-Lagos-Lagos-Ikoyi-Fresha.jpg');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Content -->
    <div class="relative z-10 py-20 px-6">
        <h2 class="text-4xl md:text-5xl font-bold mb-6 text-white">
            Get In <span class="gradient-text">Touch</span>
        </h2>
        <p class="text-lg text-gray-200 max-w-3xl mx-auto">
            Have questions or ready to book? Contact us today—we're here to help transform your hair experience.
        </p>
    </div>
</div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <div class="lg:col-span-1">
                        <div class="space-y-8">
                            <div class="flex items-start">
                                <div class="w-14 h-14 rounded-full gold-bg flex items-center justify-center mr-5 flex-shrink-0">
                                    <i class="fas fa-phone text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-xl mb-2">Call Us</h4>
                                    <p class="text-lg mb-1">+1 (437) 733-1946</p>
                                    <p class="text-gray-600 text-sm">Available 9am-9pm, 7 days a week</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="w-14 h-14 rounded-full pink-bg flex items-center justify-center mr-5 flex-shrink-0">
                                    <i class="fas fa-envelope text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-xl mb-2">Email Us</h4>
                                    <p class="text-lg mb-1">cutishhair@gmail.com</p>
                                    <p class="text-gray-600 text-sm">Response within 24 hours</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="w-14 h-14 rounded-full gold-bg flex items-center justify-center mr-5 flex-shrink-0">
                                    <i class="fab fa-instagram text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-xl mb-2">Follow Us</h4>
                                    <p class="text-lg mb-1">@cutish.ca</p>
                                    <p class="text-gray-600 text-sm">Style inspiration & updates</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-12 bg-gradient-to-r from-gold-50 to-pink-50 p-6 rounded-2xl">
                            <h4 class="font-bold text-xl mb-4">Service Areas</h4>
                            <p class="text-gray-700 mb-4">We serve all of Toronto and the GTA including:</p>
                            <div class="grid grid-cols-2 gap-3">
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
                    
                    <div class="lg:col-span-2">
                        <form id="contact-form" class="bg-white p-8 rounded-2xl shadow-lg">
                            <h3 class="text-2xl font-bold mb-6">Send a Message</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block mb-2 font-medium">Your Name *</label>
                                    <input type="text" class="form-input" required>
                                </div>
                                <div>
                                    <label class="block mb-2 font-medium">Email Address *</label>
                                    <input type="email" class="form-input" required>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Phone Number</label>
                                <input type="tel" class="form-input">
                            </div>
                            
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Service Interest</label>
                                <select class="form-input">
                                    <option value="">Select a service</option>
                                    <option value="wig">Wig Installation</option>
                                    <option value="silk">Silk Press</option>
                                    <option value="bridal">Bridal Styling</option>
                                    <option value="weave">Sew-In Weaves</option>
                                    <option value="consultation">Consultation</option>
                                </select>
                            </div>
                            
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Your Message *</label>
                                <textarea class="form-input" rows="5" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn-primary w-full py-4">
                                <span>Send Message</span>
                                <i class="fas fa-paper-plane ml-3"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @endsection