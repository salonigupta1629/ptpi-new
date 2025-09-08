<div class="bg-gray-100">
    <div class="max-w-7xl mx-auto p-6 space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-desktop text-blue-600"></i> Manage Exam Sets
                </h1>
                <p class="text-sm text-gray-500">Create and manage your examination sets</p>
            </div>
            <button  data-modal-target="default-modal" data-modal-toggle="default-modal" 
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 transition px-4 py-2 rounded-md text-white font-medium shadow-sm">
                <i class="fa-solid fa-plus"></i> Create Exam Set
            </button>
        </div>
        <!-- Search & Filter -->
        <div class="bg-white rounded-md shadow-sm p-4 flex items-center justify-between">
            <div class="relative w-full max-w-sm">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" placeholder="Search exam sets..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
            </div>
            <button class="ml-4 px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-100">
                <i class="fa-solid fa-filter"></i> Filters
            </button>
        </div>
                    <livewire:@livewire('examiner.component.create-exam-set')>

        <!-- Exam Table -->
        <div class="bg-white rounded-md shadow-sm overflow-hidden">
            <table class="w-full border-collapse text-sm">
                <thead class="bg-gray-50 border-b text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left">Exam Details</th>
                        <th class="px-4 py-3 text-left">Class & Subject</th>
                        <th class="px-4 py-3 text-left">Type</th>
                        <th class="px-4 py-3 text-left">Duration</th>
                        <th class="px-4 py-3 text-left">Marks</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Questions</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-gray-700">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="font-semibold">SET - A</div>
                            <div class="text-xs text-gray-500">Testing</div>
                        </td>
                        <td class="px-4 py-3">Mathematics (0 to 2)<br><span class="text-xs text-gray-500">Level -
                                1</span></td>
                        <td class="px-4 py-3"><span
                                class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Home</span></td>
                        <td class="px-4 py-3"><i class="fa-regular fa-clock"></i> 20 mins</td>
                        <td class="px-4 py-3"><i class="fa-solid fa-medal"></i> 200 marks</td>
                        <td class="px-4 py-3"><span class="text-orange-600 flex items-center gap-1"><i
                                    class="fa-solid fa-lock"></i> Draft</span></td>
                        <td class="px-4 py-3">10 / 40 questions</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-list"></i></button>
                            <button class="text-purple-600 hover:text-purple-800"><i
                                    class="fa-solid fa-pen"></i></button>
                            <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="font-semibold">SET - B</div>
                            <div class="text-xs text-gray-500">Demo Exam</div>
                        </td>
                        <td class="px-4 py-3">Mathematics (0 to 2)<br><span class="text-xs text-gray-500">Level -
                                2</span></td>
                        <td class="px-4 py-3"><span
                                class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">Exam Centre</span></td>
                        <td class="px-4 py-3"><i class="fa-regular fa-clock"></i> 200 mins</td>
                        <td class="px-4 py-3"><i class="fa-solid fa-medal"></i> 100 marks</td>
                        <td class="px-4 py-3"><span class="text-orange-600 flex items-center gap-1"><i
                                    class="fa-solid fa-lock"></i> Draft</span></td>
                        <td class="px-4 py-3">0 / 222 questions</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-list"></i></button>
                            <button class="text-purple-600 hover:text-purple-800"><i
                                    class="fa-solid fa-pen"></i></button>
                            <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="font-semibold">SET - C</div>
                            <div class="text-xs text-gray-500">Practice Test</div>
                        </td>
                        <td class="px-4 py-3">Science (0 to 2)<br><span class="text-xs text-gray-500">Level - 1</span>
                        </td>
                        <td class="px-4 py-3"><span
                                class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Home</span></td>
                        <td class="px-4 py-3"><i class="fa-regular fa-clock"></i> 30 mins</td>
                        <td class="px-4 py-3"><i class="fa-solid fa-medal"></i> 150 marks</td>
                        <td class="px-4 py-3"><span class="text-orange-600 flex items-center gap-1"><i
                                    class="fa-solid fa-lock"></i> Draft</span></td>
                        <td class="px-4 py-3">5 / 50 questions</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-list"></i></button>
                            <button class="text-purple-600 hover:text-purple-800"><i
                                    class="fa-solid fa-pen"></i></button>
                            <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
