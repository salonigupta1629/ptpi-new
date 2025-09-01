<div class="p-6 bg-white shadow rounded-lg">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold">Job Types</h2>
        <button wire:click="openModal" class="px-4 py-2 bg-blue-600 text-white rounded">+ Add Job Type</button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border text-left">#</th>
                    <th class="p-2 border text-left">Name</th>
                    <th class="p-2 border text-left">Description</th>
                    <th class="p-2 border text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobTypes as $jobType)
                    <tr>
                        <td class="p-2 border">{{ $jobType->id }}</td>
                        <td class="p-2 border">{{ $jobType->teacher_job_name }}</td>
                        <td class="p-2 border">{{ $jobType->description }}</td>
                        <td class="p-2 border">
                            <button wire:click="edit({{ $jobType->id }})" class="px-3 py-1 mr-2 bg-yellow-500 text-white rounded">Edit</button>

                            <!-- JS confirm before firing Livewire delete -->
                            <button
                                onclick="confirm('Are you sure you want to delete this job type?') || event.stopImmediatePropagation()"
                                wire:click="delete({{ $jobType->id }})"
                                class="px-3 py-1 bg-red-600 text-white rounded">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-2 border text-center" colspan="4">No job types yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
                <div class="p-4 border-b">
                    <h3 class="text-lg font-semibold">{{ $isEditing ? 'Edit Job Type' : 'Add Job Type' }}</h3>
                </div>

                <div class="p-4">
                    <form wire:submit.prevent="save" class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium mb-1">Name</label>
                            <input type="text" wire:model.defer="teacher_job_name" class="w-full border border-gray-300 p-2 rounded" placeholder="e.g. Full-time / Part-time">
                            @error('teacher_job_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Description (optional)</label>
                            <textarea wire:model.defer="description" class="w-full border border-gray-400 p-2 rounded" rows="3"></textarea>
                            @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end space-x-2 mt-3">
                            <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ $isEditing ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
