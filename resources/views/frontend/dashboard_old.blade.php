@extends('frontend.app')

@section('content')


    <main>
    

         <!-- Dashboard Section -->
        <section id="dashboard" class="section-padding  light-bg">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    {{-- <h2 class="text-3xl md:text-4xl font-bold mb-4 dark-text">My <span class="gold-text">Dashboard</span></h2> --}}
                    <div class="w-24 h-1 gold-bg mx-auto mb-8"></div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Sidebar -->
                    @include('frontend.sidebar')
                    <!-- Main Content -->
                    <div class="lg:col-span-3">
                        <!-- Appointments Tab -->
                        <div id="appointments-tab" class="dashboard-content">
                            <div class="dashboard-card">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-2xl font-bold">My Appointments</h3>
                                    <div class="text-sm text-gray-600">
                                        <span id="appointment-count">0</span> appointment(s)
                                    </div>
                                </div>
                                
                                <div id="appointments-list">
                                    <!-- Appointments will be loaded here -->
                                    <div class="text-center py-12">
                                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-6">
                                            <i class="fas fa-calendar-plus text-3xl text-gray-400"></i>
                                        </div>
                                        <h4 class="text-xl font-bold mb-2">No Appointments Yet</h4>
                                        <p class="text-gray-600 mb-6">You haven't booked any appointments yet.</p>
                                        <a href="#" class="btn-primary" data-section="booking">Book Your First Appointment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payments Tab -->
                        <div id="payments-tab" class="dashboard-content hidden">
                            <div class="dashboard-card">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-2xl font-bold">Payment History</h3>
                                    <div class="text-sm text-gray-600">
                                        Total: <span id="total-payments" class="font-bold gold-text">$0</span>
                                    </div>
                                </div>
                                
                                <div id="payments-list">
                                    <!-- Payments will be loaded here -->
                                    <div class="text-center py-12">
                                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-6">
                                            <i class="fas fa-receipt text-3xl text-gray-400"></i>
                                        </div>
                                        <h4 class="text-xl font-bold mb-2">No Payment History</h4>
                                        <p class="text-gray-600">You haven't made any payments yet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Profile Tab -->
                        <div id="profile-tab" class="dashboard-content hidden">
                            <div class="dashboard-card">
                                <h3 class="text-2xl font-bold mb-6">Profile Settings</h3>
                                
                                <form id="profile-form">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <div class="form-group">
                                            <label class="form-label">First Name</label>
                                            <input type="text" id="first-name" class="form-input" placeholder="Enter first name">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" id="last-name" class="form-input" placeholder="Enter last name">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-6">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" id="user-email" class="form-input" placeholder="Enter email address">
                                    </div>
                                    
                                    <div class="form-group mb-6">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" id="user-phone" class="form-input" placeholder="+1 (123) 456-7890">
                                    </div>
                                    
                                    <div class="form-group mb-8">
                                        <label class="form-label">Address (For Mobile Services)</label>
                                        <textarea id="user-address" class="text-area" placeholder="Enter your address for mobile services"></textarea>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row justify-between gap-4">
                                        <button type="submit" class="btn-primary">
                                            <i class="fas fa-save mr-2"></i> Update Profile
                                        </button>
                                        <button type="button" id="change-password-btn" class="btn-secondary">
                                            <i class="fas fa-key mr-2"></i> Change Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    @endsection