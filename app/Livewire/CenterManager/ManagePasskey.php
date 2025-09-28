<?php

namespace App\Livewire\CenterManager;

use App\Models\ExamAttempt;
use App\Models\Passkeys;
use App\Models\TeacherLevel3Choice;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManagePasskey extends Component
{
    public function mount(){
    }

    #[Layout('layouts.centermanager')]
    public function render()
    {
        $passkeys = Passkeys::get();
        return view('livewire.center-manager.manage-passkey',compact('passkeys'));
    }
}
