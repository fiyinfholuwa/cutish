@extends('frontend.app')

@section('content')
<main>
    <!-- Dashboard Section -->
    <section id="dashboard" class="section-padding light-bg">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <div class="w-24 h-1 gold-bg mx-auto mb-8"></div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                @include('frontend.sidebar')
                
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <h3 class="text-2xl font-bold">My Appointments</h3>
                        <button type="button" onclick="openBookingModal()" class="btn-primary w-full sm:w-auto">
                            <i class="fas fa-plus mr-2"></i> Book Appointment
                        </button>
                    </div>
                    
                    <!-- Appointments Tab -->
                    <div id="appointments-tab" class="dashboard-content">
                        <div class="dashboard-card">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                                <h3 class="text-2xl font-bold">My Appointments</h3>
                                <div class="text-sm text-gray-600">
                                    <span id="appointment-count">{{ $appointments->count() }}</span> appointment(s)
                                </div>
                            </div>
                            
                            <div id="appointments-list">
                                @if($appointments->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($appointments as $appointment)
                                        <div class="booking-card">
                                            <div class="flex flex-col md:flex-row md:items-center justify-between">
                                                <div class="mb-4 md:mb-0">
                                                    <h4 class="text-xl font-bold mb-2">{{ $appointment->service->name ?? 'Service' }}</h4>
                                                    <div class="flex flex-wrap gap-4 text-gray-600">
                                                        <div class="flex items-center">
                                                            <i class="fas fa-calendar-alt mr-2"></i>
                                                            <span>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</span>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <i class="fas fa-clock mr-2"></i>
                                                            <span>{{ $appointment->appointment_time }}</span>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                                            <span>{{ $appointment->location_type == 'home' ? 'At Home' : 'Event Venue' }}</span>
                                                        </div>
                                                    </div>
                                                    @if($appointment->special_requests)
                                                        <p class="mt-3 text-gray-600">
                                                            <span class="font-medium">Notes:</span> {{ $appointment->special_requests }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="flex flex-col items-start md:items-end mt-4 md:mt-0">
                                                    <span class="text-2xl font-bold gold-text mb-2">
                                                        ${{ number_format($appointment->price, 2) }}
                                                    </span>
                                                    <span class="booking-status status-{{ strtolower($appointment->status) }} mb-3">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                    <div class="flex space-x-3">
                                                        @if($appointment->status !== 'cancelled')
                                                            <button type="button" onclick="rescheduleAppointment({{ $appointment->id }})" 
                                                                    class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded transition-colors">
                                                                Reschedule
                                                            </button>
                                                            {{-- <button type="button" onclick="cancelAppointment({{ $appointment->id }})" 
                                                                    class="text-sm bg-red-50 hover:bg-red-100 text-red-600 py-2 px-4 rounded transition-colors">
                                                                Cancel
                                                            </button> --}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-12">
                                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-6">
                                            <i class="fas fa-calendar-plus text-3xl text-gray-400"></i>
                                        </div>
                                        <h4 class="text-xl font-bold mb-2">No Appointments Yet</h4>
                                        <p class="text-gray-600 mb-6">You haven't booked any appointments yet.</p>
                                        <button type="button" onclick="openBookingModal()" class="btn-primary">
                                            Book Your First Appointment
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
    <div id="booking-modal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden z-50 overflow-y-auto" aria-hidden="true">
        <div class="modal-content relative bg-white rounded-2xl max-w-2xl mx-auto my-8 sm:my-12 p-6 sm:p-8">
            <button type="button" onclick="closeBookingModal()" class="close-modal absolute top-4 right-4 text-2xl" aria-label="Close modal">
                &times;
            </button>
            
            <h3 class="text-2xl font-bold mb-6">Book New Appointment</h3>
            
            <form id="booking-form" action="{{ route('bookings.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="form-group">
                        <label for="service-select" class="form-label">Select Service *</label>
                        <select name="service_id" id="service-select" class="form-input" required>
                            <option value="">Choose a service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" 
                                        data-price="{{ $service->price }}"
                                        data-duration="{{ $service->duration }}">
                                    {{ $service->name }} (${{ number_format($service->price, 2) }}, {{ $service->duration }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="appointment-date" class="form-label">Appointment Date *</label>
                        <input type="date" name="appointment_date" id="appointment-date" 
                               class="form-input" min="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="form-group">
                        <label for="appointment-time" class="form-label">Preferred Time *</label>
                        <select name="appointment_time" id="appointment-time" class="form-input" required>
                            <option value="">Select time</option>
                            @php
                                $times = ['09:00', '10:30', '12:00', '13:30', '15:00', '16:30', '18:00'];
                            @endphp
                            @foreach($times as $time)
                                <option value="{{ $time }}">{{ \Carbon\Carbon::createFromFormat('H:i', $time)->format('h:i A') }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Location Type *</label>
                        <div class="flex flex-col sm:flex-row sm:space-x-4 mt-2 space-y-2 sm:space-y-0">
                            <label class="radio-option">
                                <input type="radio" name="location_type" value="home" checked>
                                <span>My Home</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="location_type" value="venue">
                                <span>Event Venue</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="booking-address" class="form-label">Full Address *</label>
                    <input type="text" name="address" id="booking-address" 
                           class="form-input" 
                           value="{{ auth()->user()->address ?? '' }}"
                           placeholder="Enter your full address" required>
                </div>
                
                <div class="mb-8">
                    <label for="special-requests" class="form-label">Special Requests</label>
                    <textarea name="special_requests" id="special-requests" 
                              class="text-area" 
                              placeholder="Any specific details about your hair type, style preferences, or accessibility needs..."
                              rows="4"></textarea>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-xl mb-6">
                    <h4 class="font-bold text-lg mb-4">Booking Summary</h4>
                    <div id="booking-summary" class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Service:</span>
                            <span id="summary-service" class="font-medium">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date:</span>
                            <span id="summary-date" class="font-medium">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Time:</span>
                            <span id="summary-time" class="font-medium">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Duration:</span>
                            <span id="summary-duration" class="font-medium">-</span>
                        </div>
                        <div class="flex justify-between pt-3 border-t">
                            <span class="text-gray-600">Total Price:</span>
                            <span id="summary-price" class="font-bold gold-text text-xl">$0.00</span>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn-primary w-full">
                    <i class="fas fa-calendar-check mr-2"></i> Confirm Booking
                </button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="success-modal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden z-50 overflow-y-auto" aria-hidden="true">
        <div class="modal-content relative bg-white rounded-2xl max-w-md mx-auto my-8 sm:my-12 p-6 sm:p-8 text-center">
            <div class="w-16 h-16 rounded-full gold-bg flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-white text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-4">Appointment Booked!</h3>
            <p id="success-message" class="mb-6 text-gray-600">Your appointment has been successfully scheduled.</p>
            <button type="button" onclick="closeSuccessModal()" class="btn-primary w-full sm:w-auto">Close</button>
        </div>
    </div>
</main>

<style>
    /* Your existing CSS styles here */
    .gold-bg { background-color: #D1AE6C; }
    .gold-text { color: #D1AE6C; }
    .dark-text { color: #363435; }
    .light-bg { background-color: #F8F7F4; }
    
    .section-padding { padding: 3rem 1rem; }
    @media (min-width: 768px) { 
        .section-padding { padding: 5rem 1.5rem; } 
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #D1AE6C 0%, #E0C080 100%);
        color: #363435;
        font-weight: 600;
        padding: 0.875rem 2rem;
        border-radius: 50px;
        border: none;
        box-shadow: 0 10px 25px rgba(209, 174, 108, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    @media (min-width: 640px) {
        .btn-primary {
            padding: 1rem 2.5rem;
        }
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(209, 174, 108, 0.4);
    }
    
    .btn-primary:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }
    
    .dashboard-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(209, 174, 108, 0.1);
    }
    
    @media (min-width: 768px) {
        .dashboard-card {
            padding: 2rem;
        }
    }
    
    .booking-card {
        background: white;
        border-radius: 12px;
        padding: 1.25rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(209, 174, 108, 0.1);
    }
    
    @media (min-width: 768px) {
        .booking-card {
            padding: 1.5rem;
        }
    }
    
    .booking-status {
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-block;
    }
    
    .status-confirmed { background-color: rgba(34, 197, 94, 0.1); color: rgb(21, 128, 61); }
    .status-pending { background-color: rgba(251, 191, 36, 0.1); color: rgb(180, 83, 9); }
    .status-cancelled { background-color: rgba(239, 68, 68, 0.1); color: rgb(185, 28, 28); }
    
    .modal { 
        display: none; /* Changed from hidden to none */
        align-items: flex-start; 
        justify-content: center; 
        padding: 1rem;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 50;
    }
    
    .modal.active {
        display: flex; /* Show modal when active class is added */
    }
    
    .modal-content { 
        animation: slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        width: 100%;
    }
    
    @keyframes slideUp { 
        from { transform: translateY(50px) scale(0.9); opacity: 0; } 
        to { transform: translateY(0) scale(1); opacity: 1; } 
    }
    
    .close-modal {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 1.5rem;
        cursor: pointer;
        color: #363435;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.05);
        border: none;
        padding: 0;
    }
    
    .close-modal:hover { background: rgba(0, 0, 0, 0.1); }
    
    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; margin-bottom: 0.5rem; font-weight: 500; }
    
    .form-input {
        width: 100%;
        padding: 0.875rem;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 1rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #D1AE6C;
        box-shadow: 0 0 0 3px rgba(209, 174, 108, 0.1);
    }
    
    .text-area {
        width: 100%;
        padding: 0.875rem;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 1rem;
        font-family: inherit;
        resize: vertical;
        min-height: 120px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    
    .text-area:focus {
        outline: none;
        border-color: #D1AE6C;
        box-shadow: 0 0 0 3px rgba(209, 174, 108, 0.1);
    }
    
    .radio-option {
        display: flex;
        align-items: center;
        cursor: pointer;
        padding: 0.5rem 0;
    }
    
    .radio-option input { 
        margin-right: 0.5rem; 
        width: 18px;
        height: 18px;
    }
</style>

<script>
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    
    // Modal state management
    let activeModal = null;
    let isModalOpen = false;
    
    // Modal functions
    function openBookingModal() {
        if (isModalOpen) return; // Prevent multiple modals
        
        const modal = document.getElementById('booking-modal');
        if (!modal) return;
        
        // Reset form if needed
        const form = document.getElementById('booking-form');
        if (form) {
            form.reset();
            updateBookingSummary(); // Reset summary
        }
        
        modal.classList.add('active');
        activeModal = modal;
        isModalOpen = true;
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
    }
    
    function closeBookingModal() {
        if (activeModal) {
            activeModal.classList.remove('active');
        }
        const modal = document.getElementById('booking-modal');
        if (modal) {
            modal.classList.remove('active');
        }
        activeModal = null;
        isModalOpen = false;
        document.body.style.overflow = 'auto';
        document.documentElement.style.overflow = 'auto';
    }
    
    function openSuccessModal(message) {
        if (isModalOpen) return;
        
        const modal = document.getElementById('success-modal');
        if (!modal) return;
        
        if (message) {
            const messageElement = document.getElementById('success-message');
            if (messageElement) {
                messageElement.textContent = message;
            }
        }
        
        modal.classList.add('active');
        activeModal = modal;
        isModalOpen = true;
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
    }
    
    function closeSuccessModal() {
        if (activeModal) {
            activeModal.classList.remove('active');
        }
        const modal = document.getElementById('success-modal');
        if (modal) {
            modal.classList.remove('active');
        }
        activeModal = null;
        isModalOpen = false;
        document.body.style.overflow = 'auto';
        document.documentElement.style.overflow = 'auto';
    }
    
    // Update booking summary
    function updateBookingSummary() {
        const serviceSelect = document.getElementById('service-select');
        const dateInput = document.getElementById('appointment-date');
        const timeSelect = document.getElementById('appointment-time');
        
        if (!serviceSelect || !dateInput || !timeSelect) return;
        
        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
        const serviceName = selectedOption.text.split('(')[0].trim();
        const servicePrice = selectedOption.getAttribute('data-price') || '0';
        const serviceDuration = selectedOption.getAttribute('data-duration') || '-';
        
        const summaryService = document.getElementById('summary-service');
        const summaryPrice = document.getElementById('summary-price');
        const summaryDuration = document.getElementById('summary-duration');
        const summaryDate = document.getElementById('summary-date');
        const summaryTime = document.getElementById('summary-time');
        
        if (summaryService) summaryService.textContent = serviceName;
        if (summaryPrice) summaryPrice.textContent = '$' + parseFloat(servicePrice).toFixed(2);
        if (summaryDuration) summaryDuration.textContent = serviceDuration;
        
        if (dateInput.value) {
            const date = new Date(dateInput.value);
            if (summaryDate) {
                summaryDate.textContent = date.toLocaleDateString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            }
        }
        
        if (timeSelect.value) {
            const [hours, minutes] = timeSelect.value.split(':');
            const time = new Date();
            time.setHours(hours);
            time.setMinutes(minutes);
            if (summaryTime) {
                summaryTime.textContent = time.toLocaleTimeString('en-US', {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });
            }
        }
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure all modals are closed on page load
        closeBookingModal();
        closeSuccessModal();
        
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        const dateInput = document.getElementById('appointment-date');
        if (dateInput) {
            dateInput.min = today;
            dateInput.value = today;
        }
        
        // Update summary on input changes
        const serviceSelect = document.getElementById('service-select');
        const timeSelect = document.getElementById('appointment-time');
        
        if (serviceSelect) {
            serviceSelect.addEventListener('change', updateBookingSummary);
        }
        if (dateInput) {
            dateInput.addEventListener('change', updateBookingSummary);
        }
        if (timeSelect) {
            timeSelect.addEventListener('change', updateBookingSummary);
        }
        
        // Initial summary update
        updateBookingSummary();
        
        // Form submission handler
        const bookingForm = document.getElementById('booking-form');
        if (bookingForm) {
            bookingForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const submitBtn = this.querySelector('button[type="submit"]');
                if (!submitBtn) return;
                
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
                submitBtn.disabled = true;
                
                try {
                    const formData = new FormData(this);
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        closeBookingModal();
                        openSuccessModal(data.message || 'Your appointment has been successfully scheduled.');
                    } else {
                        alert('Error: ' + (data.message || 'Something went wrong. Please try again.'));
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred. Please check your connection and try again.');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        }
        
        // Close modals when clicking outside
        document.addEventListener('click', function(e) {
            if (isModalOpen && activeModal && e.target === activeModal) {
                if (activeModal.id === 'booking-modal') closeBookingModal();
                if (activeModal.id === 'success-modal') closeSuccessModal();
            }
        });
        
        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isModalOpen) {
                if (activeModal && activeModal.id === 'booking-modal') closeBookingModal();
                if (activeModal && activeModal.id === 'success-modal') closeSuccessModal();
            }
        });
        
        // Prevent form submission on enter key in inputs
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.tagName === 'INPUT' && !e.target.type === 'submit') {
                e.preventDefault();
            }
        });
    });
    
    // Clean up event listeners on page unload
    window.addEventListener('beforeunload', function() {
        closeBookingModal();
        closeSuccessModal();
    });
    
    function rescheduleAppointment(appointmentId) {
        if (confirm('Are you sure you want to reschedule this appointment?')) {
            // In a real implementation, this would open a rescheduling interface
            alert('Rescheduling functionality for appointment #' + appointmentId + ' would open here.');
        }
    }

    function cancelAppointment(appointmentId) {
        if (!confirm('Are you sure you want to cancel this appointment? This action cannot be undone.')) {
            return;
        }

        const cancelUrl = "{{ route('bookings.cancel', ['id' => ':id']) }}".replace(':id', appointmentId);

        fetch(cancelUrl, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Appointment cancelled successfully');
            } else {
                alert('Error: ' + (data.message || 'Failed to cancel appointment'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
</script>
@endsection