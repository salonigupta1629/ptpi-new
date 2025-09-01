<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Subject;

class Subjects extends Component
{

  public $subject_name, $subject_description, $subjectId;
    public $isEditing = false;
    public $showModal = false;
    public $totalCount = 0;

    protected $rules = [
        'subject_name' => 'required|string|max:255',
        'subject_description' => 'nullable|string',
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

        if ($this->isEditing) {
            $subject = Subject::findOrFail($this->subjectId);
            $subject->update([
                'subject_name' => $this->subject_name,
                'subject_description' => $this->subject_description,
            ]);
            session()->flash('message', 'Subject updated successfully!');
        } else {
            Subject::create([
                'subject_name' => $this->subject_name,
                'subject_description' => $this->subject_description,
            ]);
            session()->flash('message', 'Subject added successfully!');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $this->subjectId = $subject->id;
        $this->subject_name = $subject->subject_name;
        $this->subject_description = $subject->subject_description;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function delete($id)
    {
        Subject::destroy($id);
        session()->flash('message', 'Subject deleted!');
    }

    public function resetInput()
    {
        $this->subjectId = null;
        $this->subject_name = '';
        $this->subject_description = '';
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.admin.subjects', [
            'subjects' => Subject::latest()->get(),
            $this->totalCount = Subject::count(),
        ])->layout('layouts.admin');
    }
}