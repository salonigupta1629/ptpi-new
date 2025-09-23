<?php

namespace App\Livewire\Admin;

use App\Models\InterviewSchedule;
use App\Models\ClassCategory;
use App\Models\Subject;
use App\Models\Level;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Interview extends Component
{
    use WithPagination;

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
    
    // Filter fields
    public $statusFilter = '';
    public $teacherNameFilter = '';
    public $categoryFilter = '';
    public $subjectFilter = '';
    public $levelFilter = '';
    public $attemptFilter = '';
    public $fromDateFilter = '';
    public $toDateFilter = '';

    // Dynamic options for filters
    public $categories = [];
    public $subjects = [];
    public $levels = [];

    public function mount()
    {
        // Load dynamic filter options
        $this->categories = ClassCategory::pluck('name', 'name')->toArray();
        $this->subjects = Subject::pluck('subject_name', 'subject_name')->toArray();
        $this->levels = Level::pluck('name', 'name')->toArray();
    }

    // Reset page when filters change
    public function updating($property, $value)
    {
        if (str_contains($property, 'Filter') || $property === 'activeTab') {
            $this->resetPage();
        }
    }

    public function selectInterview($interviewId, $modalType)
    {
        $this->selectedInterviewId = $interviewId;
        $this->selectedInterview = InterviewSchedule::with([
            'teacher.user',
            'examAttempt.examSet.subject',
            'examAttempt.examSet.category',
            'examAttempt.userAnswers'
        ])->find($interviewId);
        
        if ($this->selectedInterview && $modalType === 'schedule') {
            $this->scheduleDate = $this->selectedInterview->scheduled_at->format('Y-m-d\TH:i');
        }
        
        $this->meetingLink = '';
        $this->rejectionReason = '';
        
        $this->showViewModal = ($modalType === 'view');
        $this->showScheduleModal = ($modalType === 'schedule');
        $this->showRejectModal = ($modalType === 'reject');
    }
    
    public function closeModal()
    {
        $this->showViewModal = false;
        $this->showScheduleModal = false;
        $this->showRejectModal = false;
        $this->reset(['selectedInterviewId', 'selectedInterview']);
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
    
    // Clear all filters
    public function clearFilters()
    {
        $this->reset([
            'statusFilter',
            'teacherNameFilter', 
            'categoryFilter',
            'subjectFilter',
            'levelFilter',
            'attemptFilter',
            'fromDateFilter',
            'toDateFilter'
        ]);
        $this->resetPage();
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

    // Get attempt number for an interview
    private function getAttemptNumber($teacherId, $examSetId)
    {
        return InterviewSchedule::where('teacher_id', $teacherId)
            ->whereHas('examAttempt', function($q) use ($examSetId) {
                $q->where('exam_set_id', $examSetId);
            })
            ->count();
    }

    // Calculate completion time for an exam attempt
    private function getCompletionTime($examAttempt)
    {
        if ($examAttempt->ended_at && $examAttempt->started_at) {
            $diff = $examAttempt->ended_at->diff($examAttempt->started_at);
            return $diff->h . 'h ' . $diff->i . 'm ' . $diff->s . 's';
        }
        return 'N/A';
    }

    // Calculate correct answers count
    private function getCorrectAnswersCount($examAttemptId)
    {
        return \App\Models\UserAnswer::where('exam_attempt_id', $examAttemptId)
            ->where('is_correct', true)
            ->count();
    }

    public function getInterviewsProperty()
    {
        $query = InterviewSchedule::with([
            'teacher.user',
            'examAttempt.examSet.subject',
            'examAttempt.examSet.category',
            'examAttempt.examSet.level'
        ]);
        
        // Apply tab filter
        if ($this->activeTab === 'pending') {
            $query->where('status', 'pending');
        } elseif ($this->activeTab === 'scheduled') {
            $query->where('status', 'scheduled');
        } elseif ($this->activeTab === 'completed') {
            $query->where('status', 'completed');
        }
        // 'all' tab shows all records, no status filter needed
        
        // Apply additional filters
        if (!empty($this->statusFilter) && $this->statusFilter !== 'All Status') {
            $query->where('status', strtolower($this->statusFilter));
        }
        
        if (!empty($this->teacherNameFilter)) {
            $query->whereHas('teacher.user', function($q) {
                $q->where('name', 'like', '%' . $this->teacherNameFilter . '%');
            });
        }
        
        if (!empty($this->categoryFilter) && $this->categoryFilter !== 'All Categories') {
            $query->whereHas('examAttempt.examSet.category', function($q) {
                $q->where('name', 'like', '%' . $this->categoryFilter . '%');
            });
        }
        
        if (!empty($this->subjectFilter) && $this->subjectFilter !== 'All Subjects') {
            $query->whereHas('examAttempt.examSet.subject', function($q) {
                $q->where('subject_name', 'like', '%' . $this->subjectFilter . '%');
            });
        }
        
        if (!empty($this->levelFilter) && $this->levelFilter !== 'All Levels') {
            $query->whereHas('examAttempt.examSet.level', function($q) {
                $q->where('name', 'like', '%' . $this->levelFilter . '%');
            });
        }
        
        if (!empty($this->attemptFilter) && $this->attemptFilter !== 'All Attempts') {
            // This would require additional logic to determine attempt number
            // For now, we'll implement a basic version
            if ($this->attemptFilter === 'First') {
                // Logic for first attempt would need additional data structure
            }
        }
        
        if (!empty($this->fromDateFilter)) {
            $query->whereDate('scheduled_at', '>=', $this->fromDateFilter);
        }
        
        if (!empty($this->toDateFilter)) {
            $query->whereDate('scheduled_at', '<=', $this->toDateFilter);
        }
        
        return $query->latest()->get();
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.interview', [
            'interviews' => $this->interviews,
            'pendingCount' => $this->pendingCount,
            'scheduledCount' => $this->scheduledCount,
            'completedCount' => $this->completedCount,
            'allCount' => $this->allCount,
            'categories' => $this->categories,
            'subjects' => $this->subjects,
            'levels' => $this->levels,
        ]);
    }
}













