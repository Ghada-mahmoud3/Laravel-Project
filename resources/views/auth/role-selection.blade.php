<x-guest-layout>
       <div class="mb-4 text-sm text-gray-600">
           {{ __('Please select your role to register') }}
       </div>

       <div class="flex justify-center space-x-4">
           <a href="{{ route('register.employer') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
               {{ __('Register as Employer') }}
           </a>
           <a href="{{ route('register.candidate') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
               {{ __('Register as Candidate') }}
           </a>
       </div>

       <div class="flex items-center justify-end mt-4">
           <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
               {{ __('Already registered?') }}
           </a>
       </div>
   </x-guest-layout>