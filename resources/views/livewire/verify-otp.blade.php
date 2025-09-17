<div>
    <h1 class="text-xl font-bold mb-4">Verify Your Email</h1>
    <p>We sent a 6-digit OTP to <strong>{{ $email }}</strong>. Enter it below:</p>

    <form wire:submit.prevent="verify" class="mt-4">
        <input type="text" wire:model="otp" class="border rounded p-2 w-full" placeholder="Enter OTP">
        @error('otp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror

        <button type="submit" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded">
            Verify OTP
        </button>
    </form>
</div>
