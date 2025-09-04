<div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f5f9;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .card-hover {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="container mx-auto px-4 py-6 max-w-6xl">
        <!-- Back button -->
        <a href="#" class="inline-flex items-center p-2 mb-6 text-blue-600 hover:text-blue-800 font-semibold rounded-lg transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Back To List
        </a>

        <!-- Profile Card -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-6 card-hover">
            <div class="flex flex-col md:flex-row">
                <!-- Profile Image -->
                <div class="md:w-1/3 flex justify-center p-6 md:p-8">
                    <div class="relative">
                        <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg"
                            class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover border-4 border-blue-100 shadow-md" alt="Vikash Kumar">
                        <div class="absolute bottom-4 right-4 bg-green-500 w-6 h-6 rounded-full border-2 border-white"></div>
                    </div>
                </div>
                
                <!-- Profile Info -->
                <div class="md:w-2/3 p-6 md:p-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Vikash Kumar</h2>
                    <p class="text-gray-600 mb-6">Mathematics Teacher | 5+ Years Experience</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-500 mr-3"></i>
                            <span>vikash@gmail.com</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-500 mr-3"></i>
                            <span>+91 7676767677</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-3"></i>
                            <span>New Delhi, India</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-3"></i>
                            <span>4.8 Rating (126 reviews)</span>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">About Me</h3>
                        <p class="text-gray-600">Passionate mathematics teacher with expertise in algebra and calculus. Dedicated to creating engaging learning experiences for students of all levels.</p>
                    </div>
                    
                    <div class="flex space-x-3">
                        <div class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">Algebra</div>
                        <div class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">Calculus</div>
                        <div class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">Geometry</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="flex overflow-x-auto">
                <button class="tab-btn py-4 px-6 text-center border-b-2 border-transparent flex items-center justify-center font-medium whitespace-nowrap" data-tab="qualification">
                    <i class="fas fa-graduation-cap mr-2 text-gray-500"></i>
                    Qualification
                </button>
                <button class="tab-btn py-4 px-6 text-center border-b-2 border-blue-600 flex items-center justify-center font-medium text-blue-600 whitespace-nowrap" data-tab="experience">
                    <i class="fas fa-briefcase mr-2 text-blue-600"></i>
                    Experience
                </button>
                <button class="tab-btn py-4 px-6 text-center border-b-2 border-transparent flex items-center justify-center font-medium whitespace-nowrap" data-tab="skills">
                    <i class="fas fa-tools mr-2 text-gray-500"></i>
                    Skills
                </button>
                <button class="tab-btn py-4 px-6 text-center border-b-2 border-transparent flex items-center justify-center font-medium whitespace-nowrap" data-tab="preferences">
                    <i class="fas fa-chalkboard-teacher mr-2 text-gray-500"></i>
                    Teaching Preferences
                </button>
            </div>
        </div>

        <!-- Tab Contents -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <!-- Qualification Tab -->
            <div id="qualification" class="tab-content">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Educational Qualifications</h3>
                <div class="space-y-6">
                    <div class="flex">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">M.Sc. in Mathematics</h4>
                            <p class="text-blue-600">Delhi University</p>
                            <p class="text-gray-500">2014 - 2016</p>
                            <p class="text-gray-600 mt-1">Specialized in Advanced Calculus and Linear Algebra</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">B.Sc. in Mathematics</h4>
                            <p class="text-blue-600">University of Delhi</p>
                            <p class="text-gray-500">2011 - 2014</p>
                            <p class="text-gray-600 mt-1">Graduated with First Class Honors</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-award"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Teaching Certification</h4>
                            <p class="text-blue-600">Central Teaching Council</p>
                            <p class="text-gray-500">2016</p>
                            <p class="text-gray-600 mt-1">Certified Mathematics Teacher (Grade 6-12)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Experience Tab -->
            <div id="experience" class="tab-content active">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Teaching Experience</h3>
                <div class="space-y-6">
                    <div class="flex">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Senior Mathematics Teacher</h4>
                            <p class="text-blue-600">Delhi Public School</p>
                            <p class="text-gray-500">2019 - Present</p>
                            <p class="text-gray-600 mt-1">Teaching advanced mathematics to grades 11-12, developing curriculum, and mentoring junior teachers.</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Mathematics Teacher</h4>
                            <p class="text-blue-600">Modern School</p>
                            <p class="text-gray-500">2016 - 2019</p>
                            <p class="text-gray-600 mt-1">Taught mathematics to grades 9-10, organized math clubs and competitions.</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-chalkboard"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Student Tutor</h4>
                            <p class="text-blue-600">Freelance</p>
                            <p class="text-gray-500">2014 - 2016</p>
                            <p class="text-gray-600 mt-1">Provided one-on-one tutoring to high school students in mathematics and science.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills Tab -->
            <div id="skills" class="tab-content">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Skills & Expertise</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-medium text-gray-700 mb-3">Subject Expertise</h4>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Algebra</span>
                                    <span class="text-sm font-medium">95%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 95%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Calculus</span>
                                    <span class="text-sm font-medium">90%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 90%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Geometry</span>
                                    <span class="text-sm font-medium">88%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 88%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-700 mb-3">Teaching Skills</h4>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Classroom Management</span>
                                    <span class="text-sm font-medium">92%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 92%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Lesson Planning</span>
                                    <span class="text-sm font-medium">89%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 89%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Student Engagement</span>
                                    <span class="text-sm font-medium">94%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 94%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preferences Tab -->
            <div id="preferences" class="tab-content">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Teaching Preferences</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-medium text-gray-700 mb-3">Class Preferences</h4>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-chalkboard text-blue-500 mr-3 w-5"></i>
                                <span>Grades 9-12 Mathematics</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-blue-500 mr-3 w-5"></i>
                                <span>Flexible scheduling available</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users text-blue-500 mr-3 w-5"></i>
                                <span>Group and individual sessions</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-700 mb-3">Teaching Style</h4>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-lightbulb text-yellow-500 mr-3 w-5"></i>
                                <span>Interactive and practical approach</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-laptop text-blue-500 mr-3 w-5"></i>
                                <span>Uses technology in teaching</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-puzzle-piece text-green-500 mr-3 w-5"></i>
                                <span>Problem-solving focused</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center">
                <i class="fas fa-calendar-check mr-2"></i> Schedule a Class
            </button>
            <button class="bg-white hover:bg-gray-100 text-blue-600 border border-blue-600 font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center">
                <i class="fas fa-envelope mr-2"></i> Send Message
            </button>
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