{{-- <div class="p-5">
    <h1 class="text-blue-800 font-medium text-xl">Teacher Interview Management</h1>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="border-b border-gray-200 mb-6 mt-4">
        <div class="flex space-x-4">
            <button wire:click="$set('activeTab', 'pending')" 
                    class="{{ $activeTab === 'pending' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500' }} px-4 py-2">
                Pending Approval ({{ $pendingCount }})
            </button>
            <button wire:click="$set('activeTab', 'scheduled')" 
                    class="{{ $activeTab === 'scheduled' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500' }} px-4 py-2">
                Scheduled ({{ $scheduledCount }})
            </button>
            <button wire:click="$set('activeTab', 'completed')" 
                    class="{{ $activeTab === 'completed' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500' }} px-4 py-2">
                Completed ({{ $completedCount }})
            </button>
            <button wire:click="$set('activeTab', 'all')" 
                    class="{{ $activeTab === 'all' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500' }} px-4 py-2">
                All Interviews ({{ $allCount }})
            </button>
        </div>
    </div>

    <table class="text-gray-700 mt-5 w-full">
        <thead>
            <tr>
                <th class="border-b p-2">Teacher Name</th>
                <th class="border-b p-2">Subject (class)</th>
                <th class="border-b p-2">Requested Date/Time</th>
                <th class="border-b p-2">Status</th>
                <th class="border-b p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($interviews as $interview)
                <tr>
                    <td class="border-b p-2">
                        {{ $interview->teacher->user->name ?? 'N/A' }}
                    </td>
                    <td class="border-b p-2">
                        {{ $interview->examAttempt->examSet->subject->subject_name ?? 'N/A' }} 
                        ({{ $interview->examAttempt->examSet->category->name ?? 'N/A' }})
                    </td>
                    <td class="border-b p-2">
                        {{ $interview->scheduled_at->format('Y-m-d H:i') }}
                    </td>
                    <td class="border-b p-2">
                        <span class="px-2 py-1 text-xs font-medium rounded 
                            @if($interview->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($interview->status === 'approved') bg-blue-100 text-blue-800
                            @elseif($interview->status === 'scheduled') bg-green-100 text-green-800
                            @elseif($interview->status === 'completed') bg-gray-100 text-gray-800
                            @elseif($interview->status === 'rejected') bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($interview->status) }}
                        </span>
                    </td>
                    <td class="border-b p-2">
                        <button class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 mr-2"
                            wire:click="selectInterview({{ $interview->id }}, 'view')">
                            View
                        </button>

                        @if($interview->status === 'pending')
                        <button class="px-3 py-1 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 mr-2"
                            wire:click="selectInterview({{ $interview->id }}, 'schedule')">
                            Schedule
                        </button>
                        
                        <button class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700"
                            wire:click="selectInterview({{ $interview->id }}, 'reject')">
                            Reject
                        </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            
            @if($interviews->count() === 0)
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">
                        No interviews found in this category.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- View Modal -->
    @if($showViewModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                <!-- Close Button -->
                <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl" wire:click="closeModal">
                    ✕
                </button>

                <!-- Header -->
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Interview Details</h2>

                <!-- Details Section -->
                <div class="space-y-3 text-left">
                    @if($selectedInterview)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Teacher Name</span>
                            <span class="font-medium text-gray-900">{{ $selectedInterview->teacher->user->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email</span>
                            <span class="font-medium text-gray-900">{{ $selectedInterview->teacher->user->email ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subject</span>
                            <span class="font-medium text-gray-900">{{ $selectedInterview->examAttempt->examSet->subject->subject_name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Class Category</span>
                            <span class="font-medium text-gray-900">{{ $selectedInterview->examAttempt->examSet->category->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Level</span>
                            <span class="font-medium text-gray-900">Level 2</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Score</span>
                            <span class="font-medium text-gray-900">{{ $selectedInterview->examAttempt->score ?? 'N/A' }}%</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Requested At</span>
                            <span class="font-medium text-gray-900">{{ $selectedInterview->requested_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Scheduled For</span>
                            <span class="font-medium text-gray-900">{{ $selectedInterview->scheduled_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status</span>
                            <span class="px-2 py-1 text-xs font-medium rounded 
                                @if($selectedInterview->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($selectedInterview->status === 'approved') bg-blue-100 text-blue-800
                                @elseif($selectedInterview->status === 'scheduled') bg-green-100 text-green-800
                                @elseif($selectedInterview->status === 'completed') bg-gray-100 text-gray-800
                                @elseif($selectedInterview->status === 'rejected') bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($selectedInterview->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Teacher Notes</span>
                            <span class="font-medium text-gray-900">{{ $selectedInterview->teacher_notes ?? 'No notes' }}</span>
                        </div>
                    @else
                    <div class="text-center py-4 text-gray-500">
                        No interview selected.
                    </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="mt-6 flex justify-end">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700" wire:click="closeModal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Schedule Modal -->
    @if($showScheduleModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                <!-- Close Button -->
                <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl" wire:click="closeModal">
                    ✕
                </button>

                <!-- Header -->
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Schedule Interview</h2>

                <!-- Details -->
                <div class="space-y-4 text-left">
                    @if($selectedInterview)
                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Teacher Name</label>
                            <p class="font-medium text-gray-900">{{ $selectedInterview->teacher->user->name ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Subject & Class</label>
                            <p class="font-medium text-gray-900">
                                {{ $selectedInterview->examAttempt->examSet->subject->subject_name ?? 'N/A' }} 
                                ({{ $selectedInterview->examAttempt->examSet->category->name ?? 'N/A' }})
                            </p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Requested Date & Time</label>
                            <p class="font-medium text-gray-900 bg-gray-100 p-2 rounded">
                                {{ $selectedInterview->scheduled_at->format('Y-m-d H:i') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">This is the date/time requested by the teacher</p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Schedule Date & Time *</label>
                            <input type="datetime-local" wire:model="scheduleDate"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                            @error('scheduleDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            <p class="text-xs text-gray-500 mt-1">You can edit this to schedule a different time</p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Interview Meeting Link *</label>
                            <input type="url" wire:model="meetingLink" placeholder="Enter meeting URL (Google Meet, Zoom, etc.)"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                            @error('meetingLink') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    @else
                    <div class="text-center py-4 text-gray-500">
                        No interview selected.
                    </div>
                    @endif
                </div>

                <!-- Footer Buttons -->
                <div class="mt-6 flex justify-end space-x-2">
                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300" wire:click="closeModal">
                        Cancel
                    </button>
                    <button wire:click="approveInterview({{ $selectedInterview->id ?? 'null' }})"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                        </svg>
                        Schedule Interview
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Reject Modal -->
    @if($showRejectModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                <!-- Close Button -->
                <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl" wire:click="closeModal">
                    ✕
                </button>

                <!-- Header -->
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Reject Interview Request</h2>

                <!-- Details -->
                <div class="space-y-4 text-left">
                    @if($selectedInterview)
                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Teacher Name</label>
                            <p class="font-medium text-gray-900">{{ $selectedInterview->teacher->user->name ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Subject & Class</label>
                            <p class="font-medium text-gray-900">
                                {{ $selectedInterview->examAttempt->examSet->subject->subject_name ?? 'N/A' }} 
                                ({{ $selectedInterview->examAttempt->examSet->category->name ?? 'N/A' }})
                            </p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Rejection Reason *</label>
                            <textarea wire:model="rejectionReason" placeholder="Please explain why this interview request is being rejected"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200" rows="4"></textarea>
                            @error('rejectionReason') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    @else
                    <div class="text-center py-4 text-gray-500">
                        No interview selected.
                    </div>
                    @endif
                </div>

                <!-- Footer Buttons -->
                <div class="mt-6 flex justify-end space-x-2">
                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300" wire:click="closeModal">
                        Cancel
                    </button>
                    <button wire:click="rejectInterview({{ $selectedInterview->id ?? 'null' }})"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reject Interview
                    </button>
                </div>
            </div>
        </div>
    @endif
</div> --}}






<div class="teacher-interview-management">
    <div class="p-5 max-w-7xl mx-auto">
        <h1 class="text-primary font-medium text-xl mb-2">Teacher Interview Management</h1>
        
        <!-- Flash Messages -->
        <div id="flash-messages">
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-6 mt-4">
            <div class="flex space-x-4">
                <button wire:click="$set('activeTab', 'pending')" 
                        class="{{ $activeTab === 'pending' ? 'tab-active' : 'text-gray-500' }} px-4 py-2 font-medium">
                    Pending Approval ({{ $pendingCount }})
                </button>
                <button wire:click="$set('activeTab', 'scheduled')" 
                        class="{{ $activeTab === 'scheduled' ? 'tab-active' : 'text-gray-500' }} px-4 py-2 font-medium">
                    Scheduled ({{ $scheduledCount }})
                </button>
                <button wire:click="$set('activeTab', 'completed')" 
                        class="{{ $activeTab === 'completed' ? 'tab-active' : 'text-gray-500' }} px-4 py-2 font-medium">
                    Completed ({{ $completedCount }})
                </button>
                <button wire:click="$set('activeTab', 'all')" 
                        class="{{ $activeTab === 'all' ? 'tab-active' : 'text-gray-500' }} px-4 py-2 font-medium">
                    All Interviews ({{ $allCount }})
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model="statusFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="completed">Completed</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Teacher Name</label>
                    <input type="text" wire:model.debounce.300ms="teacherNameFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm" placeholder="Search name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Class Category</label>
                    <select wire:model="categoryFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $categoryName => $categoryValue)
                            <option value="{{ $categoryName }}">{{ $categoryName }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                    <select wire:model="subjectFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                        <option value="">All Subjects</option>
                        @foreach($subjects as $subjectName => $subjectValue)
                            <option value="{{ $subjectName }}">{{ $subjectName }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                    <select wire:model="levelFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                        <option value="">All Levels</option>
                        @foreach($levels as $levelName => $levelValue)
                            <option value="{{ $levelName }}">{{ $levelName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Attempt</label>
                    <select wire:model="attemptFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                        <option value="">All Attempts</option>
                        <option value="First">First</option>
                        <option value="Second">Second</option>
                        <option value="Third">Third</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">From Date (Request)</label>
                    <input type="date" wire:model="fromDateFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">To Date (Request)</label>
                    <input type="date" wire:model="toDateFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                </div>
                <div class="flex items-end space-x-2">
                    <button wire:click="clearFilters" class="flex-1 bg-gray-300 text-gray-700 rounded-md px-4 py-2 text-sm font-medium hover:bg-gray-400">
                        Clear Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Interview List -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-gray-700">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left p-4 font-medium">Teacher Name</th>
                        <th class="text-left p-4 font-medium">Subject (class)</th>
                        <th class="text-left p-4 font-medium">Requested Date/Time</th>
                        <th class="text-left p-4 font-medium">Status</th>
                        <th class="text-left p-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($interviews as $interview)
                        <tr>
                            <td class="p-4">
                                <div class="font-medium">{{ $interview->teacher->user->name ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $interview->teacher->user->email ?? 'N/A' }}</div>
                            </td>
                            <td class="p-4">
                                {{ $interview->examAttempt->examSet->subject->subject_name ?? 'N/A' }} 
                                ({{ $interview->examAttempt->examSet->category->name ?? 'N/A' }})
                                <div class="text-sm text-gray-500">Level: {{ $interview->examAttempt->examSet->level->name ?? 'N/A' }}</div>
                            </td>
                            <td class="p-4">{{ $interview->scheduled_at->format('Y-m-d H:i') }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 text-xs font-medium rounded 
                                    @if($interview->status === 'pending') status-pending
                                    @elseif($interview->status === 'scheduled') status-scheduled
                                    @elseif($interview->status === 'completed') status-completed
                                    @elseif($interview->status === 'rejected') status-rejected
                                    @else status-pending @endif">
                                    {{ ucfirst($interview->status) }}
                                </span>
                            </td>
                            <td class="p-4">
                                <button class="view-btn px-3 py-1 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 mr-2"
                                    wire:click="selectInterview({{ $interview->id }}, 'view')">
                                    View
                                </button>

                                @if($interview->status === 'pending')
                                <button class="schedule-btn px-3 py-1 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 mr-2"
                                    wire:click="selectInterview({{ $interview->id }}, 'schedule')">
                                    Schedule
                                </button>
                                
                                <button class="reject-btn px-3 py-1 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700"
                                    wire:click="selectInterview({{ $interview->id }}, 'reject')">
                                    Reject
                                </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    
                    @if($interviews->count() === 0)
                        <tr>
                            <td colspan="5" class="text-center p-4 text-gray-500">
                                No interviews found in this category.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Dynamic View Modal -->
    @if($showViewModal)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl relative">
            <!-- Close Button -->
            <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl z-10" wire:click="closeModal">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Header -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100 rounded-t-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Interview Details</h2>
                        <p class="text-sm text-gray-600 mt-1">Complete information about the interview request</p>
                    </div>
                    @if($selectedInterview)
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs font-medium rounded-full 
                            @if($selectedInterview->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($selectedInterview->status === 'scheduled') bg-green-100 text-green-800
                            @elseif($selectedInterview->status === 'completed') bg-gray-100 text-gray-800
                            @elseif($selectedInterview->status === 'rejected') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            {{ ucfirst($selectedInterview->status) }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="p-6 max-h-[70vh] overflow-y-auto">
                @if($selectedInterview)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Teacher Information -->
                    <div class="space-y-4">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h3 class="font-semibold text-blue-800 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Teacher Information
                            </h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Full Name</span>
                                    <span class="font-medium text-gray-900">{{ $selectedInterview->teacher->user->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Email</span>
                                    <span class="font-medium text-gray-900">{{ $selectedInterview->teacher->user->email ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Phone</span>
                                    <span class="font-medium text-gray-900">{{ $selectedInterview->teacher->phone ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Experience</span>
                                    <span class="font-medium text-gray-900">{{ $selectedInterview->teacher->experience ?? 'N/A' }} years</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Attempt Number</span>
                                    <span class="font-medium text-gray-900">
                                        {{ $this->getAttemptNumber($selectedInterview->teacher_id, $selectedInterview->examAttempt->exam_set_id) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Exam Details -->
                        <div class="bg-green-50 rounded-lg p-4">
                            <h3 class="font-semibold text-green-800 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Exam Performance
                            </h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Score</span>
                                    <span class="font-medium text-gray-900">{{ $selectedInterview->examAttempt->score ?? 'N/A' }}/{{ $selectedInterview->examAttempt->examSet->total_marks ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Correct Answers</span>
                                    <span class="font-medium text-gray-900">
                                        {{ $this->getCorrectAnswersCount($selectedInterview->examAttempt->id) }}/{{ $selectedInterview->examAttempt->examSet->total_question ?? 'N/A' }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Completion Time</span>
                                    <span class="font-medium text-gray-900">{{ $this->getCompletionTime($selectedInterview->examAttempt) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Exam Type</span>
                                    <span class="font-medium text-gray-900">{{ ucfirst($selectedInterview->examAttempt->examSet->type ?? 'N/A') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Interview Details -->
                    <div class="space-y-4">
                        <!-- Subject & Class -->
                        <div class="bg-purple-50 rounded-lg p-4">
                            <h3 class="font-semibold text-purple-800 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                                Subject & Class Details
                            </h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Subject</span>
                                    <span class="font-medium text-gray-900">{{ $selectedInterview->examAttempt->examSet->subject->subject_name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Class Category</span>
                                    <span class="font-medium text-gray-900">{{ $selectedInterview->examAttempt->examSet->category->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Level</span>
                                    <span class="font-medium text-gray-900">{{ $selectedInterview->examAttempt->examSet->level->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Exam Set</span>
                                    <span class="font-medium text-gray-900">{{ $selectedInterview->examAttempt->examSet->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Information -->
                        <div class="bg-orange-50 rounded-lg p-4">
                            <h3 class="font-semibold text-orange-800 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                Schedule Information
                            </h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Requested At</span>
                                    <span class="font-medium text-gray-900">{{ $selectedInterview->requested_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Scheduled For</span>
                                    <span class="font-medium text-gray-900">{{ $selectedInterview->scheduled_at->format('M d, Y H:i') }}</span>
                                </div>
                                @if($selectedInterview->meeting_link)
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Meeting Link</span>
                                    <a href="{{ $selectedInterview->meeting_link }}" target="_blank" class="font-medium text-blue-600 hover:text-blue-800 truncate max-w-[150px]">
                                        Join Meeting
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Teacher Notes -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                Teacher Notes
                            </h3>
                            <p class="text-sm text-gray-700 bg-white p-3 rounded border">
                                {{ $selectedInterview->teacher_notes ?? 'No additional notes provided by the teacher.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                @if($selectedInterview->status === 'pending')
                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200 font-medium"
                            wire:click="closeModal">
                        Close
                    </button>
                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 font-medium flex items-center"
                            wire:click="selectInterview({{ $selectedInterview->id }}, 'reject')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reject
                    </button>
                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 font-medium flex items-center"
                            wire:click="selectInterview({{ $selectedInterview->id }}, 'schedule')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                        </svg>
                        Schedule Interview
                    </button>
                </div>
                @else
                <div class="flex justify-end mt-6 pt-4 border-t border-gray-200">
                    <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 font-medium"
                            wire:click="closeModal">
                        Close Details
                    </button>
                </div>
                @endif

                @else
                <div class="text-center py-8 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-2">No interview selected or interview not found.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Schedule Modal -->
    @if($showScheduleModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md relative">
                <!-- Close Button -->
                <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl" wire:click="closeModal">✕</button>

                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Schedule Interview</h2>
                </div>

                <!-- Details -->
                <div class="p-6 space-y-4 text-left">
                    @if($selectedInterview)
                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Teacher Name</label>
                            <p class="font-medium text-gray-900">{{ $selectedInterview->teacher->user->name ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Subject & Class</label>
                            <p class="font-medium text-gray-900">
                                {{ $selectedInterview->examAttempt->examSet->subject->subject_name ?? 'N/A' }} 
                                ({{ $selectedInterview->examAttempt->examSet->category->name ?? 'N/A' }})
                            </p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Requested Date & Time</label>
                            <p class="font-medium text-gray-900 bg-gray-100 p-2 rounded">
                                {{ $selectedInterview->scheduled_at->format('Y-m-d H:i') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">This is the date/time requested by the teacher</p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Schedule Date & Time *</label>
                            <input type="datetime-local" wire:model="scheduleDate"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                            @error('scheduleDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            <p class="text-xs text-gray-500 mt-1">You can edit this to schedule a different time</p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Interview Meeting Link *</label>
                            <input type="url" wire:model="meetingLink" placeholder="Enter meeting URL (Google Meet, Zoom, etc.)"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                            @error('meetingLink') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    @else
                        <div class="text-center py-4 text-gray-500">
                            No interview selected.
                        </div>
                    @endif
                </div>

                <!-- Footer Buttons -->
                <div class="p-6 border-t border-gray-200 flex justify-end space-x-2">
                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300" wire:click="closeModal">Cancel</button>
                    <button wire:click="approveInterview({{ $selectedInterview->id ?? 'null' }})"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                        </svg>
                        Schedule Interview
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Reject Modal -->
    @if($showRejectModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md relative">
                <!-- Close Button -->
                <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl" wire:click="closeModal">✕</button>

                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Reject Interview Request</h2>
                </div>

                <!-- Details -->
                <div class="p-6 space-y-4 text-left">
                    @if($selectedInterview)
                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Teacher Name</label>
                            <p class="font-medium text-gray-900">{{ $selectedInterview->teacher->user->name ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Subject & Class</label>
                            <p class="font-medium text-gray-900">
                                {{ $selectedInterview->examAttempt->examSet->subject->subject_name ?? 'N/A' }} 
                                ({{ $selectedInterview->examAttempt->examSet->category->name ?? 'N/A' }})
                            </p>
                        </div>

                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Rejection Reason *</label>
                            <textarea wire:model="rejectionReason" placeholder="Please explain why this interview request is being rejected"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200" rows="4"></textarea>
                            @error('rejectionReason') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    @else
                        <div class="text-center py-4 text-gray-500">
                            No interview selected.
                        </div>
                    @endif
                </div>

                <!-- Footer Buttons -->
                <div class="p-6 border-t border-gray-200 flex justify-end space-x-2">
                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300" wire:click="closeModal">Cancel</button>
                    <button wire:click="rejectInterview({{ $selectedInterview->id ?? 'null' }})"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reject Interview
                    </button>
                </div>
            </div>
        </div>
    @endif

        <style>
        .tab-active {
            border-bottom: 2px solid #1e40af;
            color: #1e40af;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-scheduled { background-color: #d1fae5; color: #065f46; }
        .status-completed { background-color: #f3f4f6; color: #374151; }
        .status-rejected { background-color: #fee2e2; color: #991b1b; }
    </style>
</div>
   