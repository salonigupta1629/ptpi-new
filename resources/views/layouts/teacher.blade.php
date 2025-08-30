<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        <script src="https://cdn.tailwindcss.com"></script>

        @php
            $activeTab = $activeTab ?? 'dashboard';
            $currentStep = $currentStep ?? 1;
            $progressPercentage = ($currentStep - 1) * 50; // Assuming 3 steps: 0%, 50%, 100%
            $categories = [
                ['id' => 'math', 'label' => 'Mathematics', 'subjects' => 5],
                ['id' => 'science', 'label' => 'Science', 'subjects' => 4],
                ['id' => 'english', 'label' => 'English', 'subjects' => 3],
                ['id' => 'history', 'label' => 'History', 'subjects' => 2],
            ];
            $selectedCategory = $selectedCategory ?? null;
            $notificationCount = $notificationCount ?? 0;
            $personalDetails = $personalDetails ?? ['name' => '', 'email' => '', 'phone' => '', 'experience' => ''];
        @endphp
    </head>
    <body>
        <div>
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <!-- Logo Header -->
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-800">PTPI</h1>
                <p class="text-sm text-gray-500">Private Teacher Provider Institute</p>
            </div>

            <!-- User Profile -->
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
                <button wire:click="setActiveTab('dashboard')" 
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 {{ $activeTab === 'dashboard' ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-500' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </button>

                <button wire:click="setActiveTab('personal')" 
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 {{ $activeTab === 'personal' ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-500' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium">Personal Details</span>
                </button>

                <button wire:click="setActiveTab('job-details')" 
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 {{ $activeTab === 'job-details' ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-500' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2V6"></path>
                    </svg>
                    <span class="font-medium">Job Details</span>
                </button>

                <button wire:click="setActiveTab('view-attempts')" 
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 {{ $activeTab === 'view-attempts' ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-500' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span class="font-medium">View Attempts</span>
                </button>

                <button wire:click="setActiveTab('job-apply')" 
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 {{ $activeTab === 'job-apply' ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-500' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="font-medium">Job Apply</span>
                </button>

                <button wire:click="setActiveTab('settings')" 
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 {{ $activeTab === 'settings' ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-500' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="font-medium">Setting</span>
                </button>

                <button wire:click="logout" 
                        class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-left transition-colors mb-1 text-red-600 hover:bg-red-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">Logout</span>
                </button>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="bg-blue-500 text-white p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold">Teacher Dashboard</h2>
                    <div class="flex items-center space-x-4">
                        <button class="relative" wire:click="toggleNotifications">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM19 12H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v5a2 2 0 01-2 2z"></path>
                            </svg>
                            @if($notificationCount > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ $notificationCount }}
                                </span>
                            @endif
                        </button>
                        <div class="text-right">
                            <p class="font-medium">Name</p>
                            <p class="text-blue-100 text-sm">Email</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Breadcrumb/Progress -->
            <div class="bg-white border-b p-4">
                <div class="flex items-center space-x-4">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 h-2 bg-gray-200 rounded-full">
                        <div class="h-2 bg-blue-500 rounded-full transition-all duration-300" style="width: {{ $progressPercentage }}%"></div>
                    </div>
                    <div class="flex space-x-8 text-sm">
                        <span class="text-blue-600 font-medium">Category</span>
                        <span class="{{ $currentStep >= 2 ? 'text-blue-600 font-medium' : 'text-gray-400' }}">Subject</span>
                        <span class="{{ $currentStep >= 3 ? 'text-blue-600 font-medium' : 'text-gray-400' }}">Level</span>
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                @if($activeTab === 'dashboard')
                    <!-- Class Category Selection -->
                    <div class="bg-blue-500 rounded-lg p-6 mb-6 text-white">
                        <div class="flex items-center space-x-2 mb-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            </svg>
                            <h3 class="text-xl font-bold">Select Class Category</h3>
                        </div>
                        <p class="text-blue-100">Choose from your profile preferences</p>
                    </div>

                    <!-- Category Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        @foreach($categories as $category)
                            <div wire:click="selectCategory('{{ $category['id'] }}')" 
                                 class="bg-white rounded-lg border-2 p-6 cursor-pointer transition-all duration-200 hover:shadow-lg {{ $selectedCategory === $category['id'] ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-blue-300' }}">
                                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $category['label'] }}</h4>
                                <p class="text-gray-500 text-sm">{{ $category['subjects'] }} subject{{ $category['subjects'] !== 1 ? 's' : '' }}</p>
                            </div>
                        @endforeach
                    </div>

                    @if($selectedCategory)
                        <!-- Start Assessment Section -->
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Start Your Assessment</h3>
                            <p class="text-gray-600 mb-8">Follow the steps above: select category, subject, and level to begin</p>
                            <button wire:click="startAssessment" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200">
                                Begin Assessment
                            </button>
                        </div>
                    @endif

                @elseif($activeTab === 'personal')
                    <!-- Personal Details Content -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Personal Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" wire:model="personalDetails.name" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" wire:model="personalDetails.email" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input type="tel" wire:model="personalDetails.phone" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Experience (Years)</label>
                                <input type="number" wire:model="personalDetails.experience" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="mt-6">
                            <button wire:click="updatePersonalDetails" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg">
                                Save Changes
                            </button>
                        </div>
                    </div>

                @elseif($activeTab === 'view-attempts')
                    <!-- View Attempts Content -->
                    <div class="bg-white rounded-lg shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-xl font-bold text-gray-800">Assessment Attempts</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($attempts as $attempt)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $attempt['date'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $attempt['category'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $attempt['subject'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $attempt['score'] }}%
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $attempt['status'] === 'Passed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $attempt['status'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                No attempts found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                @else
                    <!-- Default Content for Other Tabs -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">{{ ucwords(str_replace('-', ' ', $activeTab)) }}</h3>
                        <p class="text-gray-600">Content for {{ ucwords(str_replace('-', ' ', $activeTab)) }} section will be displayed here.</p>
                    </div>
                @endif
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
        {{ $slot }}
    </body>
</html>
