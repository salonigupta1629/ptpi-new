<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .font-hindi {
            font-family: 'Noto Sans Devanagari', sans-serif;
            font-size: 1.1em;
            line-height: 1.6;
        }
    </style>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Notyf -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>

<body class="bg-gray-100 text-gray-800" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="transform lg:translate-x-0 transition-transform duration-200 ease-in-out bg-white w-2/12 border-r shadow-sm ">
            <!-- Logo Header -->
            <div class="px-6 py-2 flex flex-col items-center border-b border-gray-200">
                <h1 class="text-xl mt-1 font-bold text-gray-800">PTPI</h1>
                <p class="text-sm text-gray-500">Private Teacher Provider Institute</p>
            </div>
            <div class="p-5 flex flex-col gap-3">
                <a href="{{ route('center-manager.dashboard') }}" wire:navigate
                    class="flex items-center gap-2 px-4 py-2 rounded-md text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                    <i class="fa-solid fa-gauge"></i> Dashboard
                </a>
                <a href="{{ route('center-manager.manage-passkey') }}" wire:navigate
                    class="flex items-center gap-2 px-4 py-2 rounded-md text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                    <i class="fa-solid fa-key"></i> Manage Passkey
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-4 py-2 rounded-md text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                    <i class="fa-solid fa-clock-rotate-left"></i> Exam History
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-4 py-2 rounded-md text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                    <i class="fa-solid fa-gear"></i> Settings
                </a>
            </div>
        </aside>
        <div class="flex flex-1 flex-col w-10/12">
            <!-- Navbar -->
            <nav class="flex justify-between items-center bg-teal-600 text-white px-5 py-3 shadow">
                <div class="flex items-center gap-3">
                    <!-- Mobile Menu Button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-md hover:bg-teal-700">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h1 class="text-xl font-semibold">Center Manager Dashboard</h1>
                </div>

                <div x-data="{ show: false }" class="relative">
                    <button @click="show = !show" class="flex items-center gap-3 focus:outline-none">
                        <div class="text-right hidden sm:block">
                            <p class="font-medium">{{ auth()->user()->name ?? 'User' }}</p>
                            <p class="text-sm text-gray-200">{{ auth()->user()->email ?? 'user@gmail.com' }}</p>
                        </div>
                        <div class="bg-white rounded-full p-1">
                            <svg class="w-9 h-9 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A9 9 0 0112 15a9 9 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="show" @click.outside="show = false"
                        class="absolute right-0 mt-3 w-56 bg-white border rounded-lg shadow-lg p-4 z-50">
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="w-full text-left text-red-600 font-medium hover:bg-red-50 px-3 py-2 rounded-md">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            <!-- Main Content -->
            <main class="p-3 bg-gray-50 h-screen overflow-y-scroll">
                {{ $slot }}
            </main>
        </div>

    </div>

    <!-- Notyf JS -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        window.notyf = new Notyf({
            duration: 5000,
            dismissible: true,
            position: { x: 'right', y: 'top' }
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('notify', (event) => {
                notyf.success(event.message);
            });

            Livewire.on('notify-error', (event) => {
                notyf.error(event.message);
            });
        });
    </script>
</body>

</html>