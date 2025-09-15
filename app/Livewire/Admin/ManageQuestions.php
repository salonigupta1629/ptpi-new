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
   // Add this to your storeOrUpdate method before calling translateContent()
$this->validate([
    'question_text' => 'required|string',
    'options' => 'required|array|min:2',
    'options.*' => 'required|string', // Ensure each option is not empty
    'correct_options' => 'required|string|in:A,B,C,D', // Validate correct option
]);

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

        \Log::info("Hindi translation completed: ", ['question' => $hindiQuestion, 'options' => $hindiOptions]);

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
            
            $logData = is_array($responseData) ? $responseData : ['response' => $responseData];
            \Log::info("Translation API response data: ", $logData);
            
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