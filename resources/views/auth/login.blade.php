<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold text-center text-indigo-700 mb-6">
            Welcome Back!
        </h2>
        <p class="text-sm text-gray-600 text-center mb-6">
            {{ __('Log in to your account') }}
        </p>

        @if ($errors->any())
            <div class="mb-4">
                <div class="font-medium text-red-600">
                    {{ __('Whoops! Something went wrong.') }}
                </div>
                <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600 bg-green-100 px-4 py-2 rounded-md">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">📧 {{ __('Email') }}</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="you@example.com" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">🔒 {{ __('Password') }}</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="••••••••" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <a class="text-sm text-indigo-600 hover:underline" href="{{ route('register') }}">
                        {{ __('Sign up') }}
                    </a>

                <button type="submit"
                    class="ml-3 inline-flex items-center px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    🔑 {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
