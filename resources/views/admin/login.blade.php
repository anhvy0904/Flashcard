<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Đăng nhập</h2>

        <form method="POST">
            @csrf
            <div class="mb-4">
                <label for="admin-email" class="block text-gray-600 text-sm font-medium">Email/Username</label>
                <input id="email_username" type="text"
                    class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-red-500 focus:border-red-500 border-gray-300" name = "login"
                    placeholder="Nhập email/username của bạn">
                @error('login')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="admin-password" class="block text-gray-600 text-sm font-medium">Mật khẩu</label>
                <input type="password" id="admin-password"
                    class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-red-500 focus:border-red-500 border-gray-300" name="password"
                    placeholder="Nhập mật khẩu của bạn">
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" id="remember" name="remember" class="mr-2">
                <label for="remember" class="text-gray-600 text-sm">Nhớ mật khẩu</label>
            </div>
            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition">Đăng
                nhập</button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-4">
            <a href="#" class="text-red-600 hover:text-red-800">Quên mật khẩu?</a>
        </p>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        @if (session('error')
            )
            alert('{{ session('error') }}')
        @endif
        @if (session('success'))
            alert('{{ session('success') }}')
        @endif
    })
    </script>
</body>

</html>