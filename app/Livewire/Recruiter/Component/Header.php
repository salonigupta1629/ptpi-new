<?php

namespace App\Livewire\Recruiter\Component;

use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    public string $query = '';

    public function updatedQuery()
    {
        $this->dispatch('searching-teachers', query: $this->query);
    }

    #[On('clear-global-search')]
    public function clear()
    {
        $this->query = '';
    }

    public function render()
    {
        return view('livewire.recruiter.component.header');
    }
}
