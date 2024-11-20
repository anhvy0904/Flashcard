<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Flashcards</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="no-text-cursor bg-gray-100 min-h-screen pt-16">
    <nav class="bg-white shadow-lg fixed top-0 w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <h1 class="text-2xl font-bold">FlashCard</h1>
                <button class="bg-sign-in text-white px-4 py-2 rounded-lg hover:bg-opacity-80 btnLogin-popup">Sign
                    in</button>
            </div>
        </div>
    </nav>
    <div class="absolute inset-0 -z-10">
        <img src="background.jpg" alt="Background" class="object-cover w-full h-full">
    </div>
    <!-- Login/Register Popup Section -->
    <div class="bg-gray-100">
        <section class="section">
            <div
                class="popup-Container fixed inset-0 bg-transparent backdrop-blur-sm shadow-lg border-l-2 border-white/10 z-100 flex items-center justify-center p-10 transition-opacity duration-300 ease-in-out">
                <span
                    class="absolute top-0 right-0 w-11 h-11 cursor-pointer flex items-center justify-center rounded-bl-lg">
                    <i class='bx bx-x text-2xl text-gray-800'></i>
                </span>
                <div class="logreg-box w-1/2">
                    <!-- Login Form -->
                    <div class="form-box login block">
                        <div class="logreg-title text-center mb-10 -mt-10">
                            <h2 class="text-4xl">Login</h2>
                            <p class="text-sm font-medium">Please login to use the platform</p>
                        </div>
                        <form method="POST">
                            @csrf
                            <!-- Email Input -->
                            <div class="input-box relative w-full h-12 mb-8 border-b-2">
                                <span class="icon absolute top-1/2 right-0 transform -translate-y-1/2 text-lg"><i
                                        class="bx bxs-envelope"></i></span>
                                <input type="text" name="login" placeholder="Email/Username" 
                                    class="w-full h-full bg-transparent border-none outline-none text-lg font-medium pr-6">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Password Input -->
                            <div class="input-box relative w-full h-12 mb-8 border-b-2">
                                <span class="icon absolute top-1/2 right-0 transform -translate-y-1/2 text-lg"><i
                                        class="bx bxs-lock-alt"></i></span>
                                <input type="password" name="password" placeholder="Password"
                                    class="w-full h-full bg-transparent border-none outline-none text-lg font-medium pr-6">

                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Remember Me & Forgot Password -->
                            <div class="remember-forgot flex justify-between text-sm font-medium mb-4">
                                <label><input type="checkbox" class="accent-white mr-1">Remember me</label>
                                <a href="#" class="text-blue-500 hover:underline">Forgot password?</a>
                            </div>
                            <button type="submit"
                                class="btn w-full h-12 bg-blue-500 border-none rounded-full shadow-lg text-lg text-gray-800 font-semibold">Login</button>
                            <div class="logreg-link text-sm text-center font-medium my-6">
                                <p>Don't have an account? <a href="{{ route('register') }}"
                                        class="register-link text-blue-500 font-semibold hover:underline">Register</a>
                                </p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
    </div>
    </section>
    </div>
    <script src="signIn.js"></script>
</body>

</html>