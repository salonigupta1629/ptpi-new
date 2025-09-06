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

        <!-- Display View -->
        <div x-show="!show" class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
            <template x-for="(field, index) in [
            {label:'Class Category', value:'Not Provided'},
            {label:'Job Role', value:'Teacher'},
            {label:'Subject', value:'Not Provided'},
            {label:'Teacher Job Type', value:'Not Provided'}
        ]" :key="index">
                <div class="flex flex-col gap-2 border rounded-lg p-4">
                    <p class="text-base font-medium" x-text="field.label"></p>
                    <p class="bg-blue-50 border border-blue-300 rounded-full py-1 px-3 w-fit text-sm text-gray-700"
                        x-text="field.value"></p>
                </div>
            </template>
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
                                <input type="checkbox" id="classCategory-{{ $classCategory->id }}"
                                    value="{{ $classCategory->id }}" wire:model="selectedClassCategories"
                                    wire:change="updateSubjects" class="rounded text-blue-600 focus:ring-blue-500">
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
                                <input type="checkbox" id="role-{{ $role->id }}"
                                    value="{{ $role->id }}" wire:model="selectedJobRole"
                                    class="rounded text-blue-600 focus:ring-blue-500">
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
                        @forelse ($subjects as $subject)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" value="{{ $subject->name }}" wire:model="selectedSubjects"
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                {{ $subject->subject_name }}
                            </label>
                        @empty
                            <p>Select class categories to view available subjects</p>
                        @endforelse
                    </div>
                </div>

                <!-- Job Type -->
                <div class="space-y-2">
                    <p class="text-lg font-medium">Teacher Job Type*</p>
                    <p class="text-sm text-gray-500">Choose your preferred employment type(s)</p>
                    <div class="border rounded-lg p-3 space-y-2">
                        @foreach ($teacherJobTypes as $teacherJobType)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" value="{{ $teacherJobType->id }}" wire:model="selectedJobType"
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                {{ $teacherJobType->teacher_job_name }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3">
                <button @click="show=false"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md">Discard</button>
                <button wire:click="createOrUpdatePreference" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Save Changes</button>
            </div>
        </div>
    </div>


    <!-- Professional Experience -->
    <div x-data="{ show:false }" class="flex flex-col gap-4 border rounded-md p-5 shadow-sm">
        <div class="flex border-b pb-4 justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">Professional Experience</h2>
                <p class="text-gray-600 text-sm">Manage your teaching positions and institutional experience</p>
            </div>
            <div x-show="!show">
                <button @click="show = true"
                    class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 font-medium rounded px-3 py-2 text-white">
                    <i class="fa-solid fa-plus"></i> Add Experience
                </button>
            </div>
        </div>
        <div x-show="!show"
            class="flex flex-col justify-center items-center mt-4 border border-gray-300 bg-gray-50 rounded-xl p-8 border-dashed text-center">
            <i class="fa-solid fa-briefcase text-gray-400 text-3xl"></i>
            <p class="text-gray-500 font-medium mt-2">No Experience Added yet</p>
            <p class="text-gray-400 text-sm">Click 'Add Experience' to get started</p>
        </div>
        <div x-show="show" x-transition class="flex flex-col border rounded-lg mt-4 p-5 bg-gray-50">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-b pb-4">
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Institution*</label>
                    <input type="text" class="border rounded p-2" placeholder="University Name ">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Job Role*</label>
                    <select class="border rounded p-2">
                        <option value="">Select a job role</option>
                    </select>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Start Date</label>
                    <input type="date" class="border rounded p-2">
                </div>
                <div x-data="{ currentlyWorking:false }" class="flex flex-col gap-1">
                    <div class="flex justify-between items-center">
                        <label class="text-sm">End Date*</label>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="currentlyWorking" x-model="currentlyWorking">
                            <label for="currentlyWorking" class="text-sm">Currently working here</label>
                        </div>
                    </div>
                    <input type="date" :disabled="currentlyWorking" class="border rounded p-2">
                </div>
                <div class="flex flex-col gap-1 col-span-2">
                    <label class="text-sm">Achievements</label>
                    <textarea rows="3" class="border rounded p-2" placeholder="Enter Achievements"></textarea>
                </div>
                <div class="flex flex-col gap-1 col-span-2">
                    <label class="text-sm">Description</label>
                    <textarea rows="3" class="border rounded p-2" placeholder="Enter description"></textarea>
                </div>
            </div>
            <div class="flex flex-col gap-2 mt-4">
                <h3 class="text-lg font-medium">Add Subject With Marks</h3>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="text" placeholder="Subject Name" class="border flex-1 p-2 rounded">
                    <div class="flex gap-2">
                        <input type="text" placeholder="Marks" class="border p-2 rounded w-24">
                        <button
                            class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 px-3 py-2 rounded font-medium text-white">
                            <i class="fa-solid fa-plus"></i> Add
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex gap-2 mt-4">
                <button @click="show = false"
                    class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-medium px-3 py-2 rounded">
                    <i class="fa-solid fa-xmark"></i> Cancel
                </button>
                <button
                    class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 text-white font-medium px-3 py-2 rounded">
                    <i class="fa-solid fa-save"></i> Save Experience
                </button>
            </div>
        </div>
    </div>

    <!-- Education Background -->
    <div x-data="{show:false}" class="flex flex-col gap-4 border rounded-md p-5 shadow-sm">
        <div class="flex border-b pb-4 justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">Education Background</h2>
                <p class="text-gray-600 text-sm">Manage your academic qualifications and educational history</p>
            </div>
            <div x-show="!show">
                <button @click="show = true"
                    class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 font-medium rounded px-3 py-2 text-white">
                    <i class="fa-solid fa-plus"></i> Add Education
                </button>
            </div>
        </div>
        <div x-show="!show"
            class="flex flex-col justify-center items-center mt-4 border border-gray-300 bg-gray-50 rounded-xl p-8 border-dashed text-center">
            <i class="fa-solid fa-graduation-cap text-gray-400 text-3xl"></i>
            <p class="text-gray-500 font-medium mt-2">No Education Added yet</p>
            <p class="text-gray-400 text-sm">Click 'Add Education' to get started</p>
        </div>
        <div x-show="show" x-transition class="flex flex-col border rounded-lg mt-4 p-5 bg-gray-50">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-b pb-4">
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Institution Name*</label>
                    <input type="text" class="border rounded p-2" placeholder="University Name ">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Qualification*</label>
                    <select class="border rounded p-2">
                        <option value="">Select Qualification</option>
                    </select>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Session</label>
                    <input type="text" class="border rounded p-2" placeholder="YYYY-YY">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Year of Passing*</label>
                    <input type="text" class="border rounded p-2" placeholder="YYYY">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Board/University</label>
                    <input type="text" class="border rounded p-2" placeholder="Enter board or university name">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm">Grade/Percentage</label>
                    <input type="text" class="border rounded p-2" placeholder="Enter grade or percentage">
                </div>
            </div>
            <div class="flex flex-col gap-2 mt-4">
                <h3 class="text-lg font-medium">Add Subject With Marks</h3>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="text" placeholder="Subject Name" class="border flex-1 p-2 rounded">
                    <div class="flex gap-2">
                        <input type="text" placeholder="Marks" class="border p-2 rounded w-24">
                        <button
                            class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 px-3 py-2 rounded font-medium text-white">
                            <i class="fa-solid fa-plus"></i> Add
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex gap-2 mt-4">
                <button @click="show = false"
                    class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-medium px-3 py-2 rounded">
                    <i class="fa-solid fa-xmark"></i> Cancel
                </button>
                <button
                    class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 text-white font-medium px-3 py-2 rounded">
                    <i class="fa-solid fa-save"></i> Save Education
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
        <div x-show="show" x-transition class="flex flex-col sm:flex-row items-center gap-3 mt-3">
            <input type="search" placeholder="Search Skill..." class="border p-2 rounded w-full">
            <button
                class="flex items-center gap-2 bg-teal-500 hover:bg-teal-600 font-medium text-white px-3 py-2 rounded">
                <i class="fa-solid fa-plus"></i> Add
            </button>
        </div>
        <div
            class="flex flex-col justify-center items-center mt-4 border border-gray-300 bg-gray-50 rounded-xl p-8 border-dashed text-center">
            <i class="fa-solid fa-lightbulb text-gray-400 text-3xl"></i>
            <p class="text-gray-500 font-medium mt-2">No Skill Added yet</p>
        </div>
    </div>
</div>