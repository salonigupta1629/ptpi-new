<?php

namespace App\Livewire\Teacher\Exam;

use App\Models\ClassCategory;
use App\Models\ExamSet;
use App\Models\Level;
use App\Models\Question;
use App\Models\Subject;
use App\Models\UserAnswer;
use Livewire\Attributes\Layout;
use App\Models\ExamAttempt; 
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
    public $timeLeft = 30;
    public $timerActive = true;
    public $fullScreen = false; 

    public $score = 0;
    public $correctCount = 0;
    public $totalQuestions = 0;
    public $examStatus = 'in_progress';
    public $showInstructions = true; 

    public $tabSwitchCount = 0;
    public $maxTabSwitches = 3;
    public $showWarningModal = false;
    public $warningMessage = '';
    public $selectedLanguage = 'english'; 
 public $agreedToGuidelines = false;

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

        $this->categoryId = $category;
        $this->subjectId = $subject;

        $this->examSets = ExamSet::where('level_id', $level)
            ->where('category_id', $category)
            ->where('subject_id', $subject)->first();
        $this->examSetId = $this->examSets->id;

        $this->questions = Question::where('exam_set_id', $this->examSetId)->orderBy('id')->get();
        $this->correctAnswers = $this->questions->pluck('correct_option', 'id')->toArray();

        foreach ($this->questions as $question) {
            $this->selectedOption[$question->id] = $this->answers[$question->id] ?? null;
        }
    }

    public function startExam()
    {
        $this->showInstructions = false; 
        $this->fullScreen = true;
        $this->timerActive = true;
        $this->dispatch('start-exam-mode');
        $this->dispatch('start-timer', duration: $this->timeLeft);
    }

    public function exitExam()
    {
        $this->fullScreen = false;
        $this->timerActive = false;
        $this->dispatch('exit-exam-mode');
    }

    public function startTimer()
    {
        $this->timerActive = true;
        $this->dispatch('start-timer', duration: $this->timeLeft);
    }

    public function decrementTime()
    {
        if ($this->timeLeft > 0 && $this->timerActive) {
            $this->timeLeft--;
            
            if ($this->timeLeft === 0) {
                $this->timerActive = false;
                $this->submitExam();
            }
        }
    }

    public function formatTime($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
        
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function prevQuestion()
    {
        $currentQuestion = $this->questions[$this->currentIndex];
        $this->answers[$currentQuestion->id] = $this->selectedOption[$currentQuestion->id] ?? null;
        
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
            $newCurrentQuestion = $this->questions[$this->currentIndex];
            $this->selectedOption[$newCurrentQuestion->id] = $this->answers[$newCurrentQuestion->id] ?? null;
        }
    }
    
    public function nextQuestion()
    {
        $currentQuestion = $this->questions[$this->currentIndex];
        $this->answers[$currentQuestion->id] = $this->selectedOption[$currentQuestion->id] ?? null;
        
        if ($this->currentIndex < $this->questions->count() - 1) {
            $this->currentIndex++;
            $newCurrentQuestion = $this->questions[$this->currentIndex];
            $this->selectedOption[$newCurrentQuestion->id] = $this->answers[$newCurrentQuestion->id] ?? null;
        }
    }
    
public function submitExam()
{
    $this->timerActive = false;
    $this->fullScreen = false;
    $this->dispatch('exit-exam-mode');
    
    $currentQuestion = $this->questions[$this->currentIndex];
    $this->answers[$currentQuestion->id] = $this->selectedOption[$currentQuestion->id] ?? null;
    
    $this->calculateResult();

    // Get authenticated user ID or use the first available user
    $userId = auth()->id();
    
    if ($userId === null) {
        // Use the first user from your database as fallback
        $userId = \App\Models\User::first()->id; // This will use user ID 1
    }

    // First, create or get an exam attempt
    $examAttempt = ExamAttempt::firstOrCreate(
        [
            'user_id' => $userId, // Use the determined user ID
            'exam_set_id' => $this->examSetId,
            'status' => 'in_progress'
        ],
        [
            'language' => $this->selectedLanguage,
            'started_at' => now()
        ]
    );

    // Then use exam_attempt_id instead of user_id
    foreach ($this->questions as $question) {
        $selected = $this->answers[$question->id] ?? null;

        if($selected != null){
            UserAnswer::updateOrCreate(
                [
                    'exam_attempt_id' => $examAttempt->id,
                    'question_id' => $question->id,
                ],
                [
                    'selected_option' => $selected,
                    'is_correct' => $selected === $this->correctAnswers[$question->id],
                    'marks_awarded' => $selected === $this->correctAnswers[$question->id] ? 1 : 0,
                ]
            );
        }
    }

    // Update the exam attempt when submitting
    $examAttempt->update([
        'score' => $this->score,
        'status' => $this->examStatus,
        'ended_at' => now(),
        'language' => $this->selectedLanguage,
    ]);
   
    session()->put('exam_results', [
        'score' => $this->score,
        'correctCount' => $this->correctCount,
        'totalQuestions' => $this->totalQuestions,
        'examStatus' => $this->examStatus,
        'subjectName' => $this->subjectName,
        'levelName' => $this->levelName,
        'categoryName' => $this->categoryName,
        'examSetId' => $this->examSetId,
        'categoryId' => $this->categoryId,   
        'subjectId' => $this->subjectId,    
        'levelId' => $this->levelId, 
        'language' => $this->selectedLanguage,
        'examAttemptId' => $examAttempt->id,
    ]);

    return $this->redirect(route('teacher.exam.results'), navigate: true);
}

    public function calculateResult()
    {
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
        $this->score = $score;
        $this->correctCount = $correctCount;
        $this->totalQuestions = $totalQuestions;
        $this->result = "Score: $correctCount/$totalQuestions (" . round($score, 2) . "%) - " . 
                       ($score >= 60 ? "Passed" : "Failed");
    }

    public function backToDashboard()
    {
        return redirect()->route('teacher.dashboard');
    }

    public function showWarning($message)
    {
        $this->warningMessage = $message;
        $this->showWarningModal = true;
    }

    public function exitExamWithSubmit()
    {
        $this->examStatus = 'exited';
        $this->submitExam();
    }

public function incrementTabSwitchCount()
{
    $this->tabSwitchCount++;
    
    if ($this->tabSwitchCount >= $this->maxTabSwitches) {
        $this->examStatus = 'exited';
        $this->submitExam();
    } else {
        $remaining = $this->maxTabSwitches - $this->tabSwitchCount;
        $this->warningMessage = "Warning: You have switched tabs/windows. $remaining attempts remaining before automatic submission.";
        $this->showWarningModal = true;
    }
}

public function closeWarning()
{
    $this->showWarningModal = false;
    $this->warningMessage = '';
}

    #[Layout('layouts.default')]
    public function render()
    {
        return view('livewire.teacher.exam.exam-portal');
    }
}