<?php

namespace App\Livewire\Admin;

use App\Models\InterviewSchedule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Interview extends Component
{
    public $activeTab = 'pending';
    public $selectedInterviewId;
    public $selectedInterview;
    
    // Modal states
    public $showViewModal = false;
    public $showScheduleModal = false;
    public $showRejectModal = false;
    
    // Form fields
    public $scheduleDate;
    public $meetingLink;
    public $rejectionReason;

    public function selectInterview($interviewId, $modalType)
    {
        $this->selectedInterviewId = $interviewId;
        $this->selectedInterview = InterviewSchedule::with([
            'teacher.user',
            'examAttempt.examSet.subject',
            'examAttempt.examSet.category'
        ])->find($interviewId);
        
        // Set the default schedule date to the requested date/time
        if ($this->selectedInterview && $modalType === 'schedule') {
            $this->scheduleDate = $this->selectedInterview->scheduled_at->format('Y-m-d\TH:i');
        }
        
        // Reset other form fields
        $this->meetingLink = '';
        $this->rejectionReason = '';
        
        // Show the appropriate modal
        $this->showViewModal = ($modalType === 'view');
        $this->showScheduleModal = ($modalType === 'schedule');
        $this->showRejectModal = ($modalType === 'reject');
    }
    
    public function closeModal()
    {
        $this->showViewModal = false;
        $this->showScheduleModal = false;
        $this->showRejectModal = false;
    }
    
    public function approveInterview($interviewId)
    {
        $this->validate([
            'scheduleDate' => 'required|date|after:now',
            'meetingLink' => 'required|url',
        ]);
        
        $interview = InterviewSchedule::find($interviewId);
        
        if ($interview) {
            $interview->update([
                'status' => 'scheduled',
                'scheduled_at' => $this->scheduleDate,
                'meeting_link' => $this->meetingLink,
                'admin_notes' => 'Scheduled by admin on ' . now()->format('Y-m-d H:i')
            ]);
            
            $this->closeModal();
            session()->flash('message', 'Interview scheduled successfully!');
        } else {
            session()->flash('error', 'Interview not found.');
        }
    }
    
    public function rejectInterview($interviewId)
    {
        $this->validate([
            'rejectionReason' => 'required|min:10',
        ]);
        
        $interview = InterviewSchedule::find($interviewId);
        if ($interview) {
            $interview->update([
                'status' => 'rejected',
                'admin_notes' => 'Rejected: ' . $this->rejectionReason . ' on ' . now()->format('Y-m-d H:i')
            ]);
            
            $this->closeModal();
            session()->flash('message', 'Interview rejected successfully.');
        } else {
            session()->flash('error', 'Interview not found.');
        }
    }
    
    public function getPendingCountProperty()
    {
        return InterviewSchedule::where('status', 'pending')->count();
    }
    
    public function getScheduledCountProperty()
    {
        return InterviewSchedule::where('status', 'scheduled')->count();
    }
    
    public function getCompletedCountProperty()
    {
        return InterviewSchedule::where('status', 'completed')->count();
    }
    
    public function getAllCountProperty()
    {
        return InterviewSchedule::count();
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        // Eager load all necessary relationships
        $allInterviews = InterviewSchedule::with([
            'teacher.user',
            'examAttempt.examSet.subject',
            'examAttempt.examSet.category'
        ])->latest()->get();

        // Filter based on active tab
        if ($this->activeTab === 'pending') {
            $filteredInterviews = $allInterviews->where('status', 'pending');
        } elseif ($this->activeTab === 'scheduled') {
            $filteredInterviews = $allInterviews->where('status', 'scheduled');
        } elseif ($this->activeTab === 'completed') {
            $filteredInterviews = $allInterviews->where('status', 'completed');
        } else {
            $filteredInterviews = $allInterviews; // 'all' tab
        }

        return view('livewire.admin.interview', [
            'interviews' => $filteredInterviews,
            'pendingCount' => $this->getPendingCountProperty(),
            'scheduledCount' => $this->getScheduledCountProperty(),
            'completedCount' => $this->getCompletedCountProperty(),
            'allCount' => $this->getAllCountProperty(),
        ]);
    }
}