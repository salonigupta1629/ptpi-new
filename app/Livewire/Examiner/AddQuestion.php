<?php

namespace App\Livewire\Examiner;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Question;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.examiner')]
class AddQuestion extends Component
{
    public $question_en = '', $question_hi = '';
    public $options_en = ['', '', '', ''];
    public $options_hi = ['', '', '', ''];
    public $correct_option_en = '', $correct_option_hi = '';
    public $solution_en = '', $solution_hi = '';
    public $exam_set_id = 1;
    public $isTranslating = false;
    public $translationStatus = '';
    public $translationErrors = [];
    public $translationFailed = false;

    // Hook for question_en
    public function updatedQuestionEn($value)
    {
        if (!empty($value)) {
            $this->dispatch('translation-started');
            $translated = $this->translateText($value, 'en', 'hi');
            $this->question_hi = $translated;
            $this->translationStatus = $translated !== $value ? 'Question translated successfully!' : 'Translation failed for question. Enter Hindi manually.';
            $this->translationFailed = $translated === $value;
            $this->dispatch('translation-completed');
        } else {
            $this->question_hi = '';
            $this->translationFailed = false;
        }
    }

    // Hook for options_en - fixed parameter handling
    public function updatedOptionsEn($value, $name)
    {
        // Extract the index from the field name (e.g., "options_en.0" -> 0)
        $parts = explode('.', $name);
        if (count($parts) === 2 && is_numeric($parts[1])) {
            $index = (int)$parts[1];

            if (!empty($value) && isset($this->options_hi[$index])) {
                $this->dispatch('translation-started');
                $translated = $this->translateText($value, 'en', 'hi');
                $this->options_hi[$index] = $translated;
                $this->translationStatus = $translated !== $value ? "Option " . ($index + 1) . " translated successfully!" : "Translation failed for option " . ($index + 1) . ". Enter Hindi manually.";
                $this->translationFailed = $translated === $value;
                $this->dispatch('translation-completed');
            } elseif (empty($value)) {
                $this->options_hi[$index] = '';
                $this->translationFailed = false;
            }
        }
    }

    // Hook for correct_option_en
    public function updatedCorrectOptionEn($value)
    {
        if (!empty($value)) {
            $this->dispatch('translation-started');
            $translated = $this->translateText($value, 'en', 'hi');
            $this->correct_option_hi = $translated;
            $this->translationStatus = $translated !== $value ? 'Correct option translated successfully!' : 'Translation failed for correct option. Enter Hindi manually.';
            $this->translationFailed = $translated === $value;
            $this->dispatch('translation-completed');
        } else {
            $this->correct_option_hi = '';
            $this->translationFailed = false;
        }
    }

    // Hook for solution_en
    public function updatedSolutionEn($value)
    {
        if (!empty($value)) {
            $this->dispatch('translation-started');
            $translated = $this->translateText($value, 'en', 'hi');
            $this->solution_hi = $translated;
            $this->translationStatus = $translated !== $value ? 'Solution translated successfully!' : 'Translation failed for solution. Enter Hindi manually.';
            $this->translationFailed = $translated === $value;
            $this->dispatch('translation-completed');
        } else {
            $this->solution_hi = '';
            $this->translationFailed = false;
        }
    }

