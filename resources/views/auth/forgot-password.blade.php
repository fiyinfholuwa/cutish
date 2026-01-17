
@extends('auth.app')

@section('content')
<body>
  
   
    
    <!-- Forgot Password Page -->
    <div id="forgot-password-page" class="auth-container" style=";">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">
                    <span>C</span><span>H</span>
                </div>
                <h1 style="color: white; position: relative; z-index: 1;">Reset Password</h1>
                <p style="color: rgba(255, 255, 255, 0.9); position: relative; z-index: 1;">We'll send you a link to reset your password</p>
            </div>
            
            <div class="auth-body">
                <a href="{{ route('login') }}" class="back-link" id="back-from-forgot">
                    <i class="fas fa-arrow-left"></i>
                    Back to Login
                </a>
                
                <div class="page-title">
                    <h1>Forgot Password?</h1>
                    <p>Enter your email address and we'll send you instructions to reset your password.</p>
                </div>
                
                <form id="forgot-password-form">
    @csrf
    <div class="form-group">
        <label for="forgot-email" class="form-label">Email Address</label>
        <div class="input-wrapper">
            <input type="email" id="forgot-email" name="email" class="form-input" placeholder="your@email.com" required>
            <span class="error-message" id="forgot-email-error">Please enter a valid email address</span>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn-primary" id="forgot-submit">
            <span>Send Reset Link</span>
            <i class="fas fa-paper-plane"></i>
            <i class="fas fa-spinner loading" style="display:none;"></i>
        </button>
    </div>
</form>

                <div class="auth-footer">
                    <p>Remember your password? <a href="{{ route('login') }}" class="auth-link" id="login-from-forgot">Sign in here</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function() {
    $('#forgot-password-form').on('submit', function(e) {
        e.preventDefault();

        let email = $('#forgot-email').val();
        let token = $('input[name="_token"]').val();

        // Show spinner
        $('#forgot-submit .loading').show();
        $('#forgot-submit span').hide();

        $.ajax({
            url: "{{ route('password.email') }}", // Laravel default route
            type: "POST",
            data: {
                _token: token,
                email: email
            },
            success: function(response) {
                toastr.success("Reset link sent! Check your email.");
                $('#forgot-email').val('');
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Validation error
                    let errors = xhr.responseJSON.errors;
                    if (errors.email) {
                        toastr.error(errors.email[0]);
                    }
                } else {
                    toastr.error("Something went wrong. Try again later.");
                }
            },
            complete: function() {
                $('#forgot-submit .loading').hide();
                $('#forgot-submit span').show();
            }
        });
    });
});
</script>


@endsection