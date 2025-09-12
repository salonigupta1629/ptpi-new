<?php
namespace App\Livewire\Examiner;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\ExamSet;

#[Layout('layouts.examiner')]
class ManageQuestionSet extends Component
{
    public $examSet;
    public $search = '';

    public function mount($examSetId)
    {
        $this->examSet = ExamSet::with('questions')->findOrFail($examSetId);
    }
    public function render()
    {
        $questions = $this->examSet->questions()
            ->when($this->search, fn($q) => $q->where('question_text', 'like', "%{$this->search}%"))
            ->get()
            ->groupBy('id'); // group english & hindi

        return view('livewire.examiner.manage-question-set', [
            'questions' => $questions,
             'examSet'   => $this->examSet,
        ]);
    }
}
