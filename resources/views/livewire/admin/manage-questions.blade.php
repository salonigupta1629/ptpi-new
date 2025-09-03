{{-- <div class="container">
    <!-- Header -->
    <div class="mb-8">
        <nav class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manage Questions</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Exam Set: {{ $examSet->name }}
                </p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.manage-exam', $examSet->id) }}"
                    class="inline-flex items-center px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    Back to Exam Sets
                </a>
                <button wire:click="openModal"
                    class="inline-flex items-center px-4 py-2 text-sm text-white bg-teal-600 border border-transparent rounded-lg hover:bg-teal-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Question
                </button>
            </div>
        </nav>
    </div>

    @if (session()->has('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-50 text-green-700 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Questions List -->
    <div class="space-y-4">
        @forelse ($questions as $question)
            <div
                class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900">
                                {{ $question->question_text }}
                            </h3>
                            <div class="mt-4 space-y-2">
                                @foreach (json_decode($question->options) as $index => $option)
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="flex-shrink-0 w-6 h-6 rounded-full border-2 
                {{ chr(65 + $index) === $question->correct_options ? 'border-green-500 bg-green-50' : 'border-gray-300' }} 
                flex items-center justify-center">
                                            {{ chr(65 + $index) }}
                                        </span>
                                        <span class="text-gray-700">{{ $option }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 ml-6">
                            <button wire:click="edit({{ $question->id }})"
                                class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button wire:click="destroy({{ $question->id }})"
                                wire:confirm="Are you sure you want to delete this question?"
                                class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No questions</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new question.</p>
                <div class="mt-6">
                    <button wire:click="openModal"
                        class="inline-flex items-center px-4 py-2 text-sm text-white bg-teal-600 border border-transparent rounded-lg hover:bg-teal-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Question
                    </button>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Question Modal -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

                <div class="relative bg-white rounded-xl shadow-xl transform transition-all w-full max-w-4xl">
                    <!-- Close button -->
                    <button 
                        wire:click="closeModal"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition-colors"
                    >
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <form wire:submit.prevent="storeOrUpdate" class="p-6">
                        <!-- Header -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $editingQuestionId ? 'Edit Question' : 'Add New Question' }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">Fill in the question details below</p>
                        </div>

                        <!-- Question Text -->
                        <div class="mb-8">
                            <label for="question_text" class="block text-sm font-medium text-gray-700 mb-2">
                                Question Text
                            </label>
                            <textarea 
                                wire:model="question_text" 
                                id="question_text" 
                                rows="3"
                                class="w-full p-4 border rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 resize-none"
                                placeholder="Enter your question here..."
                            ></textarea>
                            @error('question_text')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Options Grid -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Options
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($options as $index => $option)
                                    <div class="bg-gray-50 rounded-xl transition-all hover:bg-gray-100/80">
                                        <div class="flex items-center p-4 gap-4">
                                            <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-white border-2 border-gray-300 flex items-center justify-center font-semibold text-gray-700 shadow-sm">
                                                {{ chr(65 + $index) }}
                                            </span>
                                            <input 
                                                type="text" 
                                                wire:model="options.{{ $index }}"
                                                class="flex-1 p-3 border rounded-lg border-gray-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                                placeholder="Enter option {{ chr(65 + $index) }}"
                                            >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('options')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Modernized Correct Option -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Select Correct Option
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                @foreach ($options as $index => $option)
                                    <button 
                                        type="button"
                                        wire:click="$set('correct_options', '{{ chr(65 + $index) }}')"
                                        class="relative p-4 rounded-xl border-2 transition-all duration-200 group {{ $correct_options === chr(65 + $index) 
                                            ? 'border-teal-500 bg-teal-50 text-teal-700' 
                                            : 'border-gray-200 hover:border-gray-300 hover:bg-gray-50' }}"
                                    >
                                        @if($correct_options === chr(65 + $index))
                                            <div class="absolute top-2 right-2 text-teal-500">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        @endif
                                        <span class="text-lg font-bold block mb-1">Option {{ chr(65 + $index) }}</span>
                                        <span class="text-sm text-gray-500 block truncate">{{ $option ?: 'Not filled yet' }}</span>
                                    </button>
                                @endforeach
                            </div>
                            @error('correct_options')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="mt-8 flex justify-end items-center gap-3">
                            <button 
                                type="button" 
                                wire:click="closeModal"
                                class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                class="px-6 py-2.5 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all"
                            >
                                {{ $editingQuestionId ? 'Update Question' : 'Save Question' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div> --}}


<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Exam Information (Left Side) -->
        <div class="lg:col-span-1">
             <div class="bg-white rounded-2xl shadow-sm border border-blue-200 p-6 sticky top-4">
                <h2 class="text-xl font-semibold text-blue-900 tracking-tight mb-6">Exam Information</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Subject</label>
                        <p class="mt-1 text-base text-gray-900">{{ $examSet->subject->subject_name ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Level</label>
                        <p class="mt-1 text-base text-gray-900">{{ $examSet->level->name ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Class Category</label>
                        <p class="mt-1 text-base text-gray-900">{{ $examSet->class_category->name ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Type</label>
                        <p class="mt-1 text-base text-gray-900">{{ $examSet->type ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Total Marks</label>
                        <p class="mt-1 text-base text-gray-900">{{ $examSet->total_marks ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Duration</label>
                        <p class="mt-1 text-base text-gray-900">{{ $examSet->duration ?? 'Not specified' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question Management (Right Side) -->
        <div class="lg:col-span-3">
            <!-- Header -->
            <div class="mb-10">
                <nav class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Manage Questions</h1>
                        <p class="mt-2 text-base text-gray-500">
                            Exam Set: {{ $examSet->name }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.manage-exam', $examSet->id) }}"
                            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            Back to Exam Sets
                        </a>
                        <button wire:click="openModal"
                            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-xl hover:bg-teal-700 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Question
                        </button>
                    </div>
                </nav>
            </div>

            @if (session()->has('success'))
                <div class="mb-8 p-4 rounded-xl bg-green-50 text-green-700 border border-green-200 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Questions List -->
            <div class="space-y-6">
                @forelse ($questions as $index => $question)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-200">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-4">
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-teal-50 text-teal-600 font-semibold text-lg">
                                            Q{{ $index + 1 }}
                                        </span>
                                        <h3 class="text-xl font-semibold text-gray-900 leading-tight">
                                            {{ $question->question_text }}
                                        </h3>
                                    </div>
                                    <div class="mt-4 space-y-3">
                                        @foreach (json_decode($question->options) as $optIndex => $option)
                                            <div class="flex items-center space-x-3">
                                                <span class="flex-shrink-0 w-8 h-8 rounded-full border-2 
                                                    {{ chr(65 + $optIndex) === $question->correct_options ? 'border-teal-500 bg-teal-50 text-teal-600' : 'border-gray-200 text-gray-600' }} 
                                                    flex items-center justify-center font-medium">
                                                    {{ chr(65 + $optIndex) }}
                                                </span>
                                                <span class="text-gray-700 text-base">{{ $option }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2 ml-6">
                                    <button wire:click="edit({{ $question->id }})"
                                        class="p-2.5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-150">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button wire:click="destroy({{ $question->id }})"
                                        wire:confirm="Are you sure you want to delete this question?"
                                        class="p-2.5 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-150">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                        <svg class="mx-auto h-14 w-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-3 text-lg font-medium text-gray-900">No questions</h3>
                        <p class="mt-2 text-base text-gray-500">Get started by creating a new question.</p>
                        <div class="mt-6">
                            <button wire:click="openModal"
                                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-xl hover:bg-teal-700 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Question
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Question Modal -->
            @if ($isModalOpen)
                <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-center justify-center min-h-screen p-4">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

                        <div class="relative bg-white rounded-2xl shadow-xl transform transition-all w-full max-w-4xl">
                            <!-- Close button -->
                            <button 
                                wire:click="closeModal"
                                class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition-colors"
                            >
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <form wire:submit.prevent="storeOrUpdate" class="p-8">
                                <!-- Header -->
                                <div class="mb-8">
                                    <h3 class="text-2xl font-semibold text-gray-900 tracking-tight">
                                        {{ $editingQuestionId ? 'Edit Question' : 'Add New Question' }}
                                    </h3>
                                    <p class="mt-2 text-base text-gray-500">Fill in the question details below</p>
                                </div>

                                <!-- Question Text -->
                                <div class="mb-8">
                                    <label for="question_text" class="block text-sm font-medium text-gray-700 mb-2">
                                        Question Text
                                    </label>
                                    <textarea 
                                        wire:model="question_text" 
                                        id="question_text" 
                                        rows="3"
                                        class="w-full p-4 border rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 resize-none text-base"
                                        placeholder="Enter your question here..."
                                    ></textarea>
                                    @error('question_text')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Options Grid -->
                                <div class="mb-8">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        Options
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach ($options as $index => $option)
                                            <div class="bg-gray-50 rounded-xl transition-all hover:bg-gray-100">
                                                <div class="flex items-center p-4 gap-4">
                                                    <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-white border-2 border-gray-200 flex items-center justify-center font-semibold text-gray-700 shadow-sm">
                                                        {{ chr(65 + $index) }}
                                                    </span>
                                                    <input 
                                                        type="text" 
                                                        wire:model="options.{{ $index }}"
                                                        class="flex-1 p-3 border rounded-lg border-gray-200 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 text-base"
                                                        placeholder="Enter option {{ chr(65 + $index) }}"
                                                    >
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('options')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Modernized Correct Option -->
                                <div class="mb-8">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        Select Correct Option
                                    </label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                        @foreach ($options as $index => $option)
                                            <button 
                                                type="button"
                                                wire:click="$set('correct_options', '{{ chr(65 + $index) }}')"
                                                class="relative p-4 rounded-xl border-2 transition-all duration-200 group {{ $correct_options === chr(65 + $index) 
                                                    ? 'border-teal-500 bg-teal-50 text-teal-700' 
                                                    : 'border-gray-200 hover:border-gray-300 hover:bg-gray-50' }}"
                                            >
                                                @if($correct_options === chr(65 + $index))
                                                    <div class="absolute top-2 right-2 text-teal-500">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <span class="text-lg font-bold block mb-1">Option {{ chr(65 + $index) }}</span>
                                                <span class="text-sm text-gray-500 block truncate">{{ $option ?: 'Not filled yet' }}</span>
                                            </button>
                                        @endforeach
                                    </div>
                                    @error('correct_options')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Actions -->
                                <div class="mt-8 flex justify-end items-center gap-3">
                                    <button 
                                        type="button" 
                                        wire:click="closeModal"
                                        class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200"
                                    >
                                        Cancel
                                    </button>
                                    <button 
                                        type="submit"
                                        class="px-6 py-2.5 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-xl hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all duration-200"
                                    >
                                        {{ $editingQuestionId ? 'Update Question' : 'Save Question' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>