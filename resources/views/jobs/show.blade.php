<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-gray-900 leading-tight">
            {{ __('Job Details') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
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

        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex justify-between items-start mb-6">
                <div class="flex items-start">
                    @if($job->logo_path)
                        <!-- صورة الشركة بتنسيق أفضل -->
                        <div class="w-24 h-24 flex items-center justify-center bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <img src="{{ asset('storage/' . $job->logo_path) }}"
                                 alt="{{ $job->title }} Logo"
                                 class="max-w-full max-h-full object-contain"
                                 onerror="this.src='{{ asset('images/default-logo.png') }}'; console.log('Error loading image: {{ asset('storage/' . $job->logo_path) }}');">
                        </div>
                    @else
                        <!-- أيقونة افتراضية إذا لم تكن هناك صورة -->
                        <div class="w-24 h-24 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-2xl font-bold text-indigo-700 mb-2">{{ $job->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($job->description), 50) }}</p>
                    </div>
                </div>

                @if(Auth::check() && $job->employer_id == Auth::id())
                    <div class="flex space-x-3">
                        <a href="{{ route('jobs.edit', $job->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit Job
                        </a>

                        <a href="{{ route('employer.applications.job', $job->id) }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                            View Applications ({{ $job->applications->count() }})
                        </a>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 mb-6">
                <p><span class="font-semibold">🗂 Category:</span> {{ $job->category }}</p>
                <p><span class="font-semibold">📍 Location:</span> {{ $job->location }}</p>
                <p><span class="font-semibold">💼 Experience:</span> {{ $job->experience_level }}</p>

                @if($job->salary_min && $job->salary_max)
                    <p><span class="font-semibold">💰 Salary:</span> ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}</p>
                @elseif($job->salary_min)
                    <p><span class="font-semibold">💰 Salary:</span> From ${{ number_format($job->salary_min) }}</p>
                @elseif($job->salary_max)
                    <p><span class="font-semibold">💰 Salary:</span> Up to ${{ number_format($job->salary_max) }}</p>
                @else
                    <p><span class="font-semibold">💰 Salary:</span> Not specified</p>
                @endif

                <p><span class="font-semibold">🕒 Work Type:</span> {{ $job->work_type }}</p>

                @if($job->application_deadline)
                    <p><span class="font-semibold">📅 Deadline:</span> {{ \Carbon\Carbon::parse($job->application_deadline)->format('Y-m-d') }}</p>
                @endif
            </div>

            <div class="border-t border-gray-200 pt-6 mt-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-1">Job Description</h4>
                <div class="prose max-w-none text-gray-600 whitespace-pre-wrap break-words overflow-hidden">
                    {!! nl2br(e($job->description)) !!}
                </div>
            </div>
        </div>

        <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-md p-6 mt-8 space-y-6">
            @csrf
            <input type="hidden" name="job_id" value="{{ $job->id }}">

            <h4 class="text-xl font-bold text-gray-800">📝 Apply for this Job</h4>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">📧 Email</label>
                <input type="email" name="email" id="email"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="you@example.com" required>
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">📱 Phone Number</label>
                <input type="text" name="phone" id="phone"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="e.g. +201234567890" required>
            </div>

            <div>
                <label for="resume" class="block text-sm font-medium text-gray-700">📄 Upload Resume</label>
                <input type="file" name="resume" id="resume"
                       class="mt-1 block w-full text-gray-700 file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-sm file:font-semibold
                              file:bg-indigo-50 file:text-indigo-700
                              hover:file:bg-indigo-100">
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">✉️ Additional Message (optional)</label>
                <textarea name="message" id="message" rows="5"
                          class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="Write a short message to the employer..."></textarea>
            </div>

            <div class="flex flex-col sm:flex-row justify-between gap-4">
                <a href="{{ route('jobs.search') }}"
                   class="inline-block px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                    ← Return to Search
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                    🚀 Apply Now
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
