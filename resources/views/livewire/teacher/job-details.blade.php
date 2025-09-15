<div class="flex flex-col gap-6">
    <!-- Teaching Preference -->
    <div x-data="{ show:false }" class="flex flex-col gap-4 border rounded-md p-5 shadow-sm bg-white">
        <!-- Header -->
        <div class="flex border-b pb-4 justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">Teaching Preference</h2>
                <p class="text-gray-600 text-sm">Manage your teaching preferences including subject, grade levels, and
                    job type</p>
            </div>
            <button x-show="!show" @click="show=true"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 rounded px-3 py-2 text-white text-sm font-medium">
                <i class="fa-solid fa-pen"></i> Edit Preferences
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
        <div x-show="show" x-transition class="border rounded-lg p-5 space-y-5">
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
                <div class="flex justify-between items-start border rounded p-3 bg-gray-50">
                    <div>
                        <p class="font-semibold">{{ $experience->institution }}</p>
                        <p class="text-gray-600">{{ $experience->role->name }}</p>
                        <p class="text-sm text-gray-500">From {{ $experience->start_date }} to
                            {{ $experience->end_date ?? 'Present' }}
                        </p>
                        <p class="text-sm">{{ $experience->description }}</p>
                        <p class="text-sm text-gray-700 italic">{{ $experience->achievements }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="editExperience({{ $experience->id }})"
                            class="px-2 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded">
                            <i class="fa-solid fa-pen"></i> Edit
                        </button>
                        <button wire:confirm="Are you sure want to delete?"
                            wire:click="deleteExperience({{ $experience->id }})"
                            class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            @empty
                <div
                    class="flex flex-col justify-center items-center mt-4 border border-gray-300 bg-gray-50 rounded-xl p-8 border-dashed text-center">
                    <i class="fa-solid fa-briefcase text-gray-400 text-3xl"></i>
                    <p class="text-gray-500 font-medium mt-2">No Experience Added yet</p>
                    <p class="text-gray-400 text-sm">Click 'Add Experience' to get started</p>
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

    <!-- Skill & Expertise -->
    <div x-data="{ show:false }" class="flex flex-col gap-4 border rounded-md p-5 shadow-sm">
        <div class="flex border-b pb-4 justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">Skill & Expertise</h2>
                <p class="text-gray-600 text-sm">Showcase your core competencies and technical abilities</p>
            </div>
            <button @click="show = !show" x-text="show ? 'Cancel' : 'Add Skill'"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 font-medium rounded px-3 py-2 text-white">
                <i class="fa-solid" :class="show ? 'fa-xmark' : 'fa-plus'"></i>
            </button>
        </div>

        <div x-show="show" x-transition class="flex flex-col sm:flex-row items-start gap-3 mt-3 w-full">
            <!-- Input with relative wrapper -->
             @foreach ($teacherSkills as $teacherSkill)
             <div class="p-1 rounded">
                <span>{{ $teacherSkill->skill->name }}</span>
                <button class="text-red-500 font-semibold" wire:click="removeSkill({{ 
                $teacherSkill->id }})">X</button>
             </div>
             @endforeach
            <div class="relative w-full sm:w-1/2">
                <input type="search" wire:model.live.debounce.300ms="searchSkill" placeholder="Search Skill..."
                    class="border p-2 rounded w-full">

                <!-- Right icon (loading or clear button) -->
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                   
                        <div wire:loading.delay.shortest wire:target="searchSkill">
                            <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 
                                                 5.291A7.962 7.962 0 014 12H0c0 
                                                 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                </div>

                <!-- Search results dropdown -->
                @if($searchSkill && count($skills) > 0)
                    <div
                        class="absolute z-10 mt-1 w-full bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto divide-y divide-gray-100">
                        @foreach ($skills as $skill)
                            <button type="button" wire:click="createSkill({{ $skill->id }})"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                {{ $skill->name }}
                            </button>
                        @endforeach
                    </div>
                @else
                    <h1 class="text-red-500 font-bold text-3xl">hello</h1>
                @endif
            </div>

            <!-- Add button -->
            <button wire:click="addSkill"
                class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 font-medium text-white px-3 py-2 rounded">
                <i class="fa-solid fa-plus"></i> Add
            </button>
        </div>
    </div>

    <!-- Education Background -->
    <div x-data="{show:false}" x-on:open-form.window="show = true" x-on:close-form.window="show = false"
        class="flex flex-col gap-4 border rounded-md p-5 shadow-sm">
        <div class="flex border-b pb-4 justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">Education Background</h2>
                <p class="text-gray-600 text-sm">Manage your academic qualifications and educational history</p>
            </div>
            <button @click="show = !show" x-text="show ? 'Cancel' : 'Add Education'"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 font-medium rounded px-3 py-2 text-white">
            </button>
        </div>
        <div class="mt-6 space-y-6">
            <h2 class="text-xl font-semibold">Qualifications</h2>

            @forelse($teacherQualification as $qualification)
                <div class="border rounded-lg p-4 bg-white shadow">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <p><strong>Institution:</strong> {{ $qualification->institution }}</p>
                        <p><strong>Qualification:</strong> {{ $qualification->qualification->name ?? 'N/A' }}</p>
                        <p><strong>Board/University:</strong> {{ $qualification->board_or_university }}</p>
                        <p><strong>Session:</strong> {{ $qualification->session }}</p>
                        <p><strong>Year of Passing:</strong> {{ $qualification->year_of_passing }}</p>
                        <p><strong>Grade/Percentage:</strong> {{ $qualification->grade_or_percentage }}</p>
                    </div>

                    <div class="mt-4">
                        <h3 class="font-medium">Subjects</h3>
                        <ul class="list-disc list-inside">
                            @foreach(json_decode($qualification->subjects, true) as $sub)
                                <li>{{ $sub['subject_name'] ?? $sub['name'] }} - {{ $sub['marks'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button class="text-white bg-red-500 p-2 rounded"
                        wire:click="deleteQualification({{ $qualification->id }})" wire:confirm="are you sure?">Delete
                        Education</button>
                </div>
            @empty
                <div x-show="!show"
                    class="flex flex-col justify-center items-center mt-4 border border-gray-300 bg-gray-50 rounded-xl p-8 border-dashed text-center">
                    <i class="fa-solid fa-graduation-cap text-gray-400 text-3xl"></i>
                    <p class="text-gray-500 font-medium mt-2">No Education Added yet</p>
                    <p class="text-gray-400 text-sm">Click 'Add Education' to get started</p>
                </div>
            @endforelse
        </div>


        <div x-show="show" class="flex flex-col border rounded-lg mt-4 p-5 bg-gray-50">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-b pb-4">
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Institution Name*</label>
                    <input type="text" class="border rounded p-2" wire:model="institute" placeholder="University Name ">
                    @error('institute')
                        <p class="text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Qualification*</label>
                    <select class="border rounded p-2" wire:model="qualification">
                        <option value="">Select Qualification</option>
                        @foreach ($qualifications as $qualification)
                            <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                        @endforeach
                    </select>
                    @error('qualification')
                        <p class="text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Session</label>
                    <input type="text" wire:model="session" class="border rounded p-2" placeholder="YYYY-YY">
                    @error('session')
                        <p class="text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Year of Passing*</label>
                    <input type="text" wire:model="year_of_passing" class="border rounded p-2" placeholder="YYYY">
                    @error('year_of_passing')
                        <p class="text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Board/University</label>
                    <input type="text" wire:model="board_or_university" class="border rounded p-2"
                        placeholder="Enter board or university name">
                    @error('board_or_university')
                        <p class="text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Grade/Percentage</label>
                    <input type="text" wire:model="grade_or_percentage" class="border rounded p-2"
                        placeholder="Enter grade or percentage">
                    @error('grade_or_percentage')
                        <p class="text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col gap-2 mt-4">
                <h3 class="text-lg font-medium">Add Subject With Marks</h3>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="text" wire:model="subject_name" class="border flex-1 p-2 rounded">
                    @error('subject_name')
                        <p class="text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                    <div class="flex gap-2">
                        <input type="text" wire:model="marks" placeholder="Marks" class="border p-2 rounded w-24">
                        @error('marks')
                            <p class="text-red-500 font-semibold">{{ $message }}</p>
                        @enderror
                        <button wire:click="addSubject"
                            class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 px-3 py-2 rounded font-medium text-white">
                            <i class="fa-solid fa-plus"></i> Add
                        </button>
                    </div>
                </div>
                <div class="flex gap-2">
                    @foreach ($qualification_subjects as $index => $subjects)
                        <div class="border p-1 rounded flex items-center gap-5">
                            <p>{{ $subjects['subject_name'] }} - {{ $subjects['marks'] }}</p>
                            <button wire:click="removeSubject({{ $index }})" class="text-red-500">
                                ✕
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex gap-2 mt-4">
                <button @click="show = false"
                    class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-medium px-3 py-2 rounded">
                    <i class="fa-solid fa-xmark"></i> Cancel
                </button>
                <button wire:click="saveEducation"
                    class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 text-white font-medium px-3 py-2 rounded">
                    <i class="fa-solid fa-save"></i> Save Education
                </button>
            </div>
        </div>
    </div>
</div>