@extends('frontend.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                    
                    <!-- Profile Tab Content -->
                    <div id="profile-tab" class="dashboard-content">
                        <div class="dashboard-card">
                            <!-- Tabs Navigation -->
<button type="button"
        class="tab-button active px-4 py-3 font-medium text-lg text-blue-600 border-b-2 border-blue-600"
        data-tab="profile-settings">
    <i class="fas fa-user mr-2"></i> Profile Settings
</button>

<button type="button"
        class="tab-button px-4 py-3 font-medium text-lg text-gray-600"
        data-tab="change-password">
    <i class="fas fa-key mr-2"></i> Change Password
</button>


                            <!-- Success/Error Messages Container -->
                            <div id="message-container" class="mb-6"></div>
                            
                            <!-- Profile Settings Tab Content -->
<div id="profile-settings" class="tab-content">
                                <form id="profile-form">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <div class="form-group">
                                            <label class="form-label">First Name *</label>
                                            <input type="text" id="first_name" name="first_name" class="form-input" 
                                                   value="{{ Auth::user()->first_name ?? '' }}" 
                                                   placeholder="Enter first name" required>
                                            <span class="text-red-500 text-sm hidden" id="first_name_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Last Name *</label>
                                            <input type="text" id="last_name" name="last_name" class="form-input" 
                                                   value="{{ Auth::user()->last_name ?? '' }}" 
                                                   placeholder="Enter last name" required>
                                            <span class="text-red-500 text-sm hidden" id="last_name_error"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-6">
                                        <label class="form-label">Email Address *</label>
                                        <input type="email" id="email" name="email" class="form-input" 
                                               value="{{ Auth::user()->email ?? '' }}" 
                                               placeholder="Enter email address" required>
                                        <span class="text-red-500 text-sm hidden" id="email_error"></span>
                                    </div>
                                    
                                    <div class="form-group mb-6">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" id="phone" name="phone" class="form-input" 
                                               value="{{ Auth::user()->phone ?? '' }}" 
                                               placeholder="+1 (123) 456-7890">
                                        <span class="text-red-500 text-sm hidden" id="phone_error"></span>
                                    </div>
                                    
                                    <div class="form-group mb-8">
                                        <label class="form-label">Address (For Mobile Services)</label>
                                        <textarea id="address" name="address" class="text-area" 
                                                  placeholder="Enter your address for mobile services" rows="3">{{ Auth::user()->address ?? '' }}</textarea>
                                        <span class="text-red-500 text-sm hidden" id="address_error"></span>
                                    </div>
                                    
                                    <div class="flex">
                                        <button type="button" id="update-profile-btn" class="btn-primary">
                                            <i class="fas fa-save mr-2"></i> Update Profile
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Change Password Tab Content -->
<div id="change-password" class="tab-content hidden">
                                <form id="password-form">
                                    @csrf
                                    <div class="max-w-lg ">
                                        <div class="space-y-6">
                                            <div class="form-group">
                                                <label class="form-label">Current Password *</label>
                                                <div class="relative">
                                                    <input type="password" id="current_password" name="current_password" 
                                                           class="form-input pr-10" placeholder="Enter current password" required>
                                                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 toggle-password" data-target="current_password">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                <span class="text-red-500 text-sm hidden" id="current_password_error"></span>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label">New Password *</label>
                                                <div class="relative">
                                                    <input type="password" id="new_password" name="new_password" 
                                                           class="form-input pr-10" placeholder="Enter new password" required>
                                                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 toggle-password" data-target="new_password">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                <span class="text-red-500 text-sm hidden" id="new_password_error"></span>
                                                <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters long</p>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label">Confirm New Password *</label>
                                                <div class="relative">
                                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                                           class="form-input pr-10" placeholder="Confirm new password" required>
                                                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 toggle-password" data-target="new_password_confirmation">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                <span class="text-red-500 text-sm hidden" id="new_password_confirmation_error"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-8">
                                            <button type="button" id="submit-password-change" class="btn-primary w-full">
                                                <i class="fas fa-key mr-2"></i> Change Password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</main>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // CSRF Token for AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Tab Switching
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            // Update active tab button
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'text-blue-600', 'border-b-2', 'border-blue-600');
                btn.classList.add('text-gray-600');
            });
            this.classList.add('active', 'text-blue-600', 'border-b-2', 'border-blue-600');
            this.classList.remove('text-gray-600');
            
            // Show active tab content
            tabContents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
            
            const activeContent = document.getElementById(tabId);
            if (activeContent) {
                activeContent.classList.remove('hidden');
                activeContent.classList.add('active');
            }
        });
    });
    
    // Profile Button Click Handler
    const updateProfileBtn = document.getElementById('update-profile-btn');
    updateProfileBtn.addEventListener('click', function(e) {
        e.preventDefault();
        updateProfile();
    });
    
    // Password Button Click Handler
    const submitPasswordBtn = document.getElementById('submit-password-change');
    submitPasswordBtn.addEventListener('click', function(e) {
        e.preventDefault();
        changePassword();
    });
    
    // Toggle Password Visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
    
    // Update Profile Function
    function updateProfile() {
        const profileForm = document.getElementById('profile-form');
        const formData = new FormData(profileForm);
        const submitBtn = updateProfileBtn;
        const originalBtnText = submitBtn.innerHTML;
        
        // Clear previous errors
        clearProfileErrors();
        
        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Updating...';
        submitBtn.disabled = true;
        
        fetch('/update-profile', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage('success', data.message);
                // Update form fields with new data if needed
                if (data.user) {
                    document.getElementById('first_name').value = data.user.first_name || '';
                    document.getElementById('last_name').value = data.user.last_name || '';
                    document.getElementById('email').value = data.user.email || '';
                    document.getElementById('phone').value = data.user.phone || '';
                    document.getElementById('address').value = data.user.address || '';
                }
            } else {
                if (data.errors) {
                    displayProfileErrors(data.errors);
                } else {
                    showMessage('error', data.message || 'Failed to update profile');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('error', 'An error occurred. Please try again.');
        })
        .finally(() => {
            submitBtn.innerHTML = originalBtnText;
            submitBtn.disabled = false;
        });
    }
    
    // Change Password Function
    function changePassword() {
        const passwordForm = document.getElementById('password-form');
        const formData = new FormData(passwordForm);
        const submitBtn = document.getElementById('submit-password-change');
        const originalBtnText = submitBtn.innerHTML;
        
        // Clear previous errors
        clearPasswordErrors();
        
        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Changing...';
        submitBtn.disabled = true;
        
        fetch('/change-password', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage('success', data.message);
                // Clear form after success
                passwordForm.reset();
            } else {
                if (data.errors) {
                    displayPasswordErrors(data.errors);
                } else {
                    showMessage('error', data.message || 'Failed to change password');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('error', 'An error occurred. Please try again.');
        })
        .finally(() => {
            submitBtn.innerHTML = originalBtnText;
            submitBtn.disabled = false;
        });
    }
    
    // Display Messages
    function showMessage(type, text) {
        const container = document.getElementById('message-container');
        container.innerHTML = `
            <div class="p-4 rounded-lg ${type === 'success' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200'}">
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                    <span>${text}</span>
                </div>
            </div>
        `;
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            container.innerHTML = '';
        }, 5000);
    }
    
    // Error Display Functions
    function displayProfileErrors(errors) {
        for (const field in errors) {
            const errorElement = document.getElementById(`${field}_error`);
            if (errorElement) {
                errorElement.textContent = errors[field][0];
                errorElement.classList.remove('hidden');
                
                // Add error class to input
                const inputElement = document.getElementById(field);
                if (inputElement) {
                    inputElement.classList.add('border-red-500');
                    inputElement.classList.remove('focus:border-blue-500');
                }
            }
        }
    }
    
    function displayPasswordErrors(errors) {
        for (const field in errors) {
            const errorElement = document.getElementById(`${field}_error`);
            if (errorElement) {
                errorElement.textContent = errors[field][0];
                errorElement.classList.remove('hidden');
                
                // Add error class to input
                const inputElement = document.getElementById(field);
                if (inputElement) {
                    inputElement.classList.add('border-red-500');
                }
            }
        }
    }
    
    // Clear Error Functions
    function clearProfileErrors() {
        document.querySelectorAll('[id$="_error"]').forEach(element => {
            if (!element.id.includes('password')) {
                element.textContent = '';
                element.classList.add('hidden');
            }
        });
        
        // Remove error classes from inputs
        document.querySelectorAll('#first_name, #last_name, #email, #phone, #address').forEach(input => {
            input.classList.remove('border-red-500');
            input.classList.add('focus:border-blue-500');
        });
    }
    
    function clearPasswordErrors() {
        document.querySelectorAll('[id$="_error"]').forEach(element => {
            if (element.id.includes('password')) {
                element.textContent = '';
                element.classList.add('hidden');
            }
        });
        
        // Remove error classes from password inputs
        document.querySelectorAll('#current_password, #new_password, #new_password_confirmation').forEach(input => {
            input.classList.remove('border-red-500');
        });
    }
});

