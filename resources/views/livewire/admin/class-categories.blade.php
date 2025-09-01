<div class="p-6 bg-white shadow rounded-lg">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold">Class Categories
            <span class=" text-gray-900 text-lg font-semibold">({{ $totalCount }})</span>
    </h2>

        <div class="flex items-center gap-3">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search..."
                   class="border rounded p-2" />

            <button wire:click="openModal"
                    class="px-4 py-2 bg-blue-600 text-white rounded">
                + Add Category
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border text-left">ID</th>
                    <th class="p-2 border text-left">Name</th>
                    <th class="p-2 border text-left">Created</th>
                    <th class="p-2 border text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($classCategories as $category)
                    <tr>
                        <td class="p-2 border">{{ $category->id }}</td>
                        <td class="p-2 border">{{ $category->name }}</td>
                        <td class="p-2 border">{{ $category->created_at->diffForHumans() }}</td>
                        <td class="p-2 border space-x-2">
                            <button wire:click="edit({{ $category->id }})"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded">
                                Edit
                            </button>

                            <button
                                onclick="confirm('Are you sure you want to delete this category?') || event.stopImmediatePropagation()"
                                wire:click="delete({{ $category->id }})"
                                class="px-3 py-1 bg-red-600 text-white rounded">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $classCategories->links() }}
    </div>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-40 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg w-full max-w-md p-6 shadow-lg">
                <h3 class="text-xl font-semibold mb-4">
                    {{ $isEditing ? 'Edit Category' : 'Add Category' }}
                </h3>

                <form wire:submit.prevent="save" class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium mb-1">Name</label>
                        <input type="text" wire:model="name" class="w-full border border-gray-400 rounded p-2" />
                        @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
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
