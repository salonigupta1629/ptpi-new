
<div class="bg-gray-50">
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="rounded-xl border bg-blue-500 text-white shadow-lg mb-6">
            <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                <div>
                    <a href="{{ route('examiner.dashboard', $examSet->id) }}" class="inline-flex items-center text-teal-100 hover:text-white underline text-sm mb-2">
                        <i class="fas fa-arrow-left mr-2"></i> Back To Exam
                    </a>
                    <h2 class="text-xl font-bold">
                        {{ $examSet->name }} | {{ $examSet->subject->name ?? '' }} | Level {{ $examSet->level_id }}
                    </h2>
                    <p class="text-sm opacity-90 mt-1">Manage all questions for this exam set</p>
                </div>
                <a wire:navigate href="{{ route('examiner.add-question',$examSet->id) }}"
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
                    <input type="search" wire:model="search" placeholder="Search question..."
                        class="border border-gray-300 rounded-lg pl-10 pr-4 py-2 w-full focus:ring-2 focus:ring-teal-500 outline-none">
                </div>
                <button class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition flex items-center justify-center">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white shadow rounded-xl p-4 text-center border-l-4 border-teal-500 hover:shadow-md transition">
                <div class="rounded-full bg-teal-100 w-12 h-12 flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-question-circle text-teal-600 text-xl"></i>
                </div>
                <p class="text-gray-500 text-sm">Total Questions</p>
                <p class="text-xl font-bold text-teal-600">{{ $examSet->total_question}}</p>
            </div>
            <div class="bg-white shadow rounded-xl p-4 text-center border-l-4 border-blue-500 hover:shadow-md transition">
                <div class="rounded-full bg-blue-100 w-12 h-12 flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-language text-blue-600 text-xl"></i>
                </div>
                <p class="text-gray-500 text-sm">English</p>
                <p class="text-xl font-bold text-blue-600">10</p>
            </div>
            <div class="bg-white shadow rounded-xl p-4 text-center border-l-4 border-orange-500 hover:shadow-md transition">
                <div class="rounded-full bg-orange-100 w-12 h-12 flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-language text-orange-600 text-xl"></i>
                </div>
                <p class="text-gray-500 text-sm">Hindi</p>
                <p class="text-xl font-bold text-orange-600">20</p>
            </div>
            <div class="bg-white shadow rounded-xl p-4 text-center border-l-4 border-purple-500 hover:shadow-md transition">
                <div class="rounded-full bg-purple-100 w-12 h-12 flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-star text-purple-600 text-xl"></i>
                </div>
                <p class="text-gray-500 text-sm">Total Marks</p>
                <p class="text-xl font-bold text-purple-600">{{ $examSet->total_marks }}</p>
            </div>
        </div>

        <!-- Questions Section -->
        <div class="rounded-xl border bg-white shadow p-4 md:p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b pb-3 mb-4">
                <h2 class="text-lg font-bold flex items-center">
                    <i class="fas fa-list-ol mr-2 text-teal-600"></i> Questions by Order
                </h2>
                <p class="text-sm text-gray-600 mt-2 md:mt-0">Total: <span class="font-semibold text-teal-700">{{ $examSet->total_question }}</span></p>
            </div>

            <div class="space-y-6">
                @forelse($questions as $qid => $langs)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 border rounded-xl p-4 shadow-sm hover:shadow-md transition">
                        @foreach($langs as $q)
                            <div class="{{ $q->language === 'hindi' ? 'md:border-l md:pl-4' : '' }}">
                                <div class="flex items-center justify-center mb-2">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $q->language === 'english' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                        {{ ucfirst($q->language) }} Question
                                    </span>
                                </div>
                                <div class="mt-3">
                                    <p class="font-semibold flex items-start">
                                        <span class="bg-teal-100 text-teal-800 rounded-full w-6 h-6 flex items-center justify-center mr-2 flex-shrink-0">{{ $loop->parent->iteration }}</span>
                                        {{ $q->question_text }}
                                    </p>
                                    <ul class="mt-3 space-y-2">
                                        @foreach($q->options as $opt)
                                            <li class="flex items-start {{ $q->correct_answer === $opt ? 'text-teal-700 font-bold' : 'text-gray-700' }}">
                                                <span class="mr-2">{{ $loop->iteration | intToLetter }}.</span>
                                                <span>{{ $opt }}</span>
                                                @if($q->correct_answer === $opt)
                                                    <span class="ml-2 text-teal-600"><i class="fas fa-check-circle"></i></span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-span-1 md:col-span-2 flex justify-end gap-2 mt-3 pt-3 border-t">
                            <button class="px-3 py-1 text-sm rounded bg-teal-100 text-teal-700 hover:bg-teal-200 flex items-center">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>
                            <button class="px-3 py-1 text-sm rounded bg-red-100 text-red-700 hover:bg-red-200 flex items-center">
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-3 text-gray-400"></i>
                        <p>No questions found. Add your first question to get started.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination (if needed) -->
            <div class="mt-6 flex justify-center">
                <nav class="inline-flex rounded-md shadow">
                    <a href="#" class="py-2 px-4 border border-teal-300 bg-white rounded-l-md text-teal-600 hover:bg-teal-50">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#" class="py-2 px-4 border border-teal-300 bg-teal-600 text-white border-l-0">
                        1
                    </a>
                    <a href="#" class="py-2 px-4 border border-teal-300 bg-white border-l-0 text-teal-600 hover:bg-teal-50">
                        2
                    </a>
                    <a href="#" class="py-2 px-4 border border-teal-300 bg-white border-l-0 text-teal-600 hover:bg-teal-50">
                        3
                    </a>
                    <a href="#" class="py-2 px-4 border border-teal-300 bg-white border-l-0 rounded-r-md text-teal-600 hover:bg-teal-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
        </div>
    </div>

    <script>
        // Simple function to convert numbers to letters (1->A, 2->B, etc.)
        function intToLetter(index) {
            return String.fromCharCode(64 + index);
        }
        
        // Apply the conversion to option indices
        document.querySelectorAll('.flex.items-start').forEach(item => {
            const indexElement = item.querySelector('span:first-child');
            if (indexElement) {
                const index = parseInt(indexElement.textContent);
                if (!isNaN(index)) {
                    indexElement.textContent = intToLetter(index) + '.';
                }
            }
        });
    </script>
</div>