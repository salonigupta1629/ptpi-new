<div class=" mx-auto p-6 bg-white rounded-xl shadow-md space-y-8">
    <!-- Profile Image, Name, Email -->
    <div class="flex flex-col sm:flex-row items-center gap-6 border-b pb-6">
        <div>
            @if($image)
                <img src="{{ asset('storage/'.$image) }}" 
                     alt="Profile" 
                     class="w-28 h-28 rounded-full object-cover border-4 border-gray-200 shadow-sm">
            @else
                <div class="w-28 h-28 rounded-full bg-gray-200 flex items-center justify-center text-4xl text-gray-500 font-bold shadow-sm">
                    <span>{{ strtoupper(substr($name,0,1)) }}</span>
                </div>
            @endif
        </div>
        <div class="flex-1 text-center sm:text-left">
            <div class="text-2xl font-bold text-gray-800">{{ $name }}</div>
            <div class="text-gray-500">{{ $email }}</div>
        </div>
    </div>

    <!-- Editable Fields -->
    <div class="space-y-6">
        <!-- phone -->
        <div x-data="{edit:false}">
            <div class="flex justify-between items-center">
                <div>
                    <span class="block text-sm font-medium text-gray-600">Phone</span>
                    <span class="text-gray-800" x-show="!edit">{{ $phone ?? '-' }}</span>
                </div>
                <button type="button" class="text-blue-600 text-sm font-medium hover:underline" x-show="!edit" @click="edit=true">Edit</button>
            </div>
            <div x-show="edit" class="flex items-center gap-2 mt-2">
                <input type="text" class="border rounded-md px-3 py-2 w-full text-sm" wire:model.defer="phone">
                <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm" wire:click="saveField('phone')" @click="edit=false">Save</button>
                <button type="button" class="bg-gray-200 hover:bg-gray-300 px-3 py-2 rounded text-sm" @click="edit=false">Cancel</button>
            </div>
            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Language -->
        <div x-data="{edit:false}">
            <div class="flex justify-between items-center">
                <div>
                    <span class="block text-sm font-medium text-gray-600">Language</span>
                    <span class="text-gray-800" x-show="!edit">{{ $language ?? '-' }}</span>
                </div>
                <button type="button" class="text-blue-600 text-sm font-medium hover:underline" x-show="!edit" @click="edit=true">Edit</button>
            </div>
            <div x-show="edit" class="flex items-center gap-2 mt-2">
                <select class="border rounded-md px-3 py-2 w-full text-sm" wire:model.defer="language">
                    <option value="">Select</option>
                    @foreach($languages as $lang)
                        <option value="{{ $lang }}">{{ $lang }}</option>
                    @endforeach
                </select>
                <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm" wire:click="saveField('language')" @click="edit=false">Save</button>
                <button type="button" class="bg-gray-200 hover:bg-gray-300 px-3 py-2 rounded text-sm" @click="edit=false">Cancel</button>
            </div>
            @error('language') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Gender, Marital Status, Religion (same style as above) -->
        <!-- Example for Gender -->
        <div x-data="{edit:false}">
            <div class="flex justify-between items-center">
                <div>
                    <span class="block text-sm font-medium text-gray-600">Gender</span>
                    <span class="text-gray-800" x-show="!edit">{{ $gender ?? '-' }}</span>
                </div>
                <button type="button" class="text-blue-600 text-sm font-medium hover:underline" x-show="!edit" @click="edit=true">Edit</button>
            </div>
            <div x-show="edit" class="flex items-center gap-2 mt-2">
                <select class="border rounded-md px-3 py-2 w-full text-sm" wire:model.defer="gender">
                    <option value="">Select</option>
                    @foreach($genders as $g)
                        <option value="{{ $g }}">{{ $g }}</option>
                    @endforeach
                </select>
                <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm" wire:click="saveField('gender')" @click="edit=false">Save</button>
                <button type="button" class="bg-gray-200 hover:bg-gray-300 px-3 py-2 rounded text-sm" @click="edit=false">Cancel</button>
            </div>
            @error('gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Current Address -->
        <div x-data="{edit:false}">
            <div class="flex justify-between items-center">
                <div class="text-sm font-medium text-gray-600">Current Address</div>
                <button type="button" class="text-blue-600 text-sm font-medium hover:underline" x-show="!edit" @click="edit=true">Edit</button>
            </div>
            <div x-show="!edit" class="text-gray-700 text-sm mt-1 leading-relaxed">
                <div>{{ $current_address['village'] ?? '-' }}, {{ $current_address['area'] ?? '-' }}, {{ $current_address['block'] ?? '-' }}</div>
                <div>{{ $current_address['district'] ?? '-' }}, {{ $current_address['state'] ?? '-' }} - {{ $current_address['pincode'] ?? '-' }}</div>
            </div>
            <div x-show="edit" class="grid grid-cols-2 gap-3 mt-2">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="Pincode" wire:model.defer="current_address.pincode">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="Village" wire:model.defer="current_address.village">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="Area" wire:model.defer="current_address.area">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="Block" wire:model.defer="current_address.block">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="District" wire:model.defer="current_address.district">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="State" wire:model.defer="current_address.state">
                <div class="col-span-2 flex gap-2 mt-3">
                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm" wire:click="saveField('current_address')" @click="edit=false">Save</button>
                    <button type="button" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded text-sm" @click="edit=false">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Permanent Address -->
        <div x-data="{edit:false}">
            <div class="flex justify-between items-center">
                <div class="text-sm font-medium text-gray-600">Permanent Address</div>
                <button type="button" class="text-blue-600 text-sm font-medium hover:underline" x-show="!edit" @click="edit=true">Edit</button>
            </div>
            <div class="flex items-center mt-1">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="same_as_current" wire:change="updatedSameAsCurrent($event.target.checked)">
                    <span class="text-sm text-gray-600">Same as Current Address</span>
                </label>
            </div>
            <div x-show="!edit" class="text-gray-700 text-sm mt-1 leading-relaxed">
                <div>{{ $permanent_address['village'] ?? '-' }}, {{ $permanent_address['area'] ?? '-' }}, {{ $permanent_address['block'] ?? '-' }}</div>
                <div>{{ $permanent_address['district'] ?? '-' }}, {{ $permanent_address['state'] ?? '-' }} - {{ $permanent_address['pincode'] ?? '-' }}</div>
            </div>
            <div x-show="edit" class="grid grid-cols-2 gap-3 mt-2">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="Pincode" wire:model.defer="permanent_address.pincode">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="Village" wire:model.defer="permanent_address.village">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="Area" wire:model.defer="permanent_address.area">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="Block" wire:model.defer="permanent_address.block">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="District" wire:model.defer="permanent_address.district">
                <input class="border rounded-md px-3 py-2 text-sm" placeholder="State" wire:model.defer="permanent_address.state">
                <div class="col-span-2 flex gap-2 mt-3">
                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm" wire:click="saveField('permanent_address')" @click="edit=false">Save</button>
                    <button type="button" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded text-sm" @click="edit=false">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
