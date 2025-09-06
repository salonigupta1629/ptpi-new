<?php

namespace App\Livewire\Recruiter;

use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.recruiter')]
class RequestTeacher extends Component
{
    public function render()
    {
        return view('livewire.recruiter.request-teacher');
    }
}
