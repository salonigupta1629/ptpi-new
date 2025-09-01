<div class="p-6 bg-white shadow rounded-lg">

    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold">Manage Skills</h2>

        <div class="flex items-center gap-3">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search skills..."
                   class="border rounded px-3 py-1" />
            <button wire:click="openModal"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Add Skill
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left  font-semibold text-black">ID</th>
                    <th class="px-4 py-2 text-left  font-semibold text-black">Name</th>
                    <th class="px-4 py-2 text-left font-semibold text-black">Description</th>
                    <th class="px-4 py-2 text-left  font-semibold text-black">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($skills as $skill)
                    <tr>
                        <td class="px-4 py-2">{{ $skill->id }}</td>
                        <td class="px-4 py-2">{{ $skill->name }}</td>
                        <td class="px-4 py-2">{{ Str::limit($skill->description, 80) }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <button wire:click="edit({{ $skill->id }})"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded">
                                Edit
                            </button>

                            <button
                                onclick="confirm('Are you sure you want to delete this skill?') || event.stopImmediatePropagation()"
                                wire:click="delete({{ $skill->id }})"
                                class="px-3 py-1 bg-red-600 text-white rounded">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500">No skills found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $skills->links() }}
    </div>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="w-full max-w-md bg-white rounded shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">
                        {{ $isEditing ? 'Edit Skill' : 'Add Skill' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>

                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Name</label>
                        <input type="text" wire:model.defer="name"
                               class="w-full border border-gray-300 rounded px-3 py-2" />
                        @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea wire:model.defer="description" class="w-full border border-gray-400 rounded px-3 py-2" rows="4"></textarea>
                        @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" wire:click="closeModal"
                                class="px-4 py-2 border rounded">Cancel</button>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                            {{ $isEditing ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
