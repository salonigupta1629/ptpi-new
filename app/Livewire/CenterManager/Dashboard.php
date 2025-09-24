<?php

namespace App\Livewire\CenterManager;

use App\Models\TeacherLevel3Choice;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    public $showModal = false;
    public $requestId, $requestedApplication ;

    #[On('viewModal')]
    public function openModal($requestId)
    {
        $this->requestId = $requestId;
        $this->requestedApplication = TeacherLevel3Choice::find($requestId)->first();
        $this->showModal = true;
    }

    public function closeModal(){
        $this->showModal = false;
    }

    public function markApprove(){
        $this->requestedApplication->status = 'approved';
        $this->requestedApplication->save();
        $this->showModal = false;
        $this->dispatch('notify', message: 'Request Approved');
    }

    public function generatePasskey($id){
        
    }
    #[Layout('layouts.centermanager')]
    public function render()
    {
        $teacherApplications = TeacherLevel3Choice::paginate(5);
        return view('livewire.center-manager.dashboard', compact('teacherApplications'));
    }
}
