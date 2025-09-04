<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ClassCategory;
use App\Models\ExamSet;
use App\Models\Level;
use App\Models\Subject;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class ManageExam extends Component
{
    public $examSets = [];
    public $categories = [];
    public $levels = [];
    public $subjects = [];

    public $isModalOpen = false;
    public $editingExamId = null;

    public $name = '';
    public $description = '';
    public $category_id = '';
    public $subject_id = '';
    public $level_id = '';
    public $total_marks = 0;
    public $duration = 60;
    public $type = 'online';
    public $status = 'draft';

    public function rules()
    {
        return [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:class_categories,id',
        'subject_id' => 'required|exists:subjects,id',
        'level_id' => 'required|exists:levels,id',
        'total_marks' => 'required|integer|min:0',
        'duration' => 'required|integer|min:1',
        'type' => 'required|in:online,offline',
        'status' => 'required|in:draft,published,archieved',
    ];
    }

    public function mount()
    {
        $this->loadData();
        // Initialize with empty subjects collection
        $this->subjects = collect();
    }

    public function loadData()
    {
        $this->examSets = ExamSet::with(['category', 'level', 'subject'])->get();
        $this->categories = ClassCategory::all();
        $this->levels = Level::all();
        // Don't load all subjects initially - they'll be loaded based on category selection
    }

    public function openModal()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->isModalOpen = false;
    }

    public function edit($id)
    {
        $exam = ExamSet::find($id);

        if ($exam) {
            $this->editingExamId = $exam->id;
            $this->name = $exam->name;
            $this->description = $exam->description;
            $this->category_id = $exam->category_id;
            
            // Load subjects for the selected category when editing
            if ($exam->category_id) {
                $this->subjects = Subject::where('category_id', $exam->category_id)->get();
            }
            
            $this->subject_id = $exam->subject_id;
            $this->level_id = $exam->level_id;
            $this->total_marks = $exam->total_marks;
            $this->duration = $exam->duration;
            $this->type = $exam->type;
            $this->status = $exam->status;
            $this->isModalOpen = true;
        }
    }

public function storeOrUpdate()
{
    \Log::info('storeOrUpdate called', [
        'form_data' => [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'subject_id' => $this->subject_id,
            'level_id' => $this->level_id,
            'total_marks' => $this->total_marks,
            'duration' => $this->duration,
        ],
        'editingExamId' => $this->editingExamId
    ]);

    try {
        $validated = $this->validate();
        \Log::info('Validation passed', $validated);

        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
            
            if ($this->editingExamId) {
                $exam = ExamSet::find($this->editingExamId);
                if ($exam) {
                    $exam->update($validated);
                    \Log::info('Exam updated successfully', ['exam_id' => $exam->id]);
                    session()->flash('success', 'Exam updated successfully!');
                }
            } else {
                $exam = ExamSet::create($validated);
                \Log::info('Exam created successfully', ['exam_id' => $exam->id]);
                session()->flash('success', 'Exam created successfully!');
            }

            $this->loadData();
            $this->closeModal();
            
        } else {
            \Log::error('User not authenticated');
            session()->flash('error', 'You must be logged in to create an exam.');
        }
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation failed', ['errors' => $e->errors()]);
        foreach ($e->errors() as $field => $errors) {
            session()->flash('error', $field . ': ' . implode(', ', $errors));
        }
    } catch (\Exception $e) {
        \Log::error('Database error', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        session()->flash('error', 'Database error: ' . $e->getMessage());
    }
}

    public function updatedCategoryId($value)
{
    $this->subject_id = ''; // Reset subject_id when category changes
    if ($value) {
        $this->subjects = Subject::where('category_id', $value)->get();
    } else {
        $this->subjects = collect();
    }
}

    public function destroy($id)
    {
        $exam = ExamSet::find($id);
        if ($exam) {
            $exam->delete();
            $this->loadData();
            session()->flash('success', 'Exam deleted successfully!');
        }
    }

    private function resetForm()
    {
        $this->reset([
            'editingExamId', 'name', 'description', 'category_id',
            'subject_id', 'level_id', 'total_marks', 'duration',
            'type', 'status'
        ]);
        // Reset subjects to empty collection
        $this->subjects = collect();
    }

    public function render()
    {
        return view('livewire.admin.manage-exam');
    }
}
