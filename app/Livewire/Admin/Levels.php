<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Level;

class Levels extends Component
{
     public $name;
    public $description;
    public $levelId = null;
     public $order; 

    public $isEditing = false;
    public $showModal = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:100',
        'description' => 'nullable|string|max:2000',
         'order' => 'required|integer|min:1', 
    ];

    public function openModal()
    {
        $this->resetInput();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

  public function save()
{
    // Different validation for editing vs creating
    if ($this->isEditing && $this->levelId) {
        $this->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:2000',
            'order' => 'required|integer|min:1',
        ]);
    } else {
        $this->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:2000',
        ]);
    }

    if ($this->isEditing && $this->levelId) {
        $level = Level::findOrFail($this->levelId);
        $level->update([
            'name' => $this->name,
            'description' => $this->description,
            'order' => $this->order,
        ]);
        session()->flash('message', 'Level updated successfully.');
    } else {
        // Automatically set order to the next available number
        $maxOrder = Level::max('order') ?? 0;
        
        Level::create([
            'name' => $this->name,
            'description' => $this->description,
            'order' => $maxOrder + 1, // Add this line
        ]);
        session()->flash('message', 'Level created successfully.');
    }

    $this->closeModal();
    $this->resetInput();
}

    public function edit($id)
    {
        $level = Level::findOrFail($id);
        $this->levelId = $level->id;
        $this->name = $level->name;
        $this->description = $level->description;
           $this->order = $level->order;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function delete($id)
    {
        Level::destroy($id);
        session()->flash('message', 'Level deleted.');
    }

    public function resetInput()
    {
        $this->levelId = null;
        $this->name = '';
        $this->description = '';
         $this->order = ''; 
        $this->isEditing = false;
    }

    public function render()
    {
        $query = Level::query();

        if (trim($this->search) !== '') {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

          $levels = $query->orderBy('order', 'asc')->get(); // Change to order by 'order'

        return view('livewire.admin.levels', [
            'levels' => $levels,
        ])->layout('layouts.admin');
    }
}
   
