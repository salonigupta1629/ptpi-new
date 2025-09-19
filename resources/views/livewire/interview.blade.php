<div class="p-5">
    <h1 class=" text-blue-800 font-medium text-xl">Teacher Interview Management</h1>
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
            <tr>
                <th class="border-b p-2">Aman Kumar</th>
                <th class="border-b p-2">Mathematics (0-2)</th>
                <th class="border-b p-2">17-09-2025 12:03</th>
                <th class="border-b p-2">8/10</th>
                <th class="border-b p-2">Completed</th>
                <th class="border-b p-2">17-09-2025 12:03</th>
                <th class="border-b p-2">
                    <div x-data="{ open: false }" class="relative">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition"
                            @click="open = true">
                            View
                        </button>

                        <div x-show="open" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
                            x-transition.opacity @click.self="open = false"  click outside closes modal
                            >
                            <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md text-center relative"
                                x-transition.scale>
                                <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
                                    @click="open = false">
                                    ✕
                                </button>

                                <h1 class="text-3xl font-bold text-gray-800 mb-4">Hello 👋</h1>
                                <p class="text-gray-600">This is your Alpine.js centered modal.</p>
                            </div>
                        </div>
                    </div>

                </th>
            </tr>

        </tbody>
    </table>



</div>