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
</head>

<body class="h-screen flex overflow-hidden bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 fixed h-screen transition-all duration-300">
        <div class="p-6 text-2xl font-bold text-gray-800 border-b border-gray-200 flex items-center space-x-2">
            <i class="fas fa-clipboard text-blue-600"></i>
            <span>PTPI</span>
        </div>
        <nav class="mt-4 flex flex-col space-y-2 px-4">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center space-x-3 text-gray-600 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-3 transition-colors duration-200">
                <i class="fas fa-tachometer-alt text-lg"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- Data Management Header -->
            <div class="text-gray-700 text-base font-semibold px-3 py-2">
                <i class="fas fa-folder-open text-base mr-2"></i>
                <span>Data Management</span>
            </div>

            <!-- Submenu Links -->
            <div class="pl-6 space-y-1">
                <a href="{{ route('admin.class_categories') }}"
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-layer-group text-sm"></i>
                    <span class="font-medium text-sm">Class Category</span>
                </a>
                <a href="{{ route('admin.subjects') }}"
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-book text-sm"></i>
                    <span class="font-medium text-sm">Subjects</span>
                </a>
                <a href="{{ route('admin.skills') }}"
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-tools text-sm"></i>
                    <span class="font-medium text-sm">Skills</span>
                </a>
                <a href="{{ route('admin.levels') }}"
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-signal text-sm"></i>
                    <span class="font-medium text-sm">Level</span>
                </a>
                <a href="{{ route('admin.qualifications') }}"
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-certificate text-sm"></i>
                    <span class="font-medium text-sm">Qualifications</span>
                </a>
                <a href="{{ route('admin.job_types') }}"
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-briefcase text-sm"></i>
                    <span class="font-medium text-sm">Job Type</span>
                </a>
                <a href="{{ route('admin.manage-role') }}"
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-users-cog text-sm"></i>
                    <span class="font-medium text-sm">Manage Role</span>
                </a>

                <a href="{{ route('admin.manage-exam') }}"
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-file-alt text-sm"></i>
                    <span class="font-medium text-sm">Exam</span>
                </a>
            </div>

            <!-- Manage Request Header -->
            <div class="text-gray-700 text-base font-semibold px-3 py-2">
                <i class="fas fa-tasks text-base mr-2"></i>
                <span>Manage Request</span>
            </div>

            <!-- Manage Request Submenu -->
            <div class="pl-6 space-y-1">
                <a href=""
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-user-plus text-sm"></i>
                    <span class="font-medium text-sm">Hiring</span>
                </a>
                <a href=""
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-key text-sm"></i>
                    <span class="font-medium text-sm">Passkeys</span>
                </a>
                <a href=""
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-comments text-sm"></i>
                    <span class="font-medium text-sm">Interview</span>
                </a>
                {{-- <a href=""
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-briefcase text-sm"></i>
                    <span class="font-medium text-sm">Job Applied</span>
                </a> --}}
                <a href="{{ route('admin.question-managers') }}"
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-envelope text-sm"></i>
                    <span class="font-medium text-sm">Question Manager</span>
                </a>
                <a href="{{ route('admin.exam-centers') }}"
                    class="flex items-center space-x-3 text-gray-500 hover:bg-blue-100 hover:text-blue-700 rounded-lg p-2 transition-colors duration-200">
                    <i class="fas fa-flag text-sm"></i>
                    <span class="font-medium text-sm">Exam Center</span>
                </a>
            </div>

            <!-- Logout -->
            <form method="POST" action="" class="mt-auto">
                @csrf
                <button type="submit"
                    class="w-full flex items-center space-x-3 text-red-500 hover:bg-red-100 hover:text-red-700 rounded-lg p-3 transition-colors duration-200">
                    <i class="fas fa-right-from-bracket text-lg"></i>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 ml-64 flex flex-col h-screen">
        <!-- Header -->
        <header class="bg-blue-900 text-white px-6 py-4 sticky top-0 z-10">
            <h1 class="text-lg font-semibold">Admin Dashboard</h1>
        </header>

        <!-- Scrollable Content -->
        <main class="flex-1 overflow-y-auto p-6">
            {{ $slot }}
        </main>
    </div>

    @livewireStyles
    @livewireScripts
</body>

</html>