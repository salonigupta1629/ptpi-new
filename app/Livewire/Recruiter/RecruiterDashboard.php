<?php

namespace App\Livewire\Recruiter;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Pest\Support\View;

#[Layout('layouts.recruiter')]
class RecruiterDashboard extends Component
{
    public function render()
    {
        return View('livewire.recruiter.recruiter-dashboard');
    }
}
