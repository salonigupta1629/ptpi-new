<div class="w-full bg-gray-50">
    <div class="px-6 py-8 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Manage Question Managers</h2>
                <p class="mt-2 text-base text-gray-600">Assign and manage question managers for different categories and subjects</p>
            </div>
            <div class="mt-6 sm:mt-0">
                <button 
                    wire:click="toggleModal"
                    class="inline-flex items-center px-4 py-2.5 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150"
                >
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Assign New Question Manager
                </button>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <!-- Search Input -->
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    wire:model.live="search"
                    placeholder="Search by name, email, category or subject..." 
                    class="pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm bg-white shadow-sm"
                >
            </div>

            <!-- Status Filter -->
            <div class="sm:w-48">
                <select 
                    wire:model.live="statusFilter"
                    class="block w-full pl-3 pr-10 py-3 text-base border-gray-200 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm rounded-xl bg-white shadow-sm"
                >
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mt-6 p-4 rounded-xl bg-green-50 text-green-700 text-sm">
                {{ session('message') }}
            </div>
        @endif

        <!-- Table -->
        <div class="mt-8 flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5 rounded-xl bg-white">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="py-4 pl-6 pr-3 text-left text-sm font-semibold text-gray-900">Manager Name</th>
                                    <th scope="col" class="px-3 py-4 text-left text-sm font-semibold text-gray-900">Email</th>
                                    <th scope="col" class="px-3 py-4 text-left text-sm font-semibold text-gray-900">Classes</th>
                                    <th scope="col" class="px-3 py-4 text-left text-sm font-semibold text-gray-900">Subjects</th>
                                    <th scope="col" class="px-3 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                                    <th scope="col" class="relative py-4 pl-3 pr-6 text-sm">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($questionManagers as $manager)
                                    <tr class="hover:bg-gray-50">
                                        <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                                            {{ $manager->user->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">{{ $manager->user->email }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">{{ $manager->category->name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">{{ $manager->subject->subject_name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">
                                            <!-- Status Toggle Switch -->
                                            <button 
                                                wire:click="toggleStatus({{ $manager->id }})"
                                                type="button"
                                                class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 {{ $manager->is_active ? 'bg-teal-600' : 'bg-gray-300' }}"
                                                role="switch"
                                                aria-checked="{{ $manager->is_active ? 'true' : 'false' }}"
                                            >
                                                <span class="sr-only">Toggle status</span>
                                                <span 
                                                    class="pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 {{ $manager->is_active ? 'translate-x-5' : 'translate-x-0' }}"
                                                    aria-hidden="true"
                                                >
                                                    <span 
                                                        class="absolute inset-0 h-full w-full flex items-center justify-center transition-opacity {{ $manager->is_active ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200' }}"
                                                        aria-hidden="true"
                                                    >
                                                        <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                                            <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                    <span 
                                                        class="absolute inset-0 h-full w-full flex items-center justify-center transition-opacity {{ $manager->is_active ? 'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100' }}"
                                                        aria-hidden="true"
                                                    >
                                                        <svg class="h-3 w-3 text-teal-600" fill="currentColor" viewBox="0 0 12 12">
                                                            <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                                        </svg>
                                                    </span>
                                                </span>
                                            </button>
                                            <span class="ml-2 text-sm font-medium text-gray-900">
                                                {{ $manager->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-center text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-3">
                                                <button 
                                                    wire:click="toggleViewModal({{ $manager->id }})" 
                                                    class="text-blue-600 hover:text-blue-800 transition duration-150"
                                                    title="View Details"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                                <button 
                                                    wire:click="toggleEditModal({{ $manager->id }})" 
                                                    class="text-indigo-600 hover:text-indigo-800 transition duration-150"
                                                    title="Edit"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button 
                                                    wire:click="deleteManager({{ $manager->id }})" 
                                                    class="text-red-600 hover:text-red-800 transition duration-150"
                                                    onclick="return confirm('Are you sure you want to delete this question manager?')"
                                                    title="Delete"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-6 text-center text-sm text-gray-600">
                                            @if($search || $statusFilter !== 'all')
                                                No question managers found matching your criteria.
                                            @else
                                                No question managers found. <a wire:click="toggleModal" class="text-teal-600 hover:text-teal-700 cursor-pointer font-medium">Create one now</a>.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $questionManagers->links() }}
        </div>
    </div>

    <!-- Create Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-60 transition-opacity duration-300">
            <div class="flex min-h-screen items-center justify-center px-4 py-8">
                <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full p-8 transform transition-all">
                    <div class="absolute right-4 top-4">
                        <button wire:click="toggleModal" class="text-gray-500 hover:text-gray-700 transition duration-150">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="createQuestionManager">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-2xl font-semibold text-gray-900">Assign New Question Manager</h3>
                                <p class="mt-2 text-base text-gray-600">Fill in the details to create a new question manager account.</p>
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name *</label>
                                <input type="text" wire:model="name" id="name" class="mt-1.5 p-3 border block w-full rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                                @error('name') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                                <input type="email" wire:model="email" id="email" class="mt-1.5 p-3 border block w-full rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                                @error('email') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password *</label>
                                <input type="password" wire:model="password" id="password" class="mt-1.5 p-3 border block w-full rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                                @error('password') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Class Categories *</label>
                                <select wire:model.change="selectedCategory" id="category" class="mt-1.5 p-3 border block w-full rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedCategory') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700">Assign Subject(s) *</label>
                                <select 
                                    wire:model="selectedSubject" 
                                    id="subject" 
                                    class="mt-1.5 p-3 border block w-full rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm"
                                    @if(!$selectedCategory) disabled @endif
                                >
                                    <option value="">Select Subject</option>
                                    @foreach($availableSubjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                    @endforeach
                                </select>
                                @if(!$selectedCategory)
                                    <p class="mt-2 text-sm text-gray-500">Please select a category first</p>
                                @endif
                                @error('selectedSubject') 
                                    <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" wire:model="is_active" class="rounded border-gray-300 text-teal-600 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    <span class="ml-2 text-sm text-gray-600">Active</span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-4">
                            <button 
                                type="button" 
                                wire:click="toggleModal"
                                class="rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition duration-150"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                class="rounded-xl border border-transparent bg-teal-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition duration-150"
                            >
                                Create Question Manager
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- View Modal -->
   <!-- View Modal -->
@if($viewModal)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-60 transition-opacity duration-300">
        <div class="flex min-h-screen items-center justify-center px-4 py-8">
            <div class="relative bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all border border-gray-100">
                <div class="absolute right-4 top-4">
                    <button wire:click="toggleViewModal" class="text-gray-400 hover:text-gray-600 transition duration-150">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-6">
                    <!-- Header with Icon -->
                  
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900">Question Manager Details</h3>
                            <p class="mt-2 text-base text-gray-600">View the details of this question manager.</p>
                        </div>

                    <!-- Profile Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-md">
                                    <span class="text-xl font-bold text-white uppercase">
                                        {{ substr($name, 0, 1) }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">{{ $name }}</h4>
                                <p class="text-sm text-blue-600">{{ $email }}</p>
                                <div class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Question Manager
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 gap-3">
                        <!-- Class Category -->
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-4 rounded-xl border border-green-100">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-green-700 uppercase tracking-wide">Class Category</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        @php
                                            $category = $categories->firstWhere('id', $selectedCategory);
                                            echo $category ? $category->name : 'N/A';
                                        @endphp
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="bg-gradient-to-br from-orange-50 to-amber-50 p-4 rounded-xl border border-orange-100">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-orange-700 uppercase tracking-wide">Subject</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        @php
                                            $subject = $availableSubjects->firstWhere('id', $selectedSubject);
                                            echo $subject ? $subject->subject_name : 'N/A';
                                        @endphp
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="bg-gradient-to-br from-teal-50 to-cyan-50 p-4 rounded-xl border border-teal-100">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-teal-700 uppercase tracking-wide">Status</p>
                                    <div class="flex items-center space-x-2">
                                        <div class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 {{ $is_active ? 'bg-teal-600' : 'bg-gray-300' }}">
                                            <span class="sr-only">Toggle status</span>
                                            <span class="pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 {{ $is_active ? 'translate-x-5' : 'translate-x-0' }}">
                                                <span class="absolute inset-0 h-full w-full flex items-center justify-center transition-opacity {{ $is_active ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200' }}">
                                                    <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                                        <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                                <span class="absolute inset-0 h-full w-full flex items-center justify-center transition-opacity {{ $is_active ? 'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100' }}">
                                                    <svg class="h-3 w-3 text-teal-600" fill="currentColor" viewBox="0 0 12 12">
                                                        <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </div>
                                        <span class="text-sm font-semibold {{ $is_active ? 'text-teal-700' : 'text-gray-600' }}">
                                            {{ $is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Manager ID -->
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-4 rounded-xl border border-purple-100">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-purple-700 uppercase tracking-wide">Manager ID</p>
                                    <p class="text-sm font-semibold text-gray-900">QM-{{ $editingId ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3 pt-4 mt-8 flex justify-end">
                        {{-- <button 
                            wire:click="toggleEditModal({{ $editingId ?? '' }})" 
                            class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white py-3 px-4 rounded-xl text-sm font-medium transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 shadow-md"
                        >
                            Edit Profile
                        </button> --}}
                            <button 
                                type="button" 
                                wire:click="toggleViewModal"
                                class="rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition duration-150"
                            >
                                Close
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

    <!-- Edit Modal -->
    @if($editModal)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-60 transition-opacity duration-300">
            <div class="flex min-h-screen items-center justify-center px-4 py-8">
                <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full p-8 transform transition-all">
                    <div class="absolute right-4 top-4">
                        <button wire:click="toggleEditModal" class="text-gray-500 hover:text-gray-700 transition duration-150">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="updateQuestionManager">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-2xl font-semibold text-gray-900">Edit Question Manager</h3>
                                <p class="mt-2 text-base text-gray-600">Update the details of this question manager.</p>
                            </div>

                            <div>
                                <label for="edit_name" class="block text-sm font-medium text-gray-700">Name *</label>
                                <input type="text" wire:model="name" id="edit_name" class="mt-1.5 p-3 border block w-full rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                                @error('name') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="edit_email" class="block text-sm font-medium text-gray-700">Email *</label>
                                <input type="email" wire:model="email" id="edit_email" class="mt-1.5 p-3 border block w-full roundedtis-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                                @error('email') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="edit_password" class="block text-sm font-medium text-gray-700">Password (leave blank to keep current)</label>
                                <input type="password" wire:model="password" id="edit_password" class="mt-1.5 p-3 border block w-full rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                                @error('password') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="edit_category" class="block text-sm font-medium text-gray-700">Class Categories *</label>
                                <select wire:model.change="selectedCategory" id="edit_category" class="mt-1.5 p-3 border block w-full rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedCategory') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="edit_subject" class="block text-sm font-medium text-gray-700">Assign Subject(s) *</label>
                                <select 
                                    wire:model="selectedSubject" 
                                    id="edit_subject" 
                                    class="mt-1.5 p-3 border block w-full rounded-xl border-gray-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm"
                                    @if(!$selectedCategory) disabled @endif
                                >
                                    <option value="">Select Subject</option>
                                    @foreach($availableSubjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $selectedSubject == $subject->id ? 'selected' : '' }}>{{ $subject->subject_name }}</option>
                                    @endforeach
                                </select>
                                @if(!$selectedCategory)
                                    <p class="mt-2 text-sm text-gray-500">Please select a category first</p>
                                @endif
                                @error('selectedSubject') 
                                    <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" wire:model="is_active" class="rounded border-gray-300 text-teal-600 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    <span class="ml-2 text-sm text-gray-600">Active</span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-4">
                            <button 
                                type="button" 
                                wire:click="toggleEditModal"
                                class="rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition duration-150"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                class="rounded-xl border border-transparent bg-teal-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition duration-150"
                            >
                                Update Question Manager
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>