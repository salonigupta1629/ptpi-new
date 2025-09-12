<div>
     <!-- Loading Overlay -->
   <div wire:loading class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class=" p-6 rounded-lg shadow-lg flex m-[20%] flex-col items-center">
        <!-- Loader -->
        <div class="loader mb-4"></div>
        <!-- Text -->
        <span class="text-white font-medium">Loading teachers...</span>
    </div>
</div>
    <div class="p-4">
    <!-- Top Bar -->
    <div class="flex justify-between bg-white p-4 shadow rounded-md border items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Available Teachers</h2>

        <!-- Buttons -->
        <div class="flex space-x-2">
            <!-- View Switch -->
            <div class="flex gap-1 border border-gray-300 rounded-lg overflow-hidden">
                <button
                    wire:click="changeView('card')"
                    class="px-4 py-2 text-sm flex items-center {{ $view === 'card' ? 'bg-white  shadow-xl
                     font-semibold' : 'bg-gray-100' }}"
                >
                  <i class="fas fa-table mr-2"></i>Table



                </button>
                <button
                    wire:click="changeView('table')"
                    class="px-4 py-2 text-sm flex items-center {{ $view === 'table' ? 'bg-white font-semibold' : 'bg-gray-100' }}"
                >
                 <i class="fa-regular fa-address-card mr-2"></i>Card
                </button>
            </div>

            <!-- Refresh -->
            <button wire:click="$refresh" class="bg-white border border-gray-300 px-4 py-2 rounded-lg text-sm flex items-center">
                <i class="fas fa-sync mr-2"></i>Refresh
            </button>

            <!-- Clear Filter -->
            <button wire:click="clearFilters" class="bg-white border border-gray-300 px-4 py-2 rounded-lg text-sm flex items-center">
                <i class="fa-regular fa-filter mr-2"></i>Clear Filter
            </button>
        </div>
    </div>

    <!-- Results Count -->
    <div class="mb-4 text-sm text-gray-600">
        Showing {{ $teachers->count() }} of {{ $teachers->total() }} teachers
    </div>


    <!-- Card View -->
    @if($view === 'table')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($teachers as $teacher)
        <div class="teacher-card bg-white rounded-md border overflow-hidden transition-all duration-300 hover:shadow-lg">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-14 h-14 rounded-full bg-purple-100 text-purple-800 flex items-center justify-center font-bold text-xl">
                            {{ substr($teacher->user->name, 0, 2) }}
                        </div>
                        <div class="ml-4">
                            <h3 class="font-bold text-lg">{{ $teacher->user->name }}</h3>
                            <p class="text-gray-500 text-sm">
                                @if($teacher->subjects->isNotEmpty())
                                    {{ $teacher->subjects->first()->subject->subject_name }} Teacher
                                @else
                                    Teacher
                                @endif
                            </p>
                        </div>
                    </div>
                    <span class="bg-{{
                        $teacher->availability_status === 'Available' ? 'green' :
                        ($teacher->availability_status === 'Busy' ? 'yellow' : 'gray')
                    }}-100 text-{{
                        $teacher->availability_status === 'Available' ? 'green' :
                        ($teacher->availability_status === 'Busy' ? 'yellow' : 'gray')
                    }}-800 text-xs px-2 py-1 rounded-full">
                        {{ $teacher->availability_status }}
                    </span>
                </div>

                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    @if($teacher->addresses->isNotEmpty())
                        {{ $teacher->addresses->first()->district ?: $teacher->addresses->first()->division }}, Bihar
                    @else
                        Location not specified
                    @endif
                </div>

                <div class="mt-2 flex items-center text-sm text-gray-600">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    @if($teacher->qualifications->isNotEmpty())
                        {{ $teacher->qualifications->first()->qualification->name }}
                    @else
                        Education not specified
                    @endif
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach($teacher->skills->take(3) as $skill)
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-xs">{{ $skill->skill->name }}</span>
                    @endforeach
                    @if($teacher->skills->count() > 3)
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-xs">+{{ $teacher->skills->count() - 3 }} more</span>
                    @endif
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <div class="text-teal-600 font-bold">
                        Rating: {{ number_format($teacher->rating, 1) }}/5
                    </div>
                    <a href="{{ route('recruiter.teacher.profile', $teacher->id) }}"
                        class="bg-teal-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-teal-600 transition-colors">
                        View Profile
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 text-gray-500">
            <i class="fas fa-users text-4xl mb-4"></i>
            <p>No teachers found matching your criteria.</p>
        </div>
        @endforelse
    </div>
    @endif

    <!-- Table View -->
    @if($view === 'card')
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($teachers as $teacher)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-800 flex items-center justify-center font-bold">
                                {{ substr($teacher->user->name, 0, 2) }}
                            </div>
                            <div class="ml-4">
                                <div class="font-medium text-gray-900">{{ $teacher->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $teacher->user->email }}</div>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($teacher->addresses->isNotEmpty())
                            {{ $teacher->addresses->first()->district ?: $teacher->addresses->first()->division }}, Bihar
                        @else
                            -
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-yellow-400 mr-1">★</span>
                            <span class="font-medium">{{ number_format($teacher->rating, 1) }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs rounded-full bg-{{
                            $teacher->availability_status === 'Available' ? 'green' :
                            ($teacher->availability_status === 'Busy' ? 'yellow' : 'gray')
                        }}-100 text-{{
                            $teacher->availability_status === 'Available' ? 'green' :
                            ($teacher->availability_status === 'Busy' ? 'yellow' : 'gray')
                        }}-800">
                            {{ $teacher->availability_status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('recruiter.teacher.profile', $teacher->id) }}"
                           class="text-teal-600 hover:text-teal-900">View Profile</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-users text-3xl mb-3"></i>
                        <p>No teachers found matching your criteria.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif

    <!-- Pagination -->
    <div class="mt-6">
        {{ $teachers->links() }}
    </div>
</div>

<!-- JavaScript for additional interactivity -->
<script>
    document.addEventListener('livewire:initialized', () => {
        // Add any additional JavaScript functionality here
    });
</script>

<style>
 .loader {
    border: 6px solid #f3f3f3;
    border-top: 6px solid #14b8a6; /* Tailwind teal-500 */
    border-radius: 50%;
    width: 48px;
    height: 48px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

    .teacher-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
</style>

</div>
