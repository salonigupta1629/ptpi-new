<div class="max-w-7xl mx-auto p-6">
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Center Exam Requests</h2>

            <!-- Search -->
            <div class="relative">
                <input type="text" wire:model.live.debounce.500="search" placeholder="Search name, email, center or pin..."
                    class="pl-10 pr-4 py-2 border rounded-lg shadow-sm w-72 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-sm text-slate-600 bg-slate-50">
                        <th class="text-left px-4 py-2">User</th>
                        <th class="text-left px-4 py-2">Center Name</th>
                        <th class="text-left px-4 py-2">Pincode</th>
                        <th class="text-left px-4 py-2">Status</th>
                        <th class="px-4 py-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teacherApplications as $teacherApplication)
                            <tr class="bg-white hover:bg-slate-50 shadow-sm rounded-lg">
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-800">{{ $teacherApplication->user->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $teacherApplication->user->email }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $teacherApplication->center->center_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $teacherApplication->pincode }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                          {{ $teacherApplication->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $teacherApplication->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center gap-2 justify-end">
                                        <!-- Generate Passkey -->
                                       <button wire:click="generatePasskey({{ $teacherApplication->id }})"
        class="bg-blue-500 hover:bg-blue-600 px-3 py-1.5 rounded-lg text-white text-sm flex items-center gap-2 transition">

    {{-- Normal state --}}
    <span wire:loading.remove wire:target="generatePasskey">
        {{ \App\Models\Passkeys::where('application_id', $teacherApplication->id)->exists() 
            ? 'Regenerate Passkey' 
            : 'Generate Passkey' }}
    </span>

    {{-- Loading state --}}
    <span wire:loading wire:target="generatePasskey" class="flex items-center">
        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
        <span class="ml-2">
            {{ \App\Models\Passkeys::where('application_id', $teacherApplication->id)->exists() 
                ? 'Regenerating...' 
                : 'Generating...' }}
        </span>
    </span>
</button>


                                        <!-- View Button -->
                                        <button wire:click="$dispatch('viewModal',{requestId: {{ $teacherApplication->id }}})"
                                            class="border border-green-500 text-green-600 hover:bg-green-50 px-3 py-1.5 rounded-lg text-sm font-medium transition">
                                            View
                                        </button>
                                    </div>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex items-center justify-between text-sm text-gray-600">
            {{ $teacherApplications->links() }}
        </div>
    </div>

    <!-- View Modal -->
    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
            <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Application Details</h3>
                <p class="mb-2"><span class="font-medium">Name:</span> {{ $requestedApplication->user->name }}</p>
                <p class="mb-4"><span class="font-medium">Email:</span> {{ $requestedApplication->user->email }}</p>

                <div class="flex gap-3 justify-end">
                    <button wire:click="markApprove"
                        class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg font-medium text-white transition">Approve</button>
                    <button wire:click="closeModal"
                        class="px-4 py-2 rounded-lg font-medium text-red-500 border border-red-400 hover:bg-red-50 transition">Close</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Passkey Modal -->
    @if ($openPasskeyModal && $passkey)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
            <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-sm text-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Generated Passkey</h3>
                <div class="text-2xl font-mono bg-gray-100 px-4 py-2 rounded-md mb-6">
                    {{ $passkey }}
                </div>
                <button wire:click="savePasskey"
                    class="bg-blue-500 hover:bg-blue-600 px-6 py-2 rounded-lg text-white font-medium transition">OK</button>
            </div>
        </div>
    @endif
</div>