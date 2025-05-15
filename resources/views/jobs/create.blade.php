<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Job Opportunity') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{-- Title --}}
        <h1 class="text-2xl font-bold text-indigo-700 mb-6">📝 Post a New Job</h1>

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

        <form action="{{ route('jobs.store') }}" method="POST" class="mt-8 space-y-6 bg-white p-6 rounded-xl shadow-md" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Job Title -->
                <div class="flex flex-col">
                    <label for="title" class="text-sm font-medium text-gray-700">Job Title <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Location -->
                <div class="flex flex-col">
                    <label for="location" class="text-sm font-medium text-gray-700">Location <span class="text-red-500">*</span></label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}" required
                        class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Company Logo -->
            <div class="mb-4">
                <label for="logo" class="block text-sm font-medium text-gray-700">Company Logo</label>
                <input type="file" id="logo" name="logo" accept="image/*"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <p class="mt-1 text-sm text-gray-500">Upload a company logo (JPEG, PNG, JPG, max 5MB)</p>
                @error('logo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Category -->
                <div class="flex flex-col">
                    <label for="category" class="text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                    <select id="category" name="category" required class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select a category</option>
                        <option value="Technology" {{ old('category') == 'Technology' ? 'selected' : '' }}>Technology</option>
                        <option value="Marketing" {{ old('category') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        <option value="Finance" {{ old('category') == 'Finance' ? 'selected' : '' }}>Finance</option>
                        <option value="Healthcare" {{ old('category') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                        <option value="Education" {{ old('category') == 'Education' ? 'selected' : '' }}>Education</option>
                        <option value="Design" {{ old('category') == 'Design' ? 'selected' : '' }}>Design</option>
                        <option value="Sales" {{ old('category') == 'Sales' ? 'selected' : '' }}>Sales</option>
                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Experience Level -->
                <div class="flex flex-col">
                    <label for="experience_level" class="text-sm font-medium text-gray-700">Experience Level</label>
                    <select id="experience_level" name="experience_level" class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select experience level</option>
                        <option value="Entry Level" {{ old('experience_level') == 'Entry Level' ? 'selected' : '' }}>Entry Level</option>
                        <option value="Mid Level" {{ old('experience_level') == 'Mid Level' ? 'selected' : '' }}>Mid Level</option>
                        <option value="Senior Level" {{ old('experience_level') == 'Senior Level' ? 'selected' : '' }}>Senior Level</option>
                        <option value="Executive" {{ old('experience_level') == 'Executive' ? 'selected' : '' }}>Executive</option>
                    </select>
                    @error('experience_level') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Salary Range -->
                <div class="flex flex-col">
                    <label for="salary_min" class="text-sm font-medium text-gray-700">Minimum Salary</label>
                    <input type="number" id="salary_min" name="salary_min" value="{{ old('salary_min') }}"
                        class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('salary_min') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col">
                    <label for="salary_max" class="text-sm font-medium text-gray-700">Maximum Salary</label>
                    <input type="number" id="salary_max" name="salary_max" value="{{ old('salary_max') }}"
                        class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('salary_max') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="flex flex-col">
                <label for="description" class="text-sm font-medium text-gray-700">Job Description <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="6" required
                    class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Work Type -->
            <div class="flex flex-col">
                <label for="work_type" class="text-sm font-medium text-gray-700">Work Type</label>
                <select id="work_type" name="work_type" class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Full-time" {{ old('work_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('work_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('work_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Remote" {{ old('work_type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                    <option value="Internship" {{ old('work_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('work_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Application Deadline -->
            <div class="flex flex-col">
                <label for="application_deadline" class="text-sm font-medium text-gray-700">Application Deadline</label>
                <input type="date" id="application_deadline" name="application_deadline" value="{{ old('application_deadline') }}"
                    class="mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                @error('application_deadline') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end mt-8 space-x-4">
                <a href="{{ route('jobs.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Create Job
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
