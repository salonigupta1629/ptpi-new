<?php

namespace App\Livewire\Teacher;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\ExamAttempt;
use App\Models\ClassCategory; 

class ViewAttempts extends Component
{
    #[Layout('layouts.teacher')]
    public function render()
    {
        $attempts = ExamAttempt::with(['examSet', 'user'])
            ->latest()
            ->get();

              $categories = ClassCategory::all();

        return view('livewire.teacher.view-attempts', [
            'attempts' => $attempts ,
              'categories' => $categories 
        ]);
    }
}