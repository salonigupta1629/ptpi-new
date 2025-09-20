<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Interview extends Component
{
    public $showModal = false;

    
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.interview');
    }
}
