<!-- Modal -->
<div id="popup-modal" class="hidden fixed inset-0 z-50 bg-black/60 flex items-center justify-center px-4">
  <div class="relative w-full max-w-lg">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden relative">
      <!-- Close Button -->
      <button type="button" id="close-modal"
        class="absolute top-4 right-4 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        <span class="sr-only">Close modal</span>
      </button>
      <!-- Modal Content -->
      <div class="p-6 text-left">
        <!-- Step 1: Class & Subjects -->
        <div id="step-1">
          <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Request a Teacher</h2>
          <label for="class-range" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Select Class Range</label>
          <select id="class-range" class="w-full mb-4 px-4 py-2 border rounded dark:bg-gray-700 dark:text-white">
            <option value="">Select class range</option>
            <option value="0-2">0-2</option>
            <option value="0-4">0-4</option>
            <option value="0-6">0-6</option>
            <option value="0-8">0-8</option>
          </select>

          <div id="subjects-container" class="hidden mb-4">
            <p class="text-sm font-medium mb-2 text-gray-700 dark:text-white">Select Subjects:</p>
            <div id="subject-checkboxes" class="grid grid-cols-2 gap-2 text-sm text-gray-700 dark:text-white"></div>
          </div>

          <div class="flex justify-end">
            <button id="next-to-step-2" disabled
              class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed">
              Next
            </button>
          </div>
        </div>

        <!-- Step 2: Location Details -->
        <div id="step-2" class="hidden">
          <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Location Details</h2>

          <label for="pincode" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Pincode</label>
          <input type="text" id="pincode" maxlength="6" placeholder="Enter 6-digit pincode"
            class="w-full mb-2 px-4 py-2 border rounded dark:bg-gray-700 dark:text-white">

          <div id="pincode-loader" class="text-teal-600 mb-4 hidden flex items-center">
            <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4v4m0 8v4m4-12h4M4 12H0m16.95 6.364l2.829 2.829M4.222 4.222L1.393 1.393" />
            </svg>
            Fetching location...
          </div>

          <label for="state" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">State</label>
          <input type="text" id="state" readonly class="w-full mb-2 px-4 py-2 border rounded bg-gray-100 dark:bg-gray-700 dark:text-white">

          <label for="city" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">City / District</label>
          <input type="text" id="city" readonly class="w-full mb-4 px-4 py-2 border rounded bg-gray-100 dark:bg-gray-700 dark:text-white">
          <label for="area" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Select Area</label>
          <select id="area" class="w-full mb-6 px-4 py-2 border rounded dark:bg-gray-700 dark:text-white">
            <option value="">Select an area</option>
            <option>North Zone</option>
            <option>South Zone</option>
            <option>East Zone</option>
            <option>West Zone</option>
          </select>

          <div class="flex justify-between">
            <button id="back-to-step-1"
              class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
              Back
            </button>
            <button id="submit-request"
              class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed"
              disabled>
              Submit Request
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  // Modal references
  const modal = document.getElementById('popup-modal');
  const closeModalBtn = document.getElementById('close-modal');

  // Step elements
  const step1 = document.getElementById('step-1');
  const step2 = document.getElementById('step-2');

  // Step 1 controls
  const classRangeSelect = document.getElementById('class-range');
  const subjectsContainer = document.getElementById('subjects-container');
  const subjectCheckboxesDiv = document.getElementById('subject-checkboxes');
  const nextBtn = document.getElementById('next-to-step-2');

  // Step 2 controls
  const backBtn = document.getElementById('back-to-step-1');
  const submitBtn = document.getElementById('submit-request');
  const pincodeInput = document.getElementById('pincode');
  const loader = document.getElementById('pincode-loader');
  const stateInput = document.getElementById('state');
  const cityInput = document.getElementById('city');
  const areaSelect = document.getElementById('area');

  // Subject options mapped by class range
  const subjectOptionsMap = {
    "0-2": ["English", "Math", "EVS", "Drawing"],
    "0-4": ["English", "Hindi", "Math", "Science", "Social Science"],
    "0-6": ["English", "Math", "Science", "History", "Geography"],
    "0-8": ["Physics", "Chemistry", "Biology", "Math", "English", "History"]
  };

  // Generate subjects checkboxes based on class range
  function renderSubjects(classRange) {
    subjectCheckboxesDiv.innerHTML = '';
    if (!classRange || !subjectOptionsMap[classRange]) {
      subjectsContainer.classList.add('hidden');
      nextBtn.disabled = true;
      return;
    }

    subjectOptionsMap[classRange].forEach((subject, idx) => {
      const id = `subject-${idx}`;
      const label = document.createElement('label');
      label.className = "inline-flex items-center mb-1";

      const checkbox = document.createElement('input');
      checkbox.type = "checkbox";
      checkbox.className = "subject-checkbox h-4 w-4 text-teal-600 border border-gray-300 rounded";
      checkbox.id = id;
      checkbox.value = subject;

      label.appendChild(checkbox);
      label.append(` ${subject}`);

      subjectCheckboxesDiv.appendChild(label);
    });

    subjectsContainer.classList.remove('hidden');
    nextBtn.disabled = true; // Require at least one subject to enable Next
  }

  // Enable Next button only if at least one subject is checked
  subjectCheckboxesDiv.addEventListener('change', () => {
    const anyChecked = [...document.querySelectorAll('.subject-checkbox')].some(cb => cb.checked);
    nextBtn.disabled = !anyChecked;
  });

  // On class range change
  classRangeSelect.addEventListener('change', e => {
    renderSubjects(e.target.value);
  });

  // Next button click -> move to step 2
  nextBtn.addEventListener('click', () => {
    step1.classList.add('hidden');
    step2.classList.remove('hidden');
  });

  // Back button click -> back to step 1
  backBtn.addEventListener('click', () => {
    step2.classList.add('hidden');
    step1.classList.remove('hidden');
  });

  // Enable submit only if pincode valid, state, city, area selected
  function validateStep2() {
    const pincodeVal = pincodeInput.value.trim();
    const areaVal = areaSelect.value;
    submitBtn.disabled = !(pincodeVal.length === 6 && stateInput.value && cityInput.value && areaVal);
  }

  // Listen for pincode input changes to fetch state & city dynamically
  pincodeInput.addEventListener('input', () => {
    const val = pincodeInput.value.trim();
    stateInput.value = '';
    cityInput.value = '';
    submitBtn.disabled = true;

    if (/^\d{6}$/.test(val)) {
      loader.classList.remove('hidden');

      fetch(`https://api.postalpincode.in/pincode/${val}`)
        .then(res => res.json())
        .then(data => {
          loader.classList.add('hidden');
          if (data[0].Status === "Success" && data[0].PostOffice && data[0].PostOffice.length > 0) {
            const postOffice = data[0].PostOffice[0];
            stateInput.value = postOffice.State || '';
            cityInput.value = postOffice.District || '';
          } else {
            stateInput.value = 'Not found';
            cityInput.value = '';
          }
          validateStep2();
        })
        .catch(() => {
          loader.classList.add('hidden');
          stateInput.value = 'Error';
          cityInput.value = '';
          validateStep2();
        });
    } else {
      loader.classList.add('hidden');
    }
  });

  // Validate area select to enable submit button
  areaSelect.addEventListener('change', validateStep2);

  // Submit button click handler
  submitBtn.addEventListener('click', () => {
    const selectedClass = classRangeSelect.value;
    const selectedSubjects = [...document.querySelectorAll('.subject-checkbox:checked')].map(cb => cb.value);
    const pincode = pincodeInput.value.trim();
    const state = stateInput.value;
    const city = cityInput.value;
    const area = areaSelect.value;

    // For demo, just logging values — replace with your logic here
    console.log("Class Range:", selectedClass);
    console.log("Subjects:", selectedSubjects);
    console.log("Pincode:", pincode);
    console.log("State:", state);
    console.log("City:", city);
    console.log("Area:", area);

    // Close modal after submit
    modal.classList.add('hidden');


  });

  // Close modal button
  closeModalBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
  });

</script>
