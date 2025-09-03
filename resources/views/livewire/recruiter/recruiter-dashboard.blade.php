<div>
    <div class="flex justify-between bg-white p-2 shadow rounded-md border items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Available Teachers</h2>
        <div class="flex space-x-2">
            <button class="bg-white border border-gray-300 px-4 py-2 rounded-lg text-sm flex items-center">
                <i class="fas fa-sort-amount-down mr-2"></i>Sort By
            </button>
            <button class="bg-white border border-gray-300 px-4 py-2 rounded-lg text-sm flex items-center">
                <i class="fas fa-th mr-2"></i>View Options
            </button>
        </div>
    </div>

    <!-- Teacher Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Teacher Card 1 -->

        <!-- Teacher Card 3 -->
        <div class="teacher-card bg-white rounded-md border overflow-hidden transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            class="w-14 h-14 rounded-full bg-purple-100 text-purple-800 flex items-center justify-center font-bold text-xl">
                            AS
                        </div>
                        <div class="ml-4">
                            <h3 class="font-bold text-lg">Amit Singh</h3>
                            <p class="text-gray-500 text-sm">English Teacher</p>
                        </div>
                    </div>
                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Available</span>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-map-marker-alt mr-2"></i>Bangalore, India
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-600">
                    <i class="fas fa-graduation-cap mr-2"></i>M.A English, TEFL Certified
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="bg-gray-100 px-3 py-1 rounded-full text-xs">Grammar</span>
                    <span class="bg-gray-100 px-3 py-1 rounded-full text-xs">Literature</span>
                    <span class="bg-gray-100 px-3 py-1 rounded-full text-xs">Writing</span>
                </div>
                <div class="mt-6 flex justify-between items-center">
                    <div class="text-teal-600 font-bold">22/hr</div>
                    <a href="{{  route('recruiter.teacher.profile')}}"
                        class="bg-teal-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-teal-600 transition-colors">
                        View Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
