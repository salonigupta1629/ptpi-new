<?php

namespace App\Livewire\Teacher;

use App\Models\Skill;
use Livewire\Attributes\Layout;
use Livewire\Component;

class JobDetails extends Component
{
    // public $searchSkill = '';
    // public $skills = [];
    // public $selectedSkill = null;
    public $currentlyWorking = false;

     public $query = '';
    public $skills = [];
    public $selectedSkill = null;

    public function updatedQuery()
    {
        $this->skills = Skill::where('name', 'like', '%' . $this->query . '%')
            ->limit(5)
            ->get();
    }

    public function selectSkill($id)
    {
        $this->selectedSkill = Skill::find($id);
        $this->query = $this->selectedSkill->name;
        $this->skills = []; // clear dropdown
    }

    #[Layout('layouts.teacher')]
    public function render()
    {
        return view('livewire.teacher.job-details');
    }
}
