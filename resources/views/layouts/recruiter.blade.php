<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Recruiter Panel</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .teacher-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .filter-box {
            transition: all 0.3s ease;
        }

        .active-filter {
            background-color: #e6fffa;
            border-left: 4px solid #0d9488;
        }
        
        /* Mobile menu animation */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-menu.open {
            transform: translateX(0);
        }
        
        /* Overlay for mobile menu */
        .overlay {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
        }
        
        .overlay.active {
            opacity: 1;
            visibility: visible;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .location-inputs {
                grid-template-columns: 1fr;
            }
        }
        
        /* Custom scrollbar */
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .custom-scroll::-webkit-scrollbar-thumb {
            background: #c5c5c5;
            border-radius: 10px;
        }
        
        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50 font-sans">
    <!-- Mobile menu button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="mobileMenuButton" class="p-2 rounded-md bg-teal-600 text-white">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Overlay for mobile -->
    <div id="overlay" class="overlay fixed inset-0 z-40 lg:hidden"></div>

    <!-- Header -->
    <header class="bg-white border-b px-4 lg:px-6 py-4 flex justify-between items-center sticky top-0 z-30">
        <h1 class="text-xl lg:text-2xl font-bold text-teal-600 flex items-center">
            <span class="hidden sm:inline">Teacher Recruiter</span>
            <span class="sm:hidden">TR</span>
        </h1>

        <div class="flex items-center space-x-2 lg:space-x-4">
            <div class="relative hidden sm:block">
                <input type="text" placeholder="Search teachers..."
                    class="border rounded-lg px-4 py-2 w-40 lg:w-64 focus:outline-none focus:ring-2 focus:ring-teal-300 pl-10" />
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            
            <!-- Mobile search button -->
            <button id="mobileSearchButton" class="sm:hidden p-2 text-gray-600">
                <i class="fas fa-search"></i>
            </button>
            
            <button class="bg-teal-500 text-white px-3 py-2 lg:px-4 lg:py-2 rounded-lg hover:bg-teal-600 flex items-center text-sm lg:text-base">
                <i class="fas fa-plus-circle mr-1 lg:mr-2"></i>
                <span class="hidden lg:inline">Request Teacher</span>
                <span class="lg:hidden">Request</span>
            </button>
            
            <div class="flex items-center">
                <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                    data-dropdown-placement="bottom-start" class="w-8 h-8 lg:w-10 lg:h-10 rounded-full cursor-pointer"
                    src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80" alt="User avatar">
            </div>

            <!-- Dropdown menu -->
            <div id="userDropdown"
                class="z-10 hidden w-56 bg-white rounded-xl shadow-lg divide-y divide-gray-100 dark:bg-gray-800 dark:divide-gray-700">
                <!-- User Info -->
                <div class="px-5 py-4 text-sm">
                    <div class="text-gray-900 dark:text-white font-semibold">Bonnie Green</div>
                    <div class="text-gray-500 dark:text-gray-400 text-xs truncate">name@flowbite.com</div>
                </div>

                <!-- Menu Items -->
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                    <li>
                        <a href="#"
                            class="flex items-center gap-2 px-5 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                            🏠 Dashboard
                        </a>
                    </li>
                </ul>

                <!-- Sign Out -->
                <div class="py-2">
                    <a href="#"
                        class="block px-5 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-red-400 dark:hover:text-red-300">
                        Sign out
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile search bar -->
    <div id="mobileSearchBar" class="bg-white p-3 hidden shadow-md">
        <div class="relative">
            <input type="text" placeholder="Search teachers..."
                class="border rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-teal-300 pl-10" />
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
    </div>

    <main class="flex">
        <!-- Sidebar Filters -->
        <aside id="sidebar" class="mobile-menu fixed top-0 left-0 h-screen w-64 lg:translate-x-0 bg-white p-4 border-r  sticky  overflow-y-auto custom-scroll  lg:relative z-50">
            <div class="flex justify-between items-center mb-4 lg:mb-6">
                <h2 class="text-xl font-semibold flex items-center">
                    <i class="fas fa-filter mr-2 text-teal-600"></i>Filters
                </h2>
                <button id="closeSidebar" class="lg:hidden p-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="space-y-5">
                <!-- Filter: Location -->
                <div class="filter-box p-4 border rounded-lg">
                    <h3 class="font-medium cursor-pointer flex justify-between items-center toggle-header">
                        <span class="flex items-center text-gray-800">
                            <i class="fas fa-map-marker-alt mr-2 text-teal-600"></i> Location
                        </span>
                        <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                    </h3>
                    <div class="mt-3 space-y-4 hidden toggle-content">
                        <div class="location-inputs grid grid-cols-1 md:grid-cols-1 gap-3">
                            <!-- Pincode -->
                            <div class="flex flex-col">
                                <label class="text-sm font-medium mb-1">Pincode</label>
                                <div class="flex gap-2">
                                    <input type="text" class="py-2 px-3 border rounded w-full text-sm"
                                        placeholder="Enter pincode">
                                    <button type="submit"
                                        class="bg-teal-600 text-white text-sm px-3 py-2 rounded">Check</button>
                                </div>
                            </div>

                            <!-- District -->
                            <div class="flex flex-col">
                                <label class="text-sm font-medium mb-1">District</label>
                                <div class="flex gap-2">
                                    <input type="text" class="py-2 px-3 border rounded w-full text-sm"
                                        placeholder="Enter district">
                                    <button type="submit"
                                        class="bg-teal-600 text-white text-sm px-3 py-2 rounded">Check</button>
                                </div>
                            </div>

                            <!-- Block -->
                            <div class="flex flex-col">
                                <label class="text-sm font-medium mb-1">Block</label>
                                <div class="flex gap-2">
                                    <input type="text" class="py-2 px-3 border rounded w-full text-sm"
                                        placeholder="Enter block">
                                    <button type="submit"
                                        class="bg-teal-600 text-white text-sm px-3 py-2 rounded">Check</button>
                                </div>
                            </div>

                            <!-- Village -->
                            <div class="flex flex-col">
                                <label class="text-sm font-medium mb-1">Village</label>
                                <div class="flex gap-2">
                                    <input type="text" class="py-2 px-3 border rounded w-full text-sm"
                                        placeholder="Enter village">
                                    <button type="submit"
                                        class="bg-teal-600 text-white text-sm px-3 py-2 rounded">Check</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="filter-box p-3 rounded-lg border">
                    <h3 class="font-medium cursor-pointer flex justify-between items-center">
                        <span><i class="fas fa-graduation-cap mr-2 text-teal-600"></i>Education</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </h3>
                    <div class="mt-2 pl-6 hidden">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="bachelor" class="mr-2 rounded text-teal-600">
                            <label for="bachelor" class="text-sm">Bachelor's Degree</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="master" class="mr-2 rounded text-teal-600">
                            <label for="master" class="text-sm">Master's Degree</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="phd" class="mr-2 rounded text-teal-600">
                            <label for="phd" class="text-sm">PhD</label>
                        </div>
                    </div>
                </div>

                <div class="filter-box p-3 rounded-lg border">
                    <h3 class="font-medium cursor-pointer flex justify-between items-center">
                        <span><i class="fas fa-layer-group mr-2 text-teal-600"></i>Class Category</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </h3>
                    <div class="mt-2 pl-6 hidden">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="primary" class="mr-2 rounded text-teal-600">
                            <label for="primary" class="text-sm">0 - 2</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="middle" class="mr-2 rounded text-teal-600">
                            <label for="middle" class="text-sm">0 - 4</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="high" class="mr-2 rounded text-teal-600">
                            <label for="high" class="text-sm">0 - 6</label>
                        </div>
                    </div>
                </div>

                <div class="filter-box p-3 rounded-lg border">
                    <h3 class="font-medium cursor-pointer flex justify-between items-center">
                        <span><i class="fas fa-book mr-2 text-teal-600"></i>Subjects</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </h3>
                    <div class="mt-2 pl-6 hidden">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="math" class="mr-2 rounded text-teal-600">
                            <label for="math" class="text-sm">Mathematics</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="science" class="mr-2 rounded text-teal-600">
                            <label for="science" class="text-sm">Science</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="english" class="mr-2 rounded text-teal-600">
                            <label for="english" class="text-sm">English</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="history" class="mr-2 rounded text-teal-600">
                            <label for="history" class="text-sm">History</label>
                        </div>
                    </div>
                </div>

                <div class="filter-box p-3 rounded-lg border">
                    <h3 class="font-medium cursor-pointer flex justify-between items-center">
                        <span><i class="fas fa-tools mr-2 text-teal-600"></i>Skills</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </h3>
                    <div class="mt-2 pl-6 hidden">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="communication" class="mr-2 rounded text-teal-600">
                            <label for="communication" class="text-sm">C++</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="management" class="mr-2 rounded text-teal-600">
                            <label for="management" class="text-sm">Java</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="technology" class="mr-2 rounded text-teal-600">
                            <label for="technology" class="text-sm">Python</label>
                        </div>
                    </div>
                </div>

                <button class="text-sm text-teal-600 mt-2 font-medium flex items-center">
                    <i class="fas fa-times-circle mr-1"></i>Clear Filters
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <section class="flex-1 p-4 lg:p-6">
            {{ $slot }}
        </section>
    </main>

    <script>
        // Toggle functionality for filters
        document.addEventListener('DOMContentLoaded', function() {
            const filterHeaders = document.querySelectorAll('.filter-box h3');

            filterHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector('.fa-chevron-down');

                    // Toggle content visibility
                    if (content.classList.contains('hidden')) {
                        content.classList.remove('hidden');
                        icon.classList.add('rotate-180');
                    } else {
                        content.classList.add('hidden');
                        icon.classList.remove('rotate-180');
                    }

                    // Toggle active state
                    this.parentElement.classList.toggle('active-filter');
                });
            });

            // Clear filters button
            const clearFiltersBtn = document.querySelector('button:last-child');
            clearFiltersBtn.addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });

                const filterBoxes = document.querySelectorAll('.filter-box');
                filterBoxes.forEach(box => {
                    box.classList.remove('active-filter');
                    const content = box.querySelector('div:last-child');
                    content.classList.add('hidden');
                    const icon = box.querySelector('.fa-chevron-down');
                    icon.classList.remove('rotate-180');
                });

                // Keep location filter active by default
                filterBoxes[0].classList.add('active-filter');
                filterBoxes[0].querySelector('div:last-child').classList.remove('hidden');
                filterBoxes[0].querySelector('.fa-chevron-down').classList.add('rotate-180');
            });

            // Mobile menu functionality
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const closeSidebar = document.getElementById('closeSidebar');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const mobileSearchButton = document.getElementById('mobileSearchButton');
            const mobileSearchBar = document.getElementById('mobileSearchBar');

            function toggleSidebar() {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
                document.body.classList.toggle('overflow-hidden');
            }

            mobileMenuButton.addEventListener('click', toggleSidebar);
            closeSidebar.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);

            // Mobile search toggle
            mobileSearchButton.addEventListener('click', function() {
                mobileSearchBar.classList.toggle('hidden');
            });

            // Make location inputs responsive
            function adjustLocationInputs() {
                const locationInputs = document.querySelector('.location-inputs');
                if (window.innerWidth < 768) {
                    locationInputs.classList.remove('grid-cols-2');
                    locationInputs.classList.add('grid-cols-1');
                } else {
                    locationInputs.classList.remove('grid-cols-1');
                    locationInputs.classList.add('grid-cols-2');
                }
            }

            // Initial call
            adjustLocationInputs();
            
            // Listen for window resize
            window.addEventListener('resize', adjustLocationInputs);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>