<?php

namespace App\Livewire\CenterManager;

use App\Models\ExamAttempt;
use App\Models\ExamCenter;
use App\Models\Passkeys;
use App\Models\TeacherLevel3Choice;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    public $showModal = false;
    public $passkey = null;
    public $openPasskeyModal = false;
    public $requestId, $requestedApplication;
    public $generatePasskeyId;
    public $examCenter;
    public $search = '';

    public function mount(){
        $this->examCenter = ExamCenter::where('manager_id',auth()->user()->id)->first();
    }
    #[On('viewModal')]
    public function openModal($requestId)
    {
        $this->requestId = $requestId;
        $this->requestedApplication = TeacherLevel3Choice::find($requestId)->first();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function markApprove()
    {
        $this->requestedApplication->status = 'approved';
        $this->requestedApplication->save();
        $this->showModal = false;
        $this->dispatch('notify', message: 'Request Approved');
    }

    public function generatePasskey($id)
    {
        $this->generatePasskeyId = $id;
        $this->passkey = rand('100000', '999999');
        $this->openPasskeyModal = true;
    }
    public function savePasskey()
    {
        $application = TeacherLevel3Choice::findOrFail($this->generatePasskeyId);
        $user_id = $application->user_id;
        Passkeys::updateOrCreate(
            [
                'application_id' => $this->generatePasskeyId,
                'user_id' => $user_id
            ],
            [
                'passkey' => $this->passkey,
            ]
        );
        $this->dispatch('notify', message: 'Saved Passkey Successfully');
        $this->reset('generatePasskeyId');
        $this->openPasskeyModal = false;
    }
    #[Layout('layouts.centermanager')]
    public function render()
    {
        $query = TeacherLevel3Choice::where('center_id', $this->examCenter->id);

        if (!empty($this->search)) {
            $query->whereHas('user', function($q){
                $q->where(function($sub){
                    $sub->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            });
        }

        $teacherApplications = $query->paginate(5);

        return view('livewire.center-manager.dashboard', compact('teacherApplications'));
    }
}
