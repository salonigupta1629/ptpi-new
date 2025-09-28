<?php

namespace App\Livewire\Admin;

use App\Models\TeacherHiring;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout("layouts.admin")]

class TeacherHiyer extends Component
{
   use WithPagination;

    public $statusFilter = 'all';
    public $recruiterFilter = 'all';
    public $teacherSearch = '';
    public $selectedRecruiters = [];

    public function mount()
    {
        // Get unique recruiter IDs from hiring requests
        $recruiterIds = TeacherHiring::distinct()->pluck('recruiter_id');
        $this->selectedRecruiters = User::whereIn('id', $recruiterIds)
            ->pluck('name', 'id')
            ->toArray();
    }
   public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedRecruiterFilter()
    {
        $this->resetPage();
    }

    public function updatedTeacherSearch()
    {
        $this->resetPage();
    }

    public function approveHiring($hiringId)
    {
        $hiring = TeacherHiring::findOrFail($hiringId);
        $hiring->update(['status' => TeacherHiring::STATUS_APPROVED]);
        
        session()->flash('message', 'Hiring request approved successfully!');
    }

    public function rejectHiring($hiringId)
    {
        $hiring = TeacherHiring::findOrFail($hiringId);
        $hiring->update(['status' => TeacherHiring::STATUS_REJECTED]);
        
        session()->flash('message', 'Hiring request rejected successfully!');
    }

    public function resetFilters()
    {
        $this->statusFilter = 'all';
        $this->recruiterFilter = 'all';
        $this->teacherSearch = '';
        $this->resetPage();
    }

    public function exportData()
    {
        // Implement export functionality
        session()->flash('message', 'Export functionality would be implemented here!');
    }

    public function getHiringsQuery()
    {
        return TeacherHiring::with([
                'teacher.user', 
                'teacher.subjects',
                'teacher.classCategories',
                'recruiter'
            ])
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->recruiterFilter !== 'all', function ($query) {
                $query->where('recruiter_id', $this->recruiterFilter);
            })
            ->when($this->teacherSearch, function ($query) {
                $query->whereHas('teacher.user', function ($q) {
                    $q->where('name', 'like', '%' . $this->teacherSearch . '%');
                });
            })
            ->orderBy('created_at', 'desc');
    }

    public function render()
    {
        $hirings = $this->getHiringsQuery()->paginate(5);
        $totalCount = $this->getHiringsQuery()->count();

        // Get available recruiters from the current results
        $recruiterOptions = ['all' => 'All Recruiters'];
        $recruiters = User::whereIn('id', TeacherHiring::distinct()->pluck('recruiter_id'))->get();
        foreach ($recruiters as $recruiter) {
            $recruiterOptions[$recruiter->id] = $recruiter->name;
        }

        $statusOptions = [
            'all' => 'All',
            TeacherHiring::STATUS_PENDING => 'Pending',
            TeacherHiring::STATUS_APPROVED => 'Approved',
            TeacherHiring::STATUS_REJECTED => 'Rejected',
        ];

        return view('livewire.admin.teacher-hiyer', [
            'hirings' => $hirings,
            'totalCount' => $totalCount,
            'statusOptions' => $statusOptions,
            'recruiterOptions' => $recruiterOptions,
        ]);
    }
}
