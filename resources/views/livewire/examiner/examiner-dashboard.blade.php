<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto p-6 space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-book-open text-indigo-600"></i> Manage Exam Sets
                </h1>
                <p class="text-sm text-gray-600 mt-1">Create and manage your examination question sets</p>
            </div>
            <button wire:click="openModal"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-6 rounded-lg shadow-sm transition-all duration-200 flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Create New Exam
            </button>
        </div>

        <!-- Search & Filter -->
        <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col sm:flex-row items-center gap-4 border border-gray-100">
            <div class="relative w-full sm:max-w-sm">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search exam sets..."
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <select wire:model.live="categoryFilter"
                    class="px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <select wire:model.live="statusFilter"
                    class="px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    <option value="">All Status</option>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex justify-between items-center" role="alert">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="text-green-700 hover:text-green-900" wire:click="$set('flashMessage', null)">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        <!-- Exam Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm">
                    <thead class="bg-gray-50 border-b text-gray-600">
                        <tr>
                            <th class="px-6 py-4 text-left font-medium">Exam Details</th>
                            <th class="px-6 py-4 text-left font-medium">Class & Subject</th>
                            <th class="px-6 py-4 text-left font-medium">Type</th>
                            <th class="px-6 py-4 text-left font-medium">Duration</th>
                            <th class="px-6 py-4 text-left font-medium">Marks</th>
                            <th class="px-6 py-4 text-left font-medium">Status</th>
                            <th class="px-6 py-4 text-left font-medium">Questions</th>
                            <th class="px-6 py-4 text-left font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-gray-700">
                        @forelse($examSets as $exam)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $exam->name }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ Str::limit($exam->description, 25) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium">{{ $exam->subject->subject_name ?? 'N/A' }}</div>
                                    <span class="text-xs text-gray-500">Level: {{ $exam->level->name ?? 'N/A' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs rounded-full font-medium {{ $exam->type === 'online' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $exam->type === 'online' ? 'Home' : 'Exam Centre' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center text-gray-600">
                                        <i class="fa-regular fa-clock mr-1.5 text-indigo-500"></i> 
                                        {{ $exam->duration }} mins
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center text-gray-600">
                                        <i class="fa-solid fa-medal mr-1.5 text-amber-500"></i> 
                                        {{ $exam->total_marks }} marks
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($exam->status === 'draft')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                            <i class="fa-solid fa-lock mr-1 text-xs"></i> Draft
                                        </span>
                                    @elseif($exam->status === 'published')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fa-solid fa-check mr-1 text-xs"></i> Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <i class="fa-solid fa-archive mr-1 text-xs"></i> Archived
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium">{{ $exam->total_question ?? 0 }} questions</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <a wire:navigate href="{{ route('examiner.manage-question',$exam->id) }}" 
                                           class="text-indigo-600 hover:text-indigo-800 transition-colors duration-200"
                                           title="Manage Questions">
                                            <i class="fa-solid fa-list"></i>
                                        </a>
                                        <button wire:click="edit({{ $exam->id }})"
                                            class="text-gray-600 hover:text-gray-800 transition-colors duration-200"
                                            title="Edit Exam">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button wire:click="delete({{ $exam->id }})"
                                            onclick="return confirm('Are you sure you want to delete this exam set?')"
                                            class="text-red-600 hover:text-red-800 transition-colors duration-200"
                                            title="Delete Exam">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fa-solid fa-inbox text-4xl text-gray-300 mb-3"></i>
                                        <p class="text-gray-600">No exam sets found.</p>
                                        <button wire:click="openModal"
                                            class="text-indigo-600 hover:text-indigo-800 font-medium mt-2">
                                            Create your first exam set
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($examSets->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $examSets->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20">
                <div class="fixed inset-0 bg-gray-800 bg-opacity-75 transition-opacity duration-300 backdrop-blur-sm"
                    wire:click="closeModal"></div>

                <div
                    class="relative w-full max-w-3xl p-6 mx-auto bg-white rounded-xl shadow-xl transform transition-all duration-300 scale-100">
                    <div class="absolute top-4 right-4">
                        <button wire:click="closeModal"
                            class="text-gray-400 hover:text-gray-600 transition-colors duration-200 focus:outline-none rounded-full p-1">
                            <span class="sr-only">Close</span>
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-2">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-100">
                            <i class="fa-solid {{ $editingExamId ? 'fa-pen' : 'fa-plus' }} mr-2 text-indigo-600"></i>
                            {{ $editingExamId ? 'Edit Exam Set' : 'Create New Exam Set' }}
                        </h3>

                        <form wire:submit.prevent="storeOrUpdate" class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Name -->
                                <div class="md:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Exam Name *</label>
                                    <input type="text" wire:model="name" id="name"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                    @error('name')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1.5">Category *</label>
                                    <select wire:model.live="category_id" id="category_id"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
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
                                    <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1.5">Subject *</label>
                                    <select wire:model="subject_id" id="subject_id"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200"
                                        {{ empty($category_id) ? 'disabled' : '' }}>
                                        <option value="">Select Subject</option>
                                        @if ($category_id && $subjects->count() > 0)
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                            @endforeach
                                        @elseif($category_id)
                                            <option value="" disabled>No subjects found for this category</option>
                                        @else
                                            <option value="" disabled>Please select a category first</option>
                                        @endif
                                    </select>
                                    @error('subject_id')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Level -->
                                <div>
                                    <label for="level_id" class="block text-sm font-medium text-gray-700 mb-1.5">Level *</label>
                                    <select wire:model="level_id" id="level_id"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
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
                                    <label for="total_marks" class="block text-sm font-medium text-gray-700 mb-1.5">Total Marks *</label>
                                    <input type="number" wire:model="total_marks" id="total_marks" min="0"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                    @error('total_marks')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Total Questions -->
                                <div>
                                    <label for="total_question" class="block text-sm font-medium text-gray-700 mb-1.5">Total Questions *</label>
                                    <input type="number" wire:model="total_question" id="total_question" min="1"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                    @error('total_question')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Duration -->
                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-1.5">Duration (minutes) *</label>
                                    <input type="number" wire:model="duration" id="duration" min="1"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                    @error('duration')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Type -->
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1.5">Exam Type *</label>
                                    <select wire:model="type" id="type"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                        <option value="online">Online (Home)</option>
                                        <option value="offline">Offline (Exam Centre)</option>
                                    </select>
                                    @error('type')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">Status *</label>
                                    <select wire:model="status" id="status"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                        <option value="archived">Archived</option>
                                    </select>
                                    @error('status')
                                        <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                                <textarea wire:model="description" id="description" rows="3"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 resize-y"></textarea>
                                @error('description')
                                    <span class="text-red-500 text-xs mt-1.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                                <button type="button" wire:click="closeModal"
                                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200 transition-all duration-200">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow-sm transition-all duration-200 hover:bg-indigo-700 flex items-center gap-2">
                                    <i class="fa-solid {{ $editingExamId ? 'fa-pen' : 'fa-plus' }}"></i>
                                    {{ $editingExamId ? 'Update Exam' : 'Create Exam' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>