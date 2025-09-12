<?php

namespace App\Livewire\Examiner;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\ExamSet;
use App\Models\ClassCategory;
use App\Models\Subject;
use App\Models\Level;

#[Layout('layouts.examiner')]
class ExaminerDashboard extends Component
{
    use WithPagination;

    // Modal state
    public $isModalOpen = false;
    public $editingExamId = null;

    // Form fields
    public $name = '';
    public $description = '';
    public $category_id = '';
    public $subject_id = '';
    public $level_id = '';
    public $total_marks = 0;
    public $total_question = '';
    public $duration = 60;
    public $type = 'online';
    public $status = 'draft';

    // Filter and search
    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = '';

    // Data collections
    public $categories = [];
    public $subjects = [];
    public $levels = [];

    public function mount()
    {
        $this->categories = ClassCategory::all();
        $this->levels = Level::all();
        $this->subjects = collect();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:class_categories,id',
            'subject_id' => 'required|exists:subjects,id',
            'level_id' => 'required|exists:levels,id',
            'total_marks' => 'required|integer|min:0',
            'total_question' => 'required|integer|min:1',
            'duration' => 'required|integer|min:1',
            'type' => 'required|in:online,offline',
            'status' => 'required|in:draft,published,archived',
        ];
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

    public function resetForm()
    {
        $this->reset([
            'editingExamId', 'name', 'description', 'category_id',
            'subject_id', 'level_id', 'total_marks', 'duration',
            'type', 'status', 'total_question',
        ]);
        $this->subjects = collect();
        $this->resetErrorBag();
    }

    public function edit($id)
    {
        $exam = ExamSet::find($id);

        if ($exam) {
            $this->editingExamId = $exam->id;
            $this->name = $exam->name;
            $this->total_question = $exam->total_question;
            $this->description = $exam->description;
            $this->category_id = $exam->category_id;

            // Load subjects for the selected category
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
        $validated = $this->validate();

        if ($this->editingExamId) {
            $exam = ExamSet::find($this->editingExamId);
            if ($exam) {
                $exam->update($validated);
                session()->flash('success', 'Exam updated successfully!');
            }
        } else {
            // Add current user ID when creating a new exam
            $validated['user_id'] =1; // Use authenticated user ID
            ExamSet::create($validated);
            session()->flash('success', 'Exam created successfully!');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $exam = ExamSet::find($id);
        if ($exam) {
            $exam->delete();
            session()->flash('success', 'Exam deleted successfully!');
        }
    }

    public function updatedCategoryId($value)
    {
        $this->subject_id = ''; // Reset subject selection
        if ($value) {
            $this->subjects = Subject::where('category_id', $value)->get();
        } else {
            $this->subjects = collect();
        }
    }

    public function render()
    {
        $query = ExamSet::with(['category', 'subject', 'level']);

        // Apply search filter
        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Apply category filter
        if (!empty($this->categoryFilter)) {
            $query->where('category_id', $this->categoryFilter);
        }

        // Apply status filter
        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        $examSets = $query->paginate(10);

        return view('livewire.examiner.examiner-dashboard', [
            'examSets' => $examSets,
        ]);
    }
}