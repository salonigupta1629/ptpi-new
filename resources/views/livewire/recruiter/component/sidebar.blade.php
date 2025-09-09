<div>
    <!-- Sidebar Filters -->
    <aside class="sidebar-container w-full lg:w-64 flex-shrink-0">
        <div id="sidebar"
            class="mobile-menu fixed top-0 left-0 h-[100vh] w-68 bg-white p-4 border-r custom-scroll lg:relative lg:translate-x-0 lg:top-auto lg:left-auto lg:h-[87vh] lg:shadow-none">
            <div class="flex justify-between items-center mb-4 lg:mb-6">
                <h2 class="text-xl font-semibold flex items-center">
                    <i class="fas fa-filter mr-2 text-teal-600"></i>Filters
                </h2>
                <button id="closeSidebar" class="lg:hidden p-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="space-y-5">
                <!-- Filter: Location -->
                <div class="filter-box p-4 border rounded-lg">
                    <h3 class="font-medium cursor-pointer flex justify-between items-center toggle-header">
                        <span class="flex items-center text-gray-800">
                            <i class="fas fa-map-marker-alt mr-2 text-teal-600"></i> Location
                        </span>
                        <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                    </h3>
                    <div class="mt-3 space-y-4 hidden toggle-content">
                        <div class="location-inputs grid grid-cols-1 md:grid-cols-1 gap-3">
                            <!-- Pincode -->
                            <div class="flex flex-col">
                                <label class="text-sm font-medium mb-1">Pincode</label>
                                <div class="flex gap-2">
                                    <input type="text" wire:model="pincode" class="py-2 px-3 border rounded w-full text-sm"
                                        placeholder="Enter pincode">
                                    <button type="button" wire:click="applyFilters"
                                        class="bg-teal-600 text-white text-sm px-3 py-2 rounded"><i class="fa-solid fa-check"></i></button>
                                </div>
                            </div>
                            <!-- District -->
                            <div class="flex flex-col">
                                <label class="text-sm font-medium mb-1">District</label>
                                <div class="flex gap-2">
                                    <input type="text" wire:model="district" class="py-2 px-3 border rounded w-full text-sm"
                                        placeholder="Enter district">
                                    <button type="button" wire:click="applyFilters"
                                        class="bg-teal-600 text-white text-sm px-3 py-2 rounded"><i class="fa-solid fa-check"></i></button>
                                </div>
                            </div>

                            <!-- Block -->
                            <div class="flex flex-col">
                                <label class="text-sm font-medium mb-1">Block</label>
                                <div class="flex gap-2">
                                    <input type="text" wire:model="block" class="py-2 px-3 border rounded w-full text-sm"
                                        placeholder="Enter block">
                                    <button type="button" wire:click="applyFilters"
                                        class="bg-teal-600 text-white text-sm px-3 py-2 rounded"><i class="fa-solid fa-check"></i></button>
                                </div>
                            </div>

                            <!-- Village -->
                            <div class="flex flex-col">
                                <label class="text-sm font-medium mb-1">Village</label>
                                <div class="flex gap-2">
                                    <input type="text" wire:model="village" class="py-2 px-3 border rounded w-full text-sm"
                                        placeholder="Enter village">
                                    <button type="button" wire:click="applyFilters"
                                        class="bg-teal-600 text-white text-sm px-3 py-2 rounded"><i class="fa-solid fa-check"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-box p-3 rounded-lg border">
                    <h3 class="font-medium cursor-pointer flex justify-between items-center toggle-header">
                        <span><i class="fas fa-graduation-cap mr-2 text-teal-600"></i>Education</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </h3>
                    <div class="mt-2 pl-6 hidden toggle-content">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="bachelor" wire:model="education" wire:click="applyFilters" value="Bachelor" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="bachelor" class="text-sm">Bachelor's Degree</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="master" wire:model="education" wire:click="applyFilters" value="Master" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="master" class="text-sm">Master's Degree</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="phd" wire:model="education" wire:click="applyFilters" value="PhD" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="phd" class="text-sm">PhD</label>
                        </div>
                    </div>
                </div>

                <div class="filter-box p-3 rounded-lg border">
                    <h3 class="font-medium cursor-pointer flex justify-between items-center toggle-header">
                        <span><i class="fas fa-layer-group mr-2 text-teal-600"></i>Class Category</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </h3>
                    <div class="mt-2 pl-6 hidden toggle-content">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="primary" wire:model="classCategory" wire:click="applyFilters" value="0-2" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="primary" class="text-sm">0 - 2</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="middle" wire:model="classCategory" wire:click="applyFilters" value="0-4" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="middle" class="text-sm">0 - 4</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="high" wire:model="classCategory" wire:click="applyFilters" value="0-6" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="high" class="text-sm">0 - 6</label>
                        </div>
                    </div>
                </div>

                <div class="filter-box p-3 rounded-lg border">
                    <h3 class="font-medium cursor-pointer flex justify-between items-center toggle-header">
                        <span><i class="fas fa-book mr-2 text-teal-600"></i>Subjects</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </h3>
                    <div class="mt-2 pl-6 hidden toggle-content">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="math" wire:model="subjects" value="Mathematics" wire:click="applyFilters" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="math" class="text-sm">Mathematics</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="science" wire:model="subjects" value="Science" wire:click="applyFilters" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="science" class="text-sm">Science</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="english" wire:model="subjects" value="English" wire:click="applyFilters" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="english" class="text-sm">English</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="history" wire:model="subjects" value="History" wire:click="applyFilters" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="history" class="text-sm">History</label>
                        </div>
                    </div>
                </div>

                <div class="filter-box p-3 rounded-lg border">
                    <h3 class="font-medium cursor-pointer flex justify-between items-center toggle-header">
                        <span><i class="fas fa-tools mr-2 text-teal-600"></i>Skills</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </h3>
                    <div class="mt-2 pl-6 hidden toggle-content">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="cplus" wire:model="skills" value="C++" wire:click="applyFilters" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="cplus" class="text-sm">C++</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="java" wire:model="skills" value="Java" wire:click="applyFilters" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="java" class="text-sm">Java</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="python" wire:model="skills" value="Python" wire:click="applyFilters" class="mr-2 rounded border border-gray-400 text-teal-600">
                            <label for="python" class="text-sm">Python</label>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2">
                   
                    <button wire:click="clearFilters" class="text-sm text-teal-600 mt-2 font-medium border border-gray-400 flex items-center px-4 py-2 rounded">
                        <i class="fas fa-times-circle mr-1"></i>Clear Filters
                    </button>
                </div>
            </div>
        </div>
    </aside>
</div>
