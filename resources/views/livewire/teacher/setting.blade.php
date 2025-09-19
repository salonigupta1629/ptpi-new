<div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-xl shadow-lg">
    <!-- Heading -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">🔒 Change Password</h2>
        <p class="text-gray-500 text-sm mt-1">Keep your account secure by updating your password</p>
    </div>

    <!-- Form -->
    <form wire:submit.prevent="changePassword" class="space-y-6">
        <!-- Old Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Old Password</label>
            <input type="password" 
                   wire:model.defer="old_password" 
                   class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                   placeholder="Enter old password"
                   autocomplete="current-password">
            @error('old_password') 
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <!-- New Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
            <input type="password" 
                   wire:model.defer="new_password" 
                   class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                   placeholder="Enter new password"
                   autocomplete="new-password">
            @error('new_password') 
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
            <input type="password" 
                   wire:model.defer="new_password_confirmation" 
                   class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                   placeholder="Re-enter new password"
                   autocomplete="new-password">
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-md shadow transition">
            Change Password
        </button>
    </form>
</div>
