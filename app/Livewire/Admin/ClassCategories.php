<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ClassCategory;
use Illuminate\Validation\Rule;

class ClassCategories extends Component
{

     use WithPagination;

    public $name;
    public $categoryId;
    public $isEditing = false;
    public $showModal = false;
    public $search = '';
    public $totalCount= 0;

    protected $paginationTheme = 'tailwind';

    public function openModal()
    {
        $this->resetInput();
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('class_categories', 'name')->ignore($this->categoryId)
            ],
        ];

        $validated = $this->validate($rules);

        if ($this->isEditing && $this->categoryId) {
            $category = ClassCategory::findOrFail($this->categoryId);
            $category->update($validated);
            session()->flash('message', 'Class category updated successfully!');
        } else {
            ClassCategory::create($validated);
            session()->flash('message', 'Class category created successfully!');
        }

        $this->closeModal();
        $this->resetInput();
    }

    public function edit($id)
    {
        $category = ClassCategory::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->isEditing = true;
        $this->showModal = true;
        $this->resetValidation();
    }

    public function delete($id)
    {
        ClassCategory::destroy($id);
        session()->flash('message', 'Class category deleted.');
    }

    public function resetInput()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->isEditing = false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = ClassCategory::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $classCategories = $query->latest()->paginate(8);
       $this->totalCount = ClassCategory::count();

        return view('livewire.admin.class-categories', [
            'classCategories' => $classCategories,
        ])->layout('layouts.admin');
    }
}


 
