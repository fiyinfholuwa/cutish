
@extends('auth.app')

@section('content')
<body>
    <!-- Login Page -->
    <div id="login-page" class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">
                    <span>C</span><span>H</span>
                </div>
                <h1 style="color: white; position: relative; z-index: 1;">Welcome Back</h1>
                <p style="color: rgba(255, 255, 255, 0.9); position: relative; z-index: 1;">Sign in to your Cutish Hair account</p>
            </div>
            
            <div class="auth-body">
                <a href="#" class="back-link" id="back-home">
                    <i class="fas fa-arrow-left"></i>
                    Back to Home
                </a>
                
                <form id="login-form">
                    <div id="login-success" class="success-message">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p id="success-text">Login successful! Redirecting...</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="login-email" class="form-label">Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" id="login-email" class="form-input" placeholder="your@email.com" required>
                            <span class="error-message" id="login-email-error">Please enter a valid email address</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="login-password" class="form-label">Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="login-password" class="form-input" placeholder="Enter your password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('login-password')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <span class="error-message" id="login-password-error">Password must be at least 8 characters</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="remember-me">
                            <label for="remember-me">Remember me</label>
                        </div>
                        <div style="text-align: right;">
                            <a href="#" class="auth-link" id="forgot-password-link">Forgot Password?</a>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn-primary" id="login-submit">
                            <span>Sign In</span>
                            <i class="fas fa-sign-in-alt"></i>
                            <i class="fas fa-spinner loading"></i>
                        </button>
                    </div>
                    
                    <div class="divider">
                        <span>or</span>
                    </div>
                    
                    <div class="form-group">
                        <button type="button" class="btn-secondary" id="register-link">
                            <i class="fas fa-user-plus"></i>
                            Create New Account
                        </button>
                    </div>
                </form>
                
                <div class="auth-footer">
                    <p>Don't have an account? <a href="#" class="auth-link" id="register-footer-link">Sign up now</a></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Register Page -->
    <div id="register-page" class="auth-container" style="display: none;">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">
                    <span>C</span><span>H</span>
                </div>
                <h1 style="color: white; position: relative; z-index: 1;">Create Account</h1>
                <p style="color: rgba(255, 255, 255, 0.9); position: relative; z-index: 1;">Join Cutish Hair for premium hairstyling services</p>
            </div>
            
            <div class="auth-body">
                <a href="#" class="back-link" id="back-to-login">
                    <i class="fas fa-arrow-left"></i>
                    Back to Login
                </a>
                
                <form id="register-form">
                    <div id="register-success" class="success-message">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p id="register-success-text">Account created successfully! Redirecting...</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="form-group">
                            <label for="register-first-name" class="form-label">First Name</label>
                            <div class="input-wrapper">
                                <input type="text" id="register-first-name" class="form-input" placeholder="Jane" required>
                                <span class="error-message" id="first-name-error">Please enter your first name</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="register-last-name" class="form-label">Last Name</label>
                            <div class="input-wrapper">
                                <input type="text" id="register-last-name" class="form-input" placeholder="Doe" required>
                                <span class="error-message" id="last-name-error">Please enter your last name</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="register-email" class="form-label">Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" id="register-email" class="form-input" placeholder="your@email.com" required>
                            <span class="error-message" id="register-email-error">Please enter a valid email address</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="register-phone" class="form-label">Phone Number</label>
                        <div class="input-wrapper">
                            <input type="tel" id="register-phone" class="form-input" placeholder="+1 (123) 456-7890" required>
                            <span class="error-message" id="phone-error">Please enter a valid phone number</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="register-password" class="form-label">Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="register-password" class="form-input" placeholder="Create a password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('register-password')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <span class="error-message" id="register-password-error">Password must be at least 8 characters</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Must be at least 8 characters with letters and numbers</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="register-confirm-password" class="form-label">Confirm Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="register-confirm-password" class="form-input" placeholder="Confirm your password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('register-confirm-password')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <span class="error-message" id="confirm-password-error">Passwords do not match</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="terms" required>
                            <label for="terms">
                                I agree to the <a href="#" class="auth-link">Terms of Service</a> and 
                                <a href="#" class="auth-link">Privacy Policy</a>
                            </label>
                        </div>
                        <span class="error-message" id="terms-error">You must agree to the terms</span>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn-primary" id="register-submit">
                            <span>Create Account</span>
                            <i class="fas fa-user-plus"></i>
                            <i class="fas fa-spinner loading"></i>
                        </button>
                    </div>
                </form>
                
                <div class="auth-footer">
                    <p>Already have an account? <a href="#" class="auth-link" id="login-footer-link">Sign in here</a></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Forgot Password Page -->
    <div id="forgot-password-page" class="auth-container" style="display: none;">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">
                    <span>C</span><span>H</span>
                </div>
                <h1 style="color: white; position: relative; z-index: 1;">Reset Password</h1>
                <p style="color: rgba(255, 255, 255, 0.9); position: relative; z-index: 1;">We'll send you a link to reset your password</p>
            </div>
            
            <div class="auth-body">
                <a href="#" class="back-link" id="back-from-forgot">
                    <i class="fas fa-arrow-left"></i>
                    Back to Login
                </a>
                
                <div class="page-title">
                    <h1>Forgot Password?</h1>
                    <p>Enter your email address and we'll send you instructions to reset your password.</p>
                </div>
                
                <form id="forgot-password-form">
                    <div id="forgot-success" class="success-message">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p id="forgot-success-text">Reset link sent! Check your email.</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="forgot-email" class="form-label">Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" id="forgot-email" class="form-input" placeholder="your@email.com" required>
                            <span class="error-message" id="forgot-email-error">Please enter a valid email address</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn-primary" id="forgot-submit">
                            <span>Send Reset Link</span>
                            <i class="fas fa-paper-plane"></i>
                            <i class="fas fa-spinner loading"></i>
                        </button>
                    </div>
                </form>
                
                <div class="auth-footer">
                    <p>Remember your password? <a href="#" class="auth-link" id="login-from-forgot">Sign in here</a></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Reset Password Page -->
    <div id="reset-password-page" class="auth-container" style="display: none;">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">
                    <span>C</span><span>H</span>
                </div>
                <h1 style="color: white; position: relative; z-index: 1;">New Password</h1>
                <p style="color: rgba(255, 255, 255, 0.9); position: relative; z-index: 1;">Create a new password for your account</p>
            </div>
            
            <div class="auth-body">
                <a href="#" class="back-link" id="back-from-reset">
                    <i class="fas fa-arrow-left"></i>
                    Back to Login
                </a>
                
                <div class="page-title">
                    <h1>Reset Password</h1>
                    <p>Create a new password. Make sure it's strong and secure.</p>
                </div>
                
                <form id="reset-password-form">
                    <div id="reset-success" class="success-message">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p id="reset-success-text">Password reset successful! Redirecting to login...</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="new-password" class="form-label">New Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="new-password" class="form-input" placeholder="Enter new password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('new-password')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <span class="error-message" id="new-password-error">Password must be at least 8 characters</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Must be at least 8 characters with letters and numbers</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm-new-password" class="form-label">Confirm New Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="confirm-new-password" class="form-input" placeholder="Confirm new password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('confirm-new-password')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <span class="error-message" id="confirm-new-password-error">Passwords do not match</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="show-password-reset" onclick="toggleAllPasswords()">
                            <label for="show-password-reset">Show passwords</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn-primary" id="reset-submit">
                            <span>Reset Password</span>
                            <i class="fas fa-key"></i>
                            <i class="fas fa-spinner loading"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection