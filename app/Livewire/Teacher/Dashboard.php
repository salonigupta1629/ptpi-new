<?php

namespace App\Livewire\Teacher;

use App\Models\ExamAttempt;
use App\Models\ExamSet;
use App\Models\ClassCategory;
use App\Models\Level;
use App\Models\Subject;
use App\Models\InterviewSchedule;
use App\Models\TeacherUnlockedLevel;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Dashboard extends Component
{

    public $subjectsForFilter = [];
    public $selectedClassCategory;
    public $selectedCategoryName;
    public $selectedSubject;
    public $selectedSubjectName;
    public $selectedLevel;
    public $selectedLevelName;
    public $subjects = [];
    public $levels = [];
    public $categories;
    public $step = 'category';
    public $unlockedLevels = [];
    public $hasQualifiedLevel2 = false;
    

    public $qualifiedExams = [];
public $myInterviews = [];
public $interviewFilters = [
    'subject' => 'all',
    'category' => 'all',
    'status' => 'all'
];


    public $selection = [
        'category_id' => null,
        'category_name' => null,
        'subject_id' => null,
        'subject_name' => null,
        'level_id' => null,
        'level_name' => null,
    ];

 public function mount()
    {
        // Check if user is authenticated and has a teacher record
        $user = Auth::user();
        
        if ($user && $user->teacher) {
            $this->unlockedLevels = $user->teacher->unlockedLevels()
                ->pluck('level_id')
                ->toArray();
            
            // Check if teacher has qualified Level 2
            $level2Unlock = TeacherUnlockedLevel::where('teacher_id', $user->teacher->id)
                ->where('level_id', 2) // Assuming Level 2 has ID 2
                ->where('passed', true)
                ->first();
            
            $this->hasQualifiedLevel2 = (bool) $level2Unlock;
            
            // Load qualified exams and interviews if teacher has qualified Level 2
            if ($this->hasQualifiedLevel2) {
                $this->loadQualifiedExams();
                $this->loadMyInterviews();
            }
        } else {
            $this->unlockedLevels = [];
            $this->hasQualifiedLevel2 = false;
            
            // If user doesn't have a teacher record, redirect or show error
            if ($user && !$user->teacher) {
                session()->flash('error', 'Teacher profile not found. Please complete your teacher profile.');
            }
        }
    }

 private function loadQualifiedExams()
{
    $user = Auth::user();
    
    if (!$user || !$user->teacher) {
        $this->qualifiedExams = [];
        return;
    }

    try {
        $examAttempts = ExamAttempt::with(['examSet.subject', 'examSet.level', 'examSet.category'])
            ->where('user_id', $user->id)
            ->where('score', '>=', 70)
            ->get();

        // Group by subject and keep only the best attempt for each subject
        $groupedExams = [];
        
        foreach ($examAttempts as $attempt) {
            if (!$attempt->examSet || !$attempt->examSet->level || $attempt->examSet->level->order != 2) {
                continue;
            }
            
            $subjectId = $attempt->examSet->subject_id;
            
            // If we haven't seen this subject yet, or this attempt has a higher score
            if (!isset($groupedExams[$subjectId]) || $attempt->score > $groupedExams[$subjectId]['score']) {
                $groupedExams[$subjectId] = [
                    'id' => $attempt->id,
                    'exam_set_id' => $attempt->exam_set_id,
                    'subject' => $attempt->examSet->subject->subject_name ?? 'Unknown Subject',
                    'category' => $attempt->examSet->category->name ?? 'Unknown Category',
                    'score' => $attempt->score,
                    'completed_at' => $attempt->ended_at,
                    'level' => $attempt->examSet->level->name ?? 'Level 2'
                ];
            }
        }
        
        $this->qualifiedExams = array_values($groupedExams);
        
        \Log::info('Unique qualified Level 2 exams found: ' . count($this->qualifiedExams));

    } catch (\Exception $e) {
        \Log::error('Error loading qualified exams: ' . $e->getMessage());
        $this->qualifiedExams = [];
    }
}

    public function updateInterviewFilters($filterType, $value)
    {
        $this->interviewFilters[$filterType] = $value;
        // Reload interviews when filters change
        $this->loadMyInterviews();
    }


    public function updateCategory($id)
    {
        $category = ClassCategory::findOrFail($id);

        $this->selection['category_id'] = $category->id;
        $this->selection['category_name'] = $category->name;

        $this->subjects = Subject::where('category_id', $id)->get();
        $this->step = 'subject';
    }

    public function updateSubject($id)
{
    $subject = Subject::findOrFail($id);

    $this->selection['subject_id'] = $subject->id;
    $this->selection['subject_name'] = $subject->subject_name;

    // Get all levels but mark which ones are unlocked and have questions
    $this->levels = Level::select('id', 'name', 'description', 'order')
        ->orderBy('order', 'asc')
        ->get()
        ->map(function($level) {
            $level->is_unlocked = $this->isLevelUnlocked($level->id);
            $level->has_questions = $this->levelHasQuestions(
                $level->id, 
                $this->selection['subject_id'], 
                $this->selection['category_id']
            );
            return $level;
        });
        
    $this->step = 'level';
}

    public function updateLevel($id)
    {
        $level = Level::findOrFail($id);

        // Check if level is unlocked
        if (!$this->isLevelUnlocked($id)) {
            session()->flash('error', 'This level is locked. Complete previous levels first.');
            return;
        }

            // NEW: Check if level has questions
    if (!$this->levelHasQuestions($id, $this->selection['subject_id'], $this->selection['category_id'])) {
        session()->flash('error', 'This level currently has no available questions. Please try another level or check back later.');
        return;
    }

        $this->selection['level_id'] = $level->id;
        $this->selection['level_name'] = $level->name;

        $this->step = 'confirm';
    }

private function isLevelUnlocked($levelId)
{
    $user = Auth::user();
    
    // If user is not authenticated or has no teacher record, only level 1 is accessible
    if (!$user || !$user->teacher) {
        return $levelId == 1;
    }
    
    // Level 1 is always unlocked
    if ($levelId == 1) return true;
    
    // Check if teacher has this level unlocked
    $unlockedLevel = TeacherUnlockedLevel::where('teacher_id', $user->teacher->id)
        ->where('level_id', $levelId)
        ->first();
    
    if ($unlockedLevel) {
        return true; // Level is in unlocked levels table
    }
    
    // For levels beyond 1, check if previous level was passed
    $level = Level::find($levelId);
    if (!$level) return false;
    
    $previousLevel = Level::where('order', $level->order - 1)->first();
    
    if ($previousLevel) {
        $previousUnlock = TeacherUnlockedLevel::where('teacher_id', $user->teacher->id)
            ->where('level_id', $previousLevel->id)
            ->where('passed', true) // ← THIS LINE WAS ADDED
            ->first();
            
        // Unlock next level only if previous level was passed
        return $previousUnlock && $previousUnlock->passed; // ← THIS LINE WAS MODIFIED
    }
    
    return false;
}

    public function goBack()
    {
        if ($this->step === 'confirm') {
            $this->step = 'level';
            $this->selection['level_id'] = null;
            $this->selection['level_name'] = null;
        } elseif ($this->step === 'level') {
            $this->step = 'subject';
            $this->selection['subject_id'] = null;
            $this->selection['subject_name'] = null;
        } elseif ($this->step === 'subject') {
            $this->step = 'category';
            $this->selection['category_id'] = null;
            $this->selection['category_name'] = null;
            $this->subjects = [];
        }
    }
    public function startExam()
    {
        $user = Auth::user();
          if (!$user || !$user->teacher) {
            session()->flash('error', 'Please complete your teacher profile before starting an exam.');
            return;
        }

            // NEW: Final verification that the level has questions
    if (!$this->levelHasQuestions(
        $this->selection['level_id'], 
        $this->selection['subject_id'], 
        $this->selection['category_id']
    )) {
        session()->flash('error', 'This exam is not available at the moment. Please try another level.');
        return;
    }
        
        return redirect()->route('teacher.exam-portal', [
            $this->selection['category_id'], 
            $this->selection['subject_id'], 
            $this->selection['level_id']
        ]);
    }

  public function scheduleInterview($examAttemptId, $scheduledTime)
{
    try {
        \Log::info('Schedule interview called', ['examAttemptId' => $examAttemptId, 'scheduledTime' => $scheduledTime]);
        
        $user = Auth::user();
        
        if (!$user || !$user->teacher) {
            \Log::error('User or teacher not found');
            session()->flash('error', 'Teacher profile not found.');
            return;
        }

        $examAttempt = ExamAttempt::with(['examSet.subject'])->find($examAttemptId);
        
        if (!$examAttempt) {
            \Log::error('Exam attempt not found', ['examAttemptId' => $examAttemptId]);
            session()->flash('error', 'Exam attempt not found.');
            return;
        }
        
        $subjectName = $examAttempt->examSet->subject->subject_name ?? 'Unknown Subject';
        
        \Log::info('Creating interview record', [
            'teacher_id' => $user->teacher->id,
            'scheduled_at' => $scheduledTime
        ]);
        
        $interview = InterviewSchedule::create([
            'exam_attempt_id' => $examAttemptId,
            'teacher_id' => $user->teacher->id,
            'scheduled_at' => $scheduledTime,
            'requested_at' => now(),
            'status' => 'pending',
            'meeting_link' => null,
            'teacher_notes' => "Interview request for {$subjectName} - Level 2 qualification",
          'teacher_notes' => "Interview request for {$subjectName} - Level 2 qualification" 
        ]);
        
        \Log::info('Interview created successfully', ['interview_id' => $interview->id]);
        
        session()->flash('message', 'Interview request submitted! Waiting for admin approval.');
        $this->loadMyInterviews();
        
    } catch (\Exception $e) {
        \Log::error('Error scheduling interview: ' . $e->getMessage());
        session()->flash('error', 'Error scheduling interview: ' . $e->getMessage());
    }
}

private function generateMeetingLink()
{
    // Implement your meeting link generation logic
    // This could be Zoom, Google Meet, MS Teams, or custom link
    return 'https://meet.example.com/' . uniqid();
}

private function loadMyInterviews()
{
    $user = Auth::user();
    
    if (!$user || !$user->teacher) {
        $this->myInterviews = [];
        return;
    }

    $query = InterviewSchedule::with(['examAttempt.examSet.subject', 'examAttempt.examSet.category'])
        ->where('teacher_id', $user->teacher->id);

    // Apply subject filter
    if ($this->interviewFilters['subject'] !== 'all') {
        $query->whereHas('examAttempt.examSet.subject', function($q) {
            $q->where('subject_name', $this->interviewFilters['subject']);
        });
    }

    // Apply category filter
    if ($this->interviewFilters['category'] !== 'all') {
        $query->whereHas('examAttempt.examSet.category', function($q) {
            $q->where('name', $this->interviewFilters['category']);
        });
    }

    // Apply status filter
    if ($this->interviewFilters['status'] !== 'all') {
        $query->where('status', $this->interviewFilters['status']);
    }

    $this->myInterviews = $query->get()
        ->map(function($interview) {
            return [
                'id' => $interview->id,
                'exam_attempt_id' => $interview->exam_attempt_id,
                'subject' => $interview->examAttempt->examSet->subject->subject_name ?? 'Unknown Subject',
                'category' => $interview->examAttempt->examSet->category->name ?? 'Unknown Category',
                'scheduled_at' => $interview->scheduled_at,
                'status' => $interview->status,
                'meeting_link' => $interview->meeting_link,
                'notes' => $interview->notes
            ];
        })
        ->toArray();
}

public function levelHasQuestions($levelId, $subjectId, $categoryId)
{
    return ExamSet::where('level_id', $levelId)
        ->where('subject_id', $subjectId)
        ->where('category_id', $categoryId)
        ->whereHas('questions', function($query) {
            $query->where('id', '>', 0); // Simple check that questions exist
        })
        ->exists();
}

  #[Layout('layouts.teacher')]
public function render()
{
    $user = Auth::user();

    if ($user && $user->teacher) {
        // Direct query to get categories for this teacher
        $this->categories = ClassCategory::whereIn('id', function($query) use ($user) {
            $query->select('class_category_id')
                  ->from('teacher_class_categories')
                  ->where('user_id', $user->id);
        })->get();
        
        // Get subjects for filters
        $categoryIds = $this->categories->pluck('id')->toArray();
        $this->subjectsForFilter = Subject::whereIn('category_id', $categoryIds)->get();
    } else {
        $this->categories = collect([]);
        $this->subjectsForFilter = collect([]);
    }
    
    return view('livewire.teacher.dashboard', [
        'categories' => $this->categories,
        'subjects' => $this->subjects,
        'subjectsForFilter' => $this->subjectsForFilter, 
        'levels' => $this->levels,
        'step' => $this->step,
        'selection' => $this->selection,
    ]);
}

} 


