<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\ExamSet;
use App\Models\Question;
use Livewire\Attributes\Validate;

class ManageQuestions extends Component
{

       public ExamSet $examSet;
    public $questions = [];
    public $isModalOpen = false;
    public $editingQuestionId = null;

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

        $data = [
            'exam_set_id' => $this->examSet->id,
            'question_text' => $this->question_text,
            'options' => json_encode(array_values(array_filter($this->options))),
            'correct_options' => $this->correct_options,
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

    public function edit($id)
    {
        $question = Question::find($id);
        if ($question) {
            $this->editingQuestionId = $question->id;
            $this->question_text = $question->question_text;
            $this->options = json_decode($question->options, true);
            $this->correct_options = $question->correct_options;
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
  