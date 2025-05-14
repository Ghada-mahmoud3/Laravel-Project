<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore Job Opportunities') }}
        </h2>
    </x-slot>

    {{-- Container --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Title and Create Button --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-indigo-700">🔍 Job Search</h1>
            @if (Auth::user()->role == 'employer')
                <a href="{{ route('jobs.create') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Post a Job
                </a>
            @endif
        </div>

        {{-- Alert Messages --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{-- Search Form --}}
        <form method="GET" action="{{ route('jobs.search') }}" class="space-y-6 bg-white p-6 rounded-xl shadow-md mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="keyword" placeholder="🔑 Keyword" value="{{ request()->keyword }}"
                    class="rounded-lg border border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400">

                <select name="location"
                    class="rounded-lg border border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                    <option value="">🌍 Location</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location }}" {{ request()->location == $location ? 'selected' : '' }}>
                            {{ $location }}
                        </option>
                    @endforeach
                </select>

                <select name="category"
                    class="rounded-lg border border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                    <option value="">🗂 Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request()->category == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

                <select name="experienceLevel"
                    class="rounded-lg border border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                    <option value="">💼 Experience</option>
                    @foreach ($experienceLevels as $level)
                        <option value="{{ $level }}" {{ request()->experienceLevel == $level ? 'selected' : '' }}>
                            {{ $level }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="salaryRange" placeholder="💰 Salary range (e.g., 50000-70000)"
                    value="{{ request()->salaryRange }}"
                    class="rounded-lg border border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400">

                <input type="date" name="application_deadline" value="{{ request()->application_deadline }}"
                    class="rounded-lg border border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">

                <select name="work_type" class="rounded-lg border border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                        <option value="">📝 Work Type</option>
                        @foreach ($work_types as $work_type)
                            <option value="{{ $work_type }}" {{ request()->work_type == $work_type ? 'selected' : '' }}>
                                {{ $work_type }}
                            </option>
                        @endforeach
                    </select>

                    <div class="flex space-x-2">
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                            🔍 Search
                        </button>
                        <button type="button" onclick="resetForm()"
                            class="w-1/3 bg-gray-200 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-300 transition duration-200">
                            ↺
                        </button>
                    </div>
            </div>
        </form>

        {{-- Job Listings --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
            @forelse ($jobs as $job)
                <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        @if($job->logo_path)
                            <img src="{{ asset('storage/' . $job->logo_path) }}" alt="{{ $job->title }} Logo"
                                class="w-12 h-12 object-contain rounded-lg border border-gray-200 mr-3">
                        @else
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-indigo-700">
                                <a href="{{ route('jobs.show', $job->id) }}" class="hover:underline">{{ $job->title }}</a>
                            </h3>
                        </div>

                        @if(Auth::check() && $job->employer_id == Auth::id())
                            <a href="{{ route('jobs.edit', $job->id) }}" class="text-blue-500 hover:text-blue-700 ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                        @endif
                    </div>

                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ Str::limit($job->description, 120) }}
                    </p>

                    <div class="text-sm text-gray-500 space-y-1">
                        <p class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-medium">{{ $job->location }}</span>
                        </p>
                        <p class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span class="font-medium">{{ $job->category }}</span>
                        </p>
                        <p class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="font-medium">{{ $job->created_at->format('Y-m-d') }}</span>
                        </p>

                        @if($job->work_type)
                            <p class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="font-medium">{{ $job->work_type }}</span>
                            </p>
                        @endif
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                        @if($job->salary_min && $job->salary_max)
                            <span class="text-sm font-semibold text-green-600">${{ number_format($job->salary_min) }} -
                                ${{ number_format($job->salary_max) }}</span>
                        @elseif($job->salary_min)
                            <span class="text-sm font-semibold text-green-600">From
                                ${{ number_format($job->salary_min) }}</span>
                        @elseif($job->salary_max)
                            <span class="text-sm font-semibold text-green-600">Up to
                                ${{ number_format($job->salary_max) }}</span>
                        @else
                            <span class="text-sm text-gray-500">Salary not specified</span>
                        @endif

                        <a href="{{ route('jobs.show', $job->id) }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-800">View Details →</a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 bg-white p-8 rounded-xl shadow text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-500 text-xl font-medium mb-4">No jobs found matching your criteria.</p>
                    <button onclick="resetForm()" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Clear Filters
                    </button>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $jobs->links() }}
        </div>
    </div>

    {{-- Reset Form Script --}}
    <script>
        function resetForm() {
            document.querySelector('form').reset();
            window.location.href = "{{ route('jobs.search') }}";
        }
    </script>
</x-app-layout>