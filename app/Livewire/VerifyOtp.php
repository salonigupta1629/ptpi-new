<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class VerifyOtp extends Component
{
    public $email;
    public $otp;

    public function mount($email)
    {
        $this->email = $email;
    }

    public function verify()
    {
        $user = User::where('email', $this->email)->first();

        if ($user && $user->email_otp == $this->otp) {
            $user->is_verified = true;
            $user->email_otp = null;
            $user->save();

            Auth::login($user);
            if (auth()->user()->role === 'teacher') {
                return redirect()->route('teacher.dashboard');
            } elseif (auth()->user()->role === 'recruiter') {
                return redirect()->route('examiner.dashboard');
            } elseif (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

        }

        $this->addError('otp', 'Invalid OTP. Please try again.');
    }
    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.verify-otp');
    }
}

