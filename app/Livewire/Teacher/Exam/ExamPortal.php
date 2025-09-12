<?php

namespace App\Livewire\Teacher\Exam;

use App\Models\ClassCategory;
use App\Models\ExamSet;
use App\Models\Level;
use App\Models\Question;
use App\Models\Subject;
use App\Models\UserAnswer;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ExamPortal extends Component
{
    public $categoryId, $categoryName, $subjectId, $subjectName, $levelId, $levelName;
    public $categories, $subjects, $levels;

    public $examSets, $examSetId;
    public $questions;
    public $correctAnswers = [];
    public $currentIndex = 0;
    public $selectedOption = [];
    public $answers = [];
    public $result;
    public function mount($category, $subject, $level)
    {
        $this->categories = ClassCategory::find($category);
        $this->subjects = Subject::find($subject);
        $this->levels = Level::find($level);
        $this->levelName = $this->levels->name;
        $this->subjectName = $this->subjects->subject_name;
        $this->categoryName = $this->categories->name;
        $this->subjectId = $subject;
        $this->levelId = $level;

        $this->examSets = ExamSet::where('level_id', $level)
            ->where('category_id', $category)
            ->where('subject_id', $subject)->first();
        $this->examSetId = $this->examSets->id;

        $this->questions = Question::where('exam_set_id', $this->examSetId)->orderBy('id')->get();
        $this->correctAnswers = $this->questions->pluck('correct_option', 'id')->toArray();
    }

    public function prevQuestion()
    {
        // $question = $this->questions[$this->currentIndex];
        // $this->answers[$question->id] = $this->selectedOption[$this->currentIndex] ?? null;
        $currentQuestion = $this->questions[$this->currentIndex];
$this->answers[$currentQuestion->id] = $this->selectedOption[$currentQuestion->id] ?? null;
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
        }
    }
    public function nextQuestion()
    {
        // $question = $this->questions[$this->currentIndex];
        // $this->answers[$question->id] = $this->selectedOption[$this->currentIndex] ?? null;
        $currentQuestion = $this->questions[$this->currentIndex];
$this->answers[$currentQuestion->id] = $this->selectedOption[$currentQuestion->id] ?? null;
        if ($this->currentIndex < $this->questions->count() - 1) {
            $this->currentIndex++;
        }
    }
    public function submitExam()
    {
        // $question = $this->questions[$this->currentIndex];
        // $this->answers[$question->id] = $this->selectedOption[$this->currentIndex] ?? null;
        $currentQuestion = $this->questions[$this->currentIndex];
$this->answers[$currentQuestion->id] = $this->selectedOption[$currentQuestion->id] ?? null;
        dd($this->answers, $this->correctAnswers);
        foreach ($this->questions as $question) {
    $selected = $this->answers[$question->id] ?? null;

            if($selected != null){
                UserAnswer::updateOrCreate(
                    [
                        'user_id' => 1,
                        'exam_set_id' => $this->examSetId,
                        'question_id' => $question->id,
                    ],
                    [
                        'selected_answer' => $selected,
                    ]
                    );
            }
        }
        $this->calculateResult();
    }

    public function calculateResult(){
       $correctCount = 0;
$totalQuestions = $this->questions->count();

foreach ($this->questions as $question) {
    $selectedAnswer = $this->answers[$question->id] ?? null;
    $correctAnswer = $this->correctAnswers[$question->id] ?? null;
    
    if ($selectedAnswer === $correctAnswer) {
        $correctCount++;
    }
}

$score = ($correctCount / $totalQuestions) * 100;
$this->result = "Score: $correctCount/$totalQuestions (" . round($score, 2) . "%) - " . 
               ($score >= 60 ? "Passed" : "Failed");
    }

    #[Layout('layouts.default')]
    public function render()
    {
        return view('livewire.teacher.exam.exam-portal');
    }
}
