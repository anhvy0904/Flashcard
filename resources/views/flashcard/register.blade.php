<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Flashcards</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="bg-light min-vh-100 pt-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('login')}}">FlashCard</a>
            <button class="btn btn-primary btnLogin-popup" onclick="{{route('login')}}">Sign in</button>
        </div>
    </nav>
    <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index: -1;">
        <img src="background.jpg" alt="Background" class="img-fluid w-100 h-100 object-cover">
    </div>
    <!-- Login/Register Popup Section -->
    <div class="bg-light">
        <section class="section">
            <div class="popup-Container position-fixed top-0 start-0 w-100 h-100 bg-transparent backdrop-blur-sm shadow-lg border-start border-white-50 d-flex align-items-center justify-content-center p-4" style="z-index: 100;">
                <span class="position-absolute top-0 end-0 p-3 cursor-pointer d-flex align-items-center justify-content-center rounded-bottom-start">
                    <i class='bx bx-x fs-2 text-dark'></i>
                </span>
                <div class="logreg-box w-50">
                    <!-- Register Form -->
                    <div class="form-box register d-block">
                        <div class="logreg-title text-center mb-4">
                            <h2 class="display-4">Register</h2>
                            <p class="text-muted">Đăng kí vào nền tảng</p>
                        </div>
                        <form method="POST">
                            @csrf
                            <!-- Username Input -->
                            <div class="mb-3 position-relative">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                                @error('username')
                                    <p class="text-danger small mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Email Input -->
                            <div class="mb-3 position-relative">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                @error('email')
                                    <p class="text-danger small mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Password Input -->
                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                @error('password')
                                    <p class="text-danger small mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Confirm Password Input -->
                            <div class="mb-3 position-relative">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                                @error('confirm_password')
                                    <p class="text-danger small mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2">Register</button>
                            <div class="logreg-link text-center mt-3">
                                <p>Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="signIn.js"></script>
</body>

</html>