<div x-data="{ step: @entangle('step') }" class="space-y-8">
    <!-- Adjusted Loader -->
    <div wire:loading wire:target="updateLevel" 
         class="fixed inset-0 flex items-center justify-center bg-white bg-opacity-70 z-50">
        <svg class="w-6 h-6 animate-spin text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
    </div>

    <!-- Dynamic Header -->
    <div class="bg-blue-500 rounded-lg p-6 text-white transition duration-500">
        <div class="flex justify-between">
            <div class="flex items-center space-x-2 mb-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479
                        A11.952 11.952 0 0012 20.055
                        a11.952 11.952 0 00-6.824-2.998
                        12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
                <h3 class="text-xl font-bold">
                    @switch($step)
                        @case('category')
                            Select Class Category
                            @break
                        @case('subject')
                            {{ $selection['category_name'] }} → Select Subject
                            @break
                        @case('level')
                            {{ $selection['subject_name'] }} → Select Level
                            @break
                        @case('confirm')
                            Ready: {{ $selection['level_name'] }}
                            @break
                    @endswitch
                </h3>
            </div>
        </div>

        <p class="text-blue-100">
            @switch($step)
                @case('category')
                    Choose from your profile preferences
                    @break
                @case('subject')
                    Now pick a subject from <strong>{{ $selection['category_name'] }}</strong>
                    @break
                @case('level')
                    Select the difficulty level for <strong>{{ $selection['subject_name'] }}</strong>
                    @break
                @case('confirm')
                    All set! Review your selection and begin the exam.
                    @break
            @endswitch
        </p>
        <button wire:click="goBack" class="bg-gray-700 text-white px-2 py-1 rounded">Back</button>

        <!-- Optional Progress Bar -->
        <div class="mt-4 h-2 bg-blue-300 rounded-full overflow-hidden">
            <div class="h-2 bg-white rounded-full transition-all duration-500"
                style="width:
                    @if($step === 'category') 25%
                    @elseif($step === 'subject') 50%
                    @elseif($step === 'level') 75%
                    @elseif($step === 'confirm') 100%
                    @endif;">
            </div>
        </div>
    </div>

    <!-- Animated Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @if ($step === 'confirm')
            <div x-transition 
                class="flex flex-col items-center border p-5 rounded-lg shadow bg-white animate-fadeIn">
                <p class="font-semibold">{{ $selection['level_name'] }}</p>
                <p class="text-gray-600">{{ $selection['subject_name'] }}</p>
                <p class="text-gray-600">{{ $selection['category_name'] }}</p>
                <button class="mt-4 bg-green-500 hover:bg-green-600 text-white p-3 rounded font-medium transition">
                    Start Exam
                </button>
            </div>
        @endif
        @if ($step === 'level')
            @foreach ($levels as $level)
                <button 
                    wire:click="updateLevel({{ $level->id }})"
                    wire:loading.attr="disabled"
                    wire:target="updateLevel"
                    x-transition
                    class="w-full flex flex-col items-center gap-2 border-2 border-gray-300 p-5 rounded-lg 
                        hover:border-blue-500 hover:shadow-lg transition transform hover:scale-105 animate-fadeIn">
                    <p class="font-semibold">{{ $level->name }}</p>
                    <p class="text-gray-600">{{ $level->description }}</p>
                </button>
            @endforeach
        @endif
        @if ($step === 'subject')
            @foreach ($subjects as $subject)
                <button wire:click="updateSubject({{ $subject->id }})" x-transition
                    class="flex items-center justify-center border-2 border-gray-300 p-5 rounded-lg
                        hover:border-blue-500 hover:shadow-lg transition transform hover:scale-105 animate-fadeIn">
                    <p>{{ $subject->subject_name }}</p>
                </button>
            @endforeach
        @endif
        @if($step === 'category')
            @foreach ($categories as $category)
                <button wire:click="updateCategory({{ $category->id }})" x-transition
                    class="flex items-center justify-center border-2 border-gray-300 p-5 rounded-lg 
                        hover:border-blue-500 hover:shadow-lg transition transform hover:scale-105 animate-fadeIn">
                    <p>{{ $category->name }}</p>
                </button>
            @endforeach
        @endif
    </div>

    <!-- Final Section -->
    <div x-show="{{ $selectedLevel ? 'true' : 'false' }}" x-transition class="text-center py-12 animate-fadeIn">
        <div class="w-24 h-24 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479
                    A11.952 11.952 0 0012 20.055
                    a11.952 11.952 0 00-6.824-2.998
                    12.078 12.078 0 01.665-6.479L12 14z" />
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Start Your Assessment</h3>
        <p class="text-gray-600 mb-8">You are ready to begin your assessment.</p>
        <button wire:click="startAssessment"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200">
            Begin Assessment
        </button>
    </div>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeIn {
            animation: fadeIn 0.4s ease-in-out;
        }
    </style>
</div>