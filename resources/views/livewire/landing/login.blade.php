<div>
    
    <!-- Main Content -->
    <main class="flex min-h-screen bg-gray-50">
        <!-- Left Side - Login Form -->
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <!-- Greeting -->
                <div class="text-left">
                    <p class="text-gray-600 text-lg">Hello, <span class="text-teal-500 font-medium">User</span></p>
                    <h2 class="mt-2 text-4xl font-bold text-gray-900">
                        Sign in to <span class="text-teal-500">PTPI</span>
                    </h2>
                </div>

                <!-- Login Form -->
                <form class="mt-8 space-y-6" action="#" method="POST">
                    <div class="space-y-6">
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>
                            <div class="relative">
                                <input 
                                    id="email" 
                                    name="email" 
                                    type="email" 
                                    autocomplete="email" 
                                    required
                                    value="cwspurnea@gmail.com"
                                    class="appearance-none relative block w-full px-3 py-3 border-2 border-teal-500 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-teal-500 focus:border-teal-500 focus:z-10 sm:text-sm bg-blue-50"
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <input 
                                    id="password" 
                                    name="password" 
                                    type="password" 
                                    autocomplete="current-password" 
                                    required
                                    value="password123"
                                    class="appearance-none relative block w-full px-3 py-3 border-2 border-teal-500 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-teal-500 focus:border-teal-500 focus:z-10 sm:text-sm bg-blue-50"
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" class="text-gray-400 hover:text-gray-600" onclick="togglePassword()">
                                        <svg id="eye-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="text-right">
                            <a href="#" class="text-teal-500 hover:text-teal-600 text-sm font-medium">
                                Forgot password?
                            </a>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <div>
                        <button 
                            type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-teal-500 hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors"
                        >
                            Log In
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="flex items-center justify-center">
                        <div class="flex-1 border-t border-gray-300"></div>
                        <div class="px-4 text-gray-500 text-sm">Or</div>
                        <div class="flex-1 border-t border-gray-300"></div>
                    </div>

                    <!-- Register Buttons -->
                    <div class="space-y-3">
                        <button 
                            type="button"
                            class="w-full flex justify-center py-3 px-4 border-2 border-teal-500 text-sm font-medium rounded-lg text-teal-500 bg-white hover:bg-teal-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors"
                        >
                            Register as Teacher
                        </button>
                        <button 
                            type="button"
                            class="w-full flex justify-center py-3 px-4 border-2 border-teal-500 text-sm font-medium rounded-lg text-teal-500 bg-white hover:bg-teal-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors"
                        >
                            Register as Recruiter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side - Process Steps -->
        <div class="hidden lg:flex flex-1 items-center justify-center bg-white">
            <div class="max-w-md w-full px-8">
                <!-- Steps -->
                <div class="space-y-8">
                    <!-- Step 1 -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-teal-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                1
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Enter Credentials</h3>
                            <p class="text-gray-600 text-sm">Sign in with your registered email and password</p>
                        </div>
                    </div>

                    <!-- Connecting Line -->
                    <div class="ml-4 w-px h-8 bg-gray-300"></div>

                    <!-- Step 2 -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">
                                2
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Login Successful</h3>
                            <p class="text-gray-600 text-sm">Verification and authentication complete</p>
                        </div>
                    </div>

                    <!-- Connecting Line -->
                    <div class="ml-4 w-px h-8 bg-gray-300"></div>

                    <!-- Step 3 -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">
                                3
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Go to Dashboard</h3>
                            <p class="text-gray-600 text-sm">Access your personalized dashboard</p>
                        </div>
                    </div>
                </div>

                <!-- Character Illustration -->
                <div class="mt-12 flex justify-center">
                    <div class="w-64 h-80 bg-gray-100 rounded-lg flex items-center justify-center relative overflow-hidden">
                        <!-- Placeholder for character illustration -->
                        <div class="w-32 h-32 bg-gray-300 rounded-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <!-- Character body -->
                        <div class="absolute bottom-0 w-full h-40 bg-gray-200 rounded-b-lg"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
            } else {
                passwordField.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }

        // Form submission handler
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulate login process
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (email && password) {
                // Add loading state
                const submitBtn = document.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Signing in...';
                submitBtn.disabled = true;
                
                // Simulate API call
                setTimeout(() => {
                    // Update step 2 to active
                    const step2Circle = document.querySelector('.space-y-8 > div:nth-child(3) .w-8');
                    step2Circle.classList.remove('bg-gray-300', 'text-gray-600');
                    step2Circle.classList.add('bg-teal-500', 'text-white');
                    
                    setTimeout(() => {
                        // Update step 3 to active and redirect
                        const step3Circle = document.querySelector('.space-y-8 > div:nth-child(5) .w-8');
                        step3Circle.classList.remove('bg-gray-300', 'text-gray-600');
                        step3Circle.classList.add('bg-teal-500', 'text-white');
                        
                        setTimeout(() => {
                            alert('Login successful! Redirecting to dashboard...');
                            // window.location.href = '/dashboard';
                        }, 1000);
                    }, 1000);
                    
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }, 1500);
            }
        });

        // Add some animations on load
        window.addEventListener('load', function() {
            const formElements = document.querySelectorAll('.space-y-6 > div');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    element.style.transition = 'all 0.5s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 150);
            });
        });
    </script>

    <style>
        /* Custom styles for better visual appeal */
        .space-y-8 > div:not(:first-child) {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Input focus styles */
        input:focus {
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        /* Button hover animations */
        button {
            transition: all 0.3s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .min-h-screen {
                min-height: calc(100vh - 80px);
            }
        }
    </style>

</div>