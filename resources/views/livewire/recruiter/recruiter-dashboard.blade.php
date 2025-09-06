<div class="p-4">
  <!-- Top Bar -->
  <div class="flex justify-between bg-white p-2 shadow rounded-md border items-center mb-6">
    <h2 class="text-xl font-bold text-gray-800">Available Teachers</h2>

    <!-- Buttons -->
    <div class="flex space-x-2">
      <!-- View Switch -->
      <div class="flex gap-1 border border-gray-300 rounded-lg overflow-hidden">
        <button id="btn-card" class="view-toggle px-4 py-2 text-sm flex items-center bg-white font-semibold">
          <i class="fa-regular fa-address-card mr-2"></i>Card
        </button>
        <button id="btn-table" class="view-toggle px-4 py-2 text-sm flex items-center">
          <i class="fas fa-table mr-2"></i>Table
        </button>
      </div>

      <!-- Refresh -->
      <button id="refresh-btn" class="bg-white border border-gray-300 px-4 py-2 rounded-lg text-sm flex items-center">
        <i class="fas fa-sync mr-2"></i>Refresh
      </button>

      <!-- Clear Filter -->
      <button id="clear-filter-btn" class="bg-white border border-gray-300 px-4 py-2 rounded-lg text-sm flex items-center">
        <i class="fa-regular fa-filter mr-2"></i>Clear Filter
      </button>
    </div>
  </div>

  <!-- Card View -->
  <div id="card-view" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Sample Teacher Card -->
    <div class="teacher-card bg-white rounded-md border overflow-hidden transition-all duration-300">
      <div class="p-6">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div class="w-14 h-14 rounded-full bg-purple-100 text-purple-800 flex items-center justify-center font-bold text-xl">AS</div>
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
          <div class="text-teal-600 font-bold">₹22/hr</div>
          <a href="{{ route('recruiter.teacher.profile') }}"
            class="bg-teal-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-teal-600 transition-colors">
            View Profile
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Table View (Hidden by default) -->
  <div id="table-view" class="hidden overflow-x-auto">
    <table class="min-w-full bg-white rounded-md overflow-hidden border">
      <thead class="bg-gray-100 text-gray-700 text-sm">
        <tr>
          <th class="px-4 py-2 text-left">Name</th>
          <th class="px-4 py-2 text-left">Subject</th>
          <th class="px-4 py-2 text-left">Location</th>
          <th class="px-4 py-2 text-left">Experience</th>
          <th class="px-4 py-2 text-left">Rate</th>
          <th class="px-4 py-2 text-left">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-t">
          <td class="px-4 py-2 font-medium">Amit Singh</td>
          <td class="px-4 py-2">English</td>
          <td class="px-4 py-2">Bangalore, India</td>
          <td class="px-4 py-2">5+ yrs</td>
          <td class="px-4 py-2">₹22/hr</td>
          <td class="px-4 py-2">
            <a href="{{ route('recruiter.teacher.profile') }}"
              class="text-teal-600 hover:underline">View</a>
          </td>
        </tr>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>
</div>


<script>
  const cardBtn = document.getElementById('btn-card');
  const tableBtn = document.getElementById('btn-table');
  const cardView = document.getElementById('card-view');
  const tableView = document.getElementById('table-view');
  const refreshBtn = document.getElementById('refresh-btn');
  const clearFilterBtn = document.getElementById('clear-filter-btn');

  function setActiveView(view) {
    if (view === 'card') {
      cardView.classList.remove('hidden');
      tableView.classList.add('hidden');
      cardBtn.classList.add('bg-white', 'font-semibold');
      tableBtn.classList.remove('bg-white', 'font-semibold');
    } else {
      cardView.classList.add('hidden');
      tableView.classList.remove('hidden');
      tableBtn.classList.add('bg-white', 'font-semibold');
      cardBtn.classList.remove('bg-white', 'font-semibold');
    }
  }

  cardBtn.addEventListener('click', () => setActiveView('card'));
  tableBtn.addEventListener('click', () => setActiveView('table'));

  refreshBtn.addEventListener('click', () => location.reload());

  clearFilterBtn.addEventListener('click', () => {
    document.querySelectorAll('input, select').forEach(el => {
      if (el.type === 'checkbox' || el.type === 'radio') {
        el.checked = false;
      } else {
        el.value = '';
      }
    });
  });

  // Set default view on page load
  document.addEventListener('DOMContentLoaded', () => setActiveView('card'));
</script>
