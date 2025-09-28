<?php

namespace App\Livewire\Admin;

use App\Models\TeacherRequest;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("layouts.admin")]
class RecruiterEnquiry extends Component
{
    public $selectedEnquiry = null;
    public $showModal = false;
    public $showRejectModal = false;
    public $rejectReason = '';
    public $adminNote = '';
    public $selectedStatus = '';

    public function render()
    {
        $enquirys = TeacherRequest::with([
            'classCategory',
            'recruiter' // Add this to eager load recruiter
        ])->paginate(10);

        return view('livewire.admin.recruiter-enquiry', [
            'enquirys' => $enquirys,
        ]);
    }

    public function showEnquiry($id)
    {
        try {
            $this->selectedEnquiry = TeacherRequest::with([
                'classCategory',
                'recruiter', // Add this
            ])->findOrFail($id);

            $this->selectedStatus = $this->selectedEnquiry->status;
            $this->rejectReason = $this->selectedEnquiry->reject_reason ?? '';
            $this->adminNote = '';
            $this->showModal = true;
        } catch (\Exception $e) {
            \Log::error('Error loading enquiry: ' . $e->getMessage());
            $this->dispatch('notify', message: 'Error loading enquiry details.');
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showRejectModal = false;
        $this->selectedEnquiry = null;
        $this->rejectReason = '';
        $this->adminNote = '';
        $this->selectedStatus = '';
    }

    public function openRejectModal()
    {
        // Validate that a status is selected
        $this->validate([
            'selectedStatus' => 'required|in:pending,approved,rejected',
        ]);

        if ($this->selectedStatus === 'rejected') {
            $this->showRejectModal = true;
        } else {
            $this->updateStatus();
            $this->selectedEnquiry = $enquiry->fresh();

            $this->showRejectModal = false;


        }
    }

    public function updateStatus()
    {
        $this->validate([
            'selectedStatus' => 'required|in:pending,approved,rejected',
            'rejectReason' => 'required_if:selectedStatus,rejected|max:500',
        ], [
            'rejectReason.required_if' => 'Reject reason is required when rejecting an enquiry.',
        ]);

        try {
            $enquiry = TeacherRequest::findOrFail($this->selectedEnquiry->id);
            $enquiry->status = $this->selectedStatus;

            if ($this->selectedStatus === 'rejected') {
                $enquiry->reject_reason = $this->rejectReason;
                // Add a note about rejection
                $enquiry->addNote("Status changed to rejected. Reason: {$this->rejectReason}");
            } else {
                $enquiry->reject_reason = null;
                $enquiry->addNote("Status changed to {$this->selectedStatus}");
            }

            $enquiry->save();

            // Refresh the selected enquiry
            $this->selectedEnquiry = $enquiry->fresh();

            $this->dispatch('notify', message: 'Status updated successfully!');

            // Close modals
            $this->showRejectModal = false;

            // Don't close main modal immediately, let user see the update
            $this->dispatch('status-updated');

        } catch (\Exception $e) {
            \Log::error('Error updating status: ' . $e->getMessage());
            $this->dispatch('notify', message: 'Error updating status: ' . $e->getMessage());
        }
    }

    public function addNote()
    {
        $this->validate([
            'adminNote' => 'required|min:5|max:1000',
        ]);

        try {
            $enquiry = TeacherRequest::findOrFail($this->selectedEnquiry->id);
            $enquiry->addNote($this->adminNote);

            $this->selectedEnquiry = $enquiry->fresh();
            $this->adminNote = '';
            $this->dispatch('notify', message: 'Note added successfully!');

        } catch (\Exception $e) {
            \Log::error('Error adding note: ' . $e->getMessage());
            $this->dispatch('notify', message: 'Error adding note.');
        }
    }

    public function updatedSelectedStatus($value)
    {
        if ($value !== 'rejected') {
            $this->rejectReason = '';
        }
    }
}
