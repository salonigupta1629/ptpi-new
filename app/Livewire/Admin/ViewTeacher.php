<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Teacher;

class ViewTeacher extends Component
{
    public $teacher;
    
    public function mount($teacherId)
    {
        $this->teacher = Teacher::with([
            'user', 
            'qualifications.qualification', 
            'subjects.subject', 
            'addresses'
        ])->findOrFail($teacherId);
    }
    
    public function render()
    {
        return view('livewire.admin.view-teacher')->layout('layouts.admin');
    }
}