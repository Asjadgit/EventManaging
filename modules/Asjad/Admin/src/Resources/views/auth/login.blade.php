<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Secure Access</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <div
                class="mx-auto h-20 w-20 bg-gradient-to-br from-blue-600 to-blue-700 rounded-full flex items-center justify-center mb-6 shadow-lg">
                <i class="fas fa-shield-alt text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Admin Portal</h1>
            <p class="mt-3 text-gray-600 font-medium">Secure Administrator Access</p>
        </div>

       @if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



        <!-- Login Form -->
        <form class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8" method="POST"
            action="{{ route('admin.login') }}">
            @csrf
            <!-- Email Input -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-envelope text-blue-500 mr-1"></i>
                    Email Address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user-circle text-gray-400 text-lg"></i>
                    </div>
                    <input id="email" name="email" type="email" required
                        class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 transition-all duration-200 placeholder-gray-400 text-gray-800 font-medium"
                        placeholder="admin@company.com">
                </div>
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-key text-blue-500 mr-1"></i>
                    Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400 text-lg"></i>
                    </div>
                    <input id="password" name="pass" type="password" required
                        class="w-full pl-12 pr-12 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 transition-all duration-200 placeholder-gray-400 text-gray-800 font-medium"
                        placeholder="••••••••">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button"
                            class="text-gray-400 hover:text-blue-600 transition-colors duration-200 p-2 rounded-lg hover:bg-blue-50">
                            <i class="fas fa-eye-slash text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition duration-200">
                    <label for="remember-me" class="ml-3 block text-sm font-medium text-gray-700">
                        Keep me signed in
                    </label>
                </div>
                <div class="text-sm">
                    <a href="#"
                        class="font-semibold text-blue-600 hover:text-blue-500 transition-colors duration-200 hover:underline">
                        Forgot password?
                    </a>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="group relative w-full flex justify-center items-center py-4 px-6 border border-transparent text-lg font-semibold rounded-xl text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i
                    class="fas fa-sign-in-alt text-blue-200 group-hover:text-white mr-3 transition-colors duration-200"></i>
                Sign In to Dashboard
            </button>

            <!-- Security Alert -->
            <div class="mt-8 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-0.5">
                        <i class="fas fa-exclamation-circle text-blue-500 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-blue-900">
                            Security Advisory
                        </h3>
                        <div class="mt-1 text-sm text-blue-800">
                            <p>This system contains confidential information. Unauthorized access is prohibited.</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Enhanced password visibility toggle
        document.querySelector('button[type="button"]').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
                this.classList.add('text-blue-600');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
                this.classList.remove('text-blue-600');
            }
        });

        // Add input focus effects
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-200', 'rounded-xl');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-200', 'rounded-xl');
            });
        });
    </script>
</body>

</html>
