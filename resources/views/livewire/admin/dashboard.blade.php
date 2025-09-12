<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .admin-dashboard {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #f9fafb;
            padding: 1.5rem;
            max-width: 100%;
        }

        .metric-card {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .fade-in {
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="admin-dashboard" x-data="dashboard()">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-gray-600">Welcome back! Here's what's happening today.</p>
        </div>

        <!-- Key Metrics -->
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Quick Overview</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 metric-card card-hover fade-in" :style="fadeIn(0)">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Pending Teachers</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">1</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-green-600 font-medium mt-3">
                    <span>↓ 2 from yesterday</span>
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 metric-card card-hover fade-in" :style="fadeIn(1)">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Pending Recruiters</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">3</h3>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 极 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-red-600 font-medium mt-3">
                    <span>↑ 1 from yesterday</span>
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 metric-card card-hover fade-in" :style="fadeIn(2)">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Upcoming Interviews</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">0</h3>
                    </div>
                    <div class="bg-amber-100 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-600 font-medium mt-3">
                    <span>No change</span>
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 metric-card card-hover fade-in" :style="fadeIn(3)">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Passkeys</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">0</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 极.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-600 font-medium mt-3">
                    <span>No change</span>
                </p>
            </div>
        </div>

        <!-- Analytics Overview -->
        <h2 class="text-lg font-semib极 text-gray-700 mb-4">Analytics Overview</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-xl shadow-md metric-card card-hover fade-in" :style="fadeIn(4)">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium opacity-80">Teachers</p>
                        <h3 class="text-2xl font-bold mt-1">8</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs opacity-80 font-medium mt-3">
                    <span>↑ 12% from last month</span>
                </p>
            </div>

            <div class="bg-gradient-to-r from-purple-400 to-purple-600 text-white p-6 rounded-xl shadow-md metric-card card-hover fade-in" :style="fadeIn(5)">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text极m font-medium opacity-80">Recruiters</p>
                        <h3 class="text-2xl font-bold mt-1">4</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1极2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs opacity-80 font-medium mt-3">
                    <span>↑ 5% from last month</span>
                </p>
            </div>

            <div class="bg-gradient-to-r from-red-500 to-red-700 text-white p-6 rounded-xl shadow-md metric-card card-hover fade-in" :style="fadeIn(6)">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium opacity-80">Interviews</p>
                        <h3 class="text-2xl font-bold mt-1">0</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4极3m-9 8h10M5 极1h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs opacity-80 font-medium mt-3">
                    <span>No scheduled interviews</span>
                </p>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-700 text-white p-6 rounded-xl shadow-md metric-card card-hover fade-in" :style="fadeIn(7)">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium opacity-80">Passkeys</p>
                        <h3 class="text-2xl font-bold mt-1">0</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs opacity-80 font-medium mt-3">
                    <span>No active passkeys</span>
                </p>
            </div>

            <div class="bg-gradient-to-r from-indigo-500 to-indigo-700 text-white p-6 rounded-xl shadow-md metric-card card-hover fade-in" :style="fadeIn(8)">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium opacity-80">Exam Centers</p>
                        <h3 class="text-2xl font-bold mt-1">1</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs opacity-80 font-medium mt-3">
                    <span>No change</span>
                </p>
            </div>

            <div class="bg-gradient-to-r from-gray-500 to-gray-700 text-white p-6 rounded-xl shadow-md metric-card card-hover fade-in" :style="fadeIn(9)">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium opacity-80">Question Reports</p>
                        <h3 class="text-2xl font-bold mt-1">0</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs opacity-80 font-medium mt-3">
                    <span>No reports</span>
                </p>
            </div>
        </div>

        <!-- Additional Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Activity -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 fade-in" :style="fadeIn(10)">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/s极" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium">New teacher registration</p>
                            <p class="text-xs text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-purple-100 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Recruiter account upgraded</p>
                            <p class="text-xs text-gray-500">5 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-amber-100 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Interview scheduled for tomorrow</p>
                            <p class="text-xs text-gray-500">Yesterday</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 fade-in" :style="fadeIn(11)">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 gap-3">
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                        <div class="bg-blue-100 p-3 rounded-full mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-blue-700">Add Teacher</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                        <div class="bg-purple-100 p-3 rounded-full mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-purple-700">Add Recruiter</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                        <div class="bg-green-100 p-3 rounded-full mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-green-700">Schedule Interview</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="bg-gray-100 p-3 rounded-full mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v极m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Generate Report</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function dashboard() {
            return {
                init() {
                    // Initialization if needed
                },
                fadeIn(index) {
                    // Calculate delay based on index
                    const delay = index * 100;
                    return {
                        'opacity': '1',
                        'transform': 'translateY(0)',
                        'transition-delay': `${delay}ms`
                    };
                }
            }
        }
    </script>
</body>
</html>