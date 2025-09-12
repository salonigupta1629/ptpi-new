<div class="min-h-screen bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-1/4 bg-white shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Questions</h2>
        <p class="text-sm text-gray-500 mb-3">Total Questions ({{ $questions->count() }})</p>

        <div class="grid grid-cols-5 gap-3">
            @foreach ($questions as $index => $q)
            @php
          $isAnswered = isset($selectedOption[$q->id]) && $selectedOption[$q->id] !== null;

            @endphp
                <button 
                    class="w-10 h-10 flex items-center justify-center rounded-full border 
                        @if($isAnswered)
                        bg-green-200 text-white border-green-400
                        @else
                        bg-gray-200 text-black border-gray-400
                        @endif
                        ">
                    {{ $index + 1 }}
                </button>
            @endforeach
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Header -->
        <div class="flex items-center justify-between bg-white p-4 rounded-md shadow">
            <div>
                <h1 class="text-xl font-bold text-gray-700">{{ $subjectName }}</h1>
                <div class="flex gap-4 mt-1 text-sm">
                    <span class="bg-blue-100 text-blue-600 px-2 py-0.5 rounded">Class: {{ $categoryName }}</span>
                    <span class="bg-green-100 text-green-600 px-2 py-0.5 rounded">Subject: {{ $subjectName }}</span>
                    <span class="bg-purple-100 text-purple-600 px-2 py-0.5 rounded">Level: {{ $levelName }}</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="bg-gray-100 px-3 py-1 rounded-md text-sm text-gray-600">
                    Time Left: <span class="font-semibold text-gray-800">{{ time() }}</span>
                </div>
                <button class="bg-red-100 text-red-600 px-3 py-1 rounded-md border border-red-200 hover:bg-red-200">
                    Exit Exam
                </button>
            </div>
        </div>

        <!-- Question Card -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow">
            @if($questions->isNotEmpty())
                @php
                    $question = $questions[$currentIndex];
                @endphp

                <h2 class="text-lg font-semibold mb-4">Question {{ $currentIndex + 1 }}</h2>
                <p class="text-gray-700 text-base mb-6">{{ $question->question_text }}</p>

                <div class="space-y-3">
                    @foreach (json_decode($question->options, true) as $key => $option)
                    @php
            $label = chr(65 + $key); // Convert 0→A, 1→B, 2→C, 3→D
        @endphp
                        <label class="flex items-center gap-3 cursor-pointer p-2 border rounded-lg hover:bg-gray-50">
                            <input type="radio" wire:model="selectedOption.{{ $question->id }}" 
                                   value="{{ $label }}" 
                                   @if (in_array($option, $answers)) checked @endif
                                   class="h-4 w-4 text-blue-500 focus:ring-blue-400">
                            <span class="text-gray-700">{{ $option }}</span>
                        </label>
                    @endforeach
                </div>
            @endif

            <!-- Navigation -->
            <div class="mt-6 flex justify-between">
                @if ($currentIndex > 0)
                    <button wire:click="prevQuestion"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md shadow flex items-center gap-2">
                        ← Previous
                    </button>
                @else
                    <div></div>
                @endif

                @if ($currentIndex < $questions->count() - 1)
                    <button wire:click="nextQuestion"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md shadow flex items-center gap-2">
                        Next →
                    </button>
                @else
                    <button wire:click="submitExam"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md shadow flex items-center gap-2">
                        ✅ Submit
                    </button>
                @endif
            </div>
        </div>
    </main>
    {{ $result ?? 'nothing' }}
</div>
