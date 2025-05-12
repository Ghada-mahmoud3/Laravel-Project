<x-guest-layout>
       <div class="mb-4 text-sm text-gray-600">
           {{ __('Log in to your account') }}
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

       @if (session('status'))
           <div class="mb-4 font-medium text-sm text-green-600">
               {{ session('status') }}
           </div>
       @endif

       <form method="POST" action="{{ route('login') }}">
           @csrf

           <!-- Email Address -->
           <div>
               <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
               <input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
           </div>

           <!-- Password -->
           <div class="mt-4">
               <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
               <input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="password" required autocomplete="current-password" />
           </div>

           <!-- Remember Me -->
           <div class="block mt-4">
               <label for="remember_me" class="inline-flex items-center">
                   <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                   <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
               </label>
           </div>

           <div class="flex items-center justify-end mt-4">
               @if (Route::has('password.request'))
                   <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                       {{ __('Forgot your password?') }}
                   </a>
               @endif

               <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                   {{ __('Log in') }}
               </button>
           </div>
       </form>
   </x-guest-layout>