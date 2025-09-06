<div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .status-indicator {
            box-shadow: 0 0 0 2px #f8fafc;
        }
    </style>
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Back button -->
        <a href="#"
            class="inline-flex items-center p-2 mb-4 text-blue-600 hover:text-blue-800 font-medium rounded-md transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Back To List
        </a>

        <!-- Profile Card -->
        <div class="bg-white rounded-xl overflow-hidden mb-6 border border-gray-100">
            <div class="flex flex-col md:flex-row">
                <!-- Profile Image -->
                <div class="md:w-1/3 flex justify-center p-6 md:p-8">
                    <div class="relative">
                        <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg"
                            class="w-48 h-48 md:w-56 md:h-56 rounded-full object-cover border-4 border-blue-50"
                            alt="Vikash Kumar">
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="md:w-2/3 p-6 md:p-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-1">Vikash Kumar</h2>
                    <p class="text-gray-600 mb-5">Mathematics Teacher | 5+ Years Experience</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-500 mr-3 w-4 text-center"></i>
                            <span class="text-sm">vikash@gmail.com</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-500 mr-3 w-4 text-center"></i>
                            <span class="text-sm">+91 7676767677</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-3 w-4 text-center"></i>
                            <span class="text-sm">New Delhi, India</span>
                        </div>
                        
                    </div>



                    <div class="flex flex-wrap gap-2">
                        <div class="bg-blue-50 text-blue-600 px-3 py-1 rounded-md text-xs font-medium">Algebra</div>
                        <div class="bg-blue-50 text-blue-600 px-3 py-1 rounded-md text-xs font-medium">Calculus</div>
                        <div class="bg-blue-50 text-blue-600 px-3 py-1 rounded-md text-xs font-medium">Geometry</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="bg-white rounded-lg mb-6 overflow-hidden border border-gray-100">
            <div class="flex overflow-x-auto">
                <button
                    class="tab-btn py-3 px-5 text-center border-b-2 border-transparent flex items-center justify-center font-medium whitespace-nowrap text-sm"
                    data-tab="qualification">
                    <i class="fas fa-graduation-cap mr-2 text-gray-500"></i>
                    Qualification
                </button>
                <button
                    class="tab-btn py-3 px-5 text-center border-b-2 border-blue-600 flex items-center justify-center font-medium text-blue-600 whitespace-nowrap text-sm"
                    data-tab="experience">
                    <i class="fas fa-briefcase mr-2 text-blue-600"></i>
                    Experience
                </button>
                <button
                    class="tab-btn py-3 px-5 text-center border-b-2 border-transparent flex items-center justify-center font-medium whitespace-nowrap text-sm"
                    data-tab="skills">
                    <i class="fas fa-tools mr-2 text-gray-500"></i>
                    Skills
                </button>
                <button
                    class="tab-btn py-3 px-5 text-center border-b-2 border-transparent flex items-center justify-center font-medium whitespace-nowrap text-sm"
                    data-tab="preferences">
                    <i class="fas fa-chalkboard-teacher mr-2 text-gray-500"></i>
                    Preferences
                </button>
            </div>
        </div>

        <!-- Tab Contents -->
        <div class="bg-white rounded-lg p-6 mb-6 border border-gray-100">
            <!-- Qualification Tab -->
            <div id="qualification" class="tab-content">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Educational Qualifications</h3>
                <div class="space-y-5">
                    <div class="flex">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-graduation-cap text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">M.Sc. in Mathematics</h4>
                            <p class="text-blue-600 text-sm">Delhi University</p>
                            <p class="text-gray-500 text-sm">2014 - 2016</p>
                            <p class="text-gray-600 mt-1 text-sm">Specialized in Advanced Calculus and Linear Algebra
                            </p>
                        </div>
                    </div>
                    <div class="flex">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-graduation-cap text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">B.Sc. in Mathematics</h4>
                            <p class="text-blue-600 text-sm">University of Delhi</p>
                            <p class="text-gray-500 text-sm">2011 - 2014</p>
                            <p class="text-gray-600 mt-1 text-sm">Graduated with First Class Honors</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-award text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Teaching Certification</h4>
                            <p class="text-blue-600 text-sm">Central Teaching Council</p>
                            <p class="text-gray-500 text-sm">2016</p>
                            <p class="text-gray-600 mt-1 text-sm">Certified Mathematics Teacher (Grade 6-12)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Experience Tab -->
            <div id="experience" class="tab-content active">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Teaching Experience</h3>
                <div class="space-y-5">
                    <div class="flex">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-briefcase text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Senior Mathematics Teacher</h4>
                            <p class="text-blue-600 text-sm">Delhi Public School</p>
                            <p class="text-gray-500 text-sm">2019 - Present</p>
                            <p class="text-gray-600 mt-1 text-sm">Teaching advanced mathematics to grades 11-12,
                                developing curriculum, and mentoring junior teachers.</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-briefcase text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Mathematics Teacher</h4>
                            <p class="text-blue-600 text-sm">Modern School</p>
                            <p class="text-gray-500 text-sm">2016 - 2019</p>
                            <p class="text-gray-600 mt-1 text-sm">Taught mathematics to grades 9-10, organized math
                                clubs and competitions.</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Skills Tab -->
            <div id="skills" class="tab-content">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Skills & Expertise</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-medium text-gray-700 mb-3 text-sm">Subject Expertise</h4>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm">Algebra</span>
                                    <span class="text-sm">95%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-1.5">
                                    <div class="bg-blue-600 h-1.5 rounded-full" style="width: 95%"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-700 mb-3 text-sm">Teaching Skills</h4>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm">Classroom Management</span>
                                    <span class="text-sm">92%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-1.5">
                                    <div class="bg-green-500 h-1.5 rounded-full" style="width: 92%"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
             <!-- Preferences Tab -->
    <div id="preferences" class="tab-content">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="font-medium text-gray-700 mb-3 text-sm">Class Preferences</h4>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-chalkboard text-blue-500 mr-3 w-4 text-center"></i>
                        <span class="text-sm">Grades 9-12 Mathematics</span>
                    </div>

                </div>
            </div>
            <div>
                <h4 class="font-medium text-gray-700 mb-3 text-sm">Teaching Style</h4>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-lightbulb text-yellow-400 mr-3 w-4 text-center"></i>
                        <span class="text-sm">Interactive and practical approach</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
        </div>
    </div>


</div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-btn');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');

                // Remove active class from all tabs and contents
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('border-blue-600', 'text-blue-600');
                    btn.classList.add('border-transparent');

                    const icon = btn.querySelector('i');
                    if (icon) {
                        icon.classList.remove('text-blue-600');
                        icon.classList.add('text-gray-500');
                    }
                });

                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });

                // Add active class to current tab and content
                this.classList.remove('border-transparent');
                this.classList.add('border-blue-600', 'text-blue-600');

                const icon = this.querySelector('i');
                if (icon) {
                    icon.classList.remove('text-gray-500');
                    icon.classList.add('text-blue-600');
                }

                document.getElementById(tabId).classList.add('active');
            });
        });
    });
</script>

</div>
