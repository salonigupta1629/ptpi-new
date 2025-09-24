<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CenterExamRequest extends Component
{
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.center-exam-request');
    }
}
