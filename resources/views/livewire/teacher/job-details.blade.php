<div class="flex flex-col gap-6">
    <!-- Teaching Preference -->
    <div x-data="{ show:false }" x-on:open-form.window="show = true" x-on:close-form.window="show = false" class="flex flex-col gap-4 border rounded-md p-5 shadow-sm bg-white">
        <!-- Header -->
        <div class="flex border-b pb-4 justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">Teaching Preference</h2>
                <p class="text-gray-600 text-sm">Manage your teaching preferences including subject, grade levels, and
                    job type</p>
            </div>
              <button @click="show = !show" x-text="show ? 'Cancel' : 'Edit Preference'"
                    class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 font-medium rounded px-3 py-2 text-white">
                </button>
        </div>

        <div x-show="!show" class="mt-5">
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Class Category -->
                <div class="flex flex-col border p-5 rounded-2xl shadow-sm bg-white">
                    <p class="text-lg font-semibold text-gray-800">Class Category</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        @foreach ($classCategories as $classCategory)
                            @if ($selectedCategory->contains($classCategory->id))
                                <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-700">
                                    {{ $classCategory->name }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Job Role -->
                <div class="flex flex-col border p-5 rounded-2xl shadow-sm bg-white">
                    <p class="text-lg font-semibold text-gray-800">Job Role</p>
                    <div class="mt-3">
                        @foreach ($jobRoles as $role)
                            @if ($selectedJobRole == $role->id)
                                <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">
                                    {{ $role->name }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Subject -->
                <div class="flex flex-col border p-5 rounded-2xl shadow-sm bg-white md:col-span-2">
                    <p class="text-lg font-semibold text-gray-800">Subjects</p>
                    <div class="mt-3 space-y-3">
                        @foreach ($subjects as $categoryId => $subjectList)
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">
                                    {{ $subjectList[0]['category_name'] }} →
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($subjectList as $sub)
                                        @if ($selectedSubject->contains($sub['id']))
                                            <span class="px-3 py-1 text-sm rounded-full bg-purple-100 text-purple-700">
                                                {{ $sub['subject_name'] }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Job Type -->
                <div class="flex flex-col border p-5 rounded-2xl shadow-sm bg-white md:col-span-2">
                    <p class="text-lg font-semibold text-gray-800">Teacher Job Type</p>
                    <div class="mt-3">
                        @foreach ($jobTypes as $type)
                            @if ($selectedJobType == $type->id)
                                <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">
                                    {{ $type->teacher_job_name }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Form -->
        <div x-show="show" class="border rounded-lg p-5 space-y-5">
            <p class="border-b pb-3 text-gray-700 text-sm">Please update your teaching preferences below. Fields marked
                with * are required.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Class Category -->
                <div class="space-y-2">
                    <p class="text-lg font-medium">Class Category*</p>
                    <p class="text-sm text-gray-500">Select the educational level you're comfortable teaching</p>
                    <div class="border rounded-lg p-3 space-y-2">
                        @foreach ($classCategories as $classCategory)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" id="classCategory-{{ $classCategory->id }}" value="{{ $classCategory->id }}"
                                    wire:model="selectedCategory" wire:change="updateSubjects"
                                    class="rounded text-blue-600 focus:ring-blue-500" 
                                    @if ($selectedCategory->contains($classCategory->id))
                                    checked 
                                    @endif
                                >
                                {{ $classCategory->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Job Role -->
                <div class="space-y-2">
                    <p class="text-lg font-medium">Job Role*</p>
                    <p class="text-sm text-gray-500">"Teacher" is required. Add additional roles if desired</p>
                    <div class="border rounded-lg p-3 space-y-2">
                        @foreach ($jobRoles as $role)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="jobRole" id="role-{{ $role->id }}" value="{{ $role->id }}"
                                    wire:model="selectedJobRole" class="text-blue-600 focus:ring-blue-500">
                                {{ $role->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Subjects -->
                <div class="space-y-2">
                    <p class="text-lg font-medium">Preferred Subjects*</p>
                    <p class="text-sm text-gray-500">Select subjects you're qualified to teach</p>
                    <div class="border rounded-lg p-3 space-y-2">
                        @foreach ($subjects as $categoryId => $subjectList)
                            <p class="mt-2 font-medium">
                                {{ $subjectList[0]['category_name'] }} →
                            </p>
                            @foreach ($subjectList as $sub)
                                <label class="flex items-center gap-2 cursor-pointer ml-4">
                                    <input type="checkbox" id="sub-{{ $sub['id'] }}" value="{{ $sub['id'] }}"
                                        wire:model="selectedSubject" class="rounded text-blue-600 focus:ring-blue-500">
                                    {{ $sub['subject_name'] }}
                                </label>
                            @endforeach
                        @endforeach
                        

                    </div>
                    @error('selectedSubject')
                        <div class="text-red-500 text-sm font-semibold">{{ $message }}</div>
                    @enderror
                    
                </div>

                <!-- Job Type -->
                <div class="space-y-2">
                    <p class="text-lg font-medium">Teacher Job Type*</p>
                    <p class="text-sm text-gray-500">Choose your preferred employment type(s)</p>
                    <div class="border rounded-lg p-3 space-y-2">
                        @foreach ($jobTypes as $type)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jobtype" id="type-{{ $type->id }}" value="{{ $type->id }}"
                                        wire:model="selectedJobType" class="text-blue-600 focus:ring-blue-500">
                                    {{ $type->teacher_job_name }}
                                </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3">
                <button @click="show=false"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md">Discard</button>
                <button wire:click="createOrUpdatePreference"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Save Changes</button>
            </div>
        </div>
    </div>
    <!-- Professional Experience -->
    <div x-data="{ show:false }" x-on:open-form.window="show = true" x-on:close-form.window="show = false"
        class="flex flex-col gap-4 border rounded-md p-5 shadow-sm">
        <div class="flex border-b pb-4 justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">Professional Experience</h2>
                <p class="text-gray-600 text-sm">Manage your teaching positions and institutional experience</p>
            </div>
            <div>
                <button @click="show = !show" x-text="show ? 'Cancel' : 'Add Experience'"
                    class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 font-medium rounded px-3 py-2 text-white">
                </button>
            </div>
        </div>

       <div x-show="!show">
            @forelse ($teacherExperience as $experience)
                <div class="flex justify-between items-start border rounded-xl p-4 bg-white shadow-sm hover:shadow-md transition mb-3">
                    <div class="space-y-1">
                        <p class="font-semibold text-lg text-gray-800">
                            <span class="text-gray-600">Institution:</span> {{ $experience->institution }}
                        </p>
                        <p class="text-gray-700">
                            <span class="text-gray-600">Role:</span> {{ $experience->role->name }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <span class="text-gray-500">Duration:</span>
                            {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }}
                            –
                            {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}
                        </p>
                        @if($experience->description)
                            <p class="text-sm text-gray-700">
                                <span class="text-gray-600">Description:</span> {{ $experience->description }}
                            </p>
                        @endif
                        @if($experience->achievements)
                            <p class="text-sm text-green-700 italic">
                                <span class="text-gray-600">Achievements:</span> {{ $experience->achievements }}
                            </p>
                        @endif
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <button wire:click="editExperience({{ $experience->id }})"
                            class="px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-sm flex items-center gap-1">
                            <i class="fa-solid fa-pen"></i> Edit
                        </button>
                        <button wire:confirm="Are you sure you want to delete this experience?"
                            wire:click="deleteExperience({{ $experience->id }})"
                            class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg shadow-sm flex items-center gap-1">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            @empty
                <div
                    class="flex flex-col justify-center items-center mt-6 border border-gray-300 bg-gray-50 rounded-xl p-10 border-dashed text-center shadow-inner">
                    <i class="fa-solid fa-briefcase text-gray-400 text-4xl mb-2"></i>
                    <p class="text-gray-600 font-semibold text-lg">No Experience Added Yet</p>
                    <p class="text-gray-400 text-sm">Click <span class="font-medium text-blue-500">'Add Experience'</span> to get started</p>
                </div>
            @endforelse
        </div>

        <!-- Add Form -->
        <div x-show="show" class="flex flex-col border rounded-lg mt-4 p-5 bg-gray-50">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-b pb-4">

                <!-- Institution -->
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Institution*</label>
                    <input type="text" class="border rounded p-2" wire:model="institution"
                        placeholder="University Name">
                    @error('institution') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Job Role -->
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Job Role*</label>
                    <select class="border rounded p-2" wire:model="selectedRole">
                        <option value="" selected>Select a job role</option>
                        @foreach ($jobRoles as $jobRole)
                            <option value="{{ $jobRole->id }}">{{ $jobRole->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedRole') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Start Date -->
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Start Date*</label>
                    <input type="date" wire:model="start_date" class="border rounded p-2">
                    @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- End Date -->
                <div x-data="{ currentlyWorking:false }" class="flex flex-col gap-1">
                    <div class="flex justify-between items-center">
                        <label class="text-sm">End Date*</label>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="currentlyWorking" x-model="currentlyWorking">
                            <label for="currentlyWorking" class="text-sm">Currently working here</label>
                        </div>
                    </div>
                    <input type="date" wire:model="end_date" :disabled="currentlyWorking" class="border rounded p-2">
                    @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Achievements -->
                <div class="flex flex-col gap-1 col-span-2">
                    <label class="text-sm">Achievements</label>
                    <textarea rows="3" wire:model="achievements" class="border rounded p-2"
                        placeholder="Enter Achievements"></textarea>
                    @error('achievements') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div class="flex flex-col gap-1 col-span-2">
                    <label class="text-sm">Description</label>
                    <textarea rows="3" wire:model="description" class="border rounded p-2"
                        placeholder="Enter description"></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-2 mt-4">
                <button wire:click="resetForm"
                    class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-medium px-3 py-2 rounded">
                    <i class="fa-solid fa-xmark"></i> Cancel
                </button>
                <button wire:click="saveExperience"
                    class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 text-white font-medium px-3 py-2 rounded">
                    <i class="fa-solid fa-save"></i> {{ $editingId ? 'Update Experience' : 'Save Experience' }}
                </button>
            </div>
        </div>
    </div>
   <!-- Education Background -->
    <div x-data="{show:false}" x-on:open-form.window="show = true" x-on:close-form.window="show = false"
        class="flex flex-col gap-6 border rounded-lg p-6 shadow-sm bg-white">
        
        <!-- Header -->
        <div class="flex border-b pb-4 justify-between items-center">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Education Background</h2>
                <p class="text-gray-600 text-sm">Manage your academic qualifications and educational history</p>
            </div>
            <button @click="show = !show" 
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 font-medium rounded-lg px-4 py-2 text-white shadow-sm transition">
                <i class="fa-solid" :class="show ? 'fa-xmark' : 'fa-plus'"></i>
                <span x-text="show ? 'Cancel' : 'Add Education'"></span>
            </button>
        </div>

        <!-- Qualifications -->
        <div class="mt-4 space-y-6">
            <h2 class="text-xl font-semibold text-gray-700">Qualifications</h2>

            @forelse($teacherQualification as $qualification)
                <div class="border rounded-xl p-5 bg-gray-50 shadow-sm hover:shadow-md transition">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                        <p><span class="font-semibold text-gray-600">Institution:</span> {{ $qualification->institution }}</p>
                        <p><span class="font-semibold text-gray-600">Qualification:</span> {{ $qualification->qualification->name ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-600">Board/University:</span> {{ $qualification->board_or_university }}</p>
                        <p><span class="font-semibold text-gray-600">Session:</span> {{ $qualification->session }}</p>
                        <p><span class="font-semibold text-gray-600">Year of Passing:</span> {{ $qualification->year_of_passing }}</p>
                        <p><span class="font-semibold text-gray-600">Grade/Percentage:</span> {{ $qualification->grade_or_percentage }}</p>
                    </div>

                    <!-- Subjects -->
                    @if($qualification->subjects)
                        <div class="mt-4">
                            <h3 class="font-medium text-gray-800 mb-2">Subjects</h3>
                            <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                                @foreach(json_decode($qualification->subjects, true) as $sub)
                                    <li>{{ $sub['subject_name'] ?? $sub['name'] }} - {{ $sub['marks'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="mt-4 flex justify-end">
                        <button class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-3 py-2 rounded-lg shadow-sm transition"
                            wire:click="deleteQualification({{ $qualification->id }})" 
                            wire:confirm="Are you sure you want to delete this education?">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            @empty
                <div x-show="!show"
                    class="flex flex-col justify-center items-center mt-6 border border-gray-300 bg-gray-50 rounded-xl p-10 border-dashed text-center shadow-inner">
                    <i class="fa-solid fa-graduation-cap text-gray-400 text-4xl"></i>
                    <p class="text-gray-600 font-semibold mt-2">No Education Added Yet</p>
                    <p class="text-gray-400 text-sm">Click "Add Education" to get started</p>
                </div>
            @endforelse
        </div>

        <!-- Add Education Form -->
        <div x-show="show" x-transition
            class="flex flex-col border rounded-xl mt-4 p-6 bg-gray-50 shadow-inner space-y-6">
            
            <!-- Inputs -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium">Institution Name*</label>
                    <input type="text" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm"
                        wire:model="institute" placeholder="University Name">
                    @error('institute') <p class="text-red-500 text-xs font-semibold">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium">Qualification*</label>
                    <select class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm"
                        wire:model="qualification">
                        <option value="">Select Qualification</option>
                        @foreach ($qualifications as $qualification)
                            <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                        @endforeach
                    </select>
                    @error('qualification') <p class="text-red-500 text-xs font-semibold">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium">Session</label>
                    <input type="text" wire:model="session" placeholder="YYYY-YY"
                        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm">
                    @error('session') <p class="text-red-500 text-xs font-semibold">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium">Year of Passing*</label>
                    <input type="text" wire:model="year_of_passing" placeholder="YYYY"
                        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm">
                    @error('year_of_passing') <p class="text-red-500 text-xs font-semibold">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium">Board/University</label>
                    <input type="text" wire:model="board_or_university" placeholder="Enter board or university name"
                        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm">
                    @error('board_or_university') <p class="text-red-500 text-xs font-semibold">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium">Grade/Percentage</label>
                    <input type="text" wire:model="grade_or_percentage" placeholder="Enter grade or percentage"
                        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm">
                    @error('grade_or_percentage') <p class="text-red-500 text-xs font-semibold">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Subjects -->
            <div class="space-y-3">
                <h3 class="text-lg font-semibold text-gray-800">Subjects & Marks</h3>
                <div class="flex flex-col sm:flex-row gap-3 items-start">
                    <input type="text" wire:model="subject_name" placeholder="Subject Name"
                        class="border rounded-lg px-3 py-2 flex-1 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm">
                    <input type="text" wire:model="marks" placeholder="Marks"
                        class="border rounded-lg px-3 py-2 w-28 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm">
                    <button wire:click="addSubject"
                        class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 px-4 py-2 rounded-lg font-medium text-white shadow-sm transition">
                        <i class="fa-solid fa-plus"></i> Add
                    </button>
                </div>
                @error('subject_name') <p class="text-red-500 text-xs font-semibold">{{ $message }}</p> @enderror
                @error('marks') <p class="text-red-500 text-xs font-semibold">{{ $message }}</p> @enderror

                <div class="flex flex-wrap gap-2">
                    @foreach ($qualification_subjects as $index => $subjects)
                        <span class="flex items-center gap-2 bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm shadow-sm">
                            {{ $subjects['subject_name'] }} - {{ $subjects['marks'] }}
                            <button wire:click="removeSubject({{ $index }})" class="text-red-500 hover:text-red-600">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3 mt-4">
                <button @click="show = false"
                    class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition">
                    <i class="fa-solid fa-xmark"></i> Cancel
                </button>
                <button wire:click="saveEducation"
                    class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition">
                    <i class="fa-solid fa-save"></i> Save Education
                </button>
            </div>
        </div>
    </div>
    <!-- Skill & Expertise -->
    <div x-data="{ show:false }" class="flex flex-col gap-4 border rounded-md p-5 shadow-sm bg-white">
        <!-- Header -->
        <div class="flex border-b pb-4 justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">Skill & Expertise</h2>
                <p class="text-gray-600 text-sm">Showcase your core competencies and technical abilities</p>
            </div>
            <button @click="show = !show" x-text="show ? 'Cancel' : 'Add Skill'"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 font-medium rounded px-3 py-2 text-white transition">
                <i class="fa-solid" :class="show ? 'fa-xmark' : 'fa-plus'"></i>
            </button>
        </div>

        <!-- Always showing skills -->
        <div class="flex flex-wrap gap-2">
            @forelse ($teacherSkills as $teacherSkill)
                <span class="flex items-center gap-2 bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm shadow-sm">
                    {{ $teacherSkill->skill->name }}
                    <button wire:click="removeSkill({{ $teacherSkill->id }})"
                        class="text-red-500 hover:text-red-600">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </span>
            @empty
                <p class="text-gray-500 text-sm italic">No skills added yet. Click "Add Skill" to get started.</p>
            @endforelse
        </div>

        <!-- Add Skill Form (toggle) -->
        <div x-show="show" x-transition class="flex flex-col sm:flex-row items-start gap-3 mt-3 w-full">
            <!-- Search box -->
            <div class="relative w-full sm:w-1/2">
                <input type="search" wire:model.live.debounce.300ms="searchSkill" placeholder="Search Skill..."
                    class="border rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm">

                <!-- Loading icon -->
                <div class="absolute inset-y-0 right-3 flex items-center">
                    <div wire:loading.delay.shortest wire:target="searchSkill">
                        <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 
                                0 5.373 0 12h4zm2 5.291A7.962 7.962 0 
                                014 12H0c0 3.042 1.135 5.824 3 
                                7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Search results dropdown -->
                @if($searchSkill && count($skills) > 0)
                    <div
                        class="absolute z-10 mt-1 w-full bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto divide-y divide-gray-100">
                        @foreach ($skills as $skill)
                            <button type="button" wire:click="createSkill({{ $skill->id }})"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-sm">
                                {{ $skill->name }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Add button -->
            <button wire:click="addSkill"
                class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 font-medium text-white px-4 py-2 rounded-lg shadow-sm transition">
                <i class="fa-solid fa-plus"></i> Add
            </button>
        </div>
    </div>
</div>