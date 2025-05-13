<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-900 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success bg-green-100 text-green-800 border-l-4 border-green-500 p-4 rounded-lg">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif

            <!-- Profile Update Form -->
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-lg font-medium text-gray-900">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <!-- Email Field (Disabled) -->
                    <div class="mb-6">
                        <label for="email" class="block text-lg font-medium text-gray-900">Email</label>
                        <input type="email" class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ $user->email ?? '' }}" disabled>
                    </div>

                    <!-- Phone Field -->
                    <div class="mb-6">
                        <label for="phone" class="block text-lg font-medium text-gray-900">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $candidate->phone ?? '') }}" class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Skills Field -->
                    <div class="mb-6">
                        <label for="skills" class="block text-lg font-medium text-gray-900">Skills</label>
                        <textarea name="skills" rows="3" class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('skills', $candidate->skills ?? '') }}</textarea>
                    </div>

                    <!-- Bio Field -->
                    <div class="mb-6">
                        <label for="bio" class="block text-lg font-medium text-gray-900">Bio</label>
                        <textarea name="bio" rows="3" class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('bio', $candidate->bio ?? '') }}</textarea>
                    </div>

                    <!-- Resume Upload -->
                    <div class="mb-6">
                        <label for="resume" class="block text-lg font-medium text-gray-900">Resume (optional)</label>
                        <input type="file" name="resume" class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @if(!empty($candidate->resume_path))
                            <div class="mt-2 text-blue-600">
                                <a href="{{ asset('storage/' . $candidate->resume_path) }}" target="_blank">View Current Resume</a>
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 px-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition ease-in-out duration-200">
                        Update Profile
                    </button>

                    <!-- Cancel Button -->
                    <a href="{{ route('profile.show') }}" class="mt-4 block text-center text-indigo-600 font-medium hover:text-indigo-700 transition ease-in-out duration-200">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
