<div class="container">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manage Exam Sets</h1>
        <button 
            wire:click="openModal"
            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200"
        >
            Add New Exam Set
        </button>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($examSets as $exam)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $exam->name }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($exam->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $exam->category->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                         {{ $exam->subject?->subject_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $exam->level->level_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $exam->status === 'published' ? 'bg-green-100 text-green-800' : 
                                   ($exam->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($exam->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3 flex items-center">
                            <a href="" 
                               class="text-teal-600 hover:text-teal-900 flex items-center">
                                <span>Questions</span>
                            </a>
                            <button wire:click="edit({{ $exam->id }})"
                                class="text-indigo-600 hover:text-indigo-900">
                                Edit
                            </button>
                            <button wire:click="destroy({{ $exam->id }})"
                                wire:confirm="Are you sure you want to delete this exam set?"
                                class="text-red-600 hover:text-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                            No exam sets found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 backdrop-blur-sm" wire:click="closeModal"></div>

                <div class="relative w-full max-w-2xl p-6 mx-auto bg-white rounded-xl shadow-xl transition-all">
                    <div class="absolute top-0 right-0 pt-4 pr-4">
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-3">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">
                            {{ $editingExamId ? 'Edit Exam Set' : 'Create New Exam Set' }}
                        </h3>
                        
                        <form wire:submit.prevent="storeOrUpdate" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <input type="text" wire:model="name" id="name" 
                                        class="w-full p-2 border rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                      @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>

                                <!-- Category - Moved before Subject -->
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                  <select wire:model="category_id" wire:change="updateSubjects($event.target.value)" id="category_id"
                                        class="w-full p-2 border rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Subject -->
 <div>
    <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
<select wire:model="subject_id" id="subject_id" 
    class="w-full p-2 border rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    <option value="">Select Subject</option>
    @foreach($subjects as $subj)
        <option value="{{ $subj->id }}">{{ $subj->subject_name }}</option>
    @endforeach
</select>
@error('subject_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
</div>


                                <!-- Level -->
                                <div>
                                    <label for="level_id" class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                                    <select wire:model="level_id" id="level_id" 
                                        class="w-full p-2 border rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Select Level</option>
                                        @foreach($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('level_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Total Marks -->
                                <div>
                                    <label for="total_marks" class="block text-sm font-medium text-gray-700 mb-1">Total Marks</label>
                                    <input type="number" wire:model="total_marks" id="total_marks" 
                                        class="w-full p-2 border rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('total_marks') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Duration -->
                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (minutes)</label>
                                    <input type="number" wire:model="duration" id="duration" 
                                        class="w-full p-2 border rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('duration') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Type -->
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                                    <select wire:model="type" id="type" 
                                        class="w-full p-2 border rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="online">Online</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                    @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select wire:model="status" id="status" 
                                        class="w-full p-2 border rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                        <option value="archieved">Archieved</option>
                                    </select>
                                    @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea wire:model="description" id="description" rows="3"
                                    class="w-full p-2 border rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex justify-end space-x-3 mt-6">
                                <button type="button" wire:click="closeModal"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-lg hover:bg-teal-700">
                                    {{ $editingExamId ? 'Update' : 'Create' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>