// <?php

// namespace App\Livewire\Admin;

// use App\Models\InterviewSchedule;
// use Livewire\Attributes\Layout;
// use Livewire\Component;

// class Interview extends Component
// {
//     public $activeTab = 'pending';
//     public $selectedInterviewId;
//     public $selectedInterview;
    
//     // Modal states
//     public $showViewModal = false;
//     public $showScheduleModal = false;
//     public $showRejectModal = false;
    
//     // Form fields
//     public $scheduleDate;
//     public $meetingLink;
//     public $rejectionReason;

//     public function selectInterview($interviewId, $modalType)
//     {
//         $this->selectedInterviewId = $interviewId;
//         $this->selectedInterview = InterviewSchedule::with([
//             'teacher.user',
//             'examAttempt.examSet.subject',
//             'examAttempt.examSet.category'
//         ])->find($interviewId);
        
//         // Set the default schedule date to the requested date/time
//         if ($this->selectedInterview && $modalType === 'schedule') {
//             $this->scheduleDate = $this->selectedInterview->scheduled_at->format('Y-m-d\TH:i');
//         }
        
//         // Reset other form fields
//         $this->meetingLink = '';
//         $this->rejectionReason = '';
        
//         // Show the appropriate modal
//         $this->showViewModal = ($modalType === 'view');
//         $this->showScheduleModal = ($modalType === 'schedule');
//         $this->showRejectModal = ($modalType === 'reject');
//     }
    
//     public function closeModal()
//     {
//         $this->showViewModal = false;
//         $this->showScheduleModal = false;
//         $this->showRejectModal = false;
//     }
    
//     public function approveInterview($interviewId)
//     {
//         $this->validate([
//             'scheduleDate' => 'required|date|after:now',
//             'meetingLink' => 'required|url',
//         ]);
        
//         $interview = InterviewSchedule::find($interviewId);
        
//         if ($interview) {
//             $interview->update([
//                 'status' => 'scheduled',
//                 'scheduled_at' => $this->scheduleDate,
//                 'meeting_link' => $this->meetingLink,
//                 'admin_notes' => 'Scheduled by admin on ' . now()->format('Y-m-d H:i')
//             ]);
            
//             $this->closeModal();
//             session()->flash('message', 'Interview scheduled successfully!');
//         } else {
//             session()->flash('error', 'Interview not found.');
//         }
//     }
    
//     public function rejectInterview($interviewId)
//     {
//         $this->validate([
//             'rejectionReason' => 'required|min:10',
//         ]);
        
//         $interview = InterviewSchedule::find($interviewId);
//         if ($interview) {
//             $interview->update([
//                 'status' => 'rejected',
//                 'admin_notes' => 'Rejected: ' . $this->rejectionReason . ' on ' . now()->format('Y-m-d H:i')
//             ]);
            
//             $this->closeModal();
//             session()->flash('message', 'Interview rejected successfully.');
//         } else {
//             session()->flash('error', 'Interview not found.');
//         }
//     }
    
//     public function getPendingCountProperty()
//     {
//         return InterviewSchedule::where('status', 'pending')->count();
//     }
    
//     public function getScheduledCountProperty()
//     {
//         return InterviewSchedule::where('status', 'scheduled')->count();
//     }
    
//     public function getCompletedCountProperty()
//     {
//         return InterviewSchedule::where('status', 'completed')->count();
//     }
    
//     public function getAllCountProperty()
//     {
//         return InterviewSchedule::count();
//     }

//     #[Layout('layouts.admin')]
//     public function render()
//     {
//         // Eager load all necessary relationships
//         $allInterviews = InterviewSchedule::with([
//             'teacher.user',
//             'examAttempt.examSet.subject',
//             'examAttempt.examSet.category'
//         ])->latest()->get();

//         // Filter based on active tab
//         if ($this->activeTab === 'pending') {
//             $filteredInterviews = $allInterviews->where('status', 'pending');
//         } elseif ($this->activeTab === 'scheduled') {
//             $filteredInterviews = $allInterviews->where('status', 'scheduled');
//         } elseif ($this->activeTab === 'completed') {
//             $filteredInterviews = $allInterviews->where('status', 'completed');
//         } else {
//             $filteredInterviews = $allInterviews; // 'all' tab
//         }

//         return view('livewire.admin.interview', [
//             'interviews' => $filteredInterviews,
//             'pendingCount' => $this->getPendingCountProperty(),
//             'scheduledCount' => $this->getScheduledCountProperty(),
//             'completedCount' => $this->getCompletedCountProperty(),
//             'allCount' => $this->getAllCountProperty(),
//         ]);
//     }
// }