<div class="bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-8 space-y-6">
        <!-- Back link and Heading -->
        <div class="flex flex-col gap-2">
            <a wire:navigate href="{{ route('examiner.manage-question', $examSetId) }}"
                class="text-blue-600 hover:underline font-medium flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Back To Questions
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Question Manager with Hindi Translation</h2>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('message') }}
            </div>
        @endif

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
                            Type in English fields and see instant Hindi translation (with a short delay for
                            processing).
                        </p>
                    </div>
                </div>
                <div>
                    <button type="button"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg border border-blue-600 hover:bg-blue-600 shadow transition-all duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                clip-rule="evenodd" />
                        </svg>
                        Re-translate All
                    </button>
                </div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="border border-green-200 bg-green-50 rounded-lg p-4 shadow-sm">
            <p class="text-gray-800 text-sm">
                <span class="font-semibold">Note:</span> You can submit English only, Hindi only, or both questions.
                The translation works best with complete sentences. There might be a short delay for translation.
            </p>
        </div>

        <div class="border border-gray-200 rounded-lg p-6 shadow-sm bg-white">
            <h2 class="text-lg font-semibold mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                        clip-rule="evenodd" />
                </svg>
                {{ $isEditing ? 'Edit Question' : 'Add New Question' }}
            </h2>
            <form wire:submit.prevent="{{ $isEditing ? 'updateQuestion' : 'createQuestion' }}">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- English Question -->
                    <div class="w-full md:w-1/2">
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-1">Question Text (English)</label>
                            <textarea wire:model.debounce.500ms="question_text" id="question-text-input" rows="4"
                                class="w-full border rounded-md p-3 focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                                placeholder="Enter question in English"></textarea>
                            @error('question_text')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-3 mb-4">
                            <label class="block font-medium text-gray-700">Answer Options (English)</label>
                            @for ($i = 0; $i < 4; $i++)
                                <div class="flex items-center gap-3">
                                    <span class="text-gray-600 w-6">{{ $i + 1 }}.</span>
                                    <input type="text" wire:model.debounce.500ms="options.{{ $i }}"
                                        id="option-{{ $i }}-input"
                                        class="flex-1 border rounded-md p-2 focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                                        placeholder="Option {{ $i + 1 }} in English" />
                                    @error("options.{$i}")
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endfor
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-1">Solution (Optional, English)</label>
                            <textarea wire:model.debounce.500ms="solution" id="solution-input" rows="3"
                                class="w-full border rounded-md p-3 focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                                placeholder="Enter solution in English"></textarea>
                            @error('solution')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Hindi Question -->
                    <div class="w-full md:w-1/2">
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-1">प्रश्न पाठ (Hindi)</label>
                            <textarea wire:model.debounce.500ms="question_text_hi" id="question-text-hi" rows="4"
                                class="w-full border rounded-md p-3 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-300 focus:border-green-300 transition"
                                placeholder="हिंदी प्रश्न दर्ज करें"></textarea>
                            @error('question_text_hi')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-3 mb-4">
                            <label class="block font-medium text-gray-700">उत्तर विकल्प (Hindi)</label>
                            @for ($i = 0; $i < 4; $i++)
                                <div class="flex items-center gap-3">
                                    <span class="text-gray-600 w-6">{{ $i + 1 }}.</span>
                                    <input type="text" wire:model.debounce.500ms="options_hi.{{ $i }}"
                                        id="option-{{ $i }}-hi"
                                        class="flex-1 border rounded-md p-2 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-300 focus:border-green-300 transition"
                                        placeholder="विकल्प {{ $i + 1 }}" />
                                    @error("options_hi.{$i}")
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endfor
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-1">समाधान (वैकल्पिक, Hindi)</label>
                            <textarea wire:model.debounce.500ms="solution_hi" id="solution-hi" rows="3"
                                class="w-full border rounded-md p-3 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-300 focus:border-green-300 transition"
                                placeholder="हिंदी में समाधान दर्ज करें"></textarea>
                            @error('solution_hi')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Correct Option</label>
                    <select wire:model="correct_option"
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-300">
                        <option value="">Select correct option</option>
                        @for ($i = 1; $i <= 4; $i++)
                            <option value="option{{ $i }}">Option {{ $i }}</option>
                        @endfor
                    </select>
                    @error('correct_option')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $isEditing ? 'Update Question' : 'Submit Question' }}
                    </button>
                    @if ($isEditing)
                        <button type="button" wire:click="resetInput"
                            class="bg-gray-500 text-white px-6 py-3 rounded-lg shadow hover:bg-gray-600 transition ml-2">Cancel</button>
                    @endif
                </div>
            </form>
        </div>
        <div class="border border-gray-200 rounded-lg p-6 shadow-sm bg-white">
            <h2 class="text-lg font-semibold mb-4 flex items-center border-b pb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                        clip-rule="evenodd" />
                </svg>
                Question Preview
            </h2>

            <div class="mb-4">
                <button wire:click="previewLatestQuestion"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd"
                            d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm1.032.063A6.5 6.5 0 1016.968 10a6.5 6.5 0 00-13.936 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Show Latest Question Preview
                </button>
            </div>

            @if ($latestQuestion)
                <div class="mb-4">
                    <h3 class="font-medium text-gray-800">Question (English):</h3>
                    <p class="text-gray-700">{{ $latestQuestion->question_text }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="font-medium text-gray-800">Options (English):</h3>
                    <ul class="list-disc pl-5 text-gray-700">
                        @foreach ($latestQuestion->options as $index => $option)
                            <li
                                class="{{ $latestQuestion->correct_option === 'option' . ($index + 1) ? 'text-green-600 font-semibold' : '' }}">
                                {{ $index + 1 }}. {{ $option }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if ($latestQuestion->solution)
                    <div class="mb-4">
                        <h3 class="font-medium text-gray-800">Solution (English):</h3>
                        <p class="text-gray-700">{{ $latestQuestion->solution }}</p>
                    </div>
                @endif
                <div class="mb-4">
                    <h3 class="font-medium text-gray-800">Question (Hindi):</h3>
                    <p class="text-gray-700">{{ $latestQuestion->translations['hi']['question_text'] ?? '' }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="font-medium text-gray-800">Options (Hindi):</h3>
                    <ul class="list-disc pl-5 text-gray-700">
                        @foreach ($latestQuestion->translations['hi']['options'] ?? [] as $index => $option)
                            <li
                                class="{{ $latestQuestion->correct_option === 'option' . ($index + 1) ? 'text-green-600 font-semibold' : '' }}">
                                {{ $index + 1 }}. {{ $option }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if ($latestQuestion->translations['hi']['solution'])
                    <div class="mb-4">
                        <h3 class="font-medium text-gray-800">Solution (Hindi):</h3>
                        <p class="text-gray-700">{{ $latestQuestion->translations['hi']['solution'] }}</p>
                    </div>
                @endif
                <div class="flex justify-end space-x-2">
                    <button wire:click="editQuestion({{ $latestQuestion->id }})"
                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                        Edit
                    </button>
                    <button wire:click="deleteQuestion({{ $latestQuestion->id }})"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        Delete
                    </button>
                </div>
            @else
                <p class="text-gray-600">No question preview available. Click "Show Latest Question Preview" to view
                    the latest question.</p>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questionTextInput = document.getElementById('question-text-input');
            const optionInputs = [
                document.getElementById('option-0-input'),
                document.getElementById('option-1-input'),
                document.getElementById('option-2-input'),
                document.getElementById('option-3-input')
            ];
            const solutionInput = document.getElementById('solution-input');
            const questionTextHi = document.getElementById('question-text-hi');
            const optionHiInputs = [
                document.getElementById('option-0-hi'),
                document.getElementById('option-1-hi'),
                document.getElementById('option-2-hi'),
                document.getElementById('option-3-hi')
            ];
            const solutionHi = document.getElementById('solution-hi');

            async function translateText(text, targetElement) {
                if (!text.trim()) {
                    targetElement.value = '';
                    return;
                }

                try {
                    const response = await fetch('https://api.ptpinstitute.com/api/translator/', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            text: text,
                            source: 'en',
                            dest: 'hi'
                        })
                    });

                    if (!response.ok) {
                        throw new Error('API request failed');
                    }

                    const data = await response.json();
                    targetElement.value = data.translated || '';
                } catch (error) {
                    console.error('Translation error:', error);
                    targetElement.value = 'Translation failed';
                }
            }

            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            questionTextInput.addEventListener('input', debounce(() => {
                translateText(questionTextInput.value, questionTextHi);
            }, 500));

            optionInputs.forEach((input, index) => {
                input.addEventListener('input', debounce(() => {
                    translateText(input.value, optionHiInputs[index]);
                }, 500));
            });

            solutionInput.addEventListener('input', debounce(() => {
                translateText(solutionInput.value, solutionHi);
            }, 500));
        });
    </script>
