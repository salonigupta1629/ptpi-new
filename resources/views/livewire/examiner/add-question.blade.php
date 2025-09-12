<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4 space-y-6">
        <!-- Back link and Heading -->
        <div class="flex flex-col gap-2">
            <a href="#" class="text-blue-600 hover:underline font-medium flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Back To Questions
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Add New Question</h2>
        </div>

        <!-- Real-time Translation Box -->
        <div class="border border-blue-200 bg-blue-50 rounded-lg p-4 shadow-sm">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2 mt-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                    </svg>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Real-time Translation</h2>
                        <p class="text-sm text-gray-700">
                            Type in English fields and see instant Hindi translation (with a short delay for processing).
                        </p>
                    </div>
                </div>
                <div>
                    <button wire:click="retranslateAll" type="button"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg border border-blue-600 hover:bg-blue-600 shadow transition-all duration-200 flex items-center"
                        wire:loading.attr="disabled" wire:loading.class="opacity-50">
                        <span wire:loading.remove wire:target="retranslateAll">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                    clip-rule="evenodd" />
                            </svg>
                            Re-translate All
                        </span>
                        <span wire:loading wire:target="retranslateAll" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Translating...
                        </span>
                    </button>
                </div>
            </div>
            @if ($translationStatus)
                <div id="translation-status" class="mt-2 text-sm text-blue-700">{{ $translationStatus }}</div>
            @endif
        </div>

        <!-- Translation Errors -->
        @if ($translationFailed && count($translationErrors))
            <div class="border border-red-200 bg-red-50 rounded-lg p-4">
                <h3 class="font-semibold text-red-800">Translation Issues:</h3>
                <ul class="list-disc list-inside text-red-700 text-sm mt-2">
                    @foreach ($translationErrors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Info Section -->
        <div class="border border-green-200 bg-green-50 rounded-lg p-4 shadow-sm">
            <p class="text-gray-800 text-sm">
                <span class="font-semibold">Note:</span> You can submit English only, Hindi only, or both questions.
                The translation works best with complete sentences. There might be a short delay for translation.
            </p>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="save" class="space-y-6">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- English Question -->
                <div class="w-full md:w-1/2 border border-gray-200 rounded-lg p-6 shadow-sm bg-white">
                    <h2 class="text-lg font-semibold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                                clip-rule="evenodd" />
                        </svg>
                        English Question
                    </h2>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Question Text</label>
                        <textarea wire:model.live.debounce.500ms="question_en" rows="4"
                            class="w-full border rounded-md p-3 focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                            placeholder="Type your question in English"></textarea>
                        @error('question_en')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Correct Option (Type exact text)</label>
                        <input type="text" wire:model.live.debounce.500ms="correct_option_en"
                            class="w-full border rounded-md p-3 focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                            placeholder="Enter the correct option text" />
                        @error('correct_option_en')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Solution (Optional)</label>
                        <textarea wire:model.live.debounce.500ms="solution_en" rows="3"
                            class="w-full border rounded-md p-3 focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                            placeholder="Explain the solution in English"></textarea>
                        @error('solution_en')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="block font-medium text-gray-700">Answer Options</label>

                        <div class="flex items-center gap-3">
                            <span class="text-gray-600 w-6">1.</span>
                            <input type="text" wire:model.live.debounce.500ms="options_en.0"
                                class="flex-1 border rounded-md p-2 focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                                placeholder="Option 1" />
                        </div>
                        @error('options_en.0')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <div class="flex items-center gap-3">
                            <span class="text-gray-600 w-6">2.</span>
                            <input type="text" wire:model.live.debounce.500ms="options_en.1"
                                class="flex-1 border rounded-md p-2 focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                                placeholder="Option 2" />
                        </div>
                        @error('options_en.1')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <div class="flex items-center gap-3">
                            <span class="text-gray-600 w-6">3.</span>
                            <input type="text" wire:model.live.debounce.500ms="options_en.2"
                                class="flex-1 border rounded-md p-2 focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                                placeholder="Option 3" />
                        </div>
                        @error('options_en.2')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <div class="flex items-center gap-3">
                            <span class="text-gray-600 w-6">4.</span>
                            <input type="text" wire:model.live.debounce.500ms="options_en.3"
                                class="flex-1 border rounded-md p-2 focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                                placeholder="Option 4" />
                        </div>
                        @error('options_en.3')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Hindi Question -->
                <div class="w-full md:w-1/2 border border-gray-200 rounded-lg p-6 shadow-sm bg-white">
                    <h2 class="text-lg font-semibold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                                clip-rule="evenodd" />
                        </svg>
                        हिंदी प्रश्न (Auto-translated)
                    </h2>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">प्रश्न पाठ</label>
                        <textarea wire:model="question_hi" rows="4"
                            class="w-full border rounded-md p-3 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-300 focus:border-green-300 transition"
                            placeholder="Hindi translation will appear here" readonly></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">सही विकल्प</label>
                        <input type="text" wire:model="correct_option_hi"
                            class="w-full border rounded-md p-3 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-300 focus:border-green-300 transition"
                            placeholder="Hindi translation will appear here" readonly />
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">समाधान (वैकल्पिक)</label>
                        <textarea wire:model="solution_hi" rows="3"
                            class="w-full border rounded-md p-3 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-300 focus:border-green-300 transition"
                            placeholder="Hindi translation will appear here" readonly></textarea>
                    </div>

                    <div class="space-y-3">
                        <label class="block font-medium text-gray-700">उत्तर विकल्प</label>

                        <div class="flex items-center gap-3">
                            <span class="text-gray-600 w-6">1.</span>
                            <input type="text" wire:model="options_hi.0"
                                class="flex-1 border rounded-md p-2 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-300 focus:border-green-300 transition"
                                placeholder="विकल्प 1" readonly />
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-gray-600 w-6">2.</span>
                            <input type="text" wire:model="options_hi.1"
                                class="flex-1 border rounded-md p-2 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-300 focus:border-green-300 transition"
                                placeholder="विकल्प 2" readonly />
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-gray-600 w-6">3.</span>
                            <input type="text" wire:model="options_hi.2"
                                class="flex-1 border rounded-md p-2 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-300 focus:border-green-300 transition"
                                placeholder="विकल्प 3" readonly />
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-gray-600 w-6">4.</span>
                            <input type="text" wire:model="options_hi.3"
                                class="flex-1 border rounded-md p-2 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-300 focus:border-green-300 transition"
                                placeholder="विकल्प 4" readonly />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Submit Question
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', function() {
        // Hide translation status after 5 seconds
        window.Livewire.on('translation-completed', () => {
            setTimeout(() => {
                const statusEl = document.getElementById('translation-status');
                if (statusEl) {
                    statusEl.style.display = 'none';
                }
            }, 5000);
        });

        // Show translation in progress
        window.Livewire.on('translation-started', () => {
            const statusEl = document.getElementById('translation-status');
            if (statusEl) {
                statusEl.textContent = 'Translating...';
                statusEl.style.display = 'block';
            }
        });
    });
</script>
