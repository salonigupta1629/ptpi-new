<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Subject;
use App\Models\ClassCategory;
class Subjects extends Component
{

  public $subject_name, $subject_description, $subjectId;
    public $isEditing = false;
    public $showModal = false;
    public $totalCount = 0;
    public $category_id;
    public $search='';

    protected $rules = [
        'subject_name' => 'required|string|max:255',
        'subject_description' => 'nullable|string',
           'category_id' => 'nullable|exists:class_categories,id',
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
                 'category_id' => $this->category_id,
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

    // public function render()
    // {
    //       $subjects = Subject::query()
    //     ->when($this->search, function ($query) {
    //         $query->where('subject_name', 'like', '%' . $this->search . '%');
    //     })
    //     ->orderBy('created_at', 'desc')
    //     ->paginate(10);

    //     return view('livewire.admin.subjects', [
    //         'subjects' => Subject::latest()->get(),
    //          'categories' => ClassCategory::all(), 
    //     'totalCount' => Subject::count(),
    //     ])->layout('layouts.admin');
    // }

    public function render()
{
    $subjectsQuery = Subject::query()
        ->when($this->search, function ($query) {
            $query->where('subject_name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('created_at', 'desc');

    return view('livewire.admin.subjects', [
        'subjects' => $subjectsQuery->paginate(10), 
        'categories' => ClassCategory::all(), 
        'totalCount' => Subject::count(),  
    ])->layout('layouts.admin');
}
}