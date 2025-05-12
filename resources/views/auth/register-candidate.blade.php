<x-guest-layout>
       <div class="mb-4 text-sm text-gray-600">
           {{ __('Register as a Candidate') }}
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

       <form method="POST" action="{{ route('register.candidate.store') }}" enctype="multipart/form-data">
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

           <!-- Resume -->
           <div class="mt-4">
               <label for="resume" class="block text-sm font-medium text-gray-700">{{ __('Resume (Optional)') }}</label>
               <input id="resume" class="block mt-1 w-full" type="file" name="resume" accept=".pdf,.doc,.docx" />
           </div>

           <!-- Skills -->
           <div class="mt-4">
               <label for="skills" class="block text-sm font-medium text-gray-700">{{ __('Skills (Optional)') }}</label>
               <textarea id="skills" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="skills">{{ old('skills') }}</textarea>
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