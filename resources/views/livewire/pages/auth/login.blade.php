<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        if (auth()->user()->role === 'teacher' && auth()->user()->email_otp === null) {
            $this->redirectIntended(default: route('teacher.dashboard', absolute: false), navigate: true);
        } elseif (auth()->user()->role === 'recruiter' && auth()->user()->email_otp === null) {
            $this->redirectIntended(default: route('examiner.dashboard', absolute: false), navigate: true);
        } elseif (auth()->user()->role === 'admin' && auth()->user()->email_otp === null) {
            $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: true);
        } elseif (auth()->user()->role === 'center-manager' && auth()->user()->email_otp === null) {
            $this->redirectIntended(default: route('center-manager.dashboard', absolute: false));
        }
    }
}; ?>

<div class="flex w-full gap-5">
    <div class="w-6/12 flex items-start justify-center">
        <div class="w-[60%] mt-10">
            <h3 class="text-xl font-medium text-gray-800">Hello, <span class="text-teal-600 capitalize">User</span></h3>
            <h1 class="text-3xl font-semibold text-gray-800">Login To <span class="text-teal-600">PTPI</span></h1>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form wire:submit="login" class="mt-4">
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                        name="password" required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>
                <div class="flex justify-end">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 mt-2 text-center hover:text-gray-900 "
                            href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <x-primary-button class=" mt-5">
                    <span wire:loading.remove>
                        {{ __('Log in') }}
                    </span>
                    <span wire:loading>
                        <svg class="w-5 h-5 animate-spin text-white mx-auto" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                            </path>
                        </svg>
                    </span>
                </x-primary-button>

                <div class="flex flex-col space-y-2 mt-5">
                    <p class="text-gray-400">------------------------------- OR -------------------------------</p>
                    <a href="{{ route('register') }}" wire:navigate class="flex gap-3 justify-center items-center cursor-pointer px-6 py-3 text-center rounded-lg border-2 border-teal-600 bg-teal-50 text-teal-700 
                    transition-all duration-200 ">{{ __('Register as Teacher/Recruiter') }}</a>
                </div>
            </form>
        </div>
    </div>

    <div class="w-6/12 flex mt-10 ">

        <!-- Left: Steps -->
        <div class="flex flex-col  space-y-8 w-1/2">
            <!-- Step 1 -->
            <div class="flex items-start">
                <div class="flex flex-col items-center mr-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-teal-600 text-white font-bold">
                        1
                    </div>
                    <div class="w-[2px] h-16 bg-teal-600"></div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Create Account</h3>
                    <p class="text-gray-500 text-sm">Fill in your details to create your account</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="flex items-start">
                <div class="flex flex-col items-center mr-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-300 text-gray-700 font-bold">
                        2
                    </div>
                    <div class="w-[2px] h-16 bg-gray-300"></div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Verify Email</h3>
                    <p class="text-gray-500 text-sm">Confirm your email address</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="flex items-start">
                <div class="flex flex-col items-center mr-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-300 text-gray-700 font-bold">
                        3
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Complete Profile</h3>
                    <p class="text-gray-500 text-sm">Set up your teacher profile</p>
                </div>
            </div>
        </div>

        <!-- Right: Image -->
        <div class="w-1/2 mt-[40%] ">
            <img src="{{ asset('images/Gemini_Generated_Image_gi5ky1gi5ky1gi5k-removebg-preview.png') }}"
                alt="Illustration" class="object-fit" class="w-32 h-64">
        </div>

    </div>
</div>