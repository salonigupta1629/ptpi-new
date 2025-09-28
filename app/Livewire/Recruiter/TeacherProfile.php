<?php

namespace App\Livewire\Recruiter;

use App\Models\Teacher;
use App\Models\TeacherQualification;
use App\Models\TeacherExperience;
use App\Models\TeacherSkill;
use App\Models\TeacherSubject;
use App\Models\TeacherClassCategory;
use App\Models\TeacherAddress;
use App\Models\TeacherHiring;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.recruiter')]
class TeacherProfile extends Component
{
    public $teacher;
    public $teacherId;
    public function mount($id = null)
    {
        $this->teacherId = $id;
        $this->loadTeacherData(); // No parameter needed
    }

    public function loadTeacherData()
    {
        $this->teacher = Teacher::with([
            'user',
            'addresses',
            'qualifications',
            'experiences',
            'skills',
            'subjects',
            'classCategories'
        ])->findOrFail($this->teacherId); // Use $this->teacherId
    }
    public function submit()
    {
        TeacherHiring::create([
            'teacher_id' => $this->teacherId,
            'recruiter_id' => 1,
            'status' => 'pending'
        ]);
        session()->flash('message', 'Teacher hiring request sent successfully!');
    }
    public function render()
    {
        return view('livewire.recruiter.teacher-profile', [
            'teacherData' => $this->teacher
        ]);
    }
}
