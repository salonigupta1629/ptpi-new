<?php

namespace App\Livewire\Teacher;

use Livewire\Attributes\Layout;
use Livewire\Component;

class JobApply extends Component
{
    #[Layout('layouts.teacher')]
    public function render()
    {
        return view('livewire.teacher.job-apply');
    }
}
