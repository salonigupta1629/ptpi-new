<div class="p-6 bg-white rounded-lg shadow-md">
    <!-- Header Section -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Manage Recruiters</h1>
        <p class="text-gray-600">{{ $filteredCount }} recruiters found</p>
        <a href="#" class="bg-purple-600 text-white px-4 py-2 rounded-md float-right">Export Data</a>
    </div>

    <!-- Search and Filter Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-4 gap-4">
        <!-- Search Bar -->
        <div class="w-full md:w-1/3">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search"
                placeholder="Search recruiters by name, email or phone..." 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>

        <!-- Filter Controls -->
        <div class="flex flex-wrap items-center gap-2">
            <select wire:model.live="statusFilter" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option value="">Status</option>
                <option value="Verified">Verified</option>
                <option value="Pending">Pending</option>
                <option value="Rejected">Rejected</option>
            </select>

            <select wire:model.live="genderFilter" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option value="">Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input type="checkbox" class="mr-2">
                        Recruiter
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Contact
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Company
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recruiters as $recruiter)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($recruiter['name'], 0, 2)) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $recruiter['name'] }}</div>
                                    <div class="text-sm text-gray-500">{{ $recruiter['email'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $recruiter['email'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $recruiter['contact'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $recruiter['company'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $recruiter['location'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $recruiter['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-900"><span class="text-xl">👁️</span></button>
                                <button class="text-yellow-600 hover:text-yellow-900"><span class="text-xl">✉️</span></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                            No recruiters found matching your criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Additional Controls (Columns, Filters, Density, Export) -->
    <div class="mt-4 flex space-x-2">
        <button class="px-3 py-2 border border-gray-300 rounded-md text-sm">Columns</button>
        <button class="px-3 py-2 border border-gray-300 rounded-md text-sm">Filters</button>
        <button class="px-3 py-2 border border-gray-300 rounded-md text-sm">Density</button>
        <button class="px-3 py-2 border border-gray-300 rounded-md text-sm">Export</button>
    </div>
</div>