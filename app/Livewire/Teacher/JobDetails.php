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
    public $selectedClassCategories = [];
    public $selectedJobType = [];
    public $teacherJobTypes = [];
    public $jobRoles;
    public $selectedJobRole = [];
    public $subjects = [];
    public $selectedSubjects = [];

    public function mount()
    {
        $this->classCategories = ClassCategory::all();
        $this->teacherJobTypes = TeacherJobType::all();
        $this->jobRoles = Role::all();
    }
    public function updateSubjects()
    {
        $this->subjects = Subject::where('category_id', $this->selectedClassCategories)->get();
    }
    public function check($id){
        dd($id);
    }

    public function createOrUpdatePreference(){
        Preference::updateOrCreate([
            'user_id' => 1,
            'job_role_id' => $this->selectedJobRole[0],
            'teacher_job_type_id' => $this->selectedJobType[0]
        ]);

        foreach ($this->selectedClassCategories as $selectedClassCategory) {
            TeacherClassCategory::updateOrCreate([
            'user_id' => 1,
            'class_category_id' => (int) $selectedClassCategory,
        ]);
        }
         foreach ($this->selectedSubjects as $selectedSubject) {
            TeacherSubject::updateOrCreate([
            'user_id' => 1,
            'subject_id' => (int) $selectedSubject,
        ]);
        }
        
        session()->flash('message','updated successfully');
    }

    // public function updatedQuery()
    // {
    //     $this->skills = Skill::where('name', 'like', '%' . $this->query . '%')
    //         ->limit(5)
    //         ->get();
    // }

    // public function selectSkill($id)
    // {
    //     $this->selectedSkill = Skill::find($id);
    //     $this->query = $this->selectedSkill->name;
    //     $this->skills = []; // clear dropdown
    // }

    #[Layout('layouts.teacher')]
    public function render()
    {
        return view('livewire.teacher.job-details');
    }
}
