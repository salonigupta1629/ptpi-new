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
    @livewireStyles
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
            z-index: 50;
        }

        .mobile-menu.open {
            transform: translateX(0);
        }

        /* Overlay for mobile menu */
        .overlay {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
            z-index: 40;
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

        /* Fix for sidebar positioning */
        @media (min-width: 1024px) {
            .sidebar-container {
                position: sticky;
                top: 80px;
                height: calc(100vh - 80px);
                overflow-y: auto;
            }
        }

        /* Improved responsive behavior */
        @media (max-width: 1023px) {
            .main-content {
                width: 100%;
            }
        }

        /* Animation for chevron icons */
        .rotate-180 {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50 font-sans">
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="mobileMenuButton" class="p-2 rounded-md bg-teal-600 text-white">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <!-- Overlay for mobile -->
    <div id="overlay" class="overlay fixed inset-0 lg:hidden"></div>

     <livewire:recruiter.component.header/>

    <main class="flex flex-col lg:flex-row  lg:pt-0">

     <livewire:recruiter.component.sidebar />

              <!-- Livewire component for teacher request -->
              <livewire:recruiter.request-teacher />


        <!-- Main Content -->
        <section class="main-content flex-1 p-4 lg:p-6">
            {{ $slot }}
        </section>
    </main>

    <!-- Livewire Scripts -->
    @livewireScripts

    <script>
        // Toggle functionality for filters
        document.addEventListener('DOMContentLoaded', function() {
            const filterHeaders = document.querySelectorAll('.toggle-header');

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
            const clearFiltersBtn = document.getElementById('clearFilters');
            clearFiltersBtn.addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });

                const filterBoxes = document.querySelectorAll('.filter-box');
                filterBoxes.forEach(box => {
                    box.classList.remove('active-filter');
                    const content = box.querySelector('.toggle-content');
                    content.classList.add('hidden');
                    const icon = box.querySelector('.fa-chevron-down');
                    icon.classList.remove('rotate-180');
                });

                // Keep location filter active by default
                filterBoxes[0].classList.add('active-filter');
                filterBoxes[0].querySelector('.toggle-content').classList.remove('hidden');
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

        document.addEventListener('DOMContentLoaded', function() {
            const openModalBtn = document.getElementById('open-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const cancelBtn = document.getElementById('cancel-delete');
            const modal = document.getElementById('popup-modal');

            // Show modal
            openModalBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });

            // Hide modal
            [closeModalBtn, cancelBtn].forEach(btn => {
                btn.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            });

            // Optional: add action on confirm
            const confirmDeleteBtn = document.getElementById('confirm-delete');
            confirmDeleteBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
                alert("Deleted successfully!"); // Replace with your delete logic
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
