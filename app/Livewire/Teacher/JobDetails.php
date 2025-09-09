<?php

namespace App\Livewire\Teacher;

use App\Models\ClassCategory;
use App\Models\Preference;
use App\Models\Role;
use App\Models\Skill;
use App\Models\Subject;
use App\Models\TeacherClassCategory;
use App\Models\TeacherJobType;
use App\Models\TeacherSubject;
use Livewire\Attributes\Layout;
use Livewire\Component;

class JobDetails extends Component
{
    public $currentlyWorking = false;
    public $classCategories;
    public $jobRoles;
    public $jobTypes;
    public $preference;
    public $selectedJobRole = 1;
    public $selectedJobType = 1;
    public $selectedCategory = [];
    public $selectedSubject = [];
    public $subjects = [];

    public function mount()
    {
        $this->classCategories = ClassCategory::all();
        $this->jobRoles = Role::all();
        $this->jobTypes = TeacherJobType::all();
        $this->preference = Preference::where('user_id', 1)->first();
        $this->selectedJobRole = $this->preference->job_role_id;
        $this->selectedCategory = TeacherClassCategory::where('user_id', 1)
            ->pluck('class_category_id'); // get only ids
        $this->selectedSubject = TeacherSubject::where('user_id', 1)
            ->pluck('subject_id');
    }
    public function updateSubjects()
    {
        $this->subjects = Subject::whereIn('category_id', $this->selectedCategory)
            ->with('category:id,name')
            ->get()
            ->groupBy('category_id')
            ->map(function ($group) {
                return $group->map(function ($sub) {
                    return [
                        'id' => $sub->id,
                        'subject_name' => $sub->subject_name,
                        'category_id' => $sub->category_id,
                        'category_name' => $sub->category->name, // ✅ include category name
                    ];
                });
            })
            ->toArray();
        ;
    }
    public function createOrUpdatePreference()
    {
        // Remove old records first (to prevent duplicates)
        TeacherClassCategory::where('user_id', 1)->delete();

        // Insert new selected categories
        foreach ($this->selectedCategory as $categoryId) {
            TeacherClassCategory::create([
                'user_id' => 1,
                'class_category_id' => $categoryId,
            ]);
        }
        Preference::updateOrCreate(
            ['user_id' => 1],
            [
                'job_role_id' => $this->selectedJobRole,
                'teacher_job_type_id' => $this->selectedJobType
            ]
        );

        TeacherSubject::where('user_id', 1)->delete();
        foreach ($this->selectedSubject as $subjectId) {
            TeacherSubject::create([
                'user_id' => 1,
                'subject_id' => $subjectId,
            ]);
        }
        
    }

    #[Layout('layouts.teacher')]
    public function render()
    {
        return view('livewire.teacher.job-details');
    }
}
