<?php

namespace App\Livewire\Teacher;

use App\Models\ClassCategory;
use App\Models\Preference;
use App\Models\Role;
use App\Models\Skill;
use App\Models\Subject;
use App\Models\TeacherClassCategory;
use App\Models\TeacherExperiences;
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

    public $institution, $selectedRole, $start_date, $end_date, $achievements, $description;
    public $teacherExperience;
    public $editingId = null;

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
        $this->teacherExperience = TeacherExperiences::where('user_id', 1)->get();
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
        $this->dispatch('notify', message: 'Preference Data updated');
    }
    public function rules()
    {
        return [
            'institution' => 'required|string|max:255',
            'selectedRole' => 'required|exists:roles,id',
            'start_date' => 'required|date|unique:teacher_experiences,start_date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'achievements' => 'nullable|string|max:1000',
            'description' => 'required|string|max:2000',
        ];
    }
    public function messages()
    {
        return [
            'institution.required' => 'Institution name is required.',
            'selectedRole.required' => 'Please select a job role.',
            'start_date.required' => 'Start date is required.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',
        ];
    }
    public function saveExperience()
    {

        if ($this->currentlyWorking == true) {
            $this->end_date = now();
        }
        if ($this->editingId) {
            $experience = TeacherExperiences::find($this->editingId);
            $experience->update([
                'role_id' => $this->selectedRole,
                'institution' => $this->institution,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'description' => $this->description,
                'achievements' => $this->achievements
            ]);
            $this->dispatch('notify', message: 'Experience Updated Successfully');
            $this->resetForm();

        } else {
            $this->validate();
            TeacherExperiences::create([
                'user_id' => 1,
                'role_id' => $this->selectedRole,
                'institution' => $this->institution,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'description' => $this->description,
                'achievements' => $this->achievements
            ]);
            $this->dispatch('notify', message: 'Experience Added Successfully');
            $this->resetForm();
        }

    }
    public function editExperience($id)
    {
        $experience = TeacherExperiences::find($id);

        $this->editingId = $experience->id;
        $this->institution = $experience->institution;
        $this->selectedRole = $experience->role_id;
        $this->start_date = $experience->start_date;
        $this->end_date = $experience->end_date;
        $this->achievements = $experience->achievements;
        $this->description = $experience->description;

        $this->dispatch('open-form');
    }
    public function deleteExperience($id)
    {
        TeacherExperiences::find($id)->delete();
    }

    public function resetForm()
    {
        $this->reset(['institution', 'selectedRole', 'start_date', 'end_date', 'achievements', 'description', 'editingId']);
        $this->dispatch('close-form');
    }

    #[Layout('layouts.teacher')]
    public function render()
    {
        $this->teacherExperience = TeacherExperiences::where('user_id', 1)->get();

        return view('livewire.teacher.job-details');
    }
}
