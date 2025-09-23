<div>
    <div class="bg-gray-50">
        <div class="container mx-auto px-4 py-6">
            <!-- Header -->
            <div class="rounded-xl border bg-blue-500 text-white shadow-lg mb-6">
                <div
                    class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                    <div>
                        <a href="{{ route('examiner.dashboard') }}"
                            class="inline-flex items-center text-teal-100 hover:text-white underline text-sm mb-2">
                            <i class="fas fa-arrow-left mr-2"></i> Back To Dashboard
                        </a>
                        <h2 class="text-xl font-bold">
                            {{ $examSet->name }} | {{ $examSet->subject->subject_name ?? 'No Subject' }} | Level
                            {{ $examSet->level_id }}
                        </h2>
                        <p class="text-sm opacity-90 mt-1">Manage all questions for this exam set</p>
                    </div>
                    <a href="{{ route('examiner.add-question', $examSet->id) }}"
                        class="inline-flex items-center bg-white text-teal-700 px-4 py-2 rounded-xl font-medium hover:bg-teal-50 transition shadow-md">
                        <i class="fas fa-plus-circle mr-2"></i> Add Question
                    </a>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="bg-white rounded-xl shadow p-4 mb-6">
                <div class="flex flex-col md:flex-row gap-3">
                    <div class="relative flex-grow">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        <input type="search" wire:model.live="search" placeholder="Search question..."
                            class="border border-gray-300 rounded-lg pl-10 pr-4 py-2 w-full focus:ring-2 focus:ring-teal-500 outline-none">
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div
                    class="bg-white shadow rounded-xl p-4 text-center border-l-4 border-teal-500 hover:shadow-md transition">
                    <div class="rounded-full bg-teal-100 w-12 h-12 flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-question-circle text-teal-600 text-xl"></i>
                    </div>
                    <p class="text-gray-500 text-sm">Total Questions</p>
                    <p class="text-xl font-bold text-teal-600">{{ $questions->count() }}</p>
                </div>
                <div
                    class="bg-white shadow rounded-xl p-4 text-center border-l-4 border-blue-500 hover:shadow-md transition">
                    <div class="rounded-full bg-blue-100 w-12 h-12 flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-language text-blue-600 text-xl"></i>
                    </div>
                    <p class="text-gray-500 text-sm">English</p>
                    <p class="text-xl font-bold text-blue-600">{{ $questions->count() }}</p>
                </div>
                <div
                    class="bg-white shadow rounded-xl p-4 text-center border-l-4 border-orange-500 hover:shadow-md transition">
                    <div class="rounded-full bg-orange-100 w-12 h-12 flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-language text-orange-600 text-xl"></i>
                    </div>
                    <p class="text-gray-500 text-sm">Hindi</p>
                    <p class="text-xl font-bold text-orange-600">{{ $questions->whereNotNull('translations')->count() }}
                    </p>
                </div>
                <div
                    class="bg-white shadow rounded-xl p-4 text-center border-l-4 border-purple-500 hover:shadow-md transition">
                    <div class="rounded-full bg-purple-100 w-12 h-12 flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-star text-purple-600 text-xl"></i>
                    </div>
                    <p class="text-gray-500 text-sm">Total Marks</p>
                    <p class="text-xl font-bold text-purple-600">{{ $examSet->total_marks }}</p>
                </div>
            </div>
            <!-- Questions Section -->
            <div class="rounded-xl border bg-white shadow p-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b pb-4 mb-6">
                    <h2 class="text-lg font-bold flex items-center">
                        <i class="fas fa-list-ol mr-2 text-teal-600"></i> Questions by Order
                    </h2>
                    <p class="text-sm text-gray-600 mt-2 md:mt-0">
                        Total: <span class="font-semibold text-teal-700">{{ $questions->count() }}</span>
                    </p>
                </div>

                @if ($questions->count() > 0)
                    @foreach ($questions as $index => $question)
                        <div class="mb-8 p-6 border rounded-xl bg-gray-50 shadow-sm hover:shadow-md transition">
                            <!-- Header -->
                            <div class="flex justify-between items-center border-b pb-3 mb-4">
                                <h3 class="font-semibold text-gray-700">Q{{ $index + 1 }}</h3>
                                <div class="flex gap-3">
                                    <a wire:navigate href="{{ route('examiner.add-question', $examSet->id) }}"
                                        class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <button wire:click="deleteQuestion({{ $question->id }})"
                                        onclick="return confirm('Are you sure you want to delete this question?')"
                                        class="inline-flex items-center text-red-600 hover:text-red-800 text-sm font-medium">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </div>
                            </div>

                            <!-- Question Versions -->
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- English Version -->
                                <div class="w-full md:w-1/2">
                                    <h4 class="text-blue-600 font-semibold mb-2 flex items-center">
                                        <i class="fas fa-language mr-2"></i> English Version
                                    </h4>
                                    <p class="mb-4 text-gray-800">{{ $question->question_text }}</p>

                                    <div class="mb-4">
                                        <h5 class="text-sm font-semibold text-gray-600 mb-2 uppercase tracking-wide">
                                            Options</h5>
                                        <ul class="space-y-2">
                                            @foreach (json_decode($question->options, true) as $key => $option)
                                                @php
                                                    $correctKey = 'option' . ($key + 1);
                                                @endphp
                                                <li class="flex items-start">
                                                    <span class="font-medium mr-2">{{ chr(65 + $key) }}.</span>
                                                    <span
                                                        class="{{ $question->correct_option === $correctKey ? 'text-green-600 font-semibold' : 'text-gray-700' }}">
                                                        {{ $option }}
                                                        @if ($question->correct_option === $correctKey)
                                                            <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded">
                                                                Correct
                                                            </span>
                                                        @endif
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>

                                    @if ($question->solution)
                                        <div class="mt-3 p-3 bg-blue-50 rounded-lg">
                                            <h5 class="font-medium text-blue-700 mb-1">Solution:</h5>
                                            <p class="text-blue-800 text-sm">{{ $question->solution }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Hindi Version -->
                                @if (isset($question->translations['hi']))
                                    <div class="w-full md:w-1/2">
                                        <h4 class="text-green-600 font-semibold mb-2 flex items-center">
                                            <i class="fas fa-language mr-2"></i> हिंदी Version
                                        </h4>
                                        <p class="mb-4 text-gray-800">
                                            {{ $question->translations['hi']['question_text'] ?? '' }}
                                        </p>

                                        <div class="mb-4">
                                            <h5 class="text-sm font-semibold text-gray-600 mb-2 uppercase tracking-wide">
                                                विकल्प</h5>
                                            <ul class="space-y-2">
                                                @if (isset($question->translations['hi']['options']) && is_array($question->translations['hi']['options']))
                                                    @foreach ($question->translations['hi']['options'] as $key => $option)
                                                        @php
                                                            $correctKey = 'option' . ($key + 1);
                                                        @endphp
                                                        <li class="flex items-start">
                                                            <span class="font-medium mr-2">{{ chr(65 + $key) }}.</span>
                                                            <span
                                                                class="{{ $question->correct_option === $correctKey ? 'text-green-600 font-semibold' : 'text-gray-700' }}">
                                                                {{ $option }}
                                                                @if ($question->correct_option === $correctKey)
                                                                    <span
                                                                        class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded">सही</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>

                                        </div>

                                        @if (isset($question->translations['hi']['solution']) && $question->translations['hi']['solution'])
                                            <div class="mt-3 p-3 bg-green-50 rounded-lg">
                                                <h5 class="font-medium text-green-700 mb-1">समाधान:</h5>
                                                <p class="text-green-800 text-sm">
                                                    {{ $question->translations['hi']['solution'] }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Footer Meta -->
                            <div class="mt-4 text-sm text-gray-500 border-t pt-2">
                                Language: <span class="font-medium">{{ ucfirst($question->language) }}</span>
                                @if ($question->translations && isset($question->translations['hi']))
                                    | <span class="text-green-600">Hindi /English</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-10 text-gray-500">
                        <i class="fas fa-question-circle text-4xl mb-3 text-gray-300"></i>
                        <p>No questions found for this exam set.</p>
                        <a href="{{ route('examiner.add-question', $examSet->id) }}"
                            class="inline-block mt-4 text-teal-600 hover:text-teal-700 font-medium">
                            <i class="fas fa-plus-circle mr-1"></i> Add your first question
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>

</div>