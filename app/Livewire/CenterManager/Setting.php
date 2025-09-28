<?php

namespace App\Livewire\CenterManager;

use App\Models\ExamCenter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Setting extends Component
{
    public $old_password, $new_password, $new_password_confirmation;

    public function changePassword(){
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed'
        ],[
            'new_password_confirmation' => 'The new password confirmation does not match'
        ]);

        if(!Hash::check($this->old_password,Auth::user()->password)){
            $this->addError('old_password','The old password is incorrect');
            return;
        }

        Auth::user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['old_password','new_password','new_password_confirmation']);
        $this->dispatch('notify',message:'Password Changed Successfully');
    }
    #[Layout('layouts.centermanager')]
    public function render()
    {
        $centerDetails = ExamCenter::where('manager_id', auth()->user()->id)->first();
        return view('livewire.center-manager.setting',compact('centerDetails'));
    }
}
