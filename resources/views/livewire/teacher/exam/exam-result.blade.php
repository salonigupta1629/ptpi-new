<div class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-2xl w-full mx-4">
        <!-- Header Icon -->
        <div class="text-center mb-6">
            @if($examStatus === 'completed')
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            @elseif($examStatus === 'time_up')
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            @elseif($examStatus === 'exited')
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            @endif
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">
            @if($examStatus === 'completed')
                🎉 Congratulations!
            @elseif($examStatus === 'time_up')
                ⏰ Time's Up!
            @elseif($examStatus === 'exited')
                🚪 Exam Exited
            @endif
        </h1>

        <!-- Status Message -->
        <div class="text-center mb-6">
            @if($examStatus === 'completed')
                <p class="text-lg text-gray-600">You have successfully completed the exam!</p>
            @elseif($examStatus === 'time_up')
                <p class="text-lg text-gray-600">The exam time has ended. Your answers have been submitted.</p>
            @elseif($examStatus === 'exited')
                <p class="text-lg text-gray-600">You have exited the exam. Your progress has been saved.</p>
            @endif
        </div>

        <!-- Score Card -->
        <div class="bg-gray-50 rounded-xl p-6 mb-6">
            <div class="text-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Your Score</h2>
                
                <div class="flex justify-center items-center mb-4">
                    <div class="relative">
                        <!-- Circular Progress -->
                        <svg class="w-32 h-32 transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-200" d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none" stroke="currentColor" stroke-width="3"
                                stroke-dasharray="100, 100"/>
                            <path class="text-blue-600" d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none" stroke="currentColor" stroke-width="3"
                                stroke-dasharray="{{ $score }}, 100"/>
                        </svg>
                        
                        <!-- Score Text -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-2xl font-bold text-gray-800">{{ number_format($score, 1) }}%</span>
                        </div>
                    </div>
                </div>

                <!-- Score Details -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="text-center">
                        <p class="text-3xl font-bold text-green-600">{{ $correctCount }}</p>
                        <p class="text-sm text-gray-600">Correct Answers</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-red-600">{{ $totalQuestions - $correctCount }}</p>
                        <p class="text-sm text-gray-600">Incorrect Answers</p>
                    </div>
                </div>

                <!-- Total Questions -->
                <p class="text-sm text-gray-600">
                    Total Questions: {{ $totalQuestions }}
                </p>

                <!-- Pass/Fail Status -->
                @if($score >= 60)
                    <div class="mt-4 p-3 bg-green-100 border border-green-300 rounded-lg">
                        <p class="text-green-800 font-semibold">✅ Status: Passed</p>
                    </div>
                @else
                    <div class="mt-4 p-3 bg-red-100 border border-red-300 rounded-lg">
                        <p class="text-red-800 font-semibold">❌ Status: Failed</p>
                        <p class="text-sm text-red-600 mt-1">Minimum passing score: {{ $score }}% </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if($score < 60 && $examStatus !== 'exited')
                <button wire:click="restartExam" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                    🔄 Retry Exam
                </button>
            @endif
            
            <button wire:click="backToDashboard" 
                    class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                📊 Back to Dashboard
            </button>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>Exam: {{ $subjectName }} - {{ $levelName }}</p>
            <p>Class: {{ $categoryName }}</p>
            <p>Submitted on: {{ now()->format('M d, Y h:i A') }}</p>
            @if($submissionReason)
                <p>Reason: {{ ucfirst(str_replace('_', ' ', $submissionReason)) }}</p>
            @endif
        </div>
    </div>
</div>