// Tab Switching (force display control)
const tabButtons = document.querySelectorAll('.tab-button');
const tabContents = document.querySelectorAll('.tab-content');

tabButtons.forEach(button => {
    button.addEventListener('click', function () {
        const tabId = this.getAttribute('data-tab');

        // Reset buttons
        tabButtons.forEach(btn => {
            btn.classList.remove('active', 'text-blue-600', 'border-b-2', 'border-blue-600');
            btn.classList.add('text-gray-600');
        });

        this.classList.add('active', 'text-blue-600', 'border-b-2', 'border-blue-600');
        this.classList.remove('text-gray-600');

        // Hide all contents
        tabContents.forEach(content => {
            content.style.display = 'none';
        });

        // Show active
        const activeContent = document.getElementById(tabId);
        if (activeContent) {
            activeContent.style.display = 'block';
        }
    });
});

</script>

<style>
/* Tab Styles */
.tab-button {
    transition: all 0.3s ease;
    position: relative;
    top: 1px;
}

.tab-button.active {
    color: #2563eb;
    border-bottom: 2px solid #2563eb;
}

.tab-button:not(.active):hover {
    color: #4b5563;
}

/* Form Styles */
.form-input {
    width: 100%;
    padding: 0.5rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    transition: all 0.2s;
}

.form-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-input.border-red-500 {
    border-color: #ef4444;
}

.text-area {
    width: 100%;
    padding: 0.5rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    transition: all 0.2s;
    resize: vertical;
}

.text-area:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.25rem;
}

.form-group {
    margin-bottom: 1rem;
}

.btn-primary {
    padding: 0.75rem 1.5rem;
    background-color: #2563eb;
    color: white;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-primary:hover {
    background-color: #1d4ed8;
}

.btn-primary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.dashboard-card {
    background-color: white;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    padding: 1.5rem;
}

/* Toggle Password Button */
.toggle-password {
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
}

.toggle-password:hover {
    color: #4b5563;
}

/* Message Styles */
#message-container .bg-green-100 {
    background-color: #d1fae5;
    border-color: #a7f3d0;
    color: #065f46;
}

#message-container .bg-red-100 {
    background-color: #fee2e2;
    border-color: #fecaca;
    color: #991b1b;
}
</style>
@endsection