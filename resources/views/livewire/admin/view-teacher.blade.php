<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profile - Sadique Hassain</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: #f9fafb;
            color: #1f2937;
            padding: 16px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
        }
        
        .text-sm {
            font-size: 0.875rem;
        }
        
        .text-xs {
            font-size: 0.75rem;
        }
        
        .text-gray-600 {
            color: #4b5563;
        }
        
        .text-gray-400 {
            color: #9ca3af;
        }
        
        .text-blue-600 {
            color: #2563eb;
        }
        
        .text-green-700 {
            color: #15803d;
        }
        
        .bg-green-100 {
            background-color: #dcfce7;
        }
        
        .bg-blue-600 {
            background-color: #2563eb;
        }
        
        .bg-red-600 {
            background-color: #dc2626;
        }
        
        .hover\:bg-blue-700:hover {
            background-color: #1d4ed8;
        }
        
        .hover\:bg-red-700:hover {
            background-color: #b91c1c;
        }
        
        .hover\:text-blue-600:hover {
            color: #2563eb;
        }
        
        .font-medium {
            font-weight: 500;
        }
        
        .font-semibold {
            font-weight: 600;
        }
        
        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        .px-2 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .py-1 {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }
        
        .p-6 {
            padding: 1.5rem;
        }
        
        .mb-4 {
            margin-bottom: 1rem;
        }
        
        .mt-1 {
            margin-top: 0.25rem;
        }
        
        .mt-3 {
            margin-top: 0.75rem;
        }
        
        .mr-2 {
            margin-right: 0.5rem;
        }
        
        .mr-6 {
            margin-right: 1.5rem;
        }
        
        .ml-2 {
            margin-left: 0.5rem;
        }
        
        .rounded-md {
            border-radius: 0.375rem;
        }
        
        .rounded-full {
            border-radius: 9999px;
        }
        
        .flex {
            display: flex;
        }
        
        .inline-flex {
            display: inline-flex;
        }
        
        .items-center {
            align-items: center;
        }
        
        .justify-between {
            justify-content: space-between;
        }
        
        .justify-center {
            justify-content: center;
        }
        
        .grid {
            display: grid;
        }
        
        .grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        
        .gap-y-3 {
            row-gap: 0.75rem;
        }
        
        .border-t {
            border-top-width: 1px;
        }
        
        .border-b {
            border-bottom-width: 1px;
        }
        
        .border-b-2 {
            border-bottom-width: 2px;
        }
        
        .border-blue-600 {
            border-color: #2563eb;
        }
        
        .space-x-2 > :not([hidden]) ~ :not([hidden]) {
            --tw-space-x-reverse: 0;
            margin-right: calc(0.5rem * var(--tw-space-x-reverse));
            margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
        }
        
        .space-x-6 > :not([hidden]) ~ :not([hidden]) {
            --tw-space-x-reverse: 0;
            margin-right: calc(1.5rem * var(--tw-space-x-reverse));
            margin-left: calc(1.5rem * calc(1 - var(--tw-space-x-reverse)));
        }
        
        .w-24 {
            width: 6rem;
        }
        
        .h-24 {
            height: 6rem;
        }
        
        .bg-gray-200 {
            background-color: #e5e7eb;
        }
        
        .text-3xl {
            font-size: 1.875rem;
        }
        
        .text-gray-400 {
            color: #9ca3af;
        }
        
        .text-white {
            color: white;
        }
        
        .border {
            border-width: 1px;
            border-color: #e5e7eb;
        }
        
        .border-gray-200 {
            border-color: #e5e7eb;
        }
        
        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 1px solid #e5e7eb;
            margin-top: 24px;
        }
        
        .tab {
            padding: 12px 16px;
            font-size: 0.875rem;
            color: #4b5563;
            border-bottom: 2px solid transparent;
            cursor: pointer;
        }
        
        .tab:hover {
            color: #2563eb;
        }
        
        .tab.active {
            color: #2563eb;
            border-bottom-color: #2563eb;
            font-weight: 500;
        }
        
        /* Tab content */
        .tab-content {
            display: none;
            padding: 24px;
            background: white;
            border-radius: 0 0 8px 8px;
            border: 1px solid #e5e7eb;
            border-top: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Skills grid */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }
        
        .skill-item {
            padding: 16px;
            background: #f9fafb;
            border-radius: 6px;
            border-left: 3px solid #2563eb;
        }
        
        .skill-name {
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .skill-level {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        
        th {
            font-weight: 500;
            color: #6b7280;
            background: #f9fafb;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .grid-cols-2 {
                grid-template-columns: 1fr;
            }
            
            .flex.justify-between {
                flex-direction: column;
                gap: 16px;
            }
            
            .skills-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Back + Actions -->
        <div class="flex justify-between items-center mb-4">
            <div>
                <a href="#"
                   class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Teacher List
                </a>
                <p class="text-xs text-gray-400 mt-1">
                    Dashboard > Manage Teachers > Sadique Hassain
                </p>
            </div>
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                    Download Profile
                </button>
                <button class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                    Deactivate Account
                </button>
            </div>
        </div>

        <!-- Teacher Information Card -->
        <div class="card">
            <div class="p-6 flex">
                <!-- Profile Placeholder -->
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mr-6">
                    <i class="fas fa-user text-3xl text-gray-400"></i>
                </div>
                <div>
                    <h2 class="text-lg font-semibold flex items-center">
                        Sadique Hassain
                        <span class="ml-2 text-green-700 text-xs font-medium bg-green-100 px-2 py-1 rounded-full">
                            ACTIVE
                        </span>
                    </h2>
                    <p class="text-sm text-gray-600">testimystep.com/3gmail.com</p>

                    <!-- Bio -->
                    <div class="mt-3">
                        <h3 class="text-sm font-medium text-gray-700">Professional Bio</h3>
                        <p class="text-sm text-gray-500 italic">
                            No professional summary available for this teacher.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Teacher Info Grid -->
            <div class="border-t p-6 grid grid-cols-2 md:grid-cols-3 gap-y-3 text-sm">
                <div><span class="font-medium">Phone:</span> Not provided</div>
                <div><span class="font-medium">Date of Birth:</span> 2022-03-01</div>
                <div><span class="font-medium">Gender:</span> Not specified</div>
                <div><span class="font-medium">Marital Status:</span> Not specified</div>
                <div><span class="font-medium">Religion:</span> Not specified</div>
                <div><span class="font-medium">Contact:</span> Not specified</div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
    <div class="tab active" onclick="openTab(event, 'skills')">Skills</div>
    <div class="tab" onclick="openTab(event, 'qualifications')">Qualifications</div>
    <div class="tab" onclick="openTab(event, 'experience')">Experience</div>
    <div class="tab" onclick="openTab(event, 'tests')">Test Scores</div>
</div>

<!-- Skills Tab -->
<div id="skills" class="tab-content active">
    <div class="skills-grid">
        @forelse($teacher->skills as $skill)
            <div class="skill-item">
                <div class="skill-name">{{ $skill->skill->name }}</div>
                <div class="skill-level">Level: {{ $skill->proficiency_level ?? 'N/A' }}</div>
                <div class="text-sm text-gray-600">Experience: {{ $skill->years_of_experience }} years</div>
            </div>
        @empty
            <p class="text-sm text-gray-500">No skills available.</p>
        @endforelse
    </div>
</div>

<!-- Qualifications Tab -->
<div id="qualifications" class="tab-content">
    <table>
        <thead>
            <tr>
                <th>Qualification</th>
                <th>Institution</th>
                <th>Year</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teacher->qualifications as $q)
                <tr>
                    <td>{{ $q->qualification->name }}</td>
                    <td>{{ $q->institution }}</td>
                    <td>{{ $q->year_of_passing }}</td>
                    <td>{{ $q->grade_or_percentage }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No qualifications found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Experience Tab -->
<div id="experience" class="tab-content">
    <table>
        <thead>
            <tr>
                <th>Role</th>
                <th>Institution</th>
                <th>Period</th>
                <th>Achievements</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teacher->experiences as $exp)
                <tr>
                    <td>{{ $exp->role->name ?? 'N/A' }}</td>
                    <td>{{ $exp->institution }}</td>
                    <td>{{ $exp->start_date }} - {{ $exp->end_date ?? 'Present' }}</td>
                    <td>{{ $exp->achievements }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No experiences found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Test Scores Tab -->
<div id="tests" class="tab-content">
    <p class="text-sm text-gray-500">Coming soon (depends on your test/exam tables).</p>
</div>
    </div>

    <script>
        // Tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const target = tab.dataset.tab;
                    
                    // Remove active class from all tabs and contents
                    tabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked tab and corresponding content
                    tab.classList.add('active');
                    document.getElementById(target).classList.add('active');
                });
            });
        });
    </script>
</body>
</html>