<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use \App\Mail\VerifyOtpMail;
use \App\Models\Teacher;

new #[Layout('layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'teacher';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:teacher,recruiter'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['email_otp'] = rand(100000, 999999);

        $user = User::create($validated);
        if ($this->role === 'teacher') {
            Teacher::create(['user_id' => $user->id]);
        }
        Mail::to($user->email)->send(new VerifyOtpMail($user->email_otp));

        $this->redirect(route('otp.verify', ['email' => $user->email]), navigate: true);
    }
}; ?>

<div class="flex w-full gap-5">
    <div class="w-6/12 flex items-center justify-center">
        <div class="w-[60%]">
            <h3 class="text-xl font-medium text-gray-800">Hello, <span
                    class="text-teal-600 capitalize">{{ $role }}s</span></h3>
            <h1 class="text-3xl font-semibold text-gray-800">Signup To <span class="text-teal-600">PTPI</span></h1>
            <form wire:submit.prevent="register" class="space-y-4 mt-5">
                <!-- Role Selection (Radio with div style) -->
                <div>
                    <div class="flex gap-4 mt-2">
                        <!-- Teacher -->
                        <div wire:click="$set('role', 'teacher')"
                            class="flex gap-3 items-center cursor-pointer px-6 py-3 text-center rounded-lg border-2 
                           transition-all duration-200 
                           {{ $role === 'teacher' ? 'border-teal-600 bg-teal-50 text-teal-700' : 'border-gray-300 text-gray-600' }}">
                            <input type="radio" wire:model="role" value="teacher" class="text-teal-600">
                            <span class="font-semibold text-sm">Sign Up as Teacher</span>
                        </div>

                        <!-- Recruiter -->
                        <div wire:click="$set('role', 'recruiter')"
                            class="flex gap-3 items-center cursor-pointer px-6 py-3 text-center rounded-lg border-2 
                           transition-all duration-200 
                           {{ $role === 'recruiter' ? 'border-teal-600 bg-teal-50 text-teal-700' : 'border-gray-300 text-gray-600' }}">
                            <input type="radio" wire:model="role" value="recruiter" class="text-teal-600">
                            <span class="font-semibold text-sm">Sign Up as Recruiter</span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>
                <!-- Full Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" />
                    <x-text-input wire:model="name" id="name" type="text" name="name" class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="email" id="email" type="email" name="email" class="block mt-1 w-full"
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input wire:model="password" id="password" type="password" name="password"
                        class="block mt-1 w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input wire:model="password_confirmation" id="password_confirmation" type="password"
                        name="password_confirmation" class="block mt-1 w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Submit -->
                <x-primary-button>
                    <span wire:loading.remove>
                        {{ __('Register') }}
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
                <a class="underline mt-2 text-sm text-left text-gray-600 hover:text-gray-900"
                    href="{{ route('login') }}" wire:navigate>
                    {{ __('Already registered?') }}
                </a>
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