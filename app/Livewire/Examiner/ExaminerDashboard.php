<?php

namespace App\Livewire\Examiner;

use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.examiner')]

class ExaminerDashboard extends Component
{
    public function render()
    {
        return view('livewire.examiner.examiner-dashboard');
    }
}
