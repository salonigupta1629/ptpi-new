<div class="p-6 bg-white shadow rounded-lg">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold">Manage Role</h2>

        <div class="flex items-center gap-2">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search role..."
                   class="border rounded px-3 py-2" />

            <button wire:click="openModal" class="px-4 py-2 bg-blue-600 text-white rounded">
                + Add Role
            </button>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif
    <div class="overflow-x-auto">
        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border text-left">ID</th>
                    <th class="p-2 border text-left">Name</th>
                    <th class="p-2 border text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td class="p-2 border">{{ $role->id }}</td>
                        <td class="p-2 border">{{ $role->name }}</td>
                        <td class="p-2 border flex gap-2">
                            <button wire:click="edit({{ $role->id }})" class="px-3 py-1 bg-yellow-500 text-white rounded">
                                Edit
                            </button>

                            <!-- JS confirm before calling delete -->
                            <button onclick="confirm('Are you sure you want to delete this Role?') || event.stopImmediatePropagation()"
                                    wire:click="delete({{ $role->id }})"
                                    class="px-3 py-1 bg-red-600 text-white rounded">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">No levels found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-40 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-semibold mb-4">{{ $isEditing ? 'Edit Role' : 'Add Role' }}</h3>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Name</label>
                        <input type="text" wire:model.defer="name" class="w-full border border-gray-300 rounded px-3 py-2" />
                        @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            {{ $isEditing ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
