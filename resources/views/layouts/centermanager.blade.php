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

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- for notification -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>

<body class="bg-gray-100">
    <nav class="flex justify-between items-center text-gray-100 bg-teal-500 px-5 py-3">
        <h1 class="text-lg font-medium">Center Manager Dashboard</h1>
        <div x-data="{ show: false}" class="relative">
            <button @click="show = true" class="flex gap-2">
                <div class="flex text-end flex-col">
                    <p class="font-medium">{{ auth()->user()->name ?? 'user'}}</p>
                    <p class="">{{ auth()->user()->email ?? 'user@gmail.com'}}</p>
                </div>
                <div class="bg-white rounded-full px-2 ">
                    <svg class="w-8 h-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A9 9 0 0112 15a9 9 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </button>
            <div x-show="show" @click.outside="show = false"
                class="absolute top-12 right-0 w-64 bg-gray-100 shadow-lg rounded-lg p-4 z-50">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class=" text-red-700  text-sm font-medium hover:bg-gray-50">
                        logout </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="flex gap-5">
        <div class="flex flex-col gap-5 p-5 w-2/12">
            <a href="" class="px-3 py-2 rounded border border-gray-500 hover:bg-gray-100">Dashboard</a>
            <a href="" class="px-3 py-2 rounded border border-gray-500 hover:bg-gray-100">Teacher Request</a>
            <a href="" class="px-3 py-2 rounded border border-gray-500 hover:bg-gray-100">Manage Passkey</a>
            <a href="" class="px-3 py-2 rounded border border-gray-500 hover:bg-gray-100">Exam Hostory</a>
            <a href="" class="px-3 py-2 rounded border border-gray-500 hover:bg-gray-100">Setting</a>
        </div>
        <div class="w-10/12 p-10">
            {{ $slot }}
        </div>
    </div>
    <!-- Notyf JS -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>

        window.notyf = new Notyf({
            duration: 5000, // auto close after 5s
            dismissible: true, // adds an ✖ close button
            position: { x: 'right', y: 'top' }
        });


        document.addEventListener('livewire:init', () => {
            // Success
            Livewire.on('notify', (event) => {
                notyf.success(event.message);
            });

            // Error
            Livewire.on('notify-error', (event) => {
                notyf.error(event.message);
            });
        });
    </script>
</body>

</html>