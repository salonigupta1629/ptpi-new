<?php

namespace App\Livewire\Admin;

use App\Models\ClassCategory;
use App\Models\QuestionManager;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class ManageQuestionManager extends Component
{
     use WithPagination;

    public $showModal = false;
    public $viewModal = false;
    public $editModal = false;
    public $email = '';
    public $password = '';
    public $name = '';
    public $selectedCategory = '';
    public $selectedSubject = '';
    public $is_active = true;
    public $availableSubjects = [];
    
    // Search and filter properties
    public $search = '';
    public $statusFilter = 'all';
    
    // Edit properties
    public $editingId = null;
    public $editingUserId = null;

    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
        $this->resetModalFields();
    }
    
    public function toggleViewModal($id = null)
    {
        if ($id) {
            $manager = QuestionManager::with(['user', 'category', 'subject'])->find($id);
            if ($manager) {
                $this->name = $manager->user->name;
                $this->email = $manager->user->email;
                $this->selectedCategory = $manager->category_id;
                $this->selectedSubject = $manager->subject_id;
                $this->is_active = $manager->is_active;
                
                // Load available subjects for the selected category
                $this->availableSubjects = Subject::where('category_id', $this->selectedCategory)->get();
            }
        }
        $this->viewModal = !$this->viewModal;
        if (!$this->viewModal) {
            $this->resetModalFields();
        }
    }
    
    public function toggleEditModal($id = null)
    {
        if ($id) {
            $manager = QuestionManager::with(['user', 'category', 'subject'])->find($id);
            if ($manager) {
                $this->editingId = $id;
                $this->editingUserId = $manager->user_id;
                $this->name = $manager->user->name;
                $this->email = $manager->user->email;
                $this->selectedCategory = $manager->category_id;
                $this->selectedSubject = $manager->subject_id;
                $this->is_active = $manager->is_active;
                
                // Load available subjects for the selected category
                $this->availableSubjects = Subject::where('category_id', $this->selectedCategory)->get();
            }
        }
        $this->editModal = !$this->editModal;
        if (!$this->editModal) {
            $this->resetModalFields();
            $this->editingId = null;
            $this->editingUserId = null;
        }
    }
    
    protected function resetModalFields()
    {
        $this->reset(['email', 'password', 'name', 'selectedCategory', 'selectedSubject', 'is_active']);
        $this->availableSubjects = [];
    }

    public function updatedSelectedCategory($value)
    {
        if ($value) {
            $this->availableSubjects = Subject::where('category_id', $value)->get();
        } else {
            $this->availableSubjects = [];
        }
        $this->selectedSubject = '';
    }
        public function createQuestionManager()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'name' => 'required|string|max:255',
            'selectedCategory' => 'required|exists:class_categories,id',
            'selectedSubject' => 'required|exists:subjects,id',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_active' => true,
        ]);

        QuestionManager::create([
            'user_id' => $user->id,
            'category_id' => $this->selectedCategory,
            'subject_id' => $this->selectedSubject,
            'is_active' => $this->is_active,
        ]);

        $this->toggleModal();
        session()->flash('message', 'Question Manager created successfully.');
    }
    
    public function updateQuestionManager()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->editingUserId,
            'name' => 'required|string|max:255',
            'selectedCategory' => 'required|exists:class_categories,id',
            'selectedSubject' => 'required|exists:subjects,id',
        ]);

        // Update user
        $user = User::find($this->editingUserId);
        if ($user) {
            $userData = [
                'name' => $this->name,
                'email' => $this->email,
            ];
            
            // Only update password if provided
            if (!empty($this->password)) {
                $userData['password'] = Hash::make($this->password);
            }
            
            $user->update($userData);
        }

        // Update question manager
        $manager = QuestionManager::find($this->editingId);
        if ($manager) {
            $manager->update([
                'category_id' => $this->selectedCategory,
                'subject_id' => $this->selectedSubject,
                'is_active' => $this->is_active,
            ]);
        }

        $this->toggleEditModal();
        session()->flash('message', 'Question Manager updated successfully.');
    }

    public function toggleStatus($id)
    {
        $manager = QuestionManager::findOrFail($id);
        $manager->update(['is_active' => !$manager->is_active]);
        
        session()->flash('message', 'Status updated successfully.');
    }

    public function deleteManager($id)
    {
        $manager = QuestionManager::findOrFail($id);
        $user = $manager->user;
        
        $manager->delete();
        
        // Check if user has other roles before deleting
        $hasOtherRoles = $user->is_teacher || $user->is_recruiter || $user->is_staff;
        
        if (!$hasOtherRoles) {
            $user->delete();
        }
           session()->flash('message', 'Question Manager deleted successfully.');
    }

    // Reset pagination when search or filter changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = QuestionManager::with(['user', 'category', 'subject']);
        
        // Apply search filter
        if ($this->search) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })->orWhereHas('category', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })->orWhereHas('subject', function ($q) {
                $q->where('subject_name', 'like', '%' . $this->search . '%');
            });
        }
        
        // Apply status filter
        if ($this->statusFilter !== 'all') {
            $query->where('is_active', $this->statusFilter === 'active');
        }
        
        $questionManagers = $query->paginate(10);

        return view('livewire.admin.manage-question-manager', [
            'questionManagers' => $questionManagers,
            'categories' => ClassCategory::all(),
        ]);
    }
}