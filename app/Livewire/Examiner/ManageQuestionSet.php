<?php

namespace App\Livewire\Examiner;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\ExamSet;
use App\Models\Question;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.examiner')]
class ManageQuestionSet extends Component
{
    public $examSet;
    public $search = '';
    public $questions;

    public function mount($examSetId)
    {
        Log::info('Mounting ManageQuestionSet', ['examSetId' => $examSetId]);
        $this->examSet = ExamSet::with('subject')->findOrFail($examSetId);
        $this->loadQuestions();
    }

    public function loadQuestions()
    {
        $query = Question::where('exam_set_id', $this->examSet->id)
            ->orderBy('id', 'desc');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('question_text', 'like', '%' . $this->search . '%')
                    ->orWhere('solution', 'like', '%' . $this->search . '%')
                    ->orWhereRaw('JSON_UNQUOTE(JSON_EXTRACT(translations, "$.hi.question_text")) LIKE ?', ['%' . $this->search . '%'])
                    ->orWhereRaw('JSON_UNQUOTE(JSON_EXTRACT(translations, "$.hi.solution")) LIKE ?', ['%' . $this->search . '%']);
            });
        }

        $this->questions = $query->orderBy('id')->get();
        Log::info('Loaded questions', ['questions' => $this->questions->toArray()]);
    }

    public function updatedSearch()
    {
        $this->loadQuestions();
    }

    public function deleteQuestion($questionId)
    {
        $question = Question::where('exam_set_id', $this->examSet->id)->findOrFail($questionId);
        $question->delete();
        session()->flash('success', 'Question deleted successfully!');
        $this->loadQuestions();
        Log::info('Deleted question', ['questionId' => $questionId]);
    }

    public function render()
    {
        return view('livewire.examiner.manage-question-set', [
            'questions' => $this->questions,
            'examSet' => $this->examSet,
        ]);
    }
}
