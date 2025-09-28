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
    public $latestQuestion = null;
    public $question_text;
    public $options = ['', '', '', ''];
    public $correct_option;
    public $solution;
    public $question_text_hi;
    public $options_hi = ['', '', '', ''];
    public $solution_hi;
    public $questionId;
    public $isEditing = false;
    public $examSetId;

    protected $rules = [
        'question_text' => 'required|min:3',
        'options' => 'required|array|size:4',
        'options.*' => 'required|string|min:1',
        'correct_option' => 'string|in:option1,option2,option3,option4',
        'solution' => 'nullable|string',
        'question_text_hi' => 'nullable|string|min:3',
        'options_hi' => 'nullable|array|size:4',
        'options_hi.*' => 'nullable|string|min:1',
        'solution_hi' => 'nullable|string',
    ];

    public function mount($examSetId)
    {
        $this->examSetId = $examSetId;
        $this->latestQuestion = null;
    }

    public function createQuestion()
    {
        $this->validate();

        // Use manual Hindi input if provided; otherwise, translate English to Hindi
        $questionTextHi = $this->question_text_hi ?: $this->translateText($this->question_text);
        $optionsHi = $this->options_hi[0] ? $this->options_hi : array_map(function ($option) {
            return $option ? $this->translateText($option) : '';
        }, $this->options);
        $solutionHi = $this->solution_hi ?: ($this->solution ? $this->translateText($this->solution) : null);

        Question::create([
            'exam_set_id' => $this->examSetId,
            'question_text' => $this->question_text,
            'options' => json_encode($this->options),
            'correct_option' => $this->correct_option,
            'solution' => $this->solution,
            'translations' => [
                'hi' => [
                    'question_text' => $questionTextHi,
                    'options' => $optionsHi,
                    'solution' => $solutionHi,
                ],
            ],
        ]);

        $this->resetInput();
        session()->flash('message', 'Question created successfully.');
    }

    public function editQuestion($id)
    {
        $question = Question::findOrFail($id);
        $this->questionId = $id;
        $this->question_text = $question->question_text;
        $this->options = $question->options ?? ['', '', '', ''];
        $this->correct_option = $question->correct_option;
        $this->solution = $question->solution;
        $this->question_text_hi = $question->translations['hi']['question_text'] ?? '';
        $this->options_hi = $question->translations['hi']['options'] ?? ['', '', '', ''];
        $this->solution_hi = $question->translations['hi']['solution'] ?? '';
        $this->isEditing = true;
        $this->latestQuestion = null;
    }

    public function updateQuestion()
    {
        $this->validate();

        if ($this->questionId) {
            $question = Question::find($this->questionId);

            $questionTextHi = $this->question_text_hi ?: $this->translateText($this->question_text);
            $optionsHi = $this->options_hi[0] ? $this->options_hi : array_map(function ($option) {
                return $option ? $this->translateText($option) : '';
            }, $this->options);
            $solutionHi = $this->solution_hi ?: ($this->solution ? $this->translateText($this->solution) : null);

            $question->update([
                'question_text' => $this->question_text,
                'options' => $this->options,
                'correct_option' => $this->correct_option,
                'solution' => $this->solution,
                'translations' => [
                    'hi' => [
                        'question_text' => $questionTextHi,
                        'options' => $optionsHi,
                        'solution' => $solutionHi,
                    ],
                ],
            ]);

            $this->resetInput();
            session()->flash('message', 'Question updated successfully.');
        }
    }

    public function deleteQuestion($id)
    {
        Question::find($id)->delete();
        $this->latestQuestion = null;
        session()->flash('message', 'Question deleted successfully.');
    }

    public function previewLatestQuestion()
    {
        $this->latestQuestion = Question::where('exam_set_id', $this->examSetId)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    private function translateText($text)
    {
        if (!$text) {
            return '';
        }

        try {
            $response = Http::withoutVerifying()->post("https://api.ptpinstitute.com/api/translator/", [
                "text" => $text,
                "source" => "en",
                "dest" => "hi"
            ]);

            return $response->json("translated") ?? '';
        } catch (\Exception $e) {
            session()->flash('message', 'Translation failed: ' . $e->getMessage());
            return '';
        }
    }

    public function resetInput()
    {
        $this->question_text = '';
        $this->options = ['', '', '', ''];
        $this->correct_option = '';
        $this->solution = '';
        $this->question_text_hi = '';
        $this->options_hi = ['', '', '', ''];
        $this->solution_hi = '';
        $this->questionId = null;
        $this->isEditing = false;
        $this->latestQuestion = null;
    }

    public function render()
    {
        return view('livewire.examiner.add-question');
    }
}
