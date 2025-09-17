<?php

namespace App\Livewire\Teacher;

use App\Models\ClassCategory;
use App\Models\Level;
use App\Models\Subject;
use App\Models\TeacherUnlockedLevel;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
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
        } else {
            $this->unlockedLevels = [];
            
            // If user doesn't have a teacher record, redirect or show error
            // You might want to handle this case differently based on your app logic
            if ($user && !$user->teacher) {
                session()->flash('error', 'Teacher profile not found. Please complete your teacher profile.');
            }
        }
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

        // Get all levels but mark which ones are unlocked
        $this->levels = Level::select('id', 'name', 'description', 'order')
            ->orderBy('order', 'asc')
            ->get()
            ->map(function($level) {
                $level->is_unlocked = $this->isLevelUnlocked($level->id);
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
        
        // Check if teacher has this level unlocked using the relationship
        if ($user->teacher->hasUnlockedLevel($levelId)) {
            return true;
        }
        
        // For other levels, check if previous level is completed
        $level = Level::find($levelId);
        $previousLevel = Level::where('order', $level->order - 1)->first();
        
        if ($previousLevel && $user->teacher->hasUnlockedLevel($previousLevel->id)) {
            return true;
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
        // Check if user has a teacher profile before proceeding
        $user = Auth::user();
        if ($user == 1) {
            session()->flash('error', 'Please complete your teacher profile before starting an exam.');
            return;
        }
        
        return redirect()->route('teacher.exam-portal', [
            $this->selection['category_id'], 
            $this->selection['subject_id'], 
            $this->selection['level_id']
        ]);
    }

    #[Layout('layouts.teacher')]
    public function render()
    {
        $this->categories = ClassCategory::select('name', 'id')->get();
        
        return view('livewire.teacher.dashboard', [
            'categories' => $this->categories,
            'subjects' => $this->subjects,
            'levels' => $this->levels,
            'step' => $this->step,
            'selection' => $this->selection,
        ]);
    }
}





// <?php

// namespace App\Livewire\Teacher;

// use App\Models\ClassCategory;
// use App\Models\Level;
// use App\Models\Subject;
// use App\Models\TeacherUnlockedLevel; 
// use Livewire\Attributes\Layout;
// use Livewire\Component;

// class Dashboard extends Component
// {
//     public $selectedClassCategory;
//     public $selectedCategoryName;
//     public $selectedSubject;
//     public $selectedSubjectName;
//     public $selectedLevel;
//     public $selectedLevelName;
//     public $subjects = [];
//     public $levels = [];
//     public $categories;
//     public $step = 'category';
//      public $unlockedLevels = [];


//     public $selection = [
//         'category_id' => null,
//         'category_name' => null,
//         'subject_id' => null,
//         'subject_name' => null,
//         'level_id' => null,
//         'level_name' => null,
//     ];

// //     public function mount()
// // {
//     // Get all levels the teacher has unlocked
//     // $teacherId = auth()->user()->teacher->id;
//     // $this->unlockedLevels = TeacherUnlockedLevel::where('teacher_id', $teacherId)
//     //     ->pluck('level_id')
//     //     ->toArray();
    
//         //   $this->unlockedLevels = auth()->user()->teacher->unlockedLevels()
//         // ->pluck('level_id')
//         // ->toArray();
// // }

//     public function mount()
//     {
//         // Safely get unlocked levels, handling cases where teacher doesn't exist
//         $teacher = auth()->user()->teacher;
//         $this->unlockedLevels = $teacher ? 
//             $teacher->unlockedLevels()->pluck('level_id')->toArray() : [];
//     }

//     public function updateCategory($id)
//     {
//         $category = ClassCategory::findOrFail($id);

//         $this->selection['category_id'] = $category->id;
//         $this->selection['category_name'] = $category->name;

//         $this->subjects = Subject::where('category_id', $id)->get();
//         $this->step = 'subject';
//     }

//    public function updateSubject($id)
// {
//     $subject = Subject::findOrFail($id);

//     $this->selection['subject_id'] = $subject->id;
//     $this->selection['subject_name'] = $subject->subject_name;

//     // Get all levels but mark which ones are unlocked
//     $this->levels = Level::select('id', 'name', 'description', 'order')
//         ->orderBy('order', 'asc')
//         ->get()
//         ->map(function($level) {
//             $level->is_unlocked = $this->isLevelUnlocked($level->id);
//             return $level;
//         });
        
//     $this->step = 'level';
// }

//     public function updateLevel($id)
// {
//     $level = Level::findOrFail($id);

//     // Check if level is unlocked
//     if (!$this->isLevelUnlocked($id)) {
//         session()->flash('error', 'This level is locked. Complete previous levels first.');
//         return;
//     }

//     $this->selection['level_id'] = $level->id;
//     $this->selection['level_name'] = $level->name;

//     $this->step = 'confirm';
// }

// // private function isLevelUnlocked($levelId)
// // {
// //     // Level 1 is always unlocked
// //     if ($levelId == 1) return true;
    
// //     // Check if teacher has this level unlocked using the relationship
// //     if (auth()->user()->teacher->hasUnlockedLevel($levelId)) {
// //         return true;
// //     }
    
// //     // For other levels, check if previous level is completed
// //     $level = Level::find($levelId);
// //     $previousLevel = Level::where('order', $level->order - 1)->first();
    
// //     if ($previousLevel && auth()->user()->teacher->hasUnlockedLevel($previousLevel->id)) {
// //         return true;
// //     }
    
// //     return false;
// // }

//  private function isLevelUnlocked($levelId)
//     {
//         // If user has no teacher record, only level 1 is accessible
//         $teacher = auth()->user()->teacher;
//         if (!$teacher) {
//             return $levelId == 1;
//         }
        
//         // Level 1 is always unlocked
//         if ($levelId == 1) return true;
        
//         // Check if teacher has this level unlocked using the relationship
//         if ($teacher->hasUnlockedLevel($levelId)) {
//             return true;
//         }
        
//         // For other levels, check if previous level is completed
//         $level = Level::find($levelId);
//         $previousLevel = Level::where('order', $level->order - 1)->first();
        
//         if ($previousLevel && $teacher->hasUnlockedLevel($previousLevel->id)) {
//             return true;
//         }
        
//         return false;
//     }


//     public function goBack()
//     {
//         if ($this->step === 'confirm') {
//             $this->step = 'level';
//             $this->selection['level_id'] = null;
//             $this->selection['level_name'] = null;
//         } elseif ($this->step === 'level') {
//             $this->step = 'subject';
//             $this->selection['subject_id'] = null;
//             $this->selection['subject_name'] = null;
//         } elseif ($this->step === 'subject') {
//             $this->step = 'category';
//             $this->selection['category_id'] = null;
//             $this->selection['category_name'] = null;
//             $this->subjects = [];
//         }
//     }
//     public function startExam()
//     {
//         return redirect()->route('teacher.exam-portal', [$this->selection['category_id'], $this->selection['subject_id'], $this->selection['level_id']]);
//     }
//     #[Layout('layouts.teacher')]
//     public function render()
//     {
//         $this->categories = ClassCategory::select('name', 'id')->get();
//         return view('livewire.teacher.dashboard', [
//             'categories' => $this->categories,
//             'subjects' => $this->subjects,
//             'levels' => $this->levels,
//             'step' => $this->step,
//             'selection' => $this->selection,
//         ]);
//     }
// }