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
<<<<<<< HEAD
            
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Profile Photo -->
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                                <i class="fas fa-user text-5xl text-gray-400"></i>
                            </div>
                            <button class="absolute bottom-0 right-0 bg-primary text-white p-2 rounded-full">
                                <i class="fas fa-camera text-sm"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Personal Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-grow">
                        <!-- Name Field -->
                        <div class="info-item p-4 rounded-lg border border-gray-100">
                            <div class="view-mode flex justify-between items-center">
                              <span class="flex flex-1 justify-between  items-center ">
  <div>
                                    <p class="text-sm text-gray-500 mb-1">Name</p>
                                    <p class="font-medium text-gray-800 name-value">Vikash Kumar</p>
                                </div>
                                  <button class="edit-address-btn text-primary  hover:text-primary-dark font-medium flex items-center" data-address-type="current">
                                <i class="fas fa-pen mr-2 justify-end flex "></i> Edit
                            </button>
                              </span>
                            </div>
                            <div class="edit-form" data-field="name">
                                <label class="block text-sm text-gray-500 mb-1">Name</label>
                                <input type="text" value="Vikash Kumar" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button class="cancel-edit px-3 py-1 text-gray-600 text-sm">Cancel</button>
                                    <button class="save-edit px-3 py-1 bg-primary text-white text-sm rounded">Save</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Email Field -->
                        <div class="info-item p-4 rounded-lg border border-gray-100">
                            <div class="view-mode flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Email Address</p>
                                    <p class="font-medium text-gray-800 email-value">vikasharyan323@gmail.com</p>
                                </div>
                                <button class="edit-btn text-primary hover:text-primary-dark" data-field="email">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                            <div class="edit-form" data-field="email">
                                <label class="block text-sm text-gray-500 mb-1">Email Address</label>
                                <input type="email" value="vikasharyan323@gmail.com" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button class="cancel-edit px-3 py-1 text-gray-600 text-sm">Cancel</button>
                                    <button class="save-edit px-3 py-1 bg-primary text-white text-sm rounded">Save</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact No Field -->
                        <div class="info-item p-4 rounded-lg border border-gray-100">
                            <div class="view-mode flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Contact No</p>
                                    <p class="font-medium text-gray-800 contact-no-value">N/A</p>
                                </div>
                                <button class="edit-btn text-primary hover:text-primary-dark" data-field="contactNo">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                            <div class="edit-form" data-field="contactNo">
                                <label class="block text-sm text-gray-500 mb-1">Contact No</label>
                                <input type="tel" value="" placeholder="Type Contact No" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button class="cancel-edit px-3 py-1 text-gray-600 text-sm">Cancel</button>
                                    <button class="save-edit px-3 py-1 bg-primary text-white text-sm rounded">Save</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Language Field -->
                        <div class="info-item p-4 rounded-lg border border-gray-100">
                            <div class="view-mode flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Language</p>
                                    <p class="font-medium text-gray-800 language-value">N/A</p>
                                </div>
                                <button class="edit-btn text-primary hover:text-primary-dark" data-field="language">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                            <div class="edit-form" data-field="language">
                                <label class="block text-sm text-gray-500 mb-1">Language</label>
                                <input type="text" value="" placeholder="Enter language" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button class="cancel-edit px-3 py-1 text-gray-600 text-sm">Cancel</button>
                                    <button class="save-edit px-3 py-1 bg-primary text-white text-sm rounded">Save</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Gender Field -->
                        <div class="info-item p-4 rounded-lg border border-gray-100">
                            <div class="view-mode flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Gender</p>
                                    <p class="font-medium text-gray-800 gender-value">N/A</p>
                                </div>
                                <button class="edit-btn text-primary hover:text-primary-dark" data-field="gender">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                            <div class="edit-form" data-field="gender">
                                <label class="block text-sm text-gray-500 mb-1">Gender</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button class="cancel-edit px-3 py-1 text-gray-600 text-sm">Cancel</button>
                                    <button class="save-edit px-3 py-1 bg-primary text-white text-sm rounded">Save</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Marital Status Field -->
                        <div class="info-item p-4 rounded-lg border border-gray-100">
                            <div class="view-mode flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Marital Status</p>
                                    <p class="font-medium text-gray-800 marital-status-value">N/A</p>
                                </div>
                                <button class="edit-btn text-primary hover:text-primary-dark" data-field="maritalStatus">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                            <div class="edit-form" data-field="maritalStatus">
                                <label class="block text-sm text-gray-500 mb-1">Marital Status</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                    <option value="">Select Marital Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button class="cancel-edit px-3 py-1 text-gray-600 text-sm">Cancel</button>
                                    <button class="save-edit px-3 py-1 bg-primary text-white text-sm rounded">Save</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Religion Field -->
                        <div class="info-item p-4 rounded-lg border border-gray-100 md:col-span-2">
                            <div class="view-mode flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Religion</p>
                                    <p class="font-medium text-gray-800 religion-value">N/A</p>
                                </div>
                                <button class="edit-btn text-primary hover:text-primary-dark" data-field="religion">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                            <div class="edit-form" data-field="religion">
                                <label class="block text-sm text-gray-500 mb-1">Religion</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md">
<option value="">Select Religion</option>
<option value="">Hindu</option>
<option value="">Muslim</option>
<option value="">Sikh</option>
<option value="">Christian</option>
<option value="">Others</option>
                                </select>
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button class="cancel-edit px-3 py-1 text-gray-600 text-sm">Cancel</button>
                                    <button class="save-edit px-3 py-1 bg-primary text-white text-sm rounded">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
=======
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
>>>>>>> a8147bdb660c5fde5d113cfd8ec7e5e8dc719191
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
