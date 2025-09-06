<?php

namespace App\Livewire\Admin;

use App\Models\Role;
use Livewire\Component;

class ManageRole extends Component
{
      public $name;
    public $roleId = null;

    public $isEditing = false;
    public $showModal = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:100',
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
        $this->validate();

        if ($this->isEditing && $this->roleId) {
            $role = Role::findOrFail($this->roleId);
            $role->update([
                'name' => $this->name,
            ]);
            session()->flash('message', 'role updated successfully.');
        } else {
            Role::create([
                'name' => $this->name,
            ]);
            session()->flash('message', 'role created successfully.');
        }

        $this->closeModal();
        $this->resetInput();
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function delete($id)
    {
        Role::destroy($id);
        session()->flash('message', 'Level deleted.');
    }

    public function resetInput()
    {
        $this->roleId = null;
        $this->name = '';
        $this->isEditing = false;
    }

    public function render()
    {
        $query = Role::query();
        


        $roles = $query->orderBy('created_at', 'desc')->get();

        return view('livewire.admin.manage-role', [
            'roles' => $roles,
        ])->layout('layouts.admin');
    }

}
