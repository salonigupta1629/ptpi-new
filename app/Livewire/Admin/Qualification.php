<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\EducationalQualification;
use Illuminate\Validation\Rule;

class Qualification extends Component
{

     public $name;
    public $description;
    public $qualificationId;

    public $isEditing = false;
    public $showModal = false;

    public function openModal()
    {
        $this->resetInput();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('educational_qualifications', 'name')->ignore($this->qualificationId)],
            'description' => 'nullable|string',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->isEditing && $this->qualificationId) {
            $q = EducationalQualification::findOrFail($this->qualificationId);
            $q->update($validated);
            session()->flash('message', 'Qualification updated successfully!');
        } else {
            EducationalQualification::create($validated);
            session()->flash('message', 'Qualification created successfully!');
        }

        $this->closeModal();
        $this->resetInput();
    }

    public function edit($id)
    {
        $q = EducationalQualification::findOrFail($id);
        $this->qualificationId = $q->id;
        $this->name = $q->name;
        $this->description = $q->description;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function delete($id)
    {
        EducationalQualification::destroy($id);
        session()->flash('message', 'Qualification deleted!');
    }

    public function resetInput()
    {
        $this->qualificationId = null;
        $this->name = '';
        $this->description = '';
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.admin.qualification', [
            'qualifications' => EducationalQualification::latest()->get(),
        ])->layout('layouts.admin');
    }
}

