<?php

namespace App\Livewire\Teacher;

use App\Models\ClassCategory;
use App\Models\Level;
use App\Models\Subject;
use Livewire\Attributes\Layout;
use Livewire\Component;

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
    // public $categories;
    public $step = 'category';

    public $selection = [
        'category_id' => null,
        'category_name' => null,
        'subject_id' => null,
        'subject_name' => null,
        'level_id' => null,
        'level_name' => null,
    ];
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

        $this->levels = Level::select('id', 'name', 'description')->get();
        $this->step = 'level';
    }

    public function updateLevel($id)
    {
        $level = Level::findOrFail($id);

        $this->selection['level_id'] = $level->id;
        $this->selection['level_name'] = $level->name;

        $this->step = 'confirm';
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
        return redirect()->route('teacher.exam-instruction', [$this->selection['category_id'], $this->selection['subject_id'], $this->selection['level_id']]);
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
