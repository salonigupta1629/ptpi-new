<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\TeacherJobType;
use Illuminate\Validation\Rule;

class JobTypes extends Component
{

      public $teacher_job_name;
    public $description;
    public $jobTypeId;
    public $isEditing = false;
    public $showModal = false;
    public $search = '';

    protected function rules()
    {
        if ($this->isEditing && $this->jobTypeId) {
            return [
                'teacher_job_name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('teacher_job_types','teacher_job_name')->ignore($this->jobTypeId),
                ],
                'description' => 'nullable|string',
            ];
        }

        return [
            'teacher_job_name' => 'required|string|max:255|unique:teacher_job_types,teacher_job_name',
            'description' => 'nullable|string',
        ];
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
        $validated = $this->validate();

        if ($this->isEditing && $this->jobTypeId) {
            $jobType = TeacherJobType::findOrFail($this->jobTypeId);
            $jobType->update($validated);
            session()->flash('message', 'Job type updated successfully.');
        } else {
            TeacherJobType::create($validated);
            session()->flash('message', 'Job type created successfully.');
        }

        $this->closeModal();
        $this->resetInput();
    }

    public function edit($id)
    {
        $jobType = TeacherJobType::findOrFail($id);
        $this->jobTypeId = $jobType->id;
        $this->teacher_job_name = $jobType->teacher_job_name;
        $this->description = $jobType->description;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function delete($id)
    {
        $jobType = TeacherJobType::find($id);
        if ($jobType) {
            $jobType->delete();
            session()->flash('message', 'Job type deleted.');
        }
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->jobTypeId = null;
        $this->teacher_job_name = '';
        $this->description = '';
        $this->isEditing = false;
    }

    public function render()
    {
        $jobTypes = TeacherJobType::query()
        ->when($this->search, function ($query) {
            $query->where('teacher_job_name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('livewire.admin.job-types', [
        'jobTypes' => $jobTypes,  
    ])->layout('layouts.admin');
    }

    
}


