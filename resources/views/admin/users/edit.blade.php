<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-center mb-6">
            <img src="/dist/assets/img/logo/logo.png" alt="Custom Logo" width="50%" height="auto">
        </div>
        <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" type="text" name="name" value="{{ $user->name }}" required autofocus autocomplete="name" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ $user->email }}" required autocomplete="username" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>


            <div class="mt-4">
                <label for="designation" class="block text-sm font-medium text-gray-700">Designation</label>
                <select name="designation" id="designation" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Admin" {{ old('designation', $user->designation ?? '') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="User" {{ old('designation', $user->designation ?? '') == 'User' ? 'selected' : '' }}>User</option>
                </select>
            </div>


            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" autocomplete="new-password" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <div class="text-red-500" id="errorMessage"></div>
            </div>


            <div class="flex items-center justify-end mt-4">
                <!-- <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Already registered?</a> -->
                <button type="submit" class="ml-3 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Update</button>
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
