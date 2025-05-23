<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-gray-900 leading-tight">
            {{ __('Edit Job Opportunity') }}
        </h2>
    </x-slot>

    {{-- Container --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Title --}}
        <h1 class="text-2xl font-bold text-indigo-700 mb-6">📝 Edit Job</h1>

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

        {{-- Edit Form --}}
        <form method="POST" action="{{ route('jobs.update', $job->id) }}" class="space-y-6 bg-white p-6 rounded-xl shadow-md" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Job Title -->
                <div class="flex flex-col">
                    <label for="title" class="text-sm font-medium text-gray-700">Job Title <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $job->title) }}" required
                        class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Location -->
                <div class="flex flex-col">
                    <label for="location" class="text-sm font-medium text-gray-700">Location <span class="text-red-500">*</span></label>
                    <input type="text" id="location" name="location" value="{{ old('location', $job->location) }}" required
                        class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Company Logo -->
            <div class="flex flex-col">
                <label for="logo" class="text-sm font-medium text-gray-700">Company Logo</label>
                <div class="mt-1 flex items-center">
                    @if($job->logo_path)
                        <div class="mr-4">
                            <img src="{{ asset('storage/' . $job->logo_path) }}" alt="Current Logo" class="w-16 h-16 object-contain rounded-lg border border-gray-200">
                        </div>
                    @endif
                    <input type="file" id="logo" name="logo" accept="image/*"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <p class="ml-3 text-xs text-gray-500">Recommended size: 200x200px (Max: 2MB)</p>
                </div>
                @error('logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Category -->
                <div class="flex flex-col">
                    <label for="category" class="text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                    <select id="category" name="category" required class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select a category</option>
                        <option value="Technology" {{ old('category', $job->category) == 'Technology' ? 'selected' : '' }}>Technology</option>
                        <option value="Marketing" {{ old('category', $job->category) == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        <option value="Finance" {{ old('category', $job->category) == 'Finance' ? 'selected' : '' }}>Finance</option>
                        <option value="Healthcare" {{ old('category', $job->category) == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                        <option value="Education" {{ old('category', $job->category) == 'Education' ? 'selected' : '' }}>Education</option>
                        <option value="Design" {{ old('category', $job->category) == 'Design' ? 'selected' : '' }}>Design</option>
                        <option value="Sales" {{ old('category', $job->category) == 'Sales' ? 'selected' : '' }}>Sales</option>
                        <option value="Other" {{ old('category', $job->category) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Experience Level -->
                <div class="flex flex-col">
                    <label for="experience_level" class="text-sm font-medium text-gray-700">Experience Level</label>
                    <select id="experience_level" name="experience_level" class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select experience level</option>
                        <option value="Entry Level" {{ old('experience_level', $job->experience_level) == 'Entry Level' ? 'selected' : '' }}>Entry Level</option>
                        <option value="Mid Level" {{ old('experience_level', $job->experience_level) == 'Mid Level' ? 'selected' : '' }}>Mid Level</option>
                        <option value="Senior Level" {{ old('experience_level', $job->experience_level) == 'Senior Level' ? 'selected' : '' }}>Senior Level</option>
                        <option value="Executive" {{ old('experience_level', $job->experience_level) == 'Executive' ? 'selected' : '' }}>Executive</option>
                    </select>
                    @error('experience_level') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Salary Range -->
                <div class="flex flex-col">
                    <label for="salary_min" class="text-sm font-medium text-gray-700">Minimum Salary</label>
                    <input type="number" id="salary_min" name="salary_min" value="{{ old('salary_min', $job->salary_min) }}"
                        class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('salary_min') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col">
                    <label for="salary_max" class="text-sm font-medium text-gray-700">Maximum Salary</label>
                    <input type="number" id="salary_max" name="salary_max" value="{{ old('salary_max', $job->salary_max) }}"
                        class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('salary_max') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="flex flex-col">
                <label for="description" class="text-sm font-medium text-gray-700">Job Description <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="6" required
                    class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $job->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Work Type -->
            <div class="flex flex-col">
                <label for="work_type" class="text-sm font-medium text-gray-700">Work Type</label>
                <select id="work_type" name="work_type" class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Full-time" {{ old('work_type', $job->work_type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('work_type', $job->work_type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('work_type', $job->work_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Remote" {{ old('work_type', $job->work_type) == 'Remote' ? 'selected' : '' }}>Remote</option>
                    <option value="Internship" {{ old('work_type', $job->work_type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('work_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Application Deadline -->
            <div class="flex flex-col">
                <label for="application_deadline" class="text-sm font-medium text-gray-700">Application Deadline</label>
                <input type="date" id="application_deadline" name="application_deadline" value="{{ old('application_deadline', $job->application_deadline ? date('Y-m-d', strtotime($job->application_deadline)) : '') }}"
                    class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                @error('application_deadline') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end mt-8 space-x-4">
                <a href="{{ route('jobs.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Update Job
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
