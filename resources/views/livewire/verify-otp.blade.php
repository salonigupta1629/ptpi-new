<div class="flex w-full gap-5">
    <div class="w-6/12 flex items-start justify-center">
        <div class="w-[60%] mt-10">

            <div>
                <h1 class="text-xl font-semibold mb-4">Verify Your Email</h1>
                <p>We sent a 6-digit OTP to <strong class="text-teal-800">{{ $email }}</strong>. Enter it below:</p>

                <form wire:submit.prevent="verify" class="mt-4">
                    <div>
                        <x-input-label for="otp" :value="__('Enter OTP')" />
                        <x-text-input wire:model="otp" id="otp" class="block mt-1 w-full" type="number" name="otp"
                         />
                        <x-input-error :messages="$errors->get('otp')" class="mt-2" />
                    </div>
                    <x-primary-button class="mt-5">
                        <span wire:loading.remove>
                            {{ __('Verify OTP') }}
                        </span>
                        <span wire:loading>
                            <svg class="w-5 h-5 animate-spin text-white mx-auto" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                            Verifying...
                        </span>
                    </x-primary-button>

                </form>
            </div>
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