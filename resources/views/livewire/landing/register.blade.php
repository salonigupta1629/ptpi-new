<div class="flex min-h-screen">
     <!-- Left Side - Form -->
     <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
         <div class="w-full max-w-md">
             <!-- Header -->
             <div class="mb-8">
                 <p class="text-gray-600 text-lg mb-2">Hello, <span class="text-teal-600 font-semibold">Teachers</span>
                 </p>
                 <h1 class="text-4xl font-bold text-gray-800 mb-2">
                     Signup To <span class="text-teal-600">PTPI</span>
                 </h1>
             </div>

             <!-- Form -->
             <form class="space-y-6">
                 <!-- Name Fields -->
                 <div class="grid grid-cols-2 gap-4">
                     <div>
                         <label class="block text-gray-700 text-sm font-medium mb-2">First Name</label>
                         <input type="text" placeholder="Enter your first name"
                             class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all">
                     </div>
                     <div>
                         <label class="block text-gray-700 text-sm font-medium mb-2">Last Name</label>
                         <input type="text" placeholder="Enter your last name"
                             class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all">
                     </div>
                 </div>

                 <!-- Email Field -->
                 <div>
                     <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                     <div class="relative">
                         <input type="email" value="cwspurnea@gmail.com"
                             class="w-full px-4 py-3 pr-12 border-2 border-teal-500 bg-teal-50 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all">
                         <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                             <i class="fas fa-check text-teal-500"></i>
                         </div>
                     </div>
                 </div>

                 <!-- Password Field -->
                 <div>
                     <label class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                     <div class="relative">
                         <input type="password" value="password123"
                             class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all">
                         <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4">
                             <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                         </button>
                     </div>
                     <!-- Password Requirements -->
                     <div class="mt-2 space-y-1">
                         <div class="flex items-center text-sm text-teal-600">
                             <i class="fas fa-check text-xs mr-2"></i>
                             <span>At least 8 characters</span>
                         </div>
                         <div class="flex items-center text-sm text-teal-600">
                             <i class="fas fa-check text-xs mr-2"></i>
                             <span>Contains a number</span>
                         </div>
                         <div class="flex items-center text-sm text-teal-600">
                             <i class="fas fa-check text-xs mr-2"></i>
                             <span>Contains a special character</span>
                         </div>
                     </div>
                 </div>

                 <!-- Buttons -->
                 <div class="space-y-3">
                     <button type="submit"
                         class="w-full bg-teal-400 hover:bg-teal-500 text-white font-semibold py-3 rounded-lg transition-colors duration-200">
                         Sign Up as Teacher
                     </button>
                     <button type="button"
                         class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 rounded-lg transition-colors duration-200">
                         Sign up as Recruiter
                     </button>
                 </div>

                 <div class="text-center">
                     <span class="text-gray-500">or</span>
                 </div>
             </form>
         </div>
     </div>

     <!-- Right Side - Process Steps and Image -->
     <div class="hidden lg:flex lg:w-1/2 bg-white items-center justify-center p-8 relative">
         <div class="max-w-md">
             <!-- Process Steps -->
             <div class="space-y-8 mb-8">
                 <!-- Step 1 -->
                 <div class="flex items-start space-x-4">
                     <div
                         class="flex-shrink-0 w-8 h-8 bg-teal-600 text-white rounded-full flex items-center justify-center text-sm font-bold">
                         1
                     </div>
                     <div>
                         <h3 class="font-semibold text-gray-800 text-lg">Create Account</h3>
                         <p class="text-gray-600">Fill in your details to create your account</p>
                     </div>
                 </div>

                 <!-- Step 2 -->
                 <div class="flex items-start space-x-4">
                     <div
                         class="flex-shrink-0 w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">
                         2
                     </div>
                     <div>
                         <h3 class="font-semibold text-gray-800 text-lg">Verify Email</h3>
                         <p class="text-gray-600">Confirm your email address</p>
                     </div>
                 </div>

                 <!-- Step 3 -->
                 <div class="flex items-start space-x-4">
                     <div
                         class="flex-shrink-0 w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">
                         3
                     </div>
                     <div>
                         <h3 class="font-semibold text-gray-800 text-lg">Complete Profile</h3>
                         <p class="text-gray-600">Set up your teacher profile</p>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Person Image -->
         <div
             class="absolute bottom-0 right-8 w-80 h-96 bg-gradient-to-t from-gray-100 to-transparent rounded-t-full overflow-hidden">
             <div class="w-full h-full flex items-end justify-center">
                 <!-- Placeholder for person image -->
                 <div class="w-64 h-80 bg-gray-300 rounded-t-full flex items-center justify-center">
                     <div class="text-center">
                         <i class="fas fa-user text-6xl text-gray-500 mb-4"></i>
                         <p class="text-gray-600">Teacher Image</p>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Connecting Line -->
         <div class="absolute left-8 top-32 w-px h-32 bg-teal-200"></div>
     </div>
</div>