    // Server-side translation for retranslateAll
    public function retranslateAll()
    {
        $this->isTranslating = true;
        $this->translationStatus = 'Translating all fields...';
        $this->translationErrors = [];
        $this->translationFailed = false;
        $this->dispatch('translation-started');

        try {
            // Translate question
            if (!empty($this->question_en)) {
                $translated = $this->translateText($this->question_en, 'en', 'hi');
                $this->question_hi = $translated;
                if ($translated === $this->question_en) {
                    $this->translationErrors[] = 'Failed to translate question. Enter Hindi manually.';
                    $this->translationFailed = true;
                }
            }

            // Translate options
            foreach ($this->options_en as $key => $option) {
                if (!empty($option) && isset($this->options_hi[$key])) {
                    $translated = $this->translateText($option, 'en', 'hi');
                    $this->options_hi[$key] = $translated;
                    if ($translated === $option) {
                        $this->translationErrors[] = "Failed to translate option " . ($key + 1) . ". Enter Hindi manually.";
                        $this->translationFailed = true;
                    }
                }
            }

            // Translate correct option
            if (!empty($this->correct_option_en)) {
                $translated = $this->translateText($this->correct_option_en, 'en', 'hi');
                $this->correct_option_hi = $translated;
                if ($translated === $this->correct_option_en) {
                    $this->translationErrors[] = 'Failed to translate correct option. Enter Hindi manually.';
                    $this->translationFailed = true;
                }
            }

            // Translate solution
            if (!empty($this->solution_en)) {
                $translated = $this->translateText($this->solution_en, 'en', 'hi');
                $this->solution_hi = $translated;
                if ($translated === $this->solution_en) {
                    $this->translationErrors[] = 'Failed to translate solution. Enter Hindi manually.';
                    $this->translationFailed = true;
                }
            }

            $this->translationStatus = empty($this->translationErrors) ? 'All fields translated successfully!' : 'Translation completed with some errors. Enter Hindi manually where needed.';
        } catch (\Exception $e) {
            $this->translationStatus = 'Translation failed: ' . $e->getMessage();
            $this->translationErrors[] = $e->getMessage();
            $this->translationFailed = true;
            Log::error('Translation error in retranslateAll: ' . $e->getMessage());
        }

        $this->isTranslating = false;
        $this->dispatch('translation-completed');
    }
    private function translateText($text, $sourceLang, $targetLang)
    {
        if (empty($text)) return '';

        // Check if text is already in Hindi (Devanagari script)
        if ($targetLang === 'hi' && preg_match('/[\x{0900}-\x{097F}]/u', $text)) {
            return $text;
        }

        $apis = [
            [
                'url' => 'https://api.ptpinstitute.com/api/translator/',
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'body' => [
                    'text' => $text,
                    'source' => $sourceLang,
                    'dest' => $targetLang
                ],
                'response_key' => 'translated'
            ],
        ];

        foreach ($apis as $api) {
            try {
              $response = Http::timeout(30)
                ->retry(3, 100) // Retry 3 times with 100ms delay
                ->withHeaders($api['headers'])
                ->withOptions([
                    'connect_timeout' => 5, // Connection timeout
                ])
                ->post($api['url'], $api['body']);
                //   dd($response);


                if ($response->successful()) {
                    $data = $response->json();

                    // Use the correct response key
                    $translated = data_get($data, $api['response_key']);


                    if ($translated && $translated !== $text && $translated !== '') {
                        return $translated;
                    }
                } else {
                    Log::warning("Translation API failed with status: " . $response->status() . " - Response: " . $response->body());
                }
            } catch (\Exception $e) {
                Log::warning("Translation API failed: " . $e->getMessage());
                continue;
            }
        }

        // Return original text if all APIs fail
        return $text;
    }

    public function save()
    {
        $this->validate([
            'question_en' => 'required|string',
            'options_en' => 'required|array|min:2',
            'options_en.*' => 'required|string',
            'correct_option_en' => 'required|string',
        ], [
            'question_en.required' => 'The English question is required.',
            'options_en.required' => 'At least two options are required.',
            'options_en.*.required' => 'Each option must not be empty.',
            'correct_option_en.required' => 'The correct option is required.',
        ]);

        $filteredOptionsEn = array_filter($this->options_en, function ($option) {
            return !empty(trim($option));
        });
        $filteredOptionsHi = array_filter($this->options_hi, function ($option) {
            return !empty(trim($option));
        });

        if (count($filteredOptionsEn) < 2) {
            $this->addError('options_en', 'At least two non-empty options are required.');
            return;
        }

        if (!in_array($this->correct_option_en, $filteredOptionsEn)) {
            $this->addError('correct_option_en', 'The correct option must match one of the provided options.');
            return;
        }

        $correctOptionIndex = array_search($this->correct_option_en, $this->options_en);

        $correctOptionHi = !empty($this->correct_option_hi) ?
            $this->correct_option_hi : (isset($this->options_hi[$correctOptionIndex]) && !empty($this->options_hi[$correctOptionIndex]) ?
                $this->options_hi[$correctOptionIndex] :
                $this->correct_option_en);

        try {
            Question::create([
                'exam_set_id' => $this->exam_set_id,
                'question_text' => $this->question_en,
                'options' => json_encode(array_values($filteredOptionsEn)),
                'correct_option' => $this->correct_option_en,
                'solution' => $this->solution_en ?: null,
                'language' => 'en',
                'translations' => json_encode([
                    'en' => [
                        'question_text' => $this->question_en,
                        'options' => array_values($filteredOptionsEn),
                        'correct_option' => $this->correct_option_en,
                        'solution' => $this->solution_en ?: null,
                    ],
                    'hi' => [
                        'question_text' => $this->question_hi ?: $this->question_en,
                        'options' => !empty($filteredOptionsHi) ?
                            array_values($filteredOptionsHi) :
                            array_values($filteredOptionsEn),
                        'correct_option' => $correctOptionHi,
                        'solution' => $this->solution_hi ?: ($this->solution_en ?: null),
                    ]
                ]),
            ]);

            session()->flash('success', 'Question added successfully!');

            // Reset form
            $this->reset([
                'question_en',
                'question_hi',
                'options_en',
                'options_hi',
                'correct_option_en',
                'correct_option_hi',
                'solution_en',
                'solution_hi',
                'translationErrors',
                'translationStatus',
                'translationFailed'
            ]);

            $this->options_en = ['', '', '', ''];
            $this->options_hi = ['', '', '', ''];
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to save question: ' . $e->getMessage());
            Log::error('Question save error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.examiner.add-question');
    }
}
