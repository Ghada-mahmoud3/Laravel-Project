<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore Job Opportunities') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-indigo-700 mb-6">🔍 Job Search</h1>


        <form method="GET" action="{{ route('jobs.search') }}" class="space-y-6 bg-white p-6 rounded-xl shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <input type="text" name="keyword" placeholder="🔑 Keyword" value="{{ request()->keyword }}"
                       class="rounded-lg border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400">

                <select name="location"
                        class="rounded-lg border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                    <option value="">🌍 Location</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location }}" {{ request()->location == $location ? 'selected' : '' }}>{{ $location }}</option>
                    @endforeach
                </select>


                <select name="category"
                        class="rounded-lg border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                    <option value="">🗂 Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request()->category == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>

                <select name="experienceLevel"
                        class="rounded-lg border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                    <option value="">💼 Experience</option>
                    @foreach ($experienceLevels as $level)
                        <option value="{{ $level }}" {{ request()->experienceLevel == $level ? 'selected' : '' }}>{{ $level }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <input type="text" name="salaryRange" placeholder="💰 Salary range (e.g., 50000-70000)" value="{{ request()->salaryRange }}"
                       class="rounded-lg border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400">

                <input type="date" name="date"
                       class="rounded-lg border-gray-300 shadow-sm w-full focus:ring-indigo-500 focus:border-indigo-500 text-gray-700"
                       value="{{ request()->date }}">

                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                    🔍 Search
                </button>

                <button type="button" onclick="resetForm()"
                        class="w-full bg-gray-200 text-gray-800 py-2 rounded-lg font-semibold hover:bg-gray-300 transition duration-200">
                    🔄 Reset
                </button>
            </div>
        </form>

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
            @forelse ($jobs as $job)
                <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition ">
                    <h3 class="text-xl font-semibold text-indigo-700 mb-1">
                        <a href="show/{{ $job->id }}">{{ $job->title }}</a>
                    </h3>
                    <p class="text-gray-600 mb-2">{{ Str::limit($job->description, 120) }}</p>
                    <div class="text-sm text-gray-500 space-y-1">
                        <p>📍 <span class="font-medium">{{ $job->location }}</span></p>
                        <p>🗂 <span class="font-medium">{{ $job->category }}</span></p>
                        <p>📅 Posted: <span class="font-medium">{{ $job->created_at->format('Y-m-d') }}</span></p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-3 text-center mt-10">No jobs found matching your criteria.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $jobs->links() }}
        </div>
    </div>

    <script>
        function resetForm() {
            document.querySelector('form').reset();
            window.location.href = "{{ route('jobs.search') }}";
        }
    </script>
</x-app-layout>
