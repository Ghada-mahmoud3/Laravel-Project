<div class="container mt-5">
    <h1 class="mb-4">Edit Job</h1>

    <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Job Title -->
            <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $job->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category -->
            <div class="col-md-6 mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ $job->category == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Description -->
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Job Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $job->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Location -->
            <div class="col-md-6 mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $job->location) }}" required>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Experience Level -->
            <div class="col-md-6 mb-3">
                <label for="experience_level" class="form-label">Experience Level</label>
                <select name="experience_level" id="experience_level" class="form-control @error('experience_level') is-invalid @enderror" required>
                    <option value="">Select Experience Level</option>
                    <option value="Junior" {{ $job->experience_level == 'Junior' ? 'selected' : '' }}>Junior</option>
                    <option value="Mid" {{ $job->experience_level == 'Mid' ? 'selected' : '' }}>Mid</option>
                    <option value="Senior" {{ $job->experience_level == 'Senior' ? 'selected' : '' }}>Senior</option>
                </select>
                @error('experience_level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Salary Range -->
            <div class="col-md-6 mb-3">
                <label for="salary_min" class="form-label">Salary Min</label>
                <input type="number" name="salary_min" id="salary_min" class="form-control @error('salary_min') is-invalid @enderror" value="{{ old('salary_min', $job->salary_min) }}" required>
                @error('salary_min')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="salary_max" class="form-label">Salary Max</label>
                <input type="number" name="salary_max" id="salary_max" class="form-control @error('salary_max') is-invalid @enderror" value="{{ old('salary_max', $job->salary_max) }}" required>
                @error('salary_max')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Deadline -->
            <div class="col-md-6 mb-3">
                <label for="application_deadline" class="form-label">Application Deadline</label>
                <input type="date" name="application_deadline" id="application_deadline" class="form-control @error('application_deadline') is-invalid @enderror" value="{{ old('application_deadline', $job->application_deadline) }}" required>
                @error('application_deadline')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Work Type -->
            <div class="col-md-6 mb-3">
                <label for="work_type" class="form-label">Work Type</label>
                <select name="work_type" id="work_type" class="form-control @error('work_type') is-invalid @enderror" required>
                    <option value="">Select Work Type</option>
                    <option value="Full-time" {{ $job->work_type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ $job->work_type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Freelance" {{ $job->work_type == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                </select>
                @error('work_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Logo Upload -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="logo" class="form-label">Job Logo (optional)</label>
                <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                @if ($job->logo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $job->logo) }}" alt="Current Logo" style="width: 100px;">
                    </div>
                @endif
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update Job</button>
            <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
