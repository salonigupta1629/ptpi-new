<div class="p-5">
    <h1 class="text-blue-800 font-medium text-xl">Teacher Interview Management</h1>

    <div x-data="{ open: false, openSchedule: false, selected: null }">
        <table class="text-gray-700 mt-5 w-full">
            <thead>
                <tr>
                    <th class="border-b p-2">Teacher Name</th>
                    <th class="border-b p-2">Subject (class)</th>
                    <th class="border-b p-2">Desired Date/ Time</th>
                    <th class="border-b p-2">Grade</th>
                    <th class="border-b p-2">Status (mode)</th>
                    <th class="border-b p-2">Shedule</th>
                    <th class="border-b p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($interviews as $interview)
                    <tr>
                        <th class="border-b p-2">{{ $interview->exam_attempt_id }}</th>
                        <th class="border-b p-2">Mathematics (0-2)</th>
                        <th class="border-b p-2">{{ $interview->sheduled_at }}</th>
                        <th class="border-b p-2">8/10</th>
                        <th class="border-b p-2">{{ $interview->status }}</th>
                        <th class="border-b p-2">17-09-2025 12:03</th>
                        <th class="border-b p-2">
                            <!-- View Modal -->
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition"
                                @click="selected = {{ $interview->id }}; open = true">
                                View
                            </button>

                            <!-- Schedule Modal -->
                            <button
                                class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition"
                                @click="selected = {{ $interview->id }}; openSchedule = true">
                                Schedule
                            </button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- View Modal -->
        <div x-show="open" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" x-transition.opacity
            @click.self="open = false">

            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative" x-transition.scale>
                <!-- Close Button -->
                <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl" @click="open = false">
                    ✕
                </button>

                <!-- Header -->
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Teacher Interview Details id <span x-text="selected"></span> </h2>

                <!-- Details Section -->
                <div class="space-y-3 text-left">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Teacher Name</span>
                        <span class="font-medium text-gray-900">Aman Kumar</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email</span>
                        <span class="font-medium text-gray-900">theaman6826@gmail.com</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subject</span>
                        <span class="font-medium text-gray-900">Mathematics</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Class Category</span>
                        <span class="font-medium text-gray-900">0 to 2</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Level</span>
                        <span class="font-medium text-gray-900">Level - 2 (From Home)</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Attempt</span>
                        <span class="font-medium text-gray-900">3</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Created At</span>
                        <span class="font-medium text-gray-900">2025-09-20 17:03</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status & Mode</span>
                        <span class="px-2 py-1 text-xs font-medium text-white bg-yellow-500 rounded">
                            Pending (Offline)
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Desired Date & Time</span>
                        <span class="font-medium text-gray-900">2025-09-25 11:33</span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-6 flex justify-end">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700" @click="open = false">
                        Close
                    </button>
                </div>
            </div>
        </div>


        <!-- Schedule Modal -->
        <div x-show="openSchedule" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
            x-transition.opacity @click.self="openSchedule = false">

            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative" x-transition.scale>
                <!-- Close Button -->
                <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl"
                    @click="openSchedule = false">✕</button>

                <!-- Header -->
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Schedule Interview id <span x-text="selected"></span> </h2>

                <!-- Details -->
                <div class="space-y-4 text-left">
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Teacher Name</label>
                        <p class="font-medium text-gray-900">Aman Kumar</p>
                    </div>

                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Subject & Class</label>
                        <p class="font-medium text-gray-900">Mathematics (0 to 2)</p>
                    </div>

                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Schedule Date & Time *</label>
                        <input type="datetime-local"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                    </div>

                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Interview Meeting Link *</label>
                        <input type="url" placeholder="Enter meeting URL (Google Meet, Zoom, etc.)"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="mt-6 flex justify-end space-x-2">
                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300"
                        @click="openSchedule = false">
                        Cancel
                    </button>
                    <button
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


    </div>
</div>