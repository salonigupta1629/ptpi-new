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
use App\Models\TeacherUnlockedLevel;
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
    public $selectedLanguage = ''; 
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
       $this->correctAnswers = $this->questions->mapWithKeys(function ($question) {
        return [$question->id => $question->getCorrectOption($this->selectedLanguage)];
    })->toArray();

        foreach ($this->questions as $question) {
            $this->selectedOption[$question->id] = $this->answers[$question->id] ?? null;
        }
    }

    public function updatedSelectedLanguage()
{
    // Update correct answers when language changes
    $this->correctAnswers = $this->questions->mapWithKeys(function ($question) {
        return [$question->id => $question->getCorrectOption($this->selectedLanguage)];
    })->toArray();
}

    public function startExam()
    {

         // Validate that a language is selected
    if (empty($this->selectedLanguage)) {
        session()->flash('error', 'Please select a language before starting the exam.');
        return;
    }
    
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

    // Get authenticated user
    $user = auth()->user();
    
    if (!$user) {
        session()->flash('error', 'You must be logged in to submit an exam.');
        return redirect()->route('login');
    }

    // First, create or get an exam attempt
    $examAttempt = ExamAttempt::firstOrCreate(
        [
            'user_id' => $user->id,
            'exam_set_id' => $this->examSetId,
            'status' => 'in_progress'
        ],
        [
            'language' => $this->selectedLanguage,
            'started_at' => now()
        ]
    );

    // Save user answers
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
   
   // LEVEL UNLOCKING LOGIC
$passed = $this->score >= 70; // Your passing threshold

if ($user->teacher) {
    // Always record the attempt (pass or fail)
    TeacherUnlockedLevel::updateOrCreate(
        [
            'teacher_id' => $user->teacher->id,
            'level_id' => $this->levelId
        ],
        [
            'score' => $this->score,
            'passed' => $passed
        ]
    );
    
    // If passed, unlock the next level
    if ($passed) {
        $currentLevel = Level::find($this->levelId);
        $nextLevel = Level::where('order', $currentLevel->order + 1)->first();
        
        if ($nextLevel) {
            // Automatically unlock the next level
            TeacherUnlockedLevel::firstOrCreate(
                [
                    'teacher_id' => $user->teacher->id,
                    'level_id' => $nextLevel->id
                ],
                [
                    'score' => 0,
                    'passed' => false
                ]
            );
        }
    }
}
    // END OF LEVEL UNLOCKING LOGIC
   
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
            $correctAnswer = $question->getCorrectOption($this->selectedLanguage);
            
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