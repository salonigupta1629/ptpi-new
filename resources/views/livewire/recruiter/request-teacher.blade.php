<div x-data="{ 
    currentStep: {{ $currentStep }},
    closeModal() {
        document.getElementById('popup-modal').classList.add('hidden');
        // Reset to step 1 when closing
        this.currentStep = 1;
        // Dispatch event to reset Livewire component
        Livewire.dispatch('reset-form');
    }
}" 
id="popup-modal" 
class="hidden fixed inset-0 z-50 bg-black/60 flex items-center justify-center px-4"
x-init="$watch('currentStep', (value) => { 
    // Sync with Livewire component
    Livewire.set('currentStep', value); 
})">
    
    <div class="relative w-full max-w-lg" @click.stop>
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden relative">
            <!-- Close Button -->
            <button type="button" @click="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-900 z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <!-- Modal Content -->
            <div class="p-6">
                <form wire:submit.prevent="submit">
                    <!-- Step 1: Class & Subjects -->
                    <div x-show="currentStep === 1" x-transition>
                        <h2 class="text-xl font-semibold mb-4 text-gray-800">Request a Teacher</h2>

                        <!-- Class Range -->
                        <div class="mb-4">
                            <label for="class_id" class="block text-sm font-medium text-gray-700 mb-2">Select Class Range</label>
                            <select id="class_id" wire:model.live="class_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                                <option value="">Select class range</option>
                                @foreach($classCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('class_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Subjects -->
                        <div>
                            @if(!empty($subjects) && count($subjects) > 0)
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Subjects</label>
                                    <div class="grid grid-cols-2 gap-3 max-h-60 overflow-y-auto">
                                        @foreach($subjects as $subject)
                                            <label class="flex items-center space-x-2 p-2 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                                <input type="checkbox" wire:model.live="subject_ids" value="{{ $subject['id'] }}" class="text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                                <span class="text-sm text-gray-700">{{ $subject['subject_name'] }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('subject_ids') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            @elseif($class_id)
                                <div class="mb-6 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                    <p class="text-sm text-yellow-700">No subjects available for this class range.</p>
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-end">
                            <button type="button" 
                                    @click="if ($wire.class_id && $wire.subject_ids.length > 0) { currentStep = 2; }" 
                                    :disabled="!$wire.class_id || $wire.subject_ids.length === 0" 
                                    class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-6 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed transition duration-200">
                                Next
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Location Details -->
                    <div x-show="currentStep === 2" x-transition>
                        <h2 class="text-xl font-semibold mb-4 text-gray-800">Location Details</h2>

                        <!-- Pincode Input -->
                        <div class="mb-4">
                            <label for="pincode" class="block text-sm font-medium text-gray-700 mb-1">Pincode</label>
                            <input type="text" id="pincode" wire:model.live="pincode" maxlength="6" placeholder="Enter 6-digit pincode" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @error('pincode') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- State Input -->
                        <div class="mb-4">
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                            <input type="text" id="state" wire:model.live="state" placeholder="Enter state" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @error('state') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- City Input -->
                        <div class="mb-4">
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City/District</label>
                            <input type="text" id="city" wire:model.live="city" placeholder="Enter city or district" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @error('city') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Area Input -->
                        <div class="mb-6">
                            <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Area</label>
                            <input type="text" id="area" wire:model.live="area" placeholder="Enter area" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @error('area') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-between pt-4">
                            <button type="button" @click="currentStep = 1" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition duration-200">
                                Back
                            </button>
                            <button type="submit" wire:loading.attr="disabled" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 flex items-center">
                                <span wire:loading.class="hidden">Submit Request</span>
                                <svg wire:loading wire:target="submit" class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span wire:loading wire:target="submit" class="ml-2">Submitting...</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal() {
        const modal = document.getElementById('popup-modal');
        modal.classList.remove('hidden');
        
        // Reset to step 1 when opening modal
        const alpineComponent = Alpine.$data(modal.querySelector('[x-data]'));
        if (alpineComponent) {
            alpineComponent.currentStep = 1;
        }
        
        // Reset Livewire component
        Livewire.dispatch('reset-form');
    }

    function closeModal() {
        document.getElementById('popup-modal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('popup-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('popup-modal');
            if (!modal.classList.contains('hidden')) {
                closeModal();
            }
        }
    });

    // Livewire event listeners
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('close-modal', () => {
            closeModal();
        });
        
        Livewire.on('reset-form', () => {
            // This will trigger the resetForm method in Livewire component
            Livewire.dispatch('reset-form');
        });
    });

    // Add event listener for Livewire model updates
    document.addEventListener('livewire:update', () => {
        // Sync Alpine currentStep with Livewire currentStep
        const modal = document.getElementById('popup-modal');
        if (!modal.classList.contains('hidden')) {
            const alpineComponent = Alpine.$data(modal.querySelector('[x-data]'));
            if (alpineComponent) {
                // Get current step from Livewire
                const livewireStep = Livewire.get('currentStep');
                if (livewireStep !== undefined) {
                    alpineComponent.currentStep = livewireStep;
                }
            }
        }
    });
</script>