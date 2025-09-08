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
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body class="h-screen flex flex-col bg-gray-100">
    <!-- HEADER -->
    <header class="w-full bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Left: Logo + Tagline -->
                <div class="flex flex-col">
                    <span class="text-lg font-bold text-gray-800">PTP INSTITUTE</span>
                    <p class="text-sm text-gray-500">Learning Excellence</p>
                </div>

                <!-- Right: User Info -->
                <div id="avatarButton" 
                    class="flex items-center gap-3 border border-gray-300 rounded-full px-3 py-1 cursor-pointer hover:shadow-md transition">
                    <img class="w-10 h-10 rounded-full"
                        src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80"
                        alt="User avatar">
                    <div class="flex flex-col leading-tight">
                        <p class="text-sm font-medium text-gray-700">Suman Kumar</p>
                        <p class="text-xs text-gray-500">sumankumar@gmail.com</p>
                    </div>
                    <i class="fa-solid fa-chevron-down text-gray-500 text-xs"></i>
                </div>
            </div>
        </div>
    </header>
    <main>

        {{ $slot }}
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>
