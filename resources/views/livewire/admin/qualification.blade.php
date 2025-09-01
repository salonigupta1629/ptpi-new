<div class="p-6 bg-white shadow rounded-lg">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold">Educational Qualifications</h2>

        <button wire:click="openModal" class="px-4 py-2 bg-blue-600 text-white rounded">
            + Add Qualification
        </button>
    </div>

    @if (session()->has('message'))
        <div class="p-2 mb-3 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-auto">
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border text-left">Name</th>
                    <th class="p-2 border text-left">Description</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($qualifications as $q)
                    <tr>
                        <td class="p-2 border">{{ $q->id }}</td>
                        <td class="p-2 border">{{ $q->name }}</td>
                        <td class="p-2 border">{{ \Illuminate\Support\Str::limit($q->description, 80) }}</td>
                        <td class="p-2 border">
                            <button wire:click="edit({{ $q->id }})" class="px-3 py-1 mr-2 bg-yellow-500 text-white rounded">Edit</button>

                            <!-- confirm on click -->
                            <button wire:click="delete({{ $q->id }})"
                                    onclick="confirm('Delete this qualification?') || event.stopImmediatePropagation()"
                                    class="px-3 py-1 bg-red-600 text-white rounded">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-2 border text-center" colspan="4">No qualifications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">
                        {{ $isEditing ? 'Edit Qualification' : 'Add Qualification' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-800">✕</button>
                </div>

                <form wire:submit.prevent="save" class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium mb-1">Name</label>
                        <input type="text" wire:model.defer="name" class="w-full border border-gray-400 p-2 rounded" />
                        @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea wire:model.defer="description" rows="4" class="w-full border border-gray-400 p-2 rounded"></textarea>
                        @error('description') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
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
