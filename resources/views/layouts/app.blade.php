<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTP Institute - Private Teacher Provider Institute</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'teal': {
                            500: '#14b8a6',
                            600: '#0d9488',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-800">PTP INSTITUTE</h1>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center space-x-3">
                    <button class="bg-teal-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-teal-600">
                        Give Job
                    </button>

                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-50">
                                logout </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" 
                            class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-50">
                            Login
                        </a>
                        <a href="{{ route('register') }}" wire:navigate
                            class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-50">
                            Register as Teacher
                        </a>
                    @endauth
                    <a href=""
                        class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-50">
                        Become Sign Up
                    </a>
                </div>
            </div>
        </div>
    </header>
    {{ $slot }}
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Tutors Column -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tutors</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Become a tutor</a></li>
                        <li><a href="#" class="hover:text-white">Tutor application</a></li>
                        <li><a href="#" class="hover:text-white">Tutor resources</a></li>
                        <li><a href="#" class="hover:text-white">About</a></li>
                        <li><a href="#" class="hover:text-white">Press</a></li>
                        <li><a href="#" class="hover:text-white">Event Center</a></li>
                        <li><a href="#" class="hover:text-white">Career</a></li>
                    </ul>
                </div>

                <!-- Top Services Column -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Top Services</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Maths Tutors</a></li>
                        <li><a href="#" class="hover:text-white">Physics Tutors</a></li>
                        <li><a href="#" class="hover:text-white">Chemistry Tutors</a></li>
                        <li><a href="#" class="hover:text-white">Hindi Tutors</a></li>
                        <li><a href="#" class="hover:text-white">English Tutors</a></li>
                        <li><a href="#" class="hover:text-white">Science Tutors</a></li>
                    </ul>
                </div>

                <!-- Students Column -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Students</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Tips for hiring</a></li>
                        <li><a href="#" class="hover:text-white">Online tutoring</a></li>
                        <li><a href="#" class="hover:text-white">In-person tutoring</a></li>
                        <li><a href="#" class="hover:text-white">Find online tutors</a></li>
                        <li><a href="#" class="hover:text-white">Online learning</a></li>
                        <li><a href="#" class="hover:text-white">Explore with us</a></li>
                    </ul>
                </div>

                <!-- Tutors Jobs Column -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tutors Jobs</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Chemistry Jobs</a></li>
                        <li><a href="#" class="hover:text-white">Physics Jobs</a></li>
                        <li><a href="#" class="hover:text-white">Maths Jobs</a></li>
                        <li><a href="#" class="hover:text-white">Online assignment Jobs</a></li>
                        <li><a href="#" class="hover:text-white">Online homework for teaching</a></li>
                        <li><a href="#" class="hover:text-white">Tutoring</a></li>
                        <li><a href="#" class="hover:text-white">PTI Service</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400 text-sm">© 2024 Copyright · Terms of Use · Privacy Policy · Accessibility ·
                    Sitemap</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to top button -->
    <button id="scrollToTop"
        class="fixed bottom-8 right-8 bg-teal-500 text-white p-3 rounded-full shadow-lg hover:bg-teal-600 transition-all duration-300 opacity-0 invisible">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <script>
        // Scroll to top functionality
        const scrollToTopButton = document.getElementById('scrollToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopButton.classList.remove('opacity-0', 'invisible');
                scrollToTopButton.classList.add('opacity-100', 'visible');
            } else {
                scrollToTopButton.classList.add('opacity-0', 'invisible');
                scrollToTopButton.classList.remove('opacity-100', 'visible');
            }
        });

        scrollToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Mobile menu toggle (if needed)
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        // Observe all sections
        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    </script>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.6s ease-in forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #14b8a6;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0d9488;
        }

        /* Smooth transitions for buttons */
        button {
            transition: all 0.3s ease;
        }

        /* Hover effects for cards */
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</body>

</html>