<?php

namespace App\Livewire\Teacher\Exam;

use Livewire\Component;
use Livewire\Attributes\Layout;

class ExamResult extends Component
{
          public $score = 0;
    public $correctCount = 0;
    public $totalQuestions = 0;
    public $examStatus = 'completed';
    public $subjectName = '';
    public $levelName = '';
    public $categoryName = '';
    public $submissionReason = '';

   public function mount()
    {
        $results = session()->get('exam_results');
        
        if ($results) {
            $this->score = $results['score'] ?? 0;
            $this->correctCount = $results['correctCount'] ?? 0;
            $this->totalQuestions = $results['totalQuestions'] ?? 0;
            $this->examStatus = $results['examStatus'] ?? 'completed';
            $this->subjectName = $results['subjectName'] ?? '';
            $this->levelName = $results['levelName'] ?? '';
            $this->categoryName = $results['categoryName'] ?? '';
            $this->submissionReason = $results['submissionReason'] ?? '';
            
            // session()->forget('exam_results');
        }
    }


    public function restartExam()
    {
         $results = session()->get('exam_results');
    
    if ($results && isset($results['categoryId'])) {
        return redirect()->route('teacher.exam-portal', [
            'category' => $results['categoryId'],
            'subject' => $results['subjectId'] ?? null,
            'level' => $results['levelId'] ?? null
        ]);
    }
    
    return redirect()->route('teacher.dashboard');
        // return redirect()->route('teacher.exam-instruction');
    }

    public function backToDashboard()
    {
        return redirect()->route('teacher.dashboard');
    }

    #[Layout('layouts.default')]
    public function render()
    {
        return view('livewire.teacher.exam.exam-result');
    }
}
