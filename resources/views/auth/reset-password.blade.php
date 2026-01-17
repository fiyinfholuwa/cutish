@extends('auth.app')

@section('content')
<body>
    <!-- Reset Password Page -->
    <div id="reset-password-page" class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">
                    <span>C</span><span>H</span>
                </div>
                <h1 style="color: white; position: relative; z-index: 1;">New Password</h1>
                <p style="color: rgba(255, 255, 255, 0.9); position: relative; z-index: 1;">Create a new password for your account</p>
            </div>

            <div class="auth-body">
                <a href="{{ route('login') }}" class="back-link" id="back-from-reset">
                    <i class="fas fa-arrow-left"></i>
                    Back to Login
                </a>

                <div class="page-title">
                    <h1>Reset Password</h1>
                    <p>Create a new password. Make sure it's strong and secure.</p>
                </div>

                <form id="reset-password-form">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <input type="hidden" name="email" value="{{ $request->email }}">

                    <div class="form-group">
                        <label for="new-password" class="form-label">New Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="new-password" name="password" class="form-input" placeholder="Enter new password" required>
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
                            <input type="password" id="confirm-new-password" name="password_confirmation" class="form-input" placeholder="Confirm new password" required>
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
                            <i class="fas fa-spinner loading" style="display:none;"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery & Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // Toggle password visibility
        function togglePassword(id) {
            let input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        function toggleAllPasswords() {
            let show = document.getElementById('show-password-reset').checked;
            document.getElementById('new-password').type = show ? 'text' : 'password';
            document.getElementById('confirm-new-password').type = show ? 'text' : 'password';
        }

        // AJAX form submission
        $(document).ready(function() {
            $('#reset-password-form').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let submitBtn = $('#reset-submit');
                submitBtn.find('span, .fa-key').hide();
                submitBtn.find('.loading').show();

                $.ajax({
                    url: "{{ route('password.store') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        toastr.success("Password reset successful! Redirecting to login...");
                        setTimeout(() => {
                            window.location.href = "{{ route('login') }}";
                        }, 2000);
                    },
                    error: function(xhr) {
                        if(xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            for (let key in errors) {
                                toastr.error(errors[key][0]);
                            }
                        } else {
                            toastr.error("Something went wrong. Please try again.");
                        }
                    },
                    complete: function() {
                        submitBtn.find('span, .fa-key').show();
                        submitBtn.find('.loading').hide();
                    }
                });
            });
        });
    </script>
@endsection
