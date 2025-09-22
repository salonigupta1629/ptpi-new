<div class="p-5">
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
</div>