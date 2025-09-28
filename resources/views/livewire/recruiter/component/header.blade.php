<div class="bg-white border-b px-4 lg:px-6 py-4 flex justify-between items-center sticky top-0 z-30">
    <a href="{{ route('recruiter.dashboard') }}" class="text-xl lg:text-2xl font-bold text-teal-600 flex items-center">
        <span class="hidden sm:inline">Teacher Recruiter</span>
        <span class="sm:hidden">TR</span>
    </a>
    <div class="flex items-center space-x-2 lg:space-x-4 md:mr-10">
        <!-- Search Component -->
        <div class="relative">
            <input type="text" wire:model.live="query" placeholder="Search teachers..."
                class="border border-gray-300 rounded-full px-4 py-2 w-40 lg:w-64 focus:outline-none focus:ring-2 focus:ring-teal-300 pl-10" />
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
        
        <!-- Request Teacher Button -->
        <button onclick="openModal()"
            class="bg-teal-500 text-white px-3 py-2 lg:px-4 lg:py-2 rounded-lg hover:bg-teal-600 flex items-center text-sm lg:text-base">
            <i class="fas fa-plus-circle mr-1 lg:mr-2"></i>
            <span class="hidden lg:inline">Request Teacher</span>
            <span class="lg:hidden">Request</span>
        </button>

        <!-- User Avatar -->
        <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
            class="flex border gap-2 py-1 cursor-pointer border-gray-300 rounded-full px-2 items-center">
            <img data-dropdown-placement="bottom-start" class="w-8 h-8 lg:w-10 lg:h-10 rounded-full cursor-pointer"
                src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80"
                alt="User avatar">
            <div class="flex flex-col">
                <p class="text-xs text-gray-600">Suman kumar</p>
                <p class="text-xs text-gray-600">Sumankumar@gmail.com</p>
            </div>
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
                 <li>
                    <a href="#"
                        class="flex items-center gap-2 px-5 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                       <i class="fa-solid fa-circle-user"></i> Profile
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
</div>

<!-- Success Message -->
@if (session()->has('success'))
    <div class="fixed top-20 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg transition-all duration-300">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-2"></i>
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-green-700 hover:text-green-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    
    <script>
        setTimeout(() => {
            const successMessage = document.querySelector('.fixed.top-20');
            if (successMessage) {
                successMessage.remove();
            }
        }, 5000);
    </script>
@endif

