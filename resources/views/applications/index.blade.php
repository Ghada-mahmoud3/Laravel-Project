<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Applications') }}
        </h2>
    </x-slot>

    <div class="container mt-8 px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($applications as $application)
                <div class="bg-white shadow-lg rounded-lg p-6 transition-shadow duration-300 hover:shadow-xl transform hover:scale-105">
                    <div class="flex justify-between items-start">
                        <!-- Job Title and Details -->
                        <div class="flex-1">
                            <strong class="text-2xl font-semibold text-gray-800">{{ $application->job->title }}</strong><br>
                            <span class="text-sm text-gray-600">Applied on: <span class="font-medium">{{ $application->created_at->format('M d, Y') }}</span></span><br>
                            <span class="text-sm text-gray-600">Status: </span>
                            <span class="inline-block px-3 py-1 text-sm rounded-full 
                                {{ 
                                    $application->status == 'accepted' ? 'bg-green-100 text-green-800' : 
                                    ($application->status == 'rejected' ? 'bg-red-100 text-red-800' : 
                                    ($application->status == 'cancelled' ? 'bg-gray-200 text-gray-600' : 'bg-yellow-100 text-yellow-800')) 
                                }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>

                        <div class="ml-4">
                            <a href="{{ asset('storage/' . $application->resume_path) }}" 
                               class="bg-blue-600 text-white px-5 py-2 rounded-md text-sm font-semibold shadow-md hover:bg-blue-700 transition-all duration-200 ease-in-out" 
                               target="_blank">
                                View Resume
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
