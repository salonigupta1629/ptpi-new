<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details - Teacher Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#6b7280',
                        success: '#10b981',
                        warning: '#f59e0b',
                        danger: '#ef4444',
                        light: '#f9fafb',
                        dark: '#1f2937'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f8fa;
        }
        
        .profile-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .profile-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .info-item {
            transition: background-color 0.2s ease;
        }
        
        .info-item:hover {
            background-color: #f9fafb;
        }
        
        .edit-btn {
            transition: all 0.2s ease;
        }
        
        .edit-btn:hover {
            transform: scale(1.05);
        }
        
        .edit-form {
            display: none;
        }
        
        .edit-form.active {
            display: block;
        }
        
        .view-mode {
            display: grid;
        }
        
        .edit-mode .view-mode {
            display: none;
        }
        
        .edit-mode .edit-form {
            display: block;
        }
        
        .address-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        @media (max-width: 768px) {
            .address-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Personal Details</h1>
            <p class="text-gray-600">Manage your personal information and contact details</p>
        </div>

        <!-- Basic Information Section -->
        <div class="bg-white rounded-xl shadow-sm profile-card mb-8 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Basic Information</h2>
                <button class="text-primary hover:text-primary-dark font-medium flex items-center">
                    <i class="fas fa-pen mr-2"></i> Edit Profile
                </button>
            </div>
            
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
                              <span class="flex flex-1 justify-between  items-center">
  <div>
                                    <p class="text-sm text-gray-500 mb-1">Name</p>
                                    <p class="font-medium text-gray-800 name-value">Vikash Kumar</p>
                                </div>
                                {{-- <button class="edit-btn text-primary hover:text-primary-dark" data-field="name">
                                    <i class="fas fa-pen"></i>Edit
                                </button> --}}
                                  <button class="edit-address-btn text-primary  hover:text-primary-dark font-medium flex items-center" data-address-type="current">
                                <i class="fas fa-pen mr-2 "></i> Edit
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
                </div>
            </div>
        </div>

        <!-- Address Information Section -->
        <div class="bg-white rounded-xl shadow-sm profile-card overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Address Information</h2>
                <p class="text-sm text-gray-600 mt-1">Both addresses are required for verification purposes.</p>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Current Address -->
                    <div class="border border-gray-200 rounded-lg p-5">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Current Address</h3>
                            <button class="edit-address-btn text-primary hover:text-primary-dark font-medium flex items-center" data-address-type="current">
                                <i class="fas fa-pen mr-2"></i> Edit
                            </button>
                        </div>
                        
                        <!-- View Mode -->
                        <div class="view-mode">
                            <div class="address-grid">
                                <div class="space-y-1">
                                    <p class="text-sm text-gray-500">Post Office</p>
                                    <p class="font-medium text-gray-800 current-post-office-value">Pachira</p>
                                </div>
                                
                                <div class="space-y-1">
                                    <p class="text-sm text-gray-500">District</p>
                                    <p class="font-medium text-gray-800 current-district-value">Araria</p>
                                </div>
                                
                                <div class="space-y-1">
                                    <p class="text-sm text-gray-500">State</p>
                                    <p class="font-medium text-gray-800 current-state-value">Bihar</p>
                                </div>
                                
                                <div class="space-y-1">
                                    <p class="text-sm text-gray-500">Pincode</p>
                                    <p class="font-medium text-gray-800 current-pincode-value">854334</p>
                                </div>
                                
                                <div class="space-y-1 md:col-span-2">
                                    <p class="text-sm text-gray-500">Area</p>
                                    <p class="font-medium text-gray-800 current-area-value">pachira</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Edit Mode -->
                        <div class="edit-form" data-address-type="current">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">Post Office*</label>
                                    <input type="text" value="Pachira" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">District*</label>
                                    <input type="text" value="Araria" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">State*</label>
                                    <input type="text" value="Bihar" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">Pincode*</label>
                                    <input type="text" value="854334" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">Area*</label>
                                    <input type="text" value="pachira" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                            </div>
                            <div class="flex justify-end space-x-2 mt-4">
                                <button class="cancel-address-edit px-3 py-1 text-gray-600 text-sm">Cancel</button>
                                <button class="save-address-edit px-3 py-1 bg-primary text-white text-sm rounded">Save</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Permanent Address -->
                    <div class="border border-gray-200 rounded-lg p-5">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Permanent Address</h3>
                            <button class="edit-address-btn text-primary hover:text-primary-dark font-medium flex items-center" data-address-type="permanent">
                                <i class="fas fa-pen mr-2"></i> Edit
                            </button>
                        </div>
                        
                        <!-- View Mode -->
                        <div class="view-mode">
                            <div class="address-grid">
                                <div class="space-y-1">
                                    <p class="text-sm text-gray-500">Post Office</p>
                                    <p class="font-medium text-gray-800 permanent-post-office-value">Pachira</p>
                                </div>
                                
                                <div class="space-y-1">
                                    <p class="text-sm text-gray-500">District</p>
                                    <p class="font-medium text-gray-800 permanent-district-value">Araria</p>
                                </div>
                                
                                <div class="space-y-1">
                                    <p class="text-sm text-gray-500">State</p>
                                    <p class="font-medium text-gray-800 permanent-state-value">Bihar</p>
                                </div>
                                
                                <div class="space-y-1">
                                    <p class="text-sm text-gray-500">Pincode</p>
                                    <p class="font-medium text-gray-800 permanent-pincode-value">854334</p>
                                </div>
                                
                                <div class="space-y-1 md:col-span-2">
                                    <p class="text-sm text-gray-500">Area</p>
                                    <p class="font-medium text-gray-800 permanent-area-value">pachira</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Edit Mode -->
                        <div class="edit-form" data-address-type="permanent">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">Post Office*</label>
                                    <input type="text" value="Pachira" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">District*</label>
                                    <input type="text" value="Araria" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">State*</label>
                                    <input type="text" value="Bihar" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">Pincode*</label>
                                    <input type="text" value="854334" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">Area*</label>
                                    <input type="text" value="pachira" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                </div>
                            </div>
                            <div class="flex justify-end space-x-2 mt-4">
                                <button class="cancel-address-edit px-3 py-1 text-gray-600 text-sm">Cancel</button>
                                <button class="save-address-edit px-3 py-1 bg-primary text-white text-sm rounded">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Field editing functionality
            const editButtons = document.querySelectorAll('.edit-btn');
            const cancelButtons = document.querySelectorAll('.cancel-edit');
            const saveButtons = document.querySelectorAll('.save-edit');
            
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const field = this.getAttribute('data-field');
                    const infoItem = this.closest('.info-item');
                    
                    // Hide view mode, show edit form
                    infoItem.classList.add('edit-mode');
                });
            });
            
            cancelButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.edit-form');
                    const field = form.getAttribute('data-field');
                    const infoItem = form.closest('.info-item');
                    
                    // Hide edit form, show view mode
                    infoItem.classList.remove('edit-mode');
                });
            });
            
            saveButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.edit-form');
                    const field = form.getAttribute('data-field');
                    const infoItem = form.closest('.info-item');
                    const input = form.querySelector('input, select');
                    const valueElement = infoItem.querySelector(`.${field}-value`);
                    
                    // Update value and hide edit form
                    if (input.value.trim() !== '') {
                        valueElement.textContent = input.value;
                    }
                    infoItem.classList.remove('edit-mode');
                });
            });
            
            // Address editing functionality
            const addressButtons = document.querySelectorAll('.edit-address-btn');
            const cancelAddressButtons = document.querySelectorAll('.cancel-address-edit');
            const saveAddressButtons = document.querySelectorAll('.save-address-edit');
            
            addressButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const addressType = this.getAttribute('data-address-type');
                    const addressCard = this.closest('.border');
                    
                    // Hide view mode, show edit form
                    addressCard.classList.add('edit-mode');
                });
            });
            
            cancelAddressButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.edit-form');
                    const addressCard = form.closest('.border');
                    
                    // Hide edit form, show view mode
                    addressCard.classList.remove('edit-mode');
                });
            });
            
            saveAddressButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.edit-form');
                    const addressType = form.getAttribute('data-address-type');
                    const addressCard = form.closest('.border');
                    const inputs = form.querySelectorAll('input');
                    
                    // Update all address fields
                    inputs.forEach(input => {
                        const fieldName = input.previousElementSibling.textContent.replace('*', '').trim().toLowerCase().replace(' ', '-');
                        const valueElement = addressCard.querySelector(`.${addressType}-${fieldName}-value`);
                        if (valueElement && input.value.trim() !== '') {
                            valueElement.textContent = input.value;
                        }
                    });
                    
                    // Hide edit form, show view mode
                    addressCard.classList.remove('edit-mode');
                });
            });
        });
    </script>
</body>
</html>





