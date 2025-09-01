<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Skill;
use Illuminate\Validation\Rule;

class Skills extends Component
{

    use WithPagination;

    public $name;
    public $description;
    public $skillId = null;

    public $showModal = false;
    public $isEditing = false;
    public $search = '';

    protected $paginationTheme = 'tailwind'; 

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('skills', 'name')->ignore($this->skillId),
            ],
            'description' => ['nullable', 'string'],
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

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

        if ($this->isEditing && $this->skillId) {
            $skill = Skill::findOrFail($this->skillId);
            $skill->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            session()->flash('message', 'Skill updated successfully.');
        } else {
            Skill::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            session()->flash('message', 'Skill created successfully.');
        }

        $this->closeModal();
        $this->resetPage(); 
    }

    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $this->skillId = $skill->id;
        $this->name = $skill->name;
        $this->description = $skill->description;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function delete($id)
    {
        Skill::destroy($id);
        session()->flash('message', 'Skill deleted.');
        $this->resetPageIfEmpty();
    }

    private function resetInput()
    {
        $this->skillId = null;
        $this->name = '';
        $this->description = '';
        $this->isEditing = false;
    }

    private function resetPageIfEmpty()
    {
        $current = Skill::where('name', 'like', '%' . $this->search . '%')->paginate(10, ['*'], 'page', $this->page);
        if ($current->isEmpty() && $this->page > 1) {
            $this->previousPage();
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $skills = Skill::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.skills', [
            'skills' => $skills,
        ])->layout('layouts.admin');
    }
}


