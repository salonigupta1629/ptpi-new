<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body>
    <div>
        <div class="flex h-screen bg-gray-50">
            <!-- Sidebar -->
            <div class="w-64 bg-white shadow-lg">
                <!-- Logo Header -->
                <div class="p-6 flex flex-col items-center border-b border-gray-200">
                    <h1 class="text-xl font-bold text-gray-800">PTPI</h1>
                    <p class="text-sm text-gray-500">Private Teacher Provider Institute</p>
                </div>
                <div class="p-4 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-medium"></span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800"></p>
                            <p class="text-xs text-gray-500"></p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="p-4">
                    <a href="{{ route('teacher.dashboard') }}" wire:navigate
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 bg-blue-50 text-blue-600 border-r-2 border-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('teacher.personal-details') }}" wire:navigate
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 ">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="font-medium">Personal Details</span>
                    </a>

                    <a href="{{ route('teacher.job-details') }}" wire:navigate
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 ">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2V6">
                            </path>
                        </svg>
                        <span class="font-medium">Job Details</span>
                    </a>

                    <a href="{{ route('teacher.view-attempts') }}" wire:navigate
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 ">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        <span class="font-medium">View Attempts</span>
                    </a>

                    <a href="{{ route('teacher.job-apply') }}" wire:navigate
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="font-medium">Job Apply</span>
                    </a>

                    <a href="{{ route('teacher.setting') }}" wire:navigate
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">Setting</span>
                    </a>

                    <button wire:click="logout"
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 text-red-600 hover:bg-red-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span class="font-medium">Logout</span>
                    </button>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- Top Header -->
                <header class="bg-blue-500 text-white px-6 py-2">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-medium">Teacher Dashboard</h2>
                        <div class="flex items-center space-x-4">
                            <button class="relative" wire:click="toggleNotifications">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-5 5v-5zM19 12H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v5a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </button>
                            <div class="text-right">
                                <p class="font-medium">Name</p>
                                <p class="text-blue-100 text-sm">Email</p>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main Dashboard Content -->
                <main class="flex-1 p-6 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <script>
        // Optional: Add any JavaScript interactions here
        document.addEventListener('livewire:load', function () {
            // Initialize any additional functionality
        });
    </script>
</body>

</html>