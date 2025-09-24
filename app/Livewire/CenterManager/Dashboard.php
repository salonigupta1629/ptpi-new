<?php

namespace App\Livewire\CenterManager;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.centermanager')]
    public function render()
    {
        return view('livewire.center-manager.dashboard');
    }
}
