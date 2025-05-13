<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 text-green-800 border-l-4 border-green-500 p-4 rounded-lg">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif

            <!-- Profile Update Form -->
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-lg font-medium text-gray-900">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                               class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <!-- Email (readonly) -->
                    <div class="mb-6">
                        <label for="email" class="block text-lg font-medium text-gray-900">Email</label>
                        <input type="email" value="{{ $user->email ?? '' }}" disabled
                               class="mt-2 p-3 w-full border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
                    </div>

                    <!-- Phone -->
                    <div class="mb-6">
                        <label for="phone" class="block text-lg font-medium text-gray-900">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $candidate->phone ?? '') }}"
                               class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Location -->
                    <div class="mb-6">
                        <label for="location" class="block text-lg font-medium text-gray-900">Location</label>
                        <input type="text" name="location" value="{{ old('location', $candidate->location ?? '') }}"
                               class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Skills -->
                    <div class="mb-6">
                        <label for="skills" class="block text-lg font-medium text-gray-900">Skills</label>
                        <textarea name="skills" rows="3"
                                  class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('skills', $candidate->skills ?? '') }}</textarea>
                    </div>

                    <!-- Experience -->
                    <div class="mb-6">
                        <label for="experience" class="block text-lg font-medium text-gray-900">Experience</label>
                        <textarea name="experience" rows="3"
                                  class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('experience', $candidate->experience ?? '') }}</textarea>
                    </div>

                    <!-- Education -->
                    <div class="mb-6">
                        <label for="education" class="block text-lg font-medium text-gray-900">Education</label>
                        <textarea name="education" rows="3"
                                  class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('education', $candidate->education ?? '') }}</textarea>
                    </div>

                    <!-- Bio -->
                    <div class="mb-6">
                        <label for="bio" class="block text-lg font-medium text-gray-900">Bio</label>
                        <textarea name="bio" rows="3"
                                  class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('bio', $candidate->bio ?? '') }}</textarea>
                    </div>

                    <!-- Resume Upload -->
                    <div class="mb-6">
                        <label for="resume" class="block text-lg font-medium text-gray-900">Resume (PDF, optional)</label>
                        <input type="file" name="resume"
                               class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" accept=".pdf">
                        @if(!empty($candidate->resume))
                            <div class="mt-2 text-blue-600">
                                <a href="{{ asset('storage/' . $candidate->resume) }}" target="_blank">View Current Resume</a>
                            </div>
                        @endif
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            class="w-full py-3 px-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-200">
                        Update Profile
                    </button>

                    <!-- Cancel -->
                    <a href="{{ route('profile.show') }}"
                       class="mt-4 block text-center text-indigo-600 font-medium hover:text-indigo-700 transition duration-200">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
