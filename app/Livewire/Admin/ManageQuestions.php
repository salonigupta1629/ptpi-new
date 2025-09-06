<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ExamSet;
use App\Models\Question;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Http;

class ManageQuestions extends Component
{
    public ExamSet $examSet;
    public $questions = [];
    public $isModalOpen = false;
    public $editingQuestionId = null;
    public $selectedLanguage = 'en';
    public $availableLanguages = ['en' => 'English', 'hi' => 'Hindi'];

    #[Validate('required|string')]
    public $question_text = '';

    #[Validate('required|array|min:2')]
    public $options = [];

    #[Validate('required|string')]
    public $correct_options = '';

    public function mount($examId)
    {
        $this->examSet = ExamSet::findOrFail($examId);
        $this->loadQuestions();
        $this->options = array_fill(0, 4, '');
    }

    public function loadQuestions()
    {
        $this->questions = Question::where('exam_set_id', $this->examSet->id)
            ->latest()
            ->get();
    }

    public function changeLanguage($language)
    {
        $this->selectedLanguage = $language;
        $this->loadQuestions();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->isModalOpen = false;
    }

   public function storeOrUpdate()
{
    $this->validate();

    \Log::info("Starting translation process...");
    \Log::info("Question text: " . $this->question_text);
    \Log::info("Options: " . json_encode($this->options));

    // Translate to all supported languages
    $translations = $this->translateContent();

    \Log::info("Final translations: " . json_encode($translations));

    $data = [
        'exam_set_id' => $this->examSet->id,
        'question_text' => $this->question_text,
        'options' => json_encode(array_values(array_filter($this->options))),
        'correct_option' => $this->correct_options,
        'translations' => json_encode($translations, JSON_UNESCAPED_UNICODE), // Add this flag
    ];

    if ($this->editingQuestionId) {
        Question::find($this->editingQuestionId)->update($data);
    } else {
        Question::create($data);
    }

    $this->loadQuestions();
    $this->closeModal();
    session()->flash('success', $this->editingQuestionId ? 'Question updated successfully!' : 'Question created successfully!');
}

private function translateContent()
{
    $translations = [
        'en' => [
            'question_text' => $this->question_text,
            'options' => $this->options
        ]
    ];

    // Translate to Hindi
    try {
        $hindiQuestion = $this->translateText($this->question_text, 'hi');

        $hindiOptions = [];
        foreach ($this->options as $option) {
            $hindiOptions[] = !empty($option) ? $this->translateText($option, 'hi') : '';
        }

        $translations['hi'] = [
            'question_text' => $hindiQuestion,
            'options' => $hindiOptions
        ];

        \Log::info("Hindi translation completed: ", $translations['hi']);

    } catch (\Exception $e) {
        \Log::error('Hindi translation failed: ' . $e->getMessage());
        // Fallback to English
        $translations['hi'] = [
            'question_text' => $this->question_text,
            'options' => $this->options
        ];
    }

    return $translations;
}

private function translateText($text, $targetLanguage)
{
    if (empty($text)) {
        return $text;
    }

    try {
        \Log::info("Attempting to translate: '$text' to $targetLanguage");

        $response = Http::timeout(10)->post('https://api.ptpinstitute.com/api/translator/', [
            'source' => 'en',
            'dest' => $targetLanguage,
            'text' => $text,
        ]);

        \Log::info("Translation API response status: " . $response->status());

        if ($response->successful()) {
            $responseData = $response->json();

            \Log::info("Translation API response data: ", $responseData);

            // FIX: Use the correct key 'translated' instead of 'translated_text'
            $translatedText = $responseData['translated'] ?? $text;

            \Log::info("Translated text: '$translatedText'");
            return $translatedText;
        } else {
            \Log::error("Translation API error - Status: " . $response->status() . ", Body: " . $response->body());
            return $text;
        }
    } catch (\Exception $e) {
        \Log::error('Translation failed: ' . $e->getMessage());
        return $text;
    }
}

    public function edit($id)
    {
        $question = Question::find($id);
        if ($question) {
            $this->editingQuestionId = $question->id;
            $this->question_text = $question->question_text;
            $this->options = json_decode($question->options, true);
            $this->correct_options = $question->correct_option;
            $this->isModalOpen = true;
        }
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        if ($question) {
            $question->delete();
            $this->loadQuestions();
            session()->flash('success', 'Question deleted successfully!');
        }
    }

    private function resetForm()
    {
        $this->reset(['editingQuestionId', 'question_text', 'correct_options']);
        $this->options = array_fill(0, 4, '');
    }

    public function render()
    {
      return view('livewire.admin.manage-questions')->layout('layouts.admin');
    }
}














// namespace App\Livewire\Admin;

// use Livewire\Component;
// use App\Models\ExamSet;
// use App\Models\Question;
// use Livewire\Attributes\Validate;
// use Illuminate\Support\Facades\Http;

// class ManageQuestions extends Component
// {
//     public ExamSet $examSet;
//     public $questions = [];
//     public $translatedQuestions = [];
//     public $isModalOpen = false;
//     public $editingQuestionId = null;
//     public $selectedLanguage = 'en'; // Default to English

