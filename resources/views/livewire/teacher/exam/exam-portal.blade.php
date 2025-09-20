<div>
    @if($showWarningModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-xl font-semibold text-red-600 mb-4">Warning</h2>
            <p class="text-gray-700 mb-6">{{ $warningMessage }}</p>
            <div class="text-right">
                <button wire:click="closeWarning" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    OK
                </button>
            </div>
        </div>
    </div>
    @endif


    <div class="min-h-screen bg-gray-100 flex" id="exam-container">
              @if($showInstructions)
            <!-- Instructions Page Content - Using your preferred design -->
            <div class="w-full bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto my-8">
                <h1 class="font-medium text-2xl text-center mb-6">Exam Guidelines</h1>
                
                <p wire:click="backToDashboard" class="text-blue-500 cursor-pointer font-medium text-end mb-4">
                    Back To teacher dashboard
                </p>

                <div class="bg-blue-50 p-4 rounded-lg mb-6">
                    <h2 class="text-lg font-semibold mb-3">About This Exam</h2>
                    <div class="grid grid-cols-2 gap-2">
                        <p><strong>Subject:</strong> {{ $subjectName }}</p>
                        <p><strong>Class:</strong> {{ $categoryName }}</p>
                        <p><strong>Level:</strong> {{ $levelName }}</p>
                        <p><strong>Total Questions:</strong> {{ $questions->count() }}</p>
                        <p><strong>Time Limit:</strong> {{ $this->formatTime($timeLeft) }}</p>
                    </div>
                </div>
                
                <div class="mt-5">
                    <h2 class="text-lg font-semibold mb-3">Important Instructions</h2>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Ensure you have a stable internet connection. / सुनिश्चित करें कि आपका इंटरनेट कनेक्शन स्थिर है।</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Use the latest version of Google Chrome or Mozilla Firefox for the best experience. / सर्वोत्तम अनुभव के लिए Google Chrome या Mozilla Firefox के नवीनतम संस्करण का उपयोग करें।</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Make sure your device is fully charged or connected to a power source. / सुनिश्चित करें कि आपका डिवाइस पूरी तरह चार्ज है या बिजली के स्रोत से जुड़ा हुआ है।</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Read each question carefully before answering. / प्रत्येक प्रश्न का उत्तर देने से पहले ध्यानपूर्वक पढ़ें।</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>You cannot go back to previous questions once you move to the next one. / एक बार अगले प्रश्न पर जाने के बाद, आप पिछले प्रश्न पर वापस नहीं जा सकते।</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Manage your time wisely each question has a time limit. / अपने समय का बुद्धिमानी से प्रबंधन करें; प्रत्येक प्रश्न की समय सीमा होती है।</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Do not refresh the page or press the back button on your browser. / पेज को रीफ्रेश न करें और न ही ब्राउज़र का बैक बटन दबाएँ।</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Review your answers if allowed before submitting. / यदि अनुमति हो तो सबमिट करने से पहले अपने उत्तरों की समीक्षा करें।</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Click the "Submit" button to finish the test. / टेस्ट समाप्त करने के लिए "Submit" बटन पर क्लिक करें।</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>If you encounter technical issues, contact support immediately. / यदि आपको कोई तकनीकी समस्या आती है, तो तुरंत सहायता से संपर्क करें।</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Ensure no external assistance is used tests are monitored for fairness. / सुनिश्चित करें कि कोई बाहरी सहायता नहीं ली जा रही है; परीक्षाएं निष्पक्षता के लिए निगरानी की जाती हैं।</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Report incorrect questions immediately. / गलत प्रश्नों की तुरंत रिपोर्ट करें।</span>
                        </li>
                    </ul>
                </div>
                
           <div class="flex mt-5 flex-col">
    <label for="languageSelect" class="font-medium text-gray-700 mb-1">
        Choose the language/ भाषा चुने
    </label>
    <select wire:model.live="selectedLanguage" id="languageSelect" 
        class="border border-gray-300 p-2 rounded mt-1 focus:ring-2 focus:ring-blue-500 focus:border-blue-500
               @if(!empty($selectedLanguage)) border-green-400 @endif">
    <option value="" disabled selected>Select the language/ भाषा चुने</option>
    <option value="english">English</option>
    <option value="hindi">Hindi</option>
</select>
    
    @error('selectedLanguage')
        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
    @enderror
</div>
                
     <div class="mt-4">
    <label for="readInstruction" class="flex items-center">
        <input type="checkbox" id="readInstruction" class="mr-2" wire:model.live="agreedToGuidelines">
        I have read and agree to the guidelines
    </label>
</div>

<div class="text-center mt-6">
   <button wire:click="startExam" 
        wire:key="proceed-button-{{ $agreedToGuidelines && !empty($selectedLanguage) ? 'enabled' : 'disabled' }}"
        class="px-6 py-2 rounded font-semibold transition-colors duration-200
               @if($agreedToGuidelines && !empty($selectedLanguage)) 
                   bg-teal-500 hover:bg-teal-600 text-white 
               @else 
                   bg-gray-300 text-gray-500 cursor-not-allowed 
               @endif"
        @if(!$agreedToGuidelines || empty($selectedLanguage)) disabled @endif>
    Proceed to exam
</button>
</div>

            </div>
        @else
            <!-- Exam Interface -->
            <!-- Sidebar -->
            <aside class="w-1/4 bg-white shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Questions</h2>
                <p class="text-sm text-gray-500 mb-3">Total Questions ({{ $questions->count() }})</p>

                <div class="grid grid-cols-5 gap-3">
                    @foreach ($questions as $index => $q)
                    @php
                    $isAnswered = isset($answers[$q->id]) && $answers[$q->id] !== null;
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
                        Time Left: <span class="font-semibold text-gray-800">{{ $this->formatTime($timeLeft) }}</span>
                        </div>
                       <button wire:click="exitExamWithSubmit" class="bg-red-100 text-red-600 px-3 py-1 rounded-md border border-red-200 hover:bg-red-200">
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
        @endif
    </div>



@script
<script>
    let altKeyPressed = false;
    
    // Define the fullscreen functions
    function enterFullScreen() {
        const elem = document.documentElement;
        if (elem.requestFullscreen) {
            elem.requestFullscreen().catch(err => {
                console.error('Full screen error:', err);
            });
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        }
    }
    
    function exitFullScreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }
    
    // Function to handle tab switching
    function handleTabSwitch() {
        console.log('Tab switch detected');
        @this.call('incrementTabSwitchCount');
    }
    
    // Livewire event listeners
    Livewire.on('start-exam-mode', () => {
        console.log('Starting exam mode');
        enterFullScreen();
        
        // Set up visibility change detection
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                handleTabSwitch();
            }
        });
        
        // Set up blur detection
        window.addEventListener('blur', function() {
            handleTabSwitch();
        });
        
        // Detect Alt+Tab combination
        document.addEventListener('keydown', function(e) {
            // Detect Alt key press
            if (e.key === 'Alt' || e.keyCode === 18) {
                altKeyPressed = true;
            }
            
            // Detect Tab key press when Alt is already pressed (Alt+Tab)
            if ((e.key === 'Tab' || e.keyCode === 9) && altKeyPressed) {
                handleTabSwitch();
                e.preventDefault();
                return false;
            }
            
            // Detect other potentially problematic key combinations
            const forbiddenCombinations = [
                e.key === 'F12', 
                (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.keyCode === 73)),
                (e.ctrlKey && e.shiftKey && (e.key === 'C' || e.keyCode === 67)),
                (e.ctrlKey && (e.key === 'u' || e.keyCode === 85)),
                (e.ctrlKey && (e.key === 'r' || e.keyCode === 82)),
            ];
            
            if (forbiddenCombinations.some(comb => comb)) {
                handleTabSwitch();
                e.preventDefault();
                return false;
            }
        });
        
        document.addEventListener('keyup', function(e) {
            if (e.key === 'Alt' || e.keyCode === 18) {
                altKeyPressed = false;
            }
        });
        
        // Prevent right-click context menu
        document.addEventListener('contextmenu', (e) => e.preventDefault());
    });
    
    Livewire.on('exit-exam-mode', () => {
        console.log('Exiting exam mode');
        exitFullScreen();
        
        // Remove event listeners
        document.removeEventListener('visibilitychange', handleVisibilityChange);
        window.removeEventListener('blur', handleWindowBlur);
        document.removeEventListener('keydown', handleKeyDown);
        document.removeEventListener('keyup', handleKeyUp);
        document.removeEventListener('contextmenu', (e) => e.preventDefault());
    });
    
    // Timer functionality
    Livewire.on('start-timer', ({ duration }) => {
        console.log('Starting timer with duration:', duration);
        const timerInterval = setInterval(() => {
            @this.call('decrementTime');
            
            if (@this.get('timeLeft') <= 0 || !@this.get('timerActive')) {
                clearInterval(timerInterval);
            }
        }, 1000);
    });
</script>
@endscript

    <style>
        .full-screen-mode {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            background: white;
            overflow: auto;
        }
        
        .full-screen-mode header,
        .full-screen-mode footer,
        .full-screen-mode .navigation {
            display: none !important;
        }
        
        .full-screen-mode {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
</div>