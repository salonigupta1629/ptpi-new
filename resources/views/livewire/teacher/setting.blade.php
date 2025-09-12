<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings - Teacher Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#6b7280',
                        success: '#10b981',
                        warning: '#f59e0b',
                        danger: '#ef4444',
                        light: '#f9fafb',
                        dark: '#1f2937'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f8fa;
        }
        
        .profile-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .profile-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .info-item {
            transition: background-color 0.2s ease;
        }
        
        .info-item:hover {
            background-color: #f9fafb;
        }
        
        .nav-item {
            transition: all 0.2s ease;
        }
        
        .nav-item.active {
            background-color: #f1f5f9;
            border-left: 4px solid #4F46E5;
        }
        
        .nav-item:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex">

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Personal Information</h1>
                    <p class="text-gray-600">Update your personal details and how others see you on the platform</p>
                </div>

                <!-- Profile Summary -->
                <div class="bg-white rounded-xl shadow-sm profile-card mb-8 p-6">
                    <div class="flex items-center">
                        <div class="h-16 w-16 rounded-full bg-primary flex items-center justify-center overflow-hidden mr-4">
                            <span class="text-white text-2xl font-bold">VK</span>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Vikash Kumar</h2>
                            <p class="text-gray-600">vikasharyan323@gmail.com</p>
                        </div>
                    </div>
                </div>

                <!-- Personal Information Form -->
                <div class="bg-white rounded-xl shadow-sm profile-card overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Basic Information</h2>
                        <p class="text-sm text-gray-600 mt-1">This information will be displayed publicly</p>
                    </div>
                    
                    <div class="p-6">
                        <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- First Name -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" value="Vikash" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            </div>
                            
                            <!-- Last Name -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" value="Kumar" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            </div>
                            
                            <!-- Phone Number -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="tel" placeholder="Enter your phone number" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            </div>
                            
                            <!-- Date of Birth -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                <input type="text" placeholder="dd/mm/yyyy" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            </div>
                            
                            <!-- Bio -->
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Bio</label>
                                <textarea rows="4" placeholder="Tell us about yourself..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"></textarea>
                                <p class="text-xs text-gray-500">Brief description for your profile.</p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="bg-white rounded-xl shadow-sm profile-card overflow-hidden mt-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Additional Information</h2>
                        <p class="text-sm text-gray-600 mt-1">For internal use only</p>
                    </div>
                    
                    <div class="p-6">
                        <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Gender -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Gender</label>
                                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                    <option value="prefer-not-to-say">Prefer not to say</option>
                                </select>
                            </div>
                            
                            <!-- Marital Status -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Marital Status</label>
                                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                    <option value="">Select Marital Status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                    <option value="prefer-not-to-say">Prefer not to say</option>
                                </select>
                            </div>
                            
                            <!-- Language -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Language</label>
                                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                    <option value="">Preferred language</option>
                                    <option value="english">English</option>
                                    <option value="hindi">Hindi</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="french">French</option>
                                    <option value="german">German</option>
                                </select>
                            </div>
                            
                            <!-- Religion -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Religion</label>
                                {{-- <input type="text" placeholder="Your religion" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"> --}}
                                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                 <option value="">Select Religion</option>
<option value="">Hindu</option>
<option value="">Muslim</option>
<option value="">Sikh</option>
<option value="">Christian</option>
<option value="">Others</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 mt-6">
                    <button class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navigation functionality
            const navItems = document.querySelectorAll('.nav-item');
            
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all items
                    navItems.forEach(navItem => {
                        navItem.classList.remove('active');
                        navItem.classList.remove('text-primary');
                    });
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                    this.classList.add('text-primary');
                });
            });
            
            // Form validation could be added here
        });
    </script>
</body>
</html>