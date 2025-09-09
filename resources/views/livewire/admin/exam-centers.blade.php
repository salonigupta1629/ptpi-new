<div class="container mx-auto p-6">
    <div class="flex flex-1 justify-between items-center">
        <h1 class="text-2xl font-bold mb-6">Exam Center Management</h1>

        <!-- Add New Center Button -->
        <div class="mb-6">
            <button wire:click="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Exam Center
            </button>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <!-- List Section -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Manage Exam Centers</h2>
            <div>
                <input type="text" wire:model.live="search" placeholder="Search by name, city or state..." 
                       class="border border-gray-300 rounded-md px-3 py-2 w-64 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Manager</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Center Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pincode</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($centers as $center)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $center->manager ? $center->manager->name : 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $center->inactive ? 'red' : 'green' }}-100 text-{{ $center->inactive ? 'red' : 'green' }}-800">
                                    {{ $center->inactive ? 'Inactive' : 'Active' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $center->center_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $center->city }}, {{ $center->state }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $center->pincode }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button wire:click="edit({{ $center->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                <button wire:click="delete({{ $center->id }})" onclick="return confirm('Are you sure you want to delete this exam center?')" class="text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center">No exam centers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $centers->links() }}
        </div>
    </div>

    <!-- Modal Backdrop -->
    @if($showModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-semibold">
                        {{ $editMode ? 'Edit Exam Center' : 'Add New Exam Center' }}
                    </h2>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <form wire:submit="{{ $editMode ? 'update' : 'save' }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- User Information -->
                            <div class="col-span-2">
                                <h3 class="text-lg font-medium mb-4 text-gray-700 border-b pb-2">User Information</h3>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                <input type="email" wire:model="email" id="email" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username *</label>
                                <input type="text" wire:model="username" id="username" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                @error('username') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password {{ $editMode ? '' : '*' }}</label>
                                <input type="password" wire:model="password" id="password" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                @if($editMode) <span class="text-xs text-gray-500 mt-1 block">Leave blank to keep current password</span> @endif
                            </div>

                            <!-- Exam Center Information -->
                            <div class="col-span-2 mt-8">
                                <h3 class="text-lg font-medium mb-4 text-gray-700 border-b pb-2">Exam Center Information</h3>
                            </div>

                            <div class="col-span-2">
                                <label for="center_name" class="block text-sm font-medium text-gray-700 mb-1">Center Name *</label>
                                <input type="text" wire:model="center_name" id="center_name" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                @error('center_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Area *</label>
                                <input type="text" wire:model="area" id="area" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                @error('area') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="pincode" class="block text-sm font-medium text-gray-700 mb-1">Pincode *</label>
                                <input type="text" wire:model="pincode" id="pincode" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                @error('pincode') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                                <input type="text" wire:model="city" id="city" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                @error('city') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State *</label>
                                <input type="text" wire:model="state" id="state" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                @error('state') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-span-2">
                                <label class="flex items-center mt-6">
                                    <input type="checkbox" wire:model="inactive" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 h-5 w-5">
                                    <span class="ml-3 text-sm text-gray-700 font-medium">Mark as Inactive</span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-8 flex space-x-4 border-t pt-6">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md shadow-sm transition duration-150 ease-in-out">
                                {{ $editMode ? 'Update' : 'Create' }} Exam Center
                            </button>
                            
                            <button type="button" wire:click="closeModal" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-3 px-6 rounded-md shadow-sm transition duration-150 ease-in-out">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>