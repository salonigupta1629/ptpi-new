<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white overflow-y-auto h-[90vh] rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create New Exam Set
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body (Form) -->
            <form action="#" method="POST" class="p-4 md:p-5 space-y-4">
                <!-- Set Name -->
                <div>
                    <label for="set_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Set Name *</label>
                    <input type="text" id="set_name" name="set_name" placeholder="Enter exam set name..."
                        class="w-full border border-gray-300 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                </div>
                <!-- Exam Description -->
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Exam Description</label>
                    <textarea id="description" name="description" rows="3" placeholder="Enter exam description..."
                        class="w-full border border-gray-300 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white"></textarea>
                </div>
                <!-- Class Category -->
                <div>
                    <label for="class_category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Category</label>
                    <select id="class_category" name="class_category"
                        class="w-full border border-gray-300 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        <option value="">Select Class Category</option>
                        <option value="1">Class 1</option>
                        <option value="2">Class 2</option>
                        <option value="3">Class 3</option>
                    </select>
                </div>
                <!-- Subject -->
                <div>
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
                    <select id="subject" name="subject"
                        class="w-full border border-gray-300 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        <option value="">Please select a class category first</option>
                    </select>
                </div>
                <!-- Level -->
                <div>
                    <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level</label>
                    <select id="level" name="level"
                        class="w-full border border-gray-300 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        <option value="">Select Level</option>
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                    </select>
                </div>
                <!-- Total Marks -->
                <div>
                    <label for="marks" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Marks</label>
                    <input type="number" id="marks" name="marks" placeholder="Enter total marks"
                        class="w-full border border-gray-300 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                </div>
                <!-- Duration -->
                <div>
                    <label for="duration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duration (minutes)</label>
                    <input type="number" id="duration" name="duration" placeholder="Enter duration in minutes"
                        class="w-full border border-gray-300 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                </div>
                <!-- Total Questions -->
                <div>
                    <label for="questions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Questions</label>
                    <input type="number" id="questions" name="questions" placeholder="Enter total questions"
                        class="w-full border border-gray-300 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    <p class="text-xs text-gray-500 mt-1">Set the number of questions for this exam</p>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-end gap-3 border-t pt-4">
                    <button data-modal-hide="default-modal" type="button"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Create Exam Set
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
