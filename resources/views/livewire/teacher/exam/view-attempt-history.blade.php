<div class="max-w-4xl mx-auto p-6 space-y-6">
    <!-- Exam Details -->
    <div class="bg-white shadow-md rounded-2xl p-5 border">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">📘 Exam Details</h1>

        @foreach ($attempts as $attempt)
            <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-700">
                <p><span class="font-semibold">Class Category:</span> {{ $attempt->examSet->classCategory->name ?? 'N/A' }}</p>
                <p><span class="font-semibold">Subject:</span> {{ $attempt->examSet->subject->subject_name ?? 'N/A' }}</p>
                <p><span class="font-semibold">Level:</span> {{ $attempt->examSet->level->name ?? 'N/A' }}</p>
                <p><span class="font-semibold">Language:</span> {{ $attempt->language }}</p>
                <p><span class="font-semibold">Status:</span> 
                    <span class="px-2 py-1 rounded-lg 
                        {{ $attempt->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($attempt->status) }}
                    </span>
                </p>
                <p><span class="font-semibold">Score:</span> {{ $attempt->score }}</p>
                <p><span class="font-semibold">Start Time:</span> {{ $attempt->started_at }}</p>
                <p><span class="font-semibold">End Time:</span> {{ $attempt->ended_at }}</p>
            </div>
        @endforeach
    </div>

    <!-- Questions Section -->
    <div class="bg-white shadow-md rounded-2xl p-5 border">
        <h2 class="text-xl font-bold text-gray-800 mb-4">📝 Questions</h2>

        <div class="space-y-6">
            @foreach ($questions as $index => $question)
              @php
    $options = json_decode($question->options, true);
    $map = ['A' => 0, 'B' => 1, 'C' => 2, 'D' => 3];
    $correctIndex = $map[$question->correct_option] ?? null;

    $userAnswer = $question->userAnswers->first();
    // Safe access to user answer properties
    $userSelectedOption = $userAnswer->selected_option ?? null;
    $userSelectedIndex = isset($map[$userSelectedOption]) ? $map[$userSelectedOption] : null;
    $isCorrect = $userAnswer->is_correct ?? null;
@endphp

                <div class="border rounded-xl p-4 bg-gray-50 hover:shadow-lg transition">
                   <div class="flex items-center justify-between">
    <h3 class="font-semibold text-gray-800">Q{{ $index+1 }}. {{ $question->question_text }}</h3>
    @if(!is_null($isCorrect))
        @if ($isCorrect)
            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-lg">✔ Correct</span>
        @else
            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-lg">✘ Incorrect</span>
        @endif
    @else
        <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-bold rounded-lg">Not Answered</span>
    @endif
</div>

                    <!-- Options -->
                    <div class="mt-3 space-y-2">
                        @foreach ($options as $key => $option)
                            <p class="border rounded-lg px-3 py-2 cursor-pointer transition 
                                @if ($key === $correctIndex)
                                    border-green-400 bg-green-50 text-green-700 font-semibold
                                @else
                                    border-gray-300 bg-white
                                @endif
                                @if($key === $userSelectedIndex && !$isCorrect)
                                    border-red-400 bg-red-50 text-red-700 font-semibold
                                @endif
                            ">
                                {{ chr(65 + $key) }}. {{ $option }}
                            </p>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
