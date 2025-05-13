<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-12 px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Left Side: Personal Info --}}
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Personal Information</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <span class="w-1/3 font-medium text-gray-700">Name:</span>
                            <span class="text-gray-800">{{ $user->name }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-1/3 font-medium text-gray-700">Email:</span>
                            <span class="text-gray-800">{{ $user->email }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-1/3 font-medium text-gray-700">Phone:</span>
                            <span class="text-gray-800">{{ $candidate->phone ?? 'Empty' }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-1/3 font-medium text-gray-700">Location:</span>
                            <span class="text-gray-800">{{ $candidate->location ?? 'Empty' }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-1/3 font-medium text-gray-700">Skills:</span>
                            <span class="text-gray-800">{{ $candidate->skills ?? 'Empty' }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-1/3 font-medium text-gray-700">Experience:</span>
                            <span class="text-gray-800">{{ $candidate->experience ?? 'Empty' }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-1/3 font-medium text-gray-700">Education:</span>
                            <span class="text-gray-800">{{ $candidate->education ?? 'Empty' }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-1/3 font-medium text-gray-700">Bio:</span>
                            <span class="text-gray-800">{{ $candidate->bio ?? 'Empty' }}</span>
                        </li>
                    </ul>
                </div>

                {{-- Right Side: Resume and Action --}}
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Resume & Action</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <span class="w-1/3 font-medium text-gray-700">Resume:</span>
                            @if(!empty($candidate->resume))
                                <a href="{{ asset('storage/' . $candidate->resume) }}"
                                   target="_blank"
                                   class="text-indigo-600 hover:text-indigo-800 transition">
                                    Download Resume
                                </a>
                            @else
                                <span class="text-gray-500">Not uploaded</span>
                            @endif
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('profile.edit') }}"
                               class="w-full md:w-auto inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-full text-lg font-semibold hover:bg-indigo-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 3l9 9-9 9M4 12h16"/>
                                </svg>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
