<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex overflow-hidden bg-gray-100">

  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md fixed h-full">
    <div class="p-4 text-xl font-bold border-b">PTPI</div>
    <nav class="mt-4 flex flex-col space-y-2 px-4">
      <a href="#" class="flex items-center space-x-2 text-gray-700 hover:bg-gray-200 rounded p-2">
        <span>📊</span><span>Dashboard</span>
      </a>
      <a href="#" class="flex items-center space-x-2 text-gray-700 hover:bg-gray-200 rounded p-2">
        <span>📂</span><span>Data Management</span>
      </a>
      <a href="#" class="flex items-center space-x-2 text-gray-700 hover:bg-gray-200 rounded p-2">
        <span>📘</span><span>Subjects</span>
      </a>
      <!-- Add more links here -->
      <a href="#" class="text-red-600 mt-auto p-2">Logout</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 ml-64 flex flex-col h-screen">

    <!-- Header -->
    <header class="bg-blue-900 text-white px-6 py-4 sticky top-0 z-10">
      <h1 class="text-lg font-semibold">Admin Dashboard</h1>
    </header>

    <!-- Scrollable Content -->
    <main class="flex-1 overflow-y-auto p-6">
      
      <!-- Key Metrics -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 shadow rounded">Pending Teachers: 1</div>
        <div class="bg-white p-4 shadow rounded">Pending Recruiters: 3</div>
        <div class="bg-white p-4 shadow rounded">Upcoming Interviews: 0</div>
        <div class="bg-white p-4 shadow rounded">Total Passkeys: 0</div>
      </div>

      <!-- Analytics Overview -->
      <h2 class="text-xl font-semibold mb-4">Analytics Overview</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <div class="bg-blue-600 text-white p-6 rounded shadow">Teachers: 8</div>
        <div class="bg-purple-400 text-white p-6 rounded shadow">Recruiters: 4</div>
        <div class="bg-red-500 text-white p-6 rounded shadow">Interviews: 0</div>
        <div class="bg-green-600 text-white p-6 rounded shadow">Passkeys: 0</div>
        <div class="bg-indigo-600 text-white p-6 rounded shadow">Exam Centers: 1</div>
        <div class="bg-gray-400 text-white p-6 rounded shadow">Question Reports: 0</div>
      </div>

      {{ $slot }}
    </main>
  </div>

</body>
</html>
