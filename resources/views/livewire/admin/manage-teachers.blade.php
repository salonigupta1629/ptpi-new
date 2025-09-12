<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Teacher Management</h1>
                <div class="flex items-center text-sm text-gray-600">
                    <span class="mr-3"><i class="fas fa-users mr-1"></i> {{ $stats['total'] }} teachers registered</span>
                    <span class="mr-3">•</span>
                    <span class="mr-3 text-success"><i class="fas fa-circle-check mr-1"></i> {{ $stats['active'] }} active</span>
                    <span class="mr-3">•</span>
                    <span class="text-danger"><i class="fas fa-circle-pause mr-1"></i> {{ $stats['inactive'] }} inactive</span>
                </div>
            </div>
            <div class="flex space-x-3">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center">
                    <i class="fas fa-file-export mr-2 text-gray-600"></i>
                    Export
                </button>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="w-full md:w-1/3 relative">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                <input 
                    type="text" 
                    wire:model.live="search"
                    placeholder="Search by name, email, or ID" 
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                />
            </div>
            <div class="flex space-x-3">
                <button wire:click="$toggle('showFilters')" class="px-4 py-2.5 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center">
                    <i class="fas fa-filter mr-2 text-gray-600"></i>
                    {{ $showFilters ?? false ? 'Hide' : 'Show' }} Filters
                </button>
                <button class="px-4 py-2.5 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center">
                    <i class="fas fa-sort mr-2 text-gray-600"></i>
                    Sort
                </button>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    @if($showFilters ?? false)
    <div class="mb-6 bg-white p-5 rounded-xl shadow filter-section">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-700"><i class="fas fa-sliders-h mr-2 text-primary"></i> Filters</h2>
            <button wire:click="clearFilters" class="text-sm text-primary hover:text-primary-dark font-medium">Clear All</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Qualification</label>
    <div class="relative">
        <select wire:model.live="qualificationFilter" class="w-full px-3 py-2.5 border border-gray-300 rounded-md appearance-none focus:ring-2 focus:ring-primary focus:border-primary">
            <option value="">All Qualifications</option>
            @foreach($qualifications as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
        <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
    </div>
</div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                <div class="relative">
                    <select wire:model.live="subjectFilter" class="w-full px-3 py-2.5 border border-gray-300 rounded-md appearance-none focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="">All Subjects</option>
                        @foreach($subjects as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <div class="relative">
                    <select wire:model.live="locationFilter" class="w-full px-3 py-2.5 border border-gray-300 rounded-md appearance-none focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="">All Locations</option>
                        @foreach($locations as $id => $name)
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <div class="relative">
                    <select wire:model.live="statusFilter" class="w-full px-3 py-2.5 border border-gray-300 rounded-md appearance-none focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="">All Statuses</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Teachers Table -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <p class="text-sm text-gray-600">
                Showing {{ $teachers->firstItem() ?? 0 }} to {{ $teachers->lastItem() ?? 0 }} of {{ $teachers->total() }} teachers
            </p>
            <div class="flex items-center">
                <span class="text-sm text-gray-600 mr-3">Rows per page:</span>
                <select wire:model.live="perPage" class="text-sm border border-gray-300 rounded px-2 py-1">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 teacher-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <span>ID</span>
                                <i class="fas fa-sort ml-1 text-gray-400"></i>
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <span>Name</span>
                                <i class="fas fa-sort ml-1 text-gray-400"></i>
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qualification</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($teachers as $teacher)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $teacher->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($teacher->user->name) }}&background=random" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $teacher->user->name ?? 'N/A' }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $teacher->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $teacher->user->email ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @if($teacher->qualifications->isNotEmpty())
                                        {{ $teacher->qualifications->first()->qualification->name ?? 'N/A' }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @if($teacher->addresses->isNotEmpty())
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt mr-1 text-gray-400"></i>
                                            {{ $teacher->addresses->first()->district ?? 'N/A' }}
                                        </div>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $teacher->availability_status === 'Available' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    <i class="fas fa-circle mr-1 text-[8px] mt-0.5 {{ $teacher->availability_status === 'Available' ? 'text-green-500' : 'text-gray-500' }}"></i>
                                    {{ $teacher->availability_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <a href="{{ route('admin.teacher.view', $teacher->id) }}" class="text-blue-600 hover:text-blue-900 action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                  
                                 
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-sm text-gray-500">No teachers found matching your criteria.</p>
                                    <button wire:click="clearFilters" class="mt-3 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark text-sm">
                                        Clear Filters
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $teachers->links() }}
        </div>
    </div>
</div>