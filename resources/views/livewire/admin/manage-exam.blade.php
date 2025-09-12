<div class="container mx-auto px-4 py-8 max-w-7xl">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Exam Sets Management</h1>
        <button wire:click="openModal"
            class="mt-4 sm:mt-0 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md transition-all duration-300 ease-in-out transform hover:scale-105">
            Create New Exam Set
        </button>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-6 animate-fade-in">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-lg mb-6 animate-fade-in">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Category</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Subject</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Level</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($examSets as $exam)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $exam->name }}</div>
                                <div class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($exam->description, 60) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $exam->category->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $exam->subject->subject_name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $exam->level->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $exam->status === 'published'
                                        ? 'bg-green-100 text-green-800'
                                        : ($exam->status === 'draft'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($exam->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center space-x-4">
                                <a href="{{ route('admin.exam-questions', $exam->id) }}"
                                    class="text-teal-500 hover:text-teal-700 flex items-center transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Questions
                                </a>
                                <button wire:click="edit({{ $exam->id }})"
                                    class="text-indigo-500 hover:text-indigo-700 transition-colors duration-200">
                                    <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>
                                <button wire:click="destroy({{ $exam->id }})"
                                    wire:confirm="Are you sure you want to delete this exam set?"
                                    class="text-red-500 hover:text-red-700 transition-colors duration-200">
                                    <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-sm text-gray-500">
                                No exam sets found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity duration-300"
                    wire:click="closeModal"></div>

                <div
                    class="relative w-full max-w-3xl p-8 mx-auto bg-white rounded-2xl shadow-2xl transform transition-all duration-300 scale-100">
                    <div class="absolute top-4 right-4">
                        <button wire:click="closeModal"
                            class="text-gray-400 hover:text-gray-600 transition-colors duration-200 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-2">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">
                            {{ $editingExamId ? 'Edit Exam Set' : 'Create New Exam Set' }}
                        </h3>

                        <form wire:submit.prevent="storeOrUpdate" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Exam
                                        Name</label>
                                    <input type="text" wire:model="name" id="name"
                                        class="w-full p-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                    @error('name')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div>
                                    <label for="category_id"
                                        class="block text-sm font-medium text-gray-700 mb-1.5">Category</label>
                                    <select wire:model.live="category_id" id="category_id"
                                        class="w-full p-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Subject -->
                                <div>
                                    <label for="subject_id"
                                        class="block text-sm font-medium text-gray-700 mb-1.5">Subject</label>
                                    <select wire:model.live="subject_id" id="subject_id"
                                        class="w-full p-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200"
                                        {{ empty($category_id) ? 'disabled' : '' }}>
                                        <option value="">Select Subject</option>
                                        @if ($category_id && $subjects->count() > 0)
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}
                                                </option>
                                            @endforeach
                                        @elseif($category_id)
                                            <option value="" disabled>No subjects found for this category
                                            </option>
                                        @else
                                            <option value="" disabled>Please select a category first</option>
                                        @endif
                                    </select>
                                    @error('subject_id')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="level_id"
                                        class="block text-sm font-medium text-gray-700 mb-1.5">Level</label>
                                    <select wire:model.live="level_id" id="level_id"
                                        class="w-full p-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                        <option value="">Select Level</option>
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('level_id')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Total Marks -->
                                <div>
                                    <label for="total_marks"
                                        class="block text-sm font-medium text-gray-700 mb-1.5">Total Marks</label>
                                    <input type="number" wire:model="total_marks" id="total_marks"
                                        class="w-full p-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                    @error('total_marks')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Duration -->
                                <div>
                                    <label for="duration"
                                        class="block text-sm font-medium text-gray-700 mb-1.5">Duration
                                        (minutes)</label>
                                    <input type="number" wire:model="duration" id="duration"
                                        class="w-full p-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                    @error('duration')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Type -->
                                <div>
                                    <label for="type"
                                        class="block text-sm font-medium text-gray-700 mb-1.5">Type</label>
                                    <select wire:model="type" id="type"
                                        class="w-full p-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                        <option value="online">Online</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                    @error('type')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status"
                                        class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                                    <select wire:model="status" id="status"
                                        class="w-full p-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                        <option value="archieved">Archieved</option>
                                    </select>
                                    @error('status')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                                <textarea wire:model="description" id="description" rows="4"
                                    class="w-full p-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 resize-y"></textarea>
                                @error('description')
                                    <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex justify-end space-x-4 mt-8">
                                <button type="button" wire:click="closeModal"
                                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-200 rounded-xl hover:bg-gray-200 transition-all duration-200">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 rounded-xl shadow-md transition-all duration-200 transform hover:scale-105">
                                    {{ $editingExamId ? 'Update Exam Set' : 'Create Exam Set' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
