<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cutish Hair - Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #D1AE6C;
            --dark: #363435;
            --pink: #F18F91;
            --white: #FFFFFF;
            --light: #F8F7F4;
            --cream: #FFFCF8;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }
        
        .gold-bg { background-color: var(--gold); }
        .gold-text { color: var(--gold); }
        .dark-bg { background-color: var(--dark); }
        .dark-text { color: var(--dark); }
        .pink-bg { background-color: var(--pink); }
        .pink-text { color: var(--pink); }
        .light-bg { background-color: var(--light); }
        .cream-bg { background-color: var(--cream); }
        
        .auth-container {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
        }
        
        .auth-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            {{-- box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1); --}}
            position: relative;
        }
        
        .auth-header {
            background: linear-gradient(135deg, var(--gold) 0%, #E0C080 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .auth-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1560066984-138dadb4c035?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            mix-blend-mode: overlay;
        }
        
        .logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            margin-bottom: 20px;
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            position: relative;
            z-index: 1;
        }
        
        .logo span:first-child {
            color: var(--pink);
        }
        
        .logo span:last-child {
            color: var(--gold);
        }
        
        .auth-body {
            padding: 40px;
        }
        
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
            font-size: 15px;
        }
        
        .form-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            background: var(--white);
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(209, 174, 108, 0.1);
        }
        
        .form-input.error {
            border-color: #ef4444;
        }
        
        .error-message {
            color: #ef4444;
            font-size: 14px;
            margin-top: 6px;
            display: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--gold) 0%, #E0C080 100%);
            color: var(--dark);
            font-weight: 600;
            padding: 18px 30px;
            border-radius: 12px;
            border: none;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(209, 174, 108, 0.2);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(209, 174, 108, 0.3);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .btn-secondary {
            background: transparent;
            color: var(--dark);
            font-weight: 600;
            padding: 18px 30px;
            border-radius: 12px;
            border: 2px solid var(--gold);
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background-color: rgba(209, 174, 108, 0.1);
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #e5e7eb;
        }
        
        .auth-link {
            color: var(--gold);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .auth-link:hover {
            color: var(--pink);
            text-decoration: underline;
        }
        
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }
        
        .back-link:hover {
            color: var(--gold);
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            border: 2px solid #e5e7eb;
            border-radius: 6px;
            cursor: pointer;
        }
        
        .checkbox-group label {
            cursor: pointer;
            font-size: 15px;
            color: var(--dark);
        }
        
        .success-message {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(34, 197, 94, 0.2) 100%);
            border: 2px solid rgba(34, 197, 94, 0.3);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            display: none;
        }
        
        .success-icon {
            color: #16a34a;
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .page-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--dark);
        }
        
        .page-title h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .page-title p {
            color: #6b7280;
            font-size: 16px;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }
        
        .divider span {
            padding: 0 15px;
            color: #6b7280;
            font-size: 14px;
        }
        
        @media (max-width: 480px) {
            .auth-body {
                padding: 30px 20px;
            }
            
            .auth-header {
                padding: 30px 20px;
            }
            
            .form-input {
                padding: 14px 16px;
            }
            
            .btn-primary,
            .btn-secondary {
                padding: 16px 20px;
            }
        }
        
        .loading {
            display: none;
        }
        
        .loading.active {
            display: inline-block;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>


@yield('content')

    <script>
        

        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const toggleBtn = input.parentNode.querySelector('.password-toggle i');
            
            if (input.type === 'password') {
                input.type = 'text';
                toggleBtn.classList.remove('fa-eye');
                toggleBtn.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                toggleBtn.classList.remove('fa-eye-slash');
                toggleBtn.classList.add('fa-eye');
            }
        }

        // Toggle all passwords on reset page
        function toggleAllPasswords() {
            const showPassword = document.getElementById('show-password-reset').checked;
            const newPassword = document.getElementById('new-password');
            const confirmPassword = document.getElementById('confirm-new-password');
            
            newPassword.type = showPassword ? 'text' : 'password';
            confirmPassword.type = showPassword ? 'text' : 'password';
        }

        // Show loading state
        function showLoading(buttonId) {
            const button = document.getElementById(buttonId);
            const spinner = button.querySelector('.loading');
            const icon = button.querySelector('.fa:not(.loading)');
            
            if (spinner && icon) {
                button.disabled = true;
                icon.style.display = 'none';
                spinner.classList.add('active');
            }
        }

        // Hide loading state
        function hideLoading(buttonId) {
            const button = document.getElementById(buttonId);
            const spinner = button.querySelector('.loading');
            const icon = button.querySelector('.fa:not(.loading)');
            
            if (spinner && icon) {
                button.disabled = false;
                icon.style.display = 'inline-block';
                spinner.classList.remove('active');
            }
        }

        // Show success message
        function showSuccess(formId, message) {
            const successDiv = document.getElementById(`${formId}-success`);
            const successText = document.getElementById(`${formId}-success-text`);
            
            if (successDiv && successText) {
                successText.textContent = message;
                successDiv.style.display = 'block';
                
                // Scroll to success message
                successDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }

        // Hide success message
        function hideSuccess(formId) {
            const successDiv = document.getElementById(`${formId}-success`);
            if (successDiv) {
                successDiv.style.display = 'none';
            }
        }

        // Show error message
        function showError(inputId, message) {
            const input = document.getElementById(inputId);
            const errorSpan = document.getElementById(`${inputId}-error`);
            
            if (input && errorSpan) {
                input.classList.add('error');
                errorSpan.textContent = message;
                errorSpan.style.display = 'block';
            }
        }

        // Hide error message
        function hideError(inputId) {
            const input = document.getElementById(inputId);
            const errorSpan = document.getElementById(`${inputId}-error`);
            
            if (input && errorSpan) {
                input.classList.remove('error');
                errorSpan.style.display = 'none';
            }
        }

        // Validate email
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Validate phone
        function validatePhone(phone) {
            const re = /^[\+]?[1-9][\d]{0,15}$/;
            return re.test(phone.replace(/[\s\(\)\-]/g, ''));
        }

        // Validate password strength
        function validatePassword(password) {
            return password.length >= 8 && /\d/.test(password) && /[a-zA-Z]/.test(password);
        }

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            // Show login page by default
            showPage('login');
            
            // Set up event listeners
            setupEventListeners();
        });

        // Setup event listeners
        function setupEventListeners() {
            // Navigation Links
            document.getElementById('register-link')?.addEventListener('click', function(e) {
                e.preventDefault();
                showPage('register');
            });
            
            document.getElementById('register-footer-link')?.addEventListener('click', function(e) {
                e.preventDefault();
                showPage('register');
            });
            
            document.getElementById('forgot-password-link')?.addEventListener('click', function(e) {
                e.preventDefault();
                showPage('forgotPassword');
            });
            
            document.getElementById('login-footer-link')?.addEventListener('click', function(e) {
                e.preventDefault();
                showPage('login');
            });
            
            document.getElementById('login-from-forgot')?.addEventListener('click', function(e) {
                e.preventDefault();
                showPage('login');
            });
            
            document.getElementById('back-to-login')?.addEventListener('click', function(e) {
                e.preventDefault();
                showPage('login');
            });
            
            document.getElementById('back-from-forgot')?.addEventListener('click', function(e) {
                e.preventDefault();
                showPage('login');
            });
            
            document.getElementById('back-from-reset')?.addEventListener('click', function(e) {
                e.preventDefault();
                showPage('login');
            });
            
            document.getElementById('back-home')?.addEventListener('click', function(e) {
                e.preventDefault();
                alert('This would redirect to the main website');
            });
            
            // Form Submissions
            document.getElementById('login-form')?.addEventListener('submit', function(e) {
                e.preventDefault();
                handleLogin();
            });
            
            document.getElementById('register-form')?.addEventListener('submit', function(e) {
                e.preventDefault();
                handleRegister();
            });
            
            document.getElementById('forgot-password-form')?.addEventListener('submit', function(e) {
                e.preventDefault();
                handleForgotPassword();
            });
            
            document.getElementById('reset-password-form')?.addEventListener('submit', function(e) {
                e.preventDefault();
                handleResetPassword();
            });
            
            // Real-time validation
            setupRealTimeValidation();
        }

        // Setup real-time form validation
        function setupRealTimeValidation() {
            // Login form validation
            const loginEmail = document.getElementById('login-email');
            const loginPassword = document.getElementById('login-password');
            
            loginEmail?.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    hideError('login-email');
                } else if (!validateEmail(this.value.trim())) {
                    showError('login-email', 'Please enter a valid email address');
                } else {
                    hideError('login-email');
                }
            });
            
            loginPassword?.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    hideError('login-password');
                } else if (this.value.length < 8) {
                    showError('login-password', 'Password must be at least 8 characters');
                } else {
                    hideError('login-password');
                }
            });
            
            // Register form validation
            const registerEmail = document.getElementById('register-email');
            const registerPassword = document.getElementById('register-password');
            const confirmPassword = document.getElementById('register-confirm-password');
            const phone = document.getElementById('register-phone');
            const firstName = document.getElementById('register-first-name');
            const lastName = document.getElementById('register-last-name');
            
            firstName?.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    showError('first-name', 'Please enter your first name');
                } else {
                    hideError('first-name');
                }
            });
            
            lastName?.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    showError('last-name', 'Please enter your last name');
                } else {
                    hideError('last-name');
                }
            });
            
            registerEmail?.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    hideError('register-email');
                } else if (!validateEmail(this.value.trim())) {
                    showError('register-email', 'Please enter a valid email address');
                } else {
                    hideError('register-email');
                }
            });
            
            phone?.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    hideError('phone');
                } else if (!validatePhone(this.value.trim())) {
                    showError('phone', 'Please enter a valid phone number');
                } else {
                    hideError('phone');
                }
            });
            
            registerPassword?.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    hideError('register-password');
                } else if (!validatePassword(this.value)) {
                    showError('register-password', 'Password must be at least 8 characters with letters and numbers');
                } else {
                    hideError('register-password');
                }
                
                // Also validate confirm password
                if (confirmPassword && confirmPassword.value.trim() !== '') {
                    if (this.value !== confirmPassword.value) {
                        showError('confirm-password', 'Passwords do not match');
                    } else {
                        hideError('confirm-password');
                    }
                }
            });
            
            confirmPassword?.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    hideError('confirm-password');
                } else if (registerPassword && this.value !== registerPassword.value) {
                    showError('confirm-password', 'Passwords do not match');
                } else {
                    hideError('confirm-password');
                }
            });
            
            // Forgot password email validation
            const forgotEmail = document.getElementById('forgot-email');
            
            forgotEmail?.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    hideError('forgot-email');
                } else if (!validateEmail(this.value.trim())) {
                    showError('forgot-email', 'Please enter a valid email address');
                } else {
                    hideError('forgot-email');
                }
            });
            
            // Reset password validation
            const newPassword = document.getElementById('new-password');
            const confirmNewPassword = document.getElementById('confirm-new-password');
            
            newPassword?.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    hideError('new-password');
                } else if (!validatePassword(this.value)) {
                    showError('new-password', 'Password must be at least 8 characters with letters and numbers');
                } else {
                    hideError('new-password');
                }
                
                // Also validate confirm password
                if (confirmNewPassword && confirmNewPassword.value.trim() !== '') {
                    if (this.value !== confirmNewPassword.value) {
                        showError('confirm-new-password', 'Passwords do not match');
                    } else {
                        hideError('confirm-new-password');
                    }
                }
            });
            
            confirmNewPassword?.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    hideError('confirm-new-password');
                } else if (newPassword && this.value !== newPassword.value) {
                    showError('confirm-new-password', 'Passwords do not match');
                } else {
                    hideError('confirm-new-password');
                }
            });
        }

        // Handle login
        function handleLogin() {
            const email = document.getElementById('login-email').value.trim();
            const password = document.getElementById('login-password').value;
            
            // Hide previous success messages
            hideSuccess('login');
            
            // Validate
            let isValid = true;
            
            if (!email) {
                showError('login-email', 'Email is required');
                isValid = false;
            } else if (!validateEmail(email)) {
                showError('login-email', 'Please enter a valid email address');
                isValid = false;
            }
            
            if (!password) {
                showError('login-password', 'Password is required');
                isValid = false;
            } else if (password.length < 8) {
                showError('login-password', 'Password must be at least 8 characters');
                isValid = false;
            }
            
            if (!isValid) return;
            
            // Show loading
            showLoading('login-submit');
            
            // Simulate API call
            setTimeout(() => {
                // For demo purposes, always succeed
                hideLoading('login-submit');
                showSuccess('login', 'Login successful! Redirecting to dashboard...');
                
                // Simulate redirect to dashboard
                setTimeout(() => {
                    alert('Redirecting to dashboard...');
                    // In real app: window.location.href = '/dashboard.html';
                }, 2000);
            }, 1500);
        }

        // Handle register
        function handleRegister() {
            const firstName = document.getElementById('register-first-name').value.trim();
            const lastName = document.getElementById('register-last-name').value.trim();
            const email = document.getElementById('register-email').value.trim();
            const phone = document.getElementById('register-phone').value.trim();
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('register-confirm-password').value;
            const termsAccepted = document.getElementById('terms').checked;
            
            // Hide previous success messages
            hideSuccess('register');
            
            // Validate
            let isValid = true;
            
            if (!firstName) {
                showError('first-name', 'First name is required');
                isValid = false;
            }
            
            if (!lastName) {
                showError('last-name', 'Last name is required');
                isValid = false;
            }
            
            if (!email) {
                showError('register-email', 'Email is required');
                isValid = false;
            } else if (!validateEmail(email)) {
                showError('register-email', 'Please enter a valid email address');
                isValid = false;
            }
            
            if (!phone) {
                showError('phone', 'Phone number is required');
                isValid = false;
            } else if (!validatePhone(phone)) {
                showError('phone', 'Please enter a valid phone number');
                isValid = false;
            }
            
            if (!password) {
                showError('register-password', 'Password is required');
                isValid = false;
            } else if (!validatePassword(password)) {
                showError('register-password', 'Password must be at least 8 characters with letters and numbers');
                isValid = false;
            }
            
            if (!confirmPassword) {
                showError('confirm-password', 'Please confirm your password');
                isValid = false;
            } else if (password !== confirmPassword) {
                showError('confirm-password', 'Passwords do not match');
                isValid = false;
            }
            
            if (!termsAccepted) {
                showError('terms', 'You must agree to the terms and conditions');
                isValid = false;
            }
            
            if (!isValid) return;
            
            // Show loading
            showLoading('register-submit');
            
            // Simulate API call
            setTimeout(() => {
                // For demo purposes, always succeed
                hideLoading('register-submit');
                showSuccess('register', 'Account created successfully! Welcome to Cutish Hair.');
                
                // Simulate redirect to dashboard
                setTimeout(() => {
                    alert('Account created! Redirecting to dashboard...');
                    // In real app: window.location.href = '/dashboard.html';
                }, 2000);
            }, 2000);
        }

        // Handle forgot password
        function handleForgotPassword() {
            const email = document.getElementById('forgot-email').value.trim();
            
            // Hide previous success messages
            hideSuccess('forgot');
            
            // Validate
            if (!email) {
                showError('forgot-email', 'Email is required');
                return;
            }
            
            if (!validateEmail(email)) {
                showError('forgot-email', 'Please enter a valid email address');
                return;
            }
            
            // Show loading
            showLoading('forgot-submit');
            
            // Simulate API call
            setTimeout(() => {
                // For demo purposes, always succeed
                hideLoading('forgot-submit');
                showSuccess('forgot', `Password reset link has been sent to ${email}. Check your email.`);
                
                // Clear form
                document.getElementById('forgot-password-form').reset();
                
                // Optionally redirect to reset page after success
                setTimeout(() => {
                    showPage('resetPassword');
                }, 3000);
            }, 1500);
        }

        // Handle reset password
        function handleResetPassword() {
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-new-password').value;
            
            // Hide previous success messages
            hideSuccess('reset');
            
            // Validate
            let isValid = true;
            
            if (!newPassword) {
                showError('new-password', 'New password is required');
                isValid = false;
            } else if (!validatePassword(newPassword)) {
                showError('new-password', 'Password must be at least 8 characters with letters and numbers');
                isValid = false;
            }
            
            if (!confirmPassword) {
                showError('confirm-new-password', 'Please confirm your password');
                isValid = false;
            } else if (newPassword !== confirmPassword) {
                showError('confirm-new-password', 'Passwords do not match');
                isValid = false;
            }
            
            if (!isValid) return;
            
            // Show loading
            showLoading('reset-submit');
            
            // Simulate API call
            setTimeout(() => {
                // For demo purposes, always succeed
                hideLoading('reset-submit');
                showSuccess('reset', 'Password reset successful! You can now login with your new password.');
                
                // Clear form
                document.getElementById('reset-password-form').reset();
                
                // Redirect to login page after success
                setTimeout(() => {
                    showPage('login');
                }, 2000);
            }, 1500);
        }

        // Simulate password reset link click (for demo)
        function simulateResetLink() {
            showPage('resetPassword');
        }
    </script>
</body>
</html>