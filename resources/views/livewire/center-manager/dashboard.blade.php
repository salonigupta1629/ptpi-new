<div class="max-w-7xl mx-auto p-6">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-2xl font-semibold">Center Exam Requests</h2>

            </div>

            <div class="flex items-center gap-3">
                <input type="text" placeholder="Search name, email, center or pin..."
                    class="px-3 py-2 border rounded-lg shadow-sm w-64 focus:outline-none focus:ring-2 focus:ring-indigo-300" />
            </div>
        </div>

        <div class="">
            <table class="min-w-full table-auto border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-sm text-slate-600">
                        <th class="text-left px-4 py-2">User</th>
                        <th class="text-left px-4 py-2">Center Name</th>
                        <th class="text-left px-4 py-2">Pincode</th>
                        <th class="text-left px-4 py-2">Status</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white shadow-sm rounded-lg align-top">
                        <td class="px-4 py-3">
                            <div class="font-medium">Aman Sharma</div>
                            <div class="text-xs text-slate-400">aman@example.com</div>
                        </td>
                        <td class="px-4 py-3 text-sm">Kitabiadda Hub</td>
                        <td class="px-4 py-3 text-sm">560001</td>
                        <td class="px-4 py-3">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center gap-2 justify-end">
                                <button class="text-sm px-3 py-1 border rounded hover:bg-slate-50">Accept</button>
                                <div x-data="{ view: false }" class="relative">
                                    <button @click="view= true"
                                        class="text-sm px-3 py-1 border rounded text-green-600 hover:bg-green-50">View</button>
                                    <div x-show="view"
                                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                        x-transition>
                                        <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md relative">
                                            <!-- Close Button -->
                                            <button @click="view = false"
                                                class="absolute top-3 right-3 text-gray-500 hover:text-red-600">
                                                ✕
                                            </button>

                                            <!-- User Data -->
                                            <h2 class="text-xl font-semibold mb-4">User Details</h2>
                                            <div class="space-y-2 text-sm">
                                                <p><strong>Name:</strong> Aman Sharma</p>
                                                <p><strong>Email:</strong> aman@example.com</p>
                                                <p><strong>Center:</strong> Kitabiadda Hub</p>
                                                <p><strong>Pincode:</strong> 560001</p>
                                                <p><strong>Status:</strong> Active</p>
                                            </div>

                                            <!-- Footer -->
                                            <div class="mt-5 flex justify-end">
                                                <button @click="view = false"
                                                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>
        </td>
        </tr>
        <tr class="bg-white shadow-sm rounded-lg align-top">
            <td class="px-4 py-3">
                <div class="font-medium">Riya Patel</div>
                <div class="text-xs text-slate-400">riya@example.com</div>
            </td>
            <td class="px-4 py-3 text-sm">West Center</td>
            <td class="px-4 py-3 text-sm">110011</td>
            <td class="px-4 py-3">
                <span
                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Paused</span>
            </td>
            <td class="px-4 py-3 text-right">
                <div class="flex items-center gap-2 justify-end">
                    <button class="text-sm px-3 py-1 border rounded hover:bg-slate-50">Accept</button>
                    <button class="text-sm px-3 py-1 border rounded text-green-600 hover:bg-green-50">View</button>
                </div>
            </td>
        </tr>
        <tr class="bg-white shadow-sm rounded-lg align-top">
            <td class="px-4 py-3">
                <div class="font-medium">Vikram Rao</div>
                <div class="text-xs text-slate-400">vikram@example.com</div>
            </td>
            <td class="px-4 py-3 text-sm">East Point</td>
            <td class="px-4 py-3 text-sm">400056</td>
            <td class="px-4 py-3">
                <span
                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Inactive</span>
            </td>
            <td class="px-4 py-3 text-right">
                <div class="flex items-center gap-2 justify-end">
                    <button class="text-sm px-3 py-1 border rounded hover:bg-slate-50">Accept</button>
                    <button class="text-sm px-3 py-1 border rounded text-green-600 hover:bg-green-50">View</button>
                </div>
            </td>
        </tr>
        </tbody>
        </table>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <div class="text-sm text-slate-500">Showing 1 - 3 of 3</div>
        <div class="flex items-center gap-2">
            <button class="px-3 py-1 border rounded">Prev</button>
            <div class="px-3 py-1 border rounded">1 / 1</div>
            <button class="px-3 py-1 border rounded">Next</button>
        </div>
    </div>
</div>

</div>