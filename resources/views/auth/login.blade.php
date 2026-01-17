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
</style>

<div id="login-page" class="auth-container">
    <div class="auth-card">

        {{-- HEADER --}}
        <div class="auth-header">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('logo.png') }}"
                         style="height:120px;width:120px;object-fit:contain;">
                </a>
            </div>
            <h1 class="text-white">Welcome Back</h1>
            <p class="text-white-50" style="font-size:12px;">
                Sign in to your Cutish Hair account
            </p>
        </div>

        <div class="auth-body">

            <a href="{{ route('home') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>

            {{-- GLOBAL ERROR --}}
            <div id="login-error" class="error-message mb-3" style="display:none;"></div>

            <form id="login-form" action="{{ route('login') }}" method="POST">
                @csrf

                {{-- EMAIL --}}
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email"
                           name="email"
                           class="form-input"
                           placeholder="your@email.com"
                           required>
                    <span class="error-message" data-error="email"></span>
                </div>

                {{-- PASSWORD --}}
                <div class="form-group password-wrapper">
                    <label>Password</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-input"
                           placeholder="Enter your password"
                           required>

                    <span class="toggle-password" id="togglePassword">
                        👁
                    </span>

                    <span class="error-message" data-error="password"></span>
                </div>

                {{-- REMEMBER --}}
                <div class="form-group d-flex justify-content-between">
                    <div>
                        <input type="checkbox" name="remember"> Remember me
                    </div>
                    <a href="{{ route('password.request') }}" class="auth-link">
                        Forgot Password?
                    </a>
                </div>

                <button type="submit" class="btn-primary w-100" id="loginBtn">
                    <span id="btnText">Sign In</span>
                    <span class="spinner" id="btnSpinner" style="display:none;"></span>
                </button>
            </form>

            <div class="auth-footer">
                <p>
                    Don't have an account?
                    <a href="{{ route('register') }}" class="auth-link">Sign up now</a>
                </p>
            </div>

        </div>
    </div>
</div>

{{-- AJAX SCRIPT --}}
<script>
/* SHOW / HIDE PASSWORD */
document.getElementById('togglePassword').addEventListener('click', function () {
    const password = document.getElementById('password');
    password.type = password.type === 'password' ? 'text' : 'password';
});

/* AJAX LOGIN */
document.getElementById('login-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    // Clear errors
    document.getElementById('login-error').style.display = 'none';
    document.querySelectorAll('[data-error]').forEach(el => el.textContent = '');

    // Loading state
    const btn = document.getElementById('loginBtn');
    document.getElementById('btnText').textContent = 'Logging in...';
    document.getElementById('btnSpinner').style.display = 'inline-block';
    btn.classList.add('btn-loading');

    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        });

        if (response.ok) {
            window.location.href = "{{ route('check_login') }}";
            return;
        }

        const data = await response.json();

        if (response.status === 422) {
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    const el = document.querySelector(`[data-error="${field}"]`);
                    if (el) el.textContent = data.errors[field][0];
                });
            } else if (data.message) {
                const global = document.getElementById('login-error');
                global.textContent = data.message;
                global.style.display = 'block';
            }
        }

    } catch (err) {
        const global = document.getElementById('login-error');
        global.textContent = 'Something went wrong. Please try again.';
        global.style.display = 'block';
    } finally {
        // Reset button
        document.getElementById('btnText').textContent = 'Sign In';
        document.getElementById('btnSpinner').style.display = 'none';
        btn.classList.remove('btn-loading');
    }
});
</script>
@endsection
