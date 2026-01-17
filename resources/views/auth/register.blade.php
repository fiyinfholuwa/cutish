@extends('auth.app')

@section('content')
<body>
<style>
    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }

    .btn-loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .spinner {
        width: 16px;
        height: 16px;
        border: 2px solid #fff;
        border-top: 2px solid transparent;
        border-radius: 50%;
        display: inline-block;
        animation: spin 0.7s linear infinite;
        margin-left: 8px;
        vertical-align: middle;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .password-wrapper {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 14px;
        color: #666;
    }

    .success-message {
        color: green;
        font-weight: bold;
        display: none;
        margin-bottom: 12px;
    }
</style>

<div id="register-page" class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="logo">
                <span>C</span><span>H</span>
            </div>
            <h1 style="color: white;">Create Account</h1>
            <p style="color: rgba(255,255,255,0.9); font-size:12px;">Join Cutish Hair for premium hairstyling services</p>
        </div>
        
        <div class="auth-body">
            <form id="register-form" action="{{ route('register') }}" method="POST">
                @csrf

                <div id="register-success" class="success-message">Account created successfully! Redirecting...</div>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-input" placeholder="Jane" required>
                    <span class="error-message" data-error="first_name"></span>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-input" placeholder="Doe" required>
                    <span class="error-message" data-error="last_name"></span>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="your@email.com" required>
                    <span class="error-message" data-error="email"></span>
                </div>

                <div style="display:none;" class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" class="form-input" placeholder="+1 (123) 456-7890" >
                    <span class="error-message" data-error="phone"></span>
                </div>

                <div class="form-group password-wrapper">
                    <label>Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Create a password" required>
                    <span class="toggle-password" onclick="togglePassword(this)">👁</span>
                    <span class="error-message" data-error="password"></span>
                </div>

                <div class="form-group password-wrapper">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm password" required>
                    <span class="toggle-password" onclick="togglePassword(this)">👁</span>
                    <span class="error-message" data-error="password_confirmation"></span>
                </div>

                <div class="form-group">
                    <label><input type="checkbox" name="terms"> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                    <span class="error-message" data-error="terms"></span>
                </div>

                <div class="form-group">
                    <button type="submit" id="register-submit" class="btn-primary">
                        <span id="btnText">Create Account</span>
                        <i class="fas fa-spinner spinner" id="btnSpinner" style="display:none;"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Show/hide password
    function togglePassword(el) {
        const input = el.parentElement.querySelector('input[type="password"], input[type="text"]');
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    // AJAX REGISTER
    const form = document.getElementById('register-form');
    form.addEventListener('submit', async function(e){
        e.preventDefault();

        // Clear previous errors
        document.querySelectorAll('[data-error]').forEach(el => el.textContent = '');
        document.getElementById('register-success').style.display = 'none';

        const btn = document.getElementById('register-submit');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');

        btnText.textContent = 'Registering...';
        btnSpinner.style.display = 'inline-block';
        btn.classList.add('btn-loading');

        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {'X-Requested-With':'XMLHttpRequest','X-CSRF-TOKEN':document.querySelector('input[name="_token"]').value},
                body: formData
            });

            const data = await response.json();

            if(response.ok){
                document.getElementById('register-success').style.display = 'block';
                setTimeout(()=>{ window.location.href = data.redirect; }, 1200);
                return;
            }

            if(response.status === 422 && data.errors){
                Object.keys(data.errors).forEach(field=>{
                    const el = document.querySelector(`[data-error="${field}"]`);
                    if(el) el.textContent = data.errors[field][0];
                });
            }

        } catch(err){
            alert('Something went wrong. Please try again.');
        } finally {
            btnText.textContent = 'Create Account';
            btnSpinner.style.display = 'none';
            btn.classList.remove('btn-loading');
        }
    });
</script>
@endsection
