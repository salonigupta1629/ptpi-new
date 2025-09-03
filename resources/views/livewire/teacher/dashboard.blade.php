<div>
    
        <!-- Class Category Selection -->
        <div class="bg-blue-500 rounded-lg p-6 mb-6 text-white">
            <div class="flex items-center space-x-2 mb-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                    </path>
                </svg>
                <h3 class="text-xl font-bold">Select Class Category</h3>
            </div>
            <p class="text-blue-100">Choose from your profile preferences</p>
        </div>

        <!-- Category Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
           
        </div>

        
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Start Your Assessment</h3>
                <p class="text-gray-600 mb-8">Follow the steps above: select category, subject, and level to
                    begin</p>
                <button wire:click="startAssessment"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200">
                    Begin Assessment
                </button>
            </div>
    
</div>