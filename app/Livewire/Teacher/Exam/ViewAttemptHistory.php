<?php

namespace App\Livewire\Teacher\Exam;

use App\Models\ExamAttempt;
use App\Models\Question;
use App\Models\UserAnswer;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewAttemptHistory extends Component
{
    public $examSetId;
    public $attempts;
    public $questions;
    public $attemptId;
    public $user_selected_option;
    public function mount($examSet)
    {
        $this->examSetId = $examSet;
        $this->attempts = ExamAttempt::with(['examSet'])
            ->where('user_id', auth()->user()->id)
            ->where('exam_set_id', $this->examSetId)
            ->get();
        $this->attemptId = $this->attempts->first()->id;
        $this->questions = Question::with(['userAnswers' => function($q){
            $q->where('exam_attempt_id',$this->attemptId ?? null);
        }])->where('exam_set_id',$this->examSetId)->orderBy('id')->get();
    }

    #[Layout('layouts.teacher')]
    public function render()
    {
        return view('livewire.teacher.exam.view-attempt-history');
    }
}
