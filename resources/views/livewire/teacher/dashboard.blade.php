<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6"> 
    <div class="max-w-6xl mx-auto">
        <div class="space-y-8">
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
                    @if($categories->count() > 0)
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
                    @else
                        <div class="col-span-full text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">No Class Categories Assigned</h3>
                            <p class="text-gray-500 mb-4">Please contact administration to assign class categories to your profile.</p>
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                Contact Support
                            </button>
                        </div>
                    @endif
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
            @if(!$level->is_unlocked || !$level->has_questions) disabled @endif
            class="bg-white rounded-xl p-6 border-2 
                @if($level->is_unlocked && $level->has_questions) 
                    border-gray-200 hover:border-blue-500 hover:shadow-lg 
                    transition-all duration-300 group text-left
                @else
                    border-gray-100 bg-gray-50 opacity-75 cursor-not-allowed
                @endif">
            
            <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 
                    @if($level->is_unlocked && $level->has_questions)
                        bg-purple-100 text-purple-600 group-hover:bg-purple-600 group-hover:text-white
                    @else
                        bg-gray-200 text-gray-400
                    @endif
                    rounded-lg flex items-center justify-center transition-colors">
                    
                    @if(!$level->is_unlocked)
                        <i class="fas fa-lock"></i>
                    @elseif(!$level->has_questions)
                        <i class="fas fa-exclamation-circle"></i>
                    @else
                        <i class="fas fa-chart-line"></i>
                    @endif
                </div>
                
                <div>
                    <h3 class="font-semibold 
                        @if($level->is_unlocked && $level->has_questions) text-gray-800 @else text-gray-400 @endif">
                        {{ $level->name }}
                    </h3>
                    @if(!$level->is_unlocked)
                        <p class="text-sm text-gray-400 mt-1">Complete previous level to unlock</p>
                    @elseif(!$level->has_questions)
                        <p class="text-sm text-gray-400 mt-1">No questions available</p>
                    @endif
                </div>
            </div>
            
            <p class="text-gray-600 text-sm @if(!$level->is_unlocked || !$level->has_questions) text-gray-400 @endif">
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

















    <!-- NEW: Level 3 Choice Modal -->
    @if($showLevel3Modal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
                <h3 class="text-xl font-semibold mb-4">Level 3 Options</h3>
                <p class="text-gray-600 mb-4">Choose how you want to complete Level 3:</p>
                
                <div class="space-y-3 mb-4">
                    <label class="flex items-center">
                        <input type="radio" wire:model="level3Mode" value="interview" class="mr-2">
                        Interview Only
                    </label>
                    <label class="flex items-center">
                        <input type="radio" wire:model="level3Mode" value="center" class="mr-2">
                        Exam at Center
                    </label>
                    <label class="flex items-center">
                        <input type="radio" wire:model="level3Mode" value="both" class="mr-2">
                        Both (Interview + Exam at Center)
                    </label>
                </div>
                @error('level3Mode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                
                @if(in_array($level3Mode, ['center', 'both']))
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Enter Pincode</label>
                        <input type="text" wire:model="pincodeForCenter" class="w-full border rounded px-3 py-2">
                        @error('pincodeForCenter') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        
                        <button wire:click="fetchCenters" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">
                            Search Centers
                        </button>
                        
                        @if(!empty($availableCenters))
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Select Center</label>
                                <select wire:model="selectedCenterId" class="w-full border rounded px-3 py-2">
                                    <option value="">-- Select --</option>
                                    @foreach($availableCenters as $center)
                                        <option value="{{ $center['id'] }}">{{ $center['center_name'] }} ({{ $center['city'] }})</option>
                                    @endforeach
                                </select>
                                @error('selectedCenterId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>
                @endif
                
                <div class="mt-6 flex justify-end gap-3">
                    <button wire:click="confirmLevel3Choice" class="bg-blue-600 text-white px-4 py-2 rounded">Confirm</button>
                    <button wire:click="$set('showLevel3Modal', false)" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel</button>
                </div>
            </div>
        </div>
    @endif



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
            
            <!-- Dynamic Interview Management Section -->
            @if($step === 'category' && $hasQualifiedLevel2)
            <!-- Interview Management Section -->
            <div x-data="{ 
                showScheduleModal: false, 
                selectedExam: null,
                interviewDate: '',
                interviewTime: '',
                activeTab: 'qualified'
            }" class="bg-white rounded-xl shadow-md p-6 mt-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                            <i class="fas fa-video"></i>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Interview Management</h2>
                    </div>
                </div>
                
                <p class="text-gray-600 mb-6">Schedule and manage your teaching qualification interviews</p>
                
                <!-- Interview Tabs -->
                <div class="border-b border-gray-200 mb-6">
                    <div class="flex space-x-4">
                        <button 
                            @click="activeTab = 'qualified'"
                            :class="{
                                'px-4 py-2 border-b-2 border-blue-500 text-blue-600 font-medium': activeTab === 'qualified',
                                'px-4 py-2 text-gray-500 font-medium': activeTab !== 'qualified'
                            }">
                            Qualified Exams ({{ count($qualifiedExams) }})
                        </button>
                        <button 
                            @click="activeTab = 'interviews'"
                            :class="{
                                'px-4 py-2 border-b-2 border-blue-500 text-blue-600 font-medium': activeTab === 'interviews',
                                'px-4 py-2 text-gray-500 font-medium': activeTab !== 'interviews'
                            }">
                            My Interviews ({{ count($myInterviews) }})
                        </button>
                    </div>
                </div>
                
                <!-- Qualified Exams Section -->
                <div x-show="activeTab === 'qualified'" x-cloak>

 <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all">All Subjects</option>
                @foreach($subjectsForFilter as $subject)
                    <option value="{{ $subject->subject_name }}">{{ $subject->subject_name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Class Category</label>
            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all">All Classes</option>
                @foreach($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Qualified Exams</h3>
                    <p class="text-gray-600 mb-4">Select an exam to schedule your interview</p>
                    
                    @if(count($qualifiedExams) > 0)
                        @foreach($qualifiedExams as $exam)
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">{{ $exam['subject'] }}</h4>
                                        <p class="text-sm text-gray-600">{{ $exam['category'] }} | {{ $exam['subject'] }} | Level 2</p>
                                        <p class="text-sm text-gray-600">Score: {{ $exam['score'] }}%</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full mb-2">Level 2 Qualified</span>
                                    <button 
                                        @click="showScheduleModal = true; selectedExam = {{ json_encode($exam) }}; interviewDate = ''; interviewTime = ''" 
                                        class="px-4 py-1 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition-colors">
                                        Schedule Interview
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <p class="text-gray-500">No qualified exams available for interview scheduling.</p>
                        </div>
                    @endif
                </div>
                
                <!-- My Interviews Section -->
                <div x-show="activeTab === 'interviews'" x-cloak>
                    <!-- Filters -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                            <select 
                                wire:model="interviewFilters.subject" 
                                wire:change="updateInterviewFilters('subject', $event.target.value)"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="all">All Subjects</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->subject_name }}">{{ $subject->subject_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Class Category</label>
                            <select 
                                wire:model="interviewFilters.category" 
                                wire:change="updateInterviewFilters('category', $event.target.value)"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="all">All Classes</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select 
                                wire:model="interviewFilters.status" 
                                wire:change="updateInterviewFilters('status', $event.target.value)"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="all">All Statuses</option>
                                <option value="scheduled">Scheduled</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                     <h3 class="text-lg font-semibold text-gray-800 mb-4">My Interviews</h3>
                     <p class="text-gray-600 mb-4">View and manage your scheduled interviews</p>
                    
                    @if(count($myInterviews) > 0)
                        @foreach($myInterviews as $interview)
                        <div class="border border-gray-200 rounded-xl p-5 mb-4">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">{{ $interview['subject'] }}</h4>
                                        <p class="text-sm text-gray-600">{{ $interview['category'] }} - {{ $interview['subject'] }}</p>
                                        
                                        <div class="mt-3">
                                            <p class="text-sm font-medium text-gray-700">Date & Time:</p>
                                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($interview['scheduled_at'])->format('d F Y \a\t h:i a') }}</p>
                                        </div>
                                        
                                        <div class="mt-4 flex gap-3">
                                            @if($interview['status'] === 'scheduled' && $interview['meeting_link'])
                                            <a href="{{ $interview['meeting_link'] }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded-lg flex items-center gap-2 hover:bg-blue-700">
                                                <i class="fas fa-video"></i> Join Interview
                                            </a>
                                            @endif
                                            <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg flex items-center gap-2 hover:bg-gray-50">
                                                <i class="fas fa-calendar-plus"></i> Add to Calendar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block px-3 py-1 
                                        @if($interview['status'] === 'scheduled') bg-blue-100 text-blue-800
                                        @elseif($interview['status'] === 'completed') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif
                                        text-sm font-medium rounded-full mb-2">
                                        {{ ucfirst($interview['status']) }}
                                    </span>
                                    <p class="text-sm text-gray-600">Level 2</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <p class="text-gray-500">No interviews scheduled yet.</p>
                        </div>
                    @endif
                </div>

                <!-- Schedule Interview Modal -->
                <div x-show="showScheduleModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" x-cloak>
                    <div class="bg-white rounded-xl shadow-xl w-full max-w-md" @click.outside="showScheduleModal = false">
                        <!-- Modal Header -->
                        <div class="border-b border-gray-200 p-6">
                            <h3 class="text-xl font-semibold text-gray-800">Schedule Interview</h3>
                            <p class="text-gray-600 mt-1">Select a date and time for your virtual interview</p>
                        </div>
                        
                        <!-- Modal Content -->
                        <div class="p-6">
                            <!-- Selected Exam Info -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <h4 class="font-medium text-gray-800 mb-2">Selected Exam:</h4>
                                <p class="text-gray-600" x-text="selectedExam.category + ' | ' + selectedExam.subject + ' | Level 2'"></p>
                            </div>
                            
                            <!-- Date & Time Selection -->
                            <div class="mb-6">
                                <h4 class="font-medium text-gray-800 mb-4">Interview Date & Time</h4>
                                
                                <!-- Date Picker -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Date</label>
                                    <input 
                                        x-model="interviewDate"
                                        type="date" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                        min="{{ date('Y-m-d') }}">
                                </div>
                                
                                <!-- Time Picker -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Time</label>
                                    <input 
                                        x-model="interviewTime"
                                        type="time" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        min="09:00" max="18:00" step="900">
                                </div>
                                
                                <!-- SelectedDateTime Display -->
                                <template x-if="interviewDate && interviewTime">
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mt-4">
                                        <p class="text-sm text-gray-600">Selected Date & Time:</p>
                                        <p class="font-medium text-blue-700" x-text="formatDateTime(interviewDate, interviewTime)"></p>
                                    </div>
                                </template>
                            </div>
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="border-t border-gray-200 p-6 flex justify-end gap-3">
                            <button @click="showScheduleModal = false" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Cancel
                            </button>
                            <button 
                                @click="if(interviewDate && interviewTime) { 
                                    $wire.scheduleInterview(selectedExam.id, interviewDate + ' ' + interviewTime); 
                                    showScheduleModal = false; 
                                }" 
                                :class="{
                                    'px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2': true,
                                    'opacity-50 cursor-not-allowed': !interviewDate || !interviewTime
                                }"
                                :disabled="!interviewDate || !interviewTime">
                                <i class="fas fa-calendar-check"></i> Schedule Interview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                // Add this function to format the date and time display
                function formatDateTime(dateString, timeString) {
                    const date = new Date(dateString + 'T' + timeString);
                    return date.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric', 
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                }
            </script>
            @endif
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
     class="fixed inset-0 bg-white bg-opacity-80 flex items-center justify-center z-50"
     style="position: fixed; top: 0; left: 0; right: 0; bottom: 0;">
    <div class="flex flex-col items-center justify-center min-h-screen">
        <div class="w-16 h-16 border-4 border-blue-600 border-t-transparent rounded-full animate-spin mb-4"></div>
        <p class="text-gray-600 text-lg font-medium">Processing your selection...</p>
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
        [x-cloak] { display: none !important; }

        /* Date and time input styling */
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
        }

        input[type="date"]:focus,
        input[type="time"]:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>
</div>