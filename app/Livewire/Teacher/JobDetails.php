<?php

namespace App\Livewire\Teacher;

use App\Models\ClassCategory;
use App\Models\EducationalQualification;
use App\Models\Preference;
use App\Models\Role;
use App\Models\Skill;
use App\Models\Subject;
use App\Models\TeacherClassCategory;
use App\Models\TeacherExperiences;
use App\Models\TeacherJobType;
use App\Models\TeacherQualification;
use App\Models\TeacherSkill;
use App\Models\TeacherSubject;
use Illuminate\Support\Facades\Auth;
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

    public $teacherQualification;
    public $teacherSkills;
    public $qualifications;
    public $institute;
    public $qualification;
    public $session;
    public $year_of_passing;
    public $board_or_university;
    public $grade_or_percentage;
    public $qualification_subjects = [], $subject_name, $marks;

    public $searchSkill = '', $isSearching = false, $skills = [];
    public function updatedSearchSkill()
    {
        $this->isSearching = true;
        if (strlen($this->searchSkill) > 1) {
            $this->skills = Skill::where('name', 'like', '%' . $this->searchSkill . '%')->take(5)->get();
        } else {
            $this->skills = [];
        }
        $this->isSearching = false;
    }

    public function createSkill($id){
        TeacherSkill::create([
            'user_id' => Auth::id(),
            'skill_id' => $id,
            'proficiency_level' => 'advance',
            'years_of_experience' => 2
        ]);
        $this->teacherSkills = TeacherSkill::where('user_id', Auth::id())->get();
        $this->dispatch('notify',message:'Skill Added Successfully');
    }

    public function removeSkill($id){
        TeacherSkill::find($id)?->delete();
        $this->teacherSkills = TeacherSkill::where('user_id', Auth::id())->get();
        $this->dispatch('notify-error', message: 'Skill Removed');
    }

    public function addSubject()
    {
        $this->validate([
            'subject_name' => 'required|string',
            'marks' => 'required|numeric|min:10|max:100'
        ]);

        $this->qualification_subjects[] = [
            'subject_name' => $this->subject_name,
            'marks' => $this->marks,
        ];

        $this->subject_name = '';
        $this->marks = '';
    }
    public function removeSubject($index)
    {
        unset($this->qualification_subjects[$index]);
        $this->qualification_subjects = array_values($this->qualification_subjects);
    }
    public function saveEducation()
    {
        $this->validate([
            'institute' => 'required|string|max:255',
            'qualification' => 'required|integer',
            'session' => 'required|regex:/^\d{4}-\d{2,4}$/',
            'year_of_passing' => 'required|digits:4|integer|min:1900|max:2100',
            'board_or_university' => 'required|string|max:255',
            'grade_or_percentage' => 'required|string|max:50',
            'qualification_subjects' => 'required|array|min:1',
        ]);
        TeacherQualification::create([
            'user_id' => Auth::id(),
            'qualification_id' => $this->qualification,
            'institution' => $this->institute,
            'board_or_university' => $this->board_or_university,
            'session' => $this->session,
            'year_of_passing' => $this->year_of_passing,
            'grade_or_percentage' => $this->grade_or_percentage,
            'subjects' => json_encode($this->qualification_subjects),
        ]);
        $this->teacherQualification = TeacherQualification::where('user_id', Auth::id())->get();
        $this->dispatch('notify', message: 'Education created Successfully');
        $this->resetForm();
    }
    public function deleteQualification($id)
    {
        TeacherQualification::find($id)->delete();
        $this->dispatch('notify-error', message: 'Qualification Deleted');

    }

    public function mount()
    {
        $userId = Auth::id();
        $this->classCategories = ClassCategory::all();
        $this->jobRoles = Role::all();
        $this->jobTypes = TeacherJobType::all();
        $this->preference = Preference::where('user_id', $userId)->first();

        // Fix: If no preference, set defaults to avoid job_role_id error
        $this->selectedJobRole = $this->preference?->job_role_id ?? ($this->jobRoles->first()->id ?? null);
        $this->selectedJobType = $this->preference?->teacher_job_type_id ?? ($this->jobTypes->first()->id ?? null);

        $this->selectedCategory = TeacherClassCategory::where('user_id', $userId)
            ->pluck('class_category_id');
        $this->selectedSubject = TeacherSubject::where('user_id', $userId)
            ->pluck('subject_id');
        $this->teacherExperience = TeacherExperiences::where('user_id', $userId)->get();

        $this->qualifications = EducationalQualification::all();
        $this->teacherQualification = TeacherQualification::where('user_id', $userId)->get();
        $this->teacherSkills = TeacherSkill::where('user_id', $userId)->get();
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
                        'category_name' => $sub->category->name,
                    ];
                });
            })
            ->toArray();
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
                        'category_name' => $sub->category->name,
                    ];
                });
            })
            ->toArray();
    }
    public function createOrUpdatePreference()
    {
        $userId = Auth::id();
        TeacherClassCategory::where('user_id', $userId)->delete();

        foreach ($this->selectedCategory as $categoryId) {
            TeacherClassCategory::create([
                'user_id' => $userId,
                'class_category_id' => $categoryId,
            ]);
        }
        Preference::updateOrCreate(
            ['user_id' => $userId],
            [
                'job_role_id' => $this->selectedJobRole,
                'teacher_job_type_id' => $this->selectedJobType
            ]
        );

        TeacherSubject::where('user_id', $userId)->delete();
        foreach ($this->selectedSubject as $subjectId) {
            TeacherSubject::create([
                'user_id' => $userId,
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

            'session.regex' => 'Session format must be YYYY-YY or YYYY-YYYY',
            'qualification_subjects.required' => 'Please add at least one subject with marks.',
        ];
    }
    public function saveExperience()
    {
        $userId = Auth::id();
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
                'user_id' => $userId,
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
        $this->dispatch('notify-error', message: 'Experience Deleted');
    }

    public function resetForm()
    {
        $this->reset(['institution', 'selectedRole', 'start_date', 'end_date', 'achievements', 'description', 'editingId', 'institute', 'grade_or_percentage', 'board_or_university', 'session', 'year_of_passing', 'qualification', 'qualification_subjects']);
        $this->dispatch('close-form');
    }

    #[Layout('layouts.teacher')]
    public function render()
    {
        $this->teacherExperience = TeacherExperiences::where('user_id', Auth::id())->get();
        return view('livewire.teacher.job-details');
    }
}
