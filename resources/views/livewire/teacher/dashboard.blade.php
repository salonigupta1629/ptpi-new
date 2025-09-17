{{-- <div x-data="{ step: @entangle('step') }" class="space-y-8">
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
                <button wire:click="startExam" class="mt-4 bg-green-500 hover:bg-green-600 text-white p-3 rounded font-medium transition">
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
</div> --}}




<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6"> 
    <div class="max-w-6xl mx-auto">
    <div x-data="{ step: @entangle('step') }" class="space-y-8">
        <!-- Progress Header -->
        <div class="bg-white rounded-xl shadow-md p-6 transition-all duration-500">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        @switch($step)
                            @case('category') Select Class Category @break
                            @case('subject') {{ $selection['category_name'] ?? 'Select Subject' }} @break
                            @case('level') {{ $selection['subject_name'] ?? 'Select Level' }} @break
                            @case('confirm') Ready to Start @break
                        @endswitch
                    </h2>
                </div>
                
                @if($step !== 'category')
                <button wire:click="goBack" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                @endif
            </div>

            <p class="text-gray-600 mb-4">
                @switch($step)
                    @case('category') Choose from your profile preferences @break
                    @case('subject') Now pick a subject from <span class="font-semibold text-blue-600">{{ $selection['category_name'] ?? '' }}</span> @break
                    @case('level') Select the difficulty level for <span class="font-semibold text-blue-600">{{ $selection['subject_name'] ?? '' }}</span> @break
                    @case('confirm') All set! Review your selection and begin the exam @break
                @endswitch
            </p>

            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500"
                     style="width: @if($step === 'category') 25%
                             @elseif($step === 'subject') 50%
                             @elseif($step === 'level') 75%
                             @elseif($step === 'confirm') 100%
                             @endif">
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if($step === 'category')
                @foreach($categories as $category)
                <button wire:click="updateCategory({{ $category->id }})" 
                        class="bg-white rounded-xl p-6 border-2 border-gray-200 hover:border-blue-500 hover:shadow-lg transition-all duration-300 group text-left">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">{{ $category->name }}</h3>
                    </div>
                    <p class="text-gray-600 text-sm">0 to 2 subjects available</p>
                </button>
                @endforeach
            @endif

            @if($step === 'subject')
                @foreach($subjects as $subject)
                <button wire:click="updateSubject({{ $subject->id }})" 
                        class="bg-white rounded-xl p-6 border-2 border-gray-200 hover:border-blue-500 hover:shadow-lg transition-all duration-300 group text-left">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors">
                            <i class="fas fa-atom"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">{{ $subject->subject_name }}</h3>
                    </div>
                </button>
                @endforeach
            @endif

          @if($step === 'level')
    @foreach($levels as $level)
        <button 
            wire:click="updateLevel({{ $level->id }})"
            @if(!$level->is_unlocked) disabled @endif
            class="bg-white rounded-xl p-6 border-2 
                @if($level->is_unlocked) 
                    border-gray-200 hover:border-blue-500 hover:shadow-lg 
                    transition-all duration-300 group text-left
                @else
                    border-gray-100 bg-gray-50 opacity-75 cursor-not-allowed
                @endif">
            
            <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 
                    @if($level->is_unlocked)
                        bg-purple-100 text-purple-600 group-hover:bg-purple-600 group-hover:text-white
                    @else
                        bg-gray-200 text-gray-400
                    @endif
                    rounded-lg flex items-center justify-center transition-colors">
                    
                    @if($level->is_unlocked)
                        <i class="fas fa-chart-line"></i>
                    @else
                        <i class="fas fa-lock"></i>
                    @endif
                </div>
                
                <div>
                    <h3 class="font-semibold 
                        @if($level->is_unlocked) text-gray-800 @else text-gray-400 @endif">
                        {{ $level->name }}
                    </h3>
                    @if(!$level->is_unlocked)
                        <p class="text-sm text-gray-400 mt-1">Complete previous level to unlock</p>
                    @endif
                </div>
            </div>
            
            <p class="text-gray-600 text-sm @if(!$level->is_unlocked) text-gray-400 @endif">
                {{ $level->description }}
            </p>
        </button>
    @endforeach
@endif

            @if($step === 'confirm')
            <div class="bg-white rounded-xl p-6 border-2 border-blue-500 shadow-lg col-span-full">
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-2xl mx-auto mb-4">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Ready to Start Assessment</h3>
                    <p class="text-gray-600">Review your selection below</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mx-auto mb-2">
                            <i class="fas fa-book"></i>
                        </div>
                        <p class="text-sm text-gray-600">Category</p>
                        <p class="font-semibold text-gray-800">{{ $selection['category_name'] ?? '' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-600 mx-auto mb-2">
                            <i class="fas fa-atom"></i>
                        </div>
                        <p class="text-sm text-gray-600">Subject</p>
                        <p class="font-semibold text-gray-800">{{ $selection['subject_name'] ?? '' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 mx-auto mb-2">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <p class="text-sm text-gray-600">Level</p>
                        <p class="font-semibold text-gray-800">{{ $selection['level_name'] ?? '' }}</p>
                    </div>
                </div>

                <div class="text-center">
                    <button wire:click="startExam" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-200 inline-flex items-center gap-2">
                        <i class="fas fa-play-circle"></i> Start Exam Now
                    </button>
                </div>
            </div>
            @endif
        </div>

        <!-- Assessment Process Info -->
        @if($step === 'category')
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Assessment Process</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="border-2 border-gray-200 rounded-lg p-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mb-3">
                        <i class="fas fa-1"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Level 1</h4>
                    <p class="text-gray-600 text-sm">Basic concepts assessment</p>
                </div>
                <div class="border-2 border-gray-200 rounded-lg p-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-600 mb-3">
                        <i class="fas fa-2"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Level 2</h4>
                    <p class="text-gray-600 text-sm">Advanced problem solving</p>
                </div>
                <div class="border-2 border-gray-200 rounded-lg p-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 mb-3">
                        <i class="fas fa-3"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Interview</h4>
                    <p class="text-gray-600 text-sm">Teaching ability showcase</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="text-center text-gray-500 text-sm mt-12 pt-6 border-t border-gray-200">
        <p>Computer Based Test Platform</p>
        <p>© 2023 Exam Portal. All rights reserved.</p>
    </div>
</div>

<!-- Loading Overlay -->
<div wire:loading wire:target="updateLevel,updateSubject,updateCategory" 
     class="fixed inset-0 bg-white bg-opacity-80 flex items-center justify-center z-50">
    <div class="text-center">
        <div class="w-16 h-16 border-4 border-blue-600 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
        <p class="text-gray-600">Processing your selection...</p>
    </div>
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
        animation: fadeIn 0.3s ease-in-out;
    }
</style>
</div>