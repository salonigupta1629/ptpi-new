<?php

namespace App\Livewire\Recruiter\Component;

use Livewire\Component;

class Sidebar extends Component
{
    public $pincode = '';
    public $district = '';
    public $block = '';
    public $village = '';
    public $education = [];
    public $classCategory = [];
    public $subjects = [];
    public $skills = [];

    public function applyFilters()
    {
        $this->dispatch('apply-sidebar-filters', [
            'pincode' => $this->pincode,
            'district' => $this->district,
            'block' => $this->block,
            'village' => $this->village,
            'education' => $this->education,
            'classCategory' => $this->classCategory,
            'subjects' => $this->subjects,
            'skills' => $this->skills,
        ]);
    }

    public function clearFilters()
    {
        $this->pincode = '';
        $this->district = '';
        $this->block = '';
        $this->village = '';
        $this->education = [];
        $this->classCategory = [];
        $this->subjects = [];
        $this->skills = [];
        
        $this->dispatch('clear-sidebar-filters');
    }

    public function render()
    {
        return view('livewire.recruiter.component.sidebar');
    }
}