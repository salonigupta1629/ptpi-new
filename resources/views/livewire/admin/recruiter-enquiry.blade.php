<div>
    <div>
        <div class="bg-gray-100 font-sans min-h-screen">
        <div class="container bg-white rounded-lg p-2 shadow-lg max-w-7xl">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Manage Recruiter Inquiries</h2>
                <p class="text-gray-600">Review and manage inquiries from recruiters seeking qualified teachers</p>
            </div>

            <!-- Search and Filter -->


            <!-- Enquiries Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Recruiter</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Requirements</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Location</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($enquirys as $enquiry)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $enquiry->recruiter->name ?? 'N/A' }}</div>
                                            <div class="text-sm text-gray-500">{{ $enquiry->recruiter->email ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 font-medium">
                                        {{ $enquiry->classCategory->name ?? 'N/A' }}</div>
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        @foreach ($enquiry->subject_names as $subjectName)
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $subjectName }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $enquiry->area }}, {{ $enquiry->city }}</div>
                                    <div class="text-sm text-gray-500">{{ $enquiry->state }} - {{ $enquiry->pincode }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $enquiry->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if ($enquiry->status == 'approved') bg-green-100 text-green-800
                                    @elseif($enquiry->status == 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                        @if ($enquiry->status == 'approved')
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        @elseif($enquiry->status == 'rejected')
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                        {{ ucfirst($enquiry->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button wire:click="showEnquiry({{ $enquiry->id }})"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        View
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No enquiries found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $enquirys->links() }}
            </div>
        </div>

        <!-- Main Modal -->
        @if ($showModal && $selectedEnquiry)
            <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ open: true }" x-show="open">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Background overlay -->
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <!-- Spacer -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <!-- Modal panel -->
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <!-- Header -->
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Enquiry Details
                                        </h3>
                                        <button wire:click="closeModal" type="button"
                                            class="text-gray-400 hover:text-gray-600 transition duration-150">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Enquiry Information -->
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Recruiter
                                                Information</label>
                                            <p class="mt-1 text-sm text-gray-900 font-semibold">
                                                {{ $selectedEnquiry->recruiter->name ?? 'N/A' }}</p>
                                            <p class="text-sm text-gray-600">
                                                {{ $selectedEnquiry->recruiter->email ?? 'N/A' }}</p>
                                            <p class="text-sm text-gray-600">
                                                {{ $selectedEnquiry->recruiter->phone ?? 'N/A' }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Request Date</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $selectedEnquiry->created_at->format('F d, Y \a\t h:i A') }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Class
                                                Category</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $selectedEnquiry->classCategory->name ?? 'N/A' }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Subjects
                                                Required</label>
                                            <div class="mt-1 flex flex-wrap gap-1">
                                                @foreach ($selectedEnquiry->subject_names as $subjectName)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ $subjectName }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Location</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $selectedEnquiry->area }},
                                                {{ $selectedEnquiry->city }}</p>
                                            <p class="text-sm text-gray-600">{{ $selectedEnquiry->state }} -
                                                {{ $selectedEnquiry->pincode }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Current
                                                Status</label>
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                            @if ($selectedEnquiry->status == 'approved') bg-green-100 text-green-800
                                            @elseif($selectedEnquiry->status == 'rejected') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($selectedEnquiry->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Admin Notes Section -->
                                    <div class="mt-6 border-t pt-4">
                                        <h4 class="text-md font-medium text-gray-900 mb-3">Admin Notes</h4>

                                        <!-- Notes List -->
                                        @if (count($selectedEnquiry->formatted_notes) > 0)
                                            <div class="mb-4 max-h-40 overflow-y-auto border rounded-lg p-2">
                                                @foreach ($selectedEnquiry->formatted_notes as $note)
                                                    <div
                                                        class="bg-gray-50 p-3 rounded-lg mb-2 border-l-4 border-blue-500">
                                                        <p class="text-sm text-gray-700">{{ $note }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-sm text-gray-500 italic bg-gray-50 p-3 rounded-lg">No notes
                                                added yet.</p>
                                        @endif

                                        <!-- Add Note Form -->
                                        <div class="mt-4">
                                            <label for="adminNote"
                                                class="block text-sm font-medium text-gray-700 mb-2">Add New
                                                Note</label>
                                            <textarea wire:model="adminNote" id="adminNote" rows="3" placeholder="Add a note about this enquiry..."
                                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                            @error('adminNote')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <button wire:click="addNote" wire:loading.attr="disabled"
                                                class="mt-2 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 text-sm disabled:opacity-50 transition duration-150">
                                                <span wire:loading.remove>Add Note</span>
                                                <span wire:loading>
                                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12"
                                                            r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                    Adding...
                                                </span>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Status Update Form -->
                                    <div class="mt-6 border-t pt-4">
                                        <h4 class="text-md font-medium text-gray-900 mb-3">Update Status</h4>

                                        <div class="space-y-4">
                                          <div>
    @if($selectedEnquiry->status === 'rejected')
        <!-- Show only reject reason for already rejected enquiries -->
        <div class="bg-red-50 p-3 rounded-lg border-l-4 border-red-500">
            <label class="block text-sm font-medium text-red-700 mb-1">Reject Reason</label>
            <p class="text-sm text-red-600">{{ $selectedEnquiry->reject_reason }}</p>
        </div>
    @else
        <!-- Show status options for non-rejected enquiries -->
        <label class="block text-sm font-medium text-gray-700 mb-2">Select Status</label>
        <div class="flex space-x-4">
            <label class="inline-flex items-center">
                <input type="radio" 
                       wire:model="selectedStatus"
                       name="statusRadioGroup"
                       value="approved"
                       class="text-green-600 border border-gray-500 focus:ring-green-500">
                <span class="ml-2 text-sm text-gray-700">Approve</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" 
                       wire:model="selectedStatus"
                       name="statusRadioGroup"
                       value="rejected" 
                       class="text-red-600 border border-gray-500 focus:ring-red-500">
                <span class="ml-2 text-sm text-gray-700">Reject</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" 
                       wire:model="selectedStatus"
                       name="statusRadioGroup"
                       value="pending"
                       class="text-yellow-600 border border-gray-500 focus:ring-yellow-500">
                <span class="ml-2 text-sm text-gray-700">Pending</span>
            </label>
        </div>
        @error('selectedStatus')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    @endif
</div>

                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Actions -->
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" wire:click="openRejectModal" wire:loading.attr="disabled"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 transition duration-150">
                                <span wire:loading.remove>Update Status</span>
                                <span wire:loading>
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </span>
                            </button>
                            <button type="button" wire:click="closeModal"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-150">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Reject Reason Modal -->
        @if ($showRejectModal)
            <div class="fixed inset-0 z-60 overflow-y-auto">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Background overlay -->
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <!-- Spacer -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <!-- Modal panel -->
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Reject Enquiry
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Please provide a reason for rejecting this enquiry. This will be recorded
                                            and visible in the enquiry history.
                                        </p>
                                        <div class="mt-4">
                                            <label for="rejectReason"
                                                class="block text-sm font-medium text-gray-700 mb-2">Reject Reason
                                                *</label>
                                            <textarea wire:model="rejectReason" id="rejectReason" rows="4" placeholder="Enter the reason for rejection..."
                                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('rejectReason') border-red-500 @enderror"></textarea>
                                            @error('rejectReason')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" wire:click="updateStatus" wire:loading.attr="disabled"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition duration-150">
                                <span wire:loading.remove>Confirm Reject</span>
                                <span wire:loading>
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>

                                </span>
                            </button>
                            <button type="button" wire:click="closeModal"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-150">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('livewire:init', () => {
            // Enhanced notifications
            Livewire.on('notify', (event) => {
                // Create notification element
                const notification = document.createElement('div');
                notification.className =
                    'fixed top-4 right-4 z-100 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300';
                notification.innerHTML = `
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>${event.message}</span>
            </div>
        `;

                document.body.appendChild(notification);

                // Animate in
                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                }, 100);

                // Remove after 3 seconds
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 3000);
            });

            // Status updated event
            Livewire.on('status-updated', () => {
                console.log('Status updated successfully');
            });

            // Close modals on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    Livewire.dispatch('close-modal');
                }
            });

            // Close modals when clicking outside
            document.addEventListener('click', (e) => {
                const mainModal = document.querySelector('[x-data]');
                const rejectModal = document.querySelector('.z-60');

                if (mainModal && mainModal.style.display !== 'none' && e.target === mainModal) {
                    Livewire.dispatch('close-modal');
                }

                if (rejectModal && rejectModal.style.display !== 'none' && e.target === rejectModal) {
                    Livewire.dispatch('close-modal');
                }
            });
        });

        // Alpine.js for modal animations
        document.addEventListener('alpine:init', () => {
            Alpine.data('modal', () => ({
                open: false,
                init() {
                    this.$watch('open', (value) => {
                        if (value) {
                            document.body.style.overflow = 'hidden';
                        } else {
                            document.body.style.overflow = 'auto';
                        }
                    });
                }
            }));
        });
    </script>

    <style>
        /* Custom styles for better modal appearance */
        .fixed {
            position: fixed;
        }

        .z-50 {
            z-index: 50;
        }

        .z-60 {
            z-index: 60;
        }

        .z-100 {
            z-index: 100;
        }

        /* Smooth transitions */
        .transition-transform {
            transition-property: transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        /* Scrollbar styling for notes */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Loading animation */
        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Hover effects */
        .hover\:bg-gray-50:hover {
            background-color: #f9fafb;
        }

        .hover\:bg-blue-700:hover {
            background-color: #1d4ed8;
        }

        .hover\:bg-red-700:hover {
            background-color: #b91c1c;
        }

        .hover\:bg-gray-700:hover {
            background-color: #374151;
        }
    </style>

</div>
</div>