//     #[Validate('required|string')]
//     public $question_text = '';

//     #[Validate('required|array|min:2')]
//     public $options = [];

//     #[Validate('required|string')]
//     public $correct_options = '';

//     public function mount($examId)
//     {
//         $this->examSet = ExamSet::findOrFail($examId);
//         $this->loadQuestions();
//         $this->options = array_fill(0, 4, '');
//     }

//     public function loadQuestions()
//     {
//         $this->questions = Question::where('exam_set_id', $this->examSet->id)
//             ->latest()
//             ->get()
//             ->toArray(); // Convert to array for easier manipulation
//         $this->translatedQuestions = $this->questions; // Initialize with original questions
//         if ($this->selectedLanguage !== 'en') {
//             $this->translateQuestions();
//         }
//     }

//     public function updatedSelectedLanguage($value)
//     {
//         $this->selectedLanguage = $value;
//         $this->translateQuestions();
//     }

//     public function translateQuestions()
//     {
//         if ($this->selectedLanguage === 'en') {
//             $this->translatedQuestions = $this->questions;
//             return;
//         }

//         $translated = [];
//         $translationFailed = false;
//         foreach ($this->questions as $question) {
//             $translatedQuestion = $question;

//             // Translate question_text
//             $translatedText = $this->translateText($question['question_text'], $this->selectedLanguage);
//             $translatedQuestion['question_text'] = $translatedText;
//             if ($translatedText === $question['question_text']) {
//                 $translationFailed = true;
//             }

//             // Translate options
//             $options = json_decode($question['options'], true);
//             $translatedOptions = [];
//             foreach ($options as $option) {
//                 $translatedOption = $this->translateText($option, $this->selectedLanguage);
//                 $translatedOptions[] = $translatedOption;
//                 if ($translatedOption === $option) {
//                     $translationFailed = true;
//                 }
//             }
//             $translatedQuestion['options'] = json_encode($translatedOptions);

//             $translated[] = $translatedQuestion;
//         }

//         $this->translatedQuestions = $translated;
//         if ($translationFailed) {
//             session()->flash('error', 'Some translations could not be fetched. Displaying original text.');
//         }
//     }

//     private function translateText($text, $targetLang)
//     {
//         try {
//             $response = Http::post('https://api.ptpinstitute.com/api/translator/', [
//                 'text' => $text,
//                 'source_lang' => 'en',
//                 'target_lang' => $targetLang,
//             ]);

//             if ($response->successful()) {
//                 $data = $response->json();
//                 return $data['translated_text'] ?? $text; // Fallback to original text if translation fails
//             }
//         } catch (\Exception $e) {
//             // Log error if needed: \Log::error('Translation error: ' . $e->getMessage());
//         }
//         return $text; // Fallback to original text on error
//     }

//     public function openModal()
//     {
//         $this->resetForm();
//         $this->isModalOpen = true;
//     }

//     public function closeModal()
//     {
//         $this->resetForm();
//         $this->isModalOpen = false;
//     }

//     public function storeOrUpdate()
//     {
//         $this->validate();

//         $data = [
//             'exam_set_id' => $this->examSet->id,
//             'question_text' => $this->question_text,
//             'options' => json_encode(array_values(array_filter($this->options))),
//             'correct_options' => $this->correct_options,
//         ];

//         if ($this->editingQuestionId) {
//             Question::find($this->editingQuestionId)->update($data);
//         } else {
//             Question::create($data);
//         }

//         $this->loadQuestions();
//         $this->closeModal();
//         session()->flash('success', $this->editingQuestionId ? 'Question updated successfully!' : 'Question created successfully!');
//     }

//     public function edit($id)
//     {
//         $question = Question::find($id);
//         if ($question) {
//             $this->editingQuestionId = $question->id;
//             $this->question_text = $question->question_text;
//             $this->options = json_decode($question->options, true);
//             $this->correct_options = $question->correct_options;
//             $this->isModalOpen = true;
//         }
//     }

//     public function destroy($id)
//     {
//         $question = Question::find($id);
//         if ($question) {
//             $question->delete();
//             $this->loadQuestions();
//             session()->flash('success', 'Question deleted successfully!');
//         }
//     }

//     private function resetForm()
//     {
//         $this->reset(['editingQuestionId', 'question_text', 'correct_options']);
//         $this->options = array_fill(0, 4, '');
//     }

//     public function render()
//     {
//         return view('livewire.admin.manage-questions')->layout('layouts.admin');
//     }
// }





        $questions = $this->questions->map(function ($question) {
            $translations = json_decode($question->translations, true) ?? [];

            if (isset($translations[$this->selectedLanguage])) {
                $question->display_question_text = $translations[$this->selectedLanguage]['question_text'] ?? $question->question_text;
                $question->display_options = $translations[$this->selectedLanguage]['options'] ?? json_decode($question->options, true);
            } else {
                $question->display_question_text = $question->question_text;
                $question->display_options = json_decode($question->options, true);
            }

            return $question;
        });

        return view('livewire.admin.manage-questions', [
            'displayQuestions' => $questions,
            'languages' => $this->availableLanguages
        ])->layout('layouts.admin');
    }
}
