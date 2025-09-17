<?php

namespace App\Livewire\Teacher;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\ExamAttempt;

class ViewAttempts extends Component
{
    #[Layout('layouts.teacher')]
    public function render()
    {
        $attempts = ExamAttempt::with(['examSet', 'user'])
            ->latest()
            ->get();

        return view('livewire.teacher.view-attempts', [
            'attempts' => $attempts
        ]);
    }
}