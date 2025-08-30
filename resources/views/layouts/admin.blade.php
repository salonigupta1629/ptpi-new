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
      
      {{ $slot }}
    </main>
  </div>

</body>
</html>
