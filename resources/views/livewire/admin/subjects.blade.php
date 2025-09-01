<div class="p-6 bg-white shadow rounded-lg">
   
    <div class="flex justify-between items-center mb-4">
 <h2 class="text-lg font-semibold mb-4">Manage Subjects
     <span class=" text-gray-900 text-lg font-semibold">({{ $totalCount }})</span>
 </h2>
     <!-- Button to open modal -->
    <button wire:click="openModal"
            class="mb-4 px-4 py-2 bg-blue-600 text-white rounded">
        + Add Subject
    </button>
    </div>


    @if (session()->has('message'))
        <div class="p-2 mb-3 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

   
    <!-- Table -->
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td class="p-2 border  text-center ">{{ $subject->id }}</td>
                    <td class="p-2 border text-center ">{{ $subject->subject_name }}</td>
                    <td class="p-2 border  text-center">{{ $subject->subject_description }}</td>
                    <td class="p-2 border space-x-2  text-center">
                        <button wire:click="edit({{ $subject->id }})"
                                class="px-3 py-1 bg-yellow-500 text-white rounded">
                            Edit
                        </button>
                        <button wire:click="delete({{ $subject->id }})"
                                class="px-3 py-1 bg-red-500 text-white rounded">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h3 class="text-lg font-semibold mb-4">
                    {{ $isEditing ? 'Edit Subject' : 'Add Subject' }}
                </h3>

                <form wire:submit.prevent="save" class="space-y-3">
                    <input type="text" wire:model="subject_name" placeholder="Subject Name"
                           class="w-full border border-gray-300 p-2 rounded">
                    <textarea wire:model="subject_description" placeholder="Description"
                              class="w-full border border-gray-400 p-2 rounded"></textarea>

                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal"
                                class="px-4 py-2 bg-gray-500 text-white rounded">
                            Cancel
                        </button>
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
