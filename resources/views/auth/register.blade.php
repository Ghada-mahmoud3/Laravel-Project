<x-guest-layout>
       <div class="mb-4 text-sm text-gray-600">
           {{ __('Register as an Employer') }}
       </div>

       @if ($errors->any())
           <div class="mb-4">
               <div class="font-medium text-red-600">
                   {{ __('Whoops! Something went wrong.') }}
               </div>
               <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                   @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                   @endforeach
               </ul>
           </div>
       @endif

       <form method="POST" action="{{ route('register.employer.store') }}" enctype="multipart/form-data">
           @csrf

           <!-- Name -->
           <div>
               <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
               <input id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
           </div>

           <!-- Email Address -->
           <div class="mt-4">
               <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
               <input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
           </div>

           <!-- Password -->
           <div class="mt-4">
               <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
               <input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="password" required autocomplete="new-password" />
           </div>

           <!-- Confirm Password -->
           <div class="mt-4">
               <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
               <input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="password_confirmation" required autocomplete="new-password" />
           </div>

           <!-- Company Name -->
           <div class="mt-4">
               <label for="company_name" class="block text-sm font-medium text-gray-700">{{ __('Company Name') }}</label>
               <input id="company_name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="company_name" value="{{ old('company_name') }}" required />
           </div>

           <!-- Company Logo -->
           <div class="mt-4">
               <label for="company_logo" class="block text-sm font-medium text-gray-700">{{ __('Company Logo (Optional)') }}</label>
               <input id="company_logo" class="block mt-1 w-full" type="file" name="company_logo" accept="image/*" />
           </div>

           <div class="flex items-center justify-end mt-4">
               <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                   {{ __('Choose another role') }}
               </a>

               <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                   {{ __('Register') }}
               </button>
           </div>
       </form>
   </x-guest-layout>