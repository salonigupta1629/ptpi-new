<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <header class="bg-blue-600 text-white rounded-xl shadow-lg mb-8">
            <div class="flex justify-between items-center p-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-semibold">Manage Recruiter Hiring Requests</h1>
                    <p class="mt-2 opacity-90">Review, approve, or reject teacher hiring requests efficiently</p>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white bg-opacity-20 p-3 rounded-lg">
                        <i class="fas fa-user-tie text-3xl"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Flash Message -->
        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('message') }}
            </div>
        @endif

        <!-- Filters Section -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Filters</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select
                        wire:model.live="statusFilter"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    >
                        @foreach($statusOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Recruiter Name Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Recruiter Name</label>
                    <select
                        wire:model.live="recruiterFilter"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    >
                        @foreach($recruiterOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Teacher Name Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Teacher Name</label>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="teacherSearch"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Search teacher..."
                    >
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-3 items-end">
                    <button
                        wire:click="resetFilters"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-200 flex-1"
                    >
                        RESET
                    </button>
                    <button
                        wire:click="exportData"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex-1 flex items-center justify-center"
                    >
                        <i class="fas fa-download mr-2"></i> EXPORT
                    </button>
                </div>
            </div>
        </div>

        <!-- Hiring Requests Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recruiter</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($hirings as $hiring)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <span class="text-blue-600 font-medium">
                                                {{ $hiring->teacher->initials ?? 'NA' }}
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $hiring->teacher->user->name ?? 'N/A' }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $hiring->teacher->experience_text ?? 'No experience' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $hiring->teacher->subjects_text }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $hiring->teacher->grade_levels_text }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $hiring->recruiter->name ?? 'N/A' }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $hiring->recruiter->email ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $hiring->request_date?->format('M j, Y') ?? $hiring->created_at->format('M j, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $hiring->status_badge_class }}">
                                        {{ ucfirst($hiring->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($hiring->status === \App\Models\TeacherHiring::STATUS_PENDING)
                                        <button
                                            wire:click="approveHiring({{ $hiring->id }})"
                                            class="text-green-600 hover:text-green-900 mr-3"
                                        >
                                            Approve
                                        </button>
                                        <button
                                            wire:click="rejectHiring({{ $hiring->id }})"
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            Reject
                                        </button>
                                    @else
                                        <button class="text-blue-600 hover:text-blue-900">
                                            View Details
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No hiring requests found matching your filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- <!-- Pagination -->
            @if($hirings->hasPages())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">{{ $hirings->firstItem() }}</span>
                                to <span class="font-medium">{{ $hirings->lastItem() }}</span>
                                of <span class="font-medium">{{ $totalCount }}</span> results
                            </p>
                        </div>
                        <div>
                            {{ $hirings->links() }}
                        </div>
                    </div>
                </div>
            @endif --}}
        </div>
    </div>
</div>
