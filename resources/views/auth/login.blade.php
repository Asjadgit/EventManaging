@extends('layouts.app')

@section('content')
 <style>
        /* Form styles */
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Toggle between login and register */
        .form-container {
            position: relative;
            overflow: hidden;
        }
        .form-panel {
            transition: transform 0.5s ease;
        }
        .register-panel {
            transform: translateX(100%);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
        .form-container.register-active .login-panel {
            transform: translateX(-100%);
        }
        .form-container.register-active .register-panel {
            transform: translateX(0);
        }

        /* Success message */
        .success-message {
            display: none;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-white via-indigo-50 to-purple-50 overflow-hidden">
        <!-- Background Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full floating"></div>
    <div class="absolute top-1/3 right-20 w-16 h-16 bg-indigo-500/20 rounded-full floating" style="animation-delay: 2s;"></div>
    <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-purple-500/20 rounded-full floating" style="animation-delay: 4s;"></div>
    <div class="absolute top-1/2 right-1/4 w-24 h-24 bg-pink-500/10 rounded-full floating" style="animation-delay: 1s;"></div>

    <!-- Background glow -->
    <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute -top-20 -right-20 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl"></div>

    <!-- Login Container -->
    <div class="relative z-10 mt-10 bg-white rounded-2xl shadow-2xl overflow-hidden w-full max-w-md fade-in">
        <div class="p-8">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-2 rounded-lg mr-2">
                        <i class="fas fa-crown"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-900 serif">Eventé</span>
                </div>
                <p class="text-gray-600">Sign in to your account</p>
            </div>

            <!-- Success Message -->
            <div id="success-message" class="success-message">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span id="success-text">Account created successfully! Please log in.</span>
                </div>
            </div>

            <!-- Form Container -->
            <div class="form-container" id="formContainer">
                <!-- Login Form -->
                <div class="form-panel login-panel">
                    <form id="loginForm">
                        <div class="form-group">
                            <label for="login-email" class="form-label">Email Address</label>
                            <input type="email" id="login-email" class="form-input" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <div class="flex justify-between items-center">
                                <label for="login-password" class="form-label">Password</label>
                                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">Forgot password?</a>
                            </div>
                            <input type="password" id="login-password" class="form-input" placeholder="Enter your password" required>
                        </div>

                        <div class="form-group flex items-center">
                            <input type="checkbox" id="remember-me" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="remember-me" class="ml-2 text-sm text-gray-600">Remember me</label>
                        </div>

                        <button type="submit" class="btn-primary text-white w-full py-3 rounded-lg font-semibold shadow-lg mb-6">
                            Sign In
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="flex items-center my-6">
                        <div class="flex-1 border-t border-gray-300"></div>
                        <div class="px-3 text-gray-500 text-sm">Or continue with</div>
                        <div class="flex-1 border-t border-gray-300"></div>
                    </div>

                    <!-- Google Sign In -->
                   <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors mb-6">
                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHZpZXdCb3g9IjAgMCAxOCAxOCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE2LjUxIDkuMjA0NTVDMTYuNTEgOC41NjYzNiAxNi40NDkgNy45NTQ1NSAxNi4zMTYgNy4zNjM2NEg5LjIyVjEwLjg0NTVIMTMuMTg0QzEzLjAyIDEyLjAxODIgMTIuMzAyIDEyLjk3MjcgMTEuMjE2IDEzLjU2ODJWMTUuODk1NUgxNC4wODRDMTUuNzA0IDE0LjMyNzMgMTYuNTEgMTIuMDA5MSAxNi41MSA5LjIwNDU1WiIgZmlsbD0iIzQyODVGNCIvPgo8cGF0aCBkPSJNOS4yMiAxOC4wMDAxQzExLjc5NiAxOC4wMDAxIDEzLjk2IDE3LjE3MjcgMTUuNTI0IDE1Ljg5NTVMMTEuMjE2IDEzLjU2ODJDMTAuMzA3IDE0LjEwOTEgOS4xNTIgMTQuNDE4MiA3Ljg4IDE0LjQxODJDNS4zNTMgMTQuNDE4MiAzLjE5OCAxMi42MzY0IDIuNDM3IDEwLjI5MDlIMC40MTYwMTZWMTIuNzA5MUMxLjk4IDE1LjkxODIgNS4xNTIgMTguMDAwMSA5LjIyIDE4LjAwMDFaIiBmaWxsPSIjMzRBODUzIi8+CjxwYXRoIGQ9Ik0yLjQzNyAxMC4yOTA5QzIuMTM4IDkuNDA5MDkgMi4xMzggOC40MzE4MiAyLjQzNyA3LjU1QzIuNzM2IDYuNjY4MTggMy4zMzUgNS45MjcyNyA0LjE5NCA1LjQwOTA5TDAuNDE2MDE2IDMuMDc3MjdDLTAuNTc0OTg0IDQuOTU0NTUgLTAuMTM1MDE2IDcuMzU0NTUgMS4zNTUgOS4yMDQ1NUwyLjQzNyAxMC4yOTA5WiIgZmlsbD0iI0ZCQkMwNCIvPgo8cGF0aCBkPSJNOS4yMiAzLjU4MTgyQzExLjA1IDMuNTgxODIgMTIuNjM0IDQuMjU0NTUgMTMuNzkgNS40MDkwOUwxNi41MSAyLjY5MDkxQzE0Ljk2IDEuMTg2MzYgMTIuODA1IDAuMjcyNzI3IDkuMjIgMC4yNzI3MjdDNS4xNTIgMC4yNzI3MjcgMS45OCAyLjM1NDU1IDAuNDE2MDE2IDUuNTYzNjRMNC4xOTQgNy44OTU0NUM0Ljk1MyA1LjU1IDcuMTA4IDMuNTgxODIgOS4yMiAzLjU4MTgyWiIgZmlsbD0iI0VBNDMzRiIvPgo8L3N2Zz4K" alt="Google" class="w-5 h-5 mr-3">
                        Continue with Google
                   </a>

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-gray-600">Don't have an account?
                            <button id="showRegister" class="text-indigo-600 font-medium hover:text-indigo-800">Sign up</button>
                        </p>
                    </div>
                </div>

                <!-- Register Form -->
                <div class="form-panel register-panel">
                    <form id="registerForm">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="first-name" class="form-label">First Name</label>
                                <input type="text" id="first-name" class="form-input" placeholder="First name" required>
                            </div>
                            <div class="form-group">
                                <label for="last-name" class="form-label">Last Name</label>
                                <input type="text" id="last-name" class="form-input" placeholder="Last name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="register-email" class="form-label">Email Address</label>
                            <input type="email" id="register-email" class="form-input" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="register-password" class="form-label">Password</label>
                            <input type="password" id="register-password" class="form-input" placeholder="Create a password" required>
                            <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters</p>
                        </div>

                        <div class="form-group">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" id="confirm-password" class="form-input" placeholder="Confirm your password" required>
                        </div>

                        <div class="form-group flex items-center">
                            <input type="checkbox" id="terms" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" required>
                            <label for="terms" class="ml-2 text-sm text-gray-600">
                                I agree to the <a href="#" class="text-indigo-600 hover:text-indigo-800">Terms of Service</a> and <a href="#" class="text-indigo-600 hover:text-indigo-800">Privacy Policy</a>
                            </label>
                        </div>

                        <button type="submit" class="btn-primary text-white w-full py-3 rounded-lg font-semibold shadow-lg mb-6">
                            Create Account
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="flex items-center my-6">
                        <div class="flex-1 border-t border-gray-300"></div>
                        <div class="px-3 text-gray-500 text-sm">Or continue with</div>
                        <div class="flex-1 border-t border-gray-300"></div>
                    </div>

                    <!-- Google Sign Up -->
                    <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors mb-6">
                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHZpZXdCb3g9IjAgMCAxOCAxOCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE2LjUxIDkuMjA0NTVDMTYuNTEgOC41NjYzNiAxNi40NDkgNy45NTQ1NSAxNi4zMTYgNy4zNjM2NEg5LjIyVjEwLjg0NTVIMTMuMTg0QzEzLjAyIDEyLjAxODIgMTIuMzAyIDEyLjk3MjcgMTEuMjE2IDEzLjU2ODJWMTUuODk1NUgxNC4wODRDMTUuNzA0IDE0LjMyNzMgMTYuNTEgMTIuMDA5MSAxNi41MSA5LjIwNDU1WiIgZmlsbD0iIzQyODVGNCIvPgo8cGF0aCBkPSJNOS4yMiAxOC4wMDAxQzExLjc5NiAxOC4wMDAxIDEzLjk2IDE3LjE3MjcgMTUuNTI0IDE1Ljg5NTVMMTEuMjE2IDEzLjU2ODJDMTAuMzA3IDE0LjEwOTEgOS4xNTIgMTQuNDE4MiA3Ljg4IDE0LjQxODJDNS4zNTMgMTQuNDE4MiAzLjE5OCAxMi42MzY0IDIuNDM3IDEwLjI5MDlIMC40MTYwMTZWMTIuNzA5MUMxLjk4IDE1LjkxODIgNS4xNTIgMTguMDAwMSA5LjIyIDE4LjAwMDFaIiBmaWxsPSIjMzRBODUzIi8+CjxwYXRoIGQ9Ik0yLjQzNyAxMC4yOTA5QzIuMTM4IDkuNDA5MDkgMi4xMzggOC40MzE4MiAyLjQzNyA3LjU1QzIuNzM2IDYuNjY4MTggMy4zMzUgNS45MjcyNyA0LjE5NCA1LjQwOTA5TDAuNDE2MDE2IDMuMDc3MjdDLTAuNTc0OTg0IDQuOTU0NTUgLTAuMTM1MDE2IDcuMzU0NTUgMS4zNTUgOS4yMDQ1NUwyLjQzNyAxMC4yOTA5WiIgZmlsbD0iI0ZCQkMwNCIvPgo8cGF0aCBkPSJNOS4yMiAzLjU4MTgyQzExLjA1IDMuNTgxODIgMTIuNjM0IDQuMjU0NTUgMTMuNzkgNS40MDkwOUwxNi41MSAyLjY5MDkxQzE0Ljk2IDEuMTg2MzYgMTIuODA1IDAuMjcyNzI3IDkuMjIgMC4yNzI3MjdDNS4xNTIgMC4yNzI3MjcgMS45OCAyLjM1NDU1IDAuNDE2MDE2IDUuNTYzNjRMNC4xOTQgNy44OTU0NUM0Ljk1MyA1LjU1IDcuMTA4IDMuNTgxODIgOS4yMiAzLjU4MTgyWiIgZmlsbD0iI0VBNDMzRiIvPgo8L3N2Zz4K" alt="Google" class="w-5 h-5 mr-3">
                        Sign up with Google
                    </a>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-gray-600">Already have an account?
                            <button id="showLogin" class="text-indigo-600 font-medium hover:text-indigo-800">Sign in</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 text-center">
            <p class="text-gray-500 text-sm">© 2024 Eventé. All rights reserved.</p>
        </div>
    </div>
    </section>

@pushOnce('scripts')
<script>
        // Scroll animation
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const fadeInObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            fadeElements.forEach(element => {
                fadeInObserver.observe(element);
            });

            // Toggle between login and register forms
            const formContainer = document.getElementById('formContainer');
            const showRegister = document.getElementById('showRegister');
            const showLogin = document.getElementById('showLogin');
            const successMessage = document.getElementById('success-message');
            const successText = document.getElementById('success-text');

            showRegister.addEventListener('click', function() {
                formContainer.classList.add('register-active');
                successMessage.style.display = 'none';
            });

            showLogin.addEventListener('click', function() {
                formContainer.classList.remove('register-active');
                successMessage.style.display = 'none';
            });

            // Form submissions
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');

            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // In a real application, you would send the login data to a server here
                console.log('Login form submitted');
                // For demo purposes, we'll just show a success message
                successText.textContent = 'Login successful! Redirecting...';
                successMessage.style.display = 'block';

                // Redirect to dashboard after 2 seconds
                setTimeout(() => {
                    window.location.href = 'admin-dashboard.html';
                }, 2000);
            });

            registerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // In a real application, you would send the registration data to a server here
                console.log('Register form submitted');

                // For demo purposes, we'll just show a success message and switch to login
                successText.textContent = 'Account created successfully! Please log in.';
                successMessage.style.display = 'block';

                // Switch to login form after 1 second
                setTimeout(() => {
                    formContainer.classList.remove('register-active');
                }, 1000);
            });

            // Google sign in/up buttons
            const googleButtons = document.querySelectorAll('button:has(img[alt="Google"])');
            googleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // In a real application, this would trigger Google OAuth flow
                    console.log('Google authentication initiated');
                    successText.textContent = 'Redirecting to Google authentication...';
                    successMessage.style.display = 'block';

                    // Simulate successful authentication after 2 seconds
                    setTimeout(() => {
                        successText.textContent = 'Authentication successful! Redirecting...';
                        setTimeout(() => {
                            window.location.href = 'admin-dashboard.html';
                        }, 1000);
                    }, 2000);
                });
            });
        });
    </script>
@endPushOnce
@endsection

