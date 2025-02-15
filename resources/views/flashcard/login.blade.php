<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Flashcards</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

    <!-- Login/Register Popup Section -->
    <div class="bg-light">
        <section class="section">
            <div class="popup-Container position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center p-3">
                <div class="position-absolute top-0 end-0 p-3">
                    <i class="bx bx-x fs-3 text-dark cursor-pointer"></i>
                </div>
                <div class="logreg-box bg-white rounded-3 shadow-lg p-4 w-50">
                    <!-- Login Form -->
                    <div class="form-box login">
                        <div class="logreg-title text-center mb-4">
                            <h2 class="h3">Login</h2>
                            <p class="text-muted">Đăng nhập vào nền tảng</p>
                        </div>
                        <form method="POST">
                            @csrf
                            <!-- Email Input -->
                            <div class="mb-3 position-relative">
                                <label for="login" class="form-label">Email/Username</label>
                                <div class="input-group">
                                    <input type="text" id="login" name="login" class="form-control"
                                        placeholder="Email/Username">
                                    <span class="input-group-text"><i class="bx bxs-envelope"></i></span>
                                </div>
                                @error('email')
                                    <p class="text-danger small mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Password Input -->
                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Password">
                                    <span class="input-group-texat"><i class="bx bxs-lock-alt"></i></span>
                                </div>
                                @error('password')
                                    <p class="text-danger small mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <a href="{{route('user.forgotPassword')}}" class="text-decoration-none text-primary">Forgot password?</a>
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                            <!-- Register Link -->
                            <div class="text-center mt-4">
                                <p class="mb-0">Don't have an account? <a href="{{ route('register') }}"
                                        class="text-decoration-none text-primary">Register</a></p>
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
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('error'))
                alert('{{ session('error') }}');
            @endif
            @if (session('success'))
                alert('{{ session('success') }}');
            @endif
        });
    </script>
</body>

</html>
