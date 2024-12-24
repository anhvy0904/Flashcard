<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Flashcards</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">
    <nav class="navbar navbar-light bg-white shadow fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="navbar-brand mb-0 h1">FlashCard</h1>
            <button class="btn btn-primary btnLogin-popup">Sign in</button>
        </div>
    </nav>
    <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden">
        <img src="background.jpg" alt="Background" class="img-fluid w-100 h-100 object-cover">
    </div>

    <!-- Forgot Password Popup Section -->
    <div class="bg-light">
        <section class="section">
            <div class="popup-Container position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center p-3">
                <div class="position-absolute top-0 end-0 p-3">
                    <i class="bx bx-x fs-3 text-dark cursor-pointer"></i>
                </div>
                <div class="logreg-box bg-white rounded-3 shadow-lg p-4 w-50">
                    <!-- Forgot Password Form -->
                    <div class="form-box forgot-password">
                        <div class="logreg-title text-center mb-4">
                            <h2 class="h3">Forgot Password</h2>
                            <p class="text-muted">Please enter your email and verification code</p>
                        </div>
                        <form id="forgot-password-form" method="GET" action="{{ route('user.resetPassword') }}">
                            @csrf
                            <!-- Email Input -->
                            <div class="mb-3 position-relative">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                    <span class="input-group-text"><i class="bx bxs-envelope"></i></span>
                                </div>
                                @error('email')
                                    <p class="text-danger small mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Verification Code Input -->
                            <div class="mb-3 position-relative">
                                <label for="verification_code" class="form-label">Verification Code</label>
                                <div class="input-group">
                                    <input type="text" id="verification_code" name="verification_code" class="form-control" placeholder="Verification Code">
                                    <span class="input-group-text"><i class="bx bxs-key"></i></span>
                                </div>
                                @error('verification_code')
                                    <p class="text-danger small mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                            <!-- Send Code Button -->
                            <button type="button" id="send-code-button" class="btn btn-secondary w-100 mt-3">Send Verification Code</button>
                            <!-- Login Link -->
                            <div class="text-center mt-4">
                                <p class="mb-0">Remembered your password? <a href="{{ route('login') }}" class="text-decoration-none text-primary">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('send-code-button').addEventListener('click', function() {
            let email = document.getElementById('email').value;

            $.ajax({
                url: "{{ route('user.sendMail') }}",
                type: "POST",
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}' 
                },
                success: function(data) {
                    if (data.success) {
                        alert(data.success);
                    } else {
                        alert('An error occurred.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Lỗi: " + textStatus, errorThrown);
                    alert('An error occurred.');
                }
            });
        });
    </script>
</body>

</html>