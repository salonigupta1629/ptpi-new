<?php

namespace App\Livewire;

use App\Models\InterviewSchedule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Interview extends Component
{
    #[Layout('layouts.admin')]
    public function render()
    {
        $interviews = InterviewSchedule::all();
            return view('livewire.interview', compact('interviews'));
    }
}
