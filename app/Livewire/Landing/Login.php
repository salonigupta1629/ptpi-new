<?php

namespace App\Livewire\Landing;

use Livewire\Component;

class Login extends Component
{
    public function render()
    {
        return view('livewire.landing.login')->layout("layouts.app");
    }
}
