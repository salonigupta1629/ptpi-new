<div class="max-w-7xl mx-auto p-6">
  <div class="bg-white rounded-2xl shadow-xl p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Generated Passkeys</h2>

    <!-- Responsive Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full border-separate border-spacing-y-2">
        <thead>
          <tr class="bg-slate-50 text-slate-600 text-sm">
            <th class="text-left px-4 py-2">#</th>
            <th class="text-left px-4 py-2">Teacher</th>
            <th class="text-left px-4 py-2">Passkey</th>
            <th class="text-left px-4 py-2">Exam Details</th>
            <th class="text-right px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($passkeys as $passkey)
            <tr class="bg-white hover:bg-slate-50 shadow-sm rounded-lg">
              <td class="px-4 py-3 text-sm text-gray-700 font-medium">{{ $passkey->id }}</td>
              <td class="px-4 py-3 text-sm text-gray-800">{{ $passkey->user->name }}</td>
              <td class="px-4 py-3">
                <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded-md">{{ $passkey->passkey }}</span>
              </td>
              <td class="px-4 py-3 text-sm text-gray-700">
                {{ $passkey->application->attempt->examSet->category->name }},
                {{ $passkey->application->attempt->examSet->subject->subject_name }}
              </td>
              <td class="px-4 py-3 text-right">
                <button
                  class="border border-indigo-500 text-indigo-600 hover:bg-indigo-50 px-3 py-1.5 rounded-lg text-sm font-medium transition">
                  View
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
