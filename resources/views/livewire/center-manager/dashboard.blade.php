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
                    @foreach ($teacherApplications as $teacherApplication)
                        <tr class="bg-white shadow-sm rounded-lg align-top">
                            <td class="px-4 py-3">
                                <div class="font-medium">{{ $teacherApplication->user->name }}</div>
                                <div class="text-xs text-slate-400">{{ $teacherApplication->user->email }}</div>
                            </td>
                            <td class="px-4 py-3 text-sm">{{$teacherApplication->center->center_name}}</td>
                            <td class="px-4 py-3 text-sm">{{ $teacherApplication->pincode }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $teacherApplication->status }}</span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center gap-2 justify-end">
                                    <button wire:click="generatePasskey({{ $teacherApplication->id }})" class="bg-blue-500 px-2 py-1 rounded text-gray-100">Generate Passkey</button>
                                    <button wire:click="$dispatch('viewModal',{requestId: {{ $teacherApplication->id }}})"
                                        class="border p-1 rounded text-green-500 font-medium">View</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex items-center justify-between">
            {{ $teacherApplications->links() }}
        </div>
    </div>
    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-white bg-opacity-50 z-50">
            <div class="bg-red-200 p-10 rounded">
                <p class="text-2xl font-medium">Hello <span>{{ $requestedApplication->user->name }}</span></p>
                <p>User email : {{ $requestedApplication->user->email }}</p>
                    <button wire:click="markApprove"
                        class="bg-green-500 px-2 py-2 rounded font-medium text-white">Approve</button>
                <button wire:click="closeModal" class="text-red-500">close</button>
            </div>
        </div>
    @endif
</div>