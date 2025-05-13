<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Details') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="text-2xl font-bold text-indigo-700 mb-2">{{ $job->title }}</h3>
            <p class="text-gray-600 mb-4">{{ Str::limit($job->description, 150) }}</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                <p><span class="font-semibold">🗂 Category:</span> {{ $job->category }}</p>
                <p><span class="font-semibold">📍 Location:</span> {{ $job->location }}</p>
                <p><span class="font-semibold">💼 Experience:</span> {{ $job->experience_level }}</p>
                <p><span class="font-semibold">💰 Salary:</span> {{ $job->salary_min }} - {{ $job->salary_max }}</p>
                <p><span class="font-semibold">🕒 Work Type:</span> {{ $job->work_type }}</p>
                <p><span class="font-semibold">📅 Deadline:</span> {{ \Carbon\Carbon::parse($job->application_deadline)->format('Y-m-d') }}</p>
            </div>
        </div>

        @if (Auth::user()->role == 'candidate')
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
        @endif
    </div>
</x-app-layout>
