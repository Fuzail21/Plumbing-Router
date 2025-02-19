<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-center mb-6">
            <img src="/dist/assets/img/logo/logo.png" alt="Custom Logo" width="50%" height="auto">
        </div>
        <form method="POST" action="/login">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <div class="text-red-500" id="errorMessage"></div>

            </div>
            
            <div class="flex items-center justify-end mt-4">
                <a href="/register" class="text-sm text-gray-600 hover:text-gray-900">Create Account</a>
                <button type="submit" class="ml-3 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Log in</button>
            </div>
        </form>
    </div>



    <script>
        document.getElementById('password').addEventListener('input', function () {
            var password = this.value;
            var passwordField = this;
            var errorMessageElement = document.getElementById('errorMessage');

            if (password.length > 6) {
                passwordField.classList.add('border-red-500');
                errorMessageElement.textContent = "Only 6 digits are allowed.";
            } else {
                passwordField.classList.remove('border-red-500');
                errorMessageElement.textContent = "";
            }
        });

        document.getElementById('password').addEventListener('blur', function () {
            var password = this.value;
            var passwordField = this;
            var errorMessageElement = document.getElementById('errorMessage');

            if (password.length < 6) {
                passwordField.classList.add('border-red-500');
                errorMessageElement.textContent = "6 digits required.";
            }
        });
    </script>
</body>
</html>
