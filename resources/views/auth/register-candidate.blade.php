<x-guest-layout>
<div class="mb-6 text-lg font-semibold text-gray-700 text-center">
    {{ __('Register as a Candidate') }}
</div>


    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <div class="font-medium">{{ __('Whoops! Something went wrong.') }}</div>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.candidate.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Section: Personal Info -->
        <div class="border-b pb-4">
            <h2 class="text-md font-semibold text-gray-800 mb-4">Personal Information</h2>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone (Optional)</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Location -->
            <div class="mt-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Location (Optional)</label>
                <input id="location" name="location" type="text" value="{{ old('location') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
        </div>

        <!-- Section: Security -->
        <div class="border-b pb-4">
            <h2 class="text-md font-semibold text-gray-800 mb-4">Account Security</h2>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
        </div>

        <!-- Section: Professional Info -->
        <div class="border-b pb-4">
            <h2 class="text-md font-semibold text-gray-800 mb-4">Professional Information</h2>

            <!-- Skills -->
            <div>
                <label for="skills" class="block text-sm font-medium text-gray-700">Skills (Optional)</label>
                <textarea id="skills" name="skills" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('skills') }}</textarea>
            </div>

            <!-- Bio -->
            <div class="mt-4">
                <label for="bio" class="block text-sm font-medium text-gray-700">Bio (Optional)</label>
                <textarea id="bio" name="bio" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('bio') }}</textarea>
            </div>

            <!-- Experience -->
            <div class="mt-4">
                <label for="experience" class="block text-sm font-medium text-gray-700">Experience (Optional)</label>
                <textarea id="experience" name="experience" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('experience') }}</textarea>
            </div>

            <!-- Education -->
            <div class="mt-4">
                <label for="education" class="block text-sm font-medium text-gray-700">Education (Optional)</label>
                <textarea id="education" name="education" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('education') }}</textarea>
            </div>
        </div>

        <!-- Section: Resume Upload -->
        <div>
            <h2 class="text-md font-semibold text-gray-800 mb-4">Resume</h2>
            <label for="resume" class="block text-sm font-medium text-gray-700">Resume (PDF, DOC)</label>
            <input id="resume" name="resume" type="file" accept=".pdf,.doc,.docx"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                       file:rounded-md file:border-0
                       file:text-sm file:font-semibold
                       file:bg-indigo-50 file:text-indigo-700
                       hover:file:bg-indigo-100" />
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                {{ __('Choose another role') }}
            </a>
            <button type="submit"
                class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white tracking-wide hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Register
            </button>
        </div>
    </form>
</x-guest-layout>
