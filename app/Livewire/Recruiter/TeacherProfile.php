<?php

namespace App\Livewire\Recruiter;

use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.recruiter')]

class TeacherProfile extends Component
{
    public function render()
    {
        return view('livewire.recruiter.teacher-profile');
    }
}
