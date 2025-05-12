<div class="container mt-5">
    <h1 class="mb-4">Create New Job</h1>

    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Job Title -->
            <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Job title" required>
            </div>

            <!-- Category -->
            <div class="col-md-6 mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <!-- Description -->
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Job Description</label>
                <textarea name="description" id="description" class="form-control" rows="5" placeholder="Job description" required></textarea>
            </div>

            <!-- Location -->
            <div class="col-md-6 mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control" placeholder="Location" required>
            </div>

            <!-- Experience Level -->
            <div class="col-md-6 mb-3">
                <label for="experience_level" class="form-label">Experience Level</label>
                <select name="experience_level" id="experience_level" class="form-control" required>
                    <option value="">Select Experience Level</option>
                    <option value="Junior">Junior</option>
                    <option value="Mid">Mid</option>
                    <option value="Senior">Senior</option>
                </select>
            </div>
        </div>

        <div class="row">
            <!-- Salary Range -->
            <div class="col-md-6 mb-3">
                <label for="salary_min" class="form-label">Salary Min</label>
                <input type="number" name="salary_min" id="salary_min" class="form-control" placeholder="Min Salary" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="salary_max" class="form-label">Salary Max</label>
                <input type="number" name="salary_max" id="salary_max" class="form-control" placeholder="Max Salary" required>
            </div>
        </div>

        <div class="row">
            <!-- Deadline -->
            <div class="col-md-6 mb-3">
                <label for="application_deadline" class="form-label">Application Deadline</label>
                <input type="date" name="application_deadline" id="application_deadline" class="form-control" required>
            </div>

            <!-- Work Type -->
            <div class="col-md-6 mb-3">
                <label for="work_type" class="form-label">Work Type</label>
                <select name="work_type" id="work_type" class="form-control" required>
                    <option value="">Select Work Type</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Freelance">Freelance</option>
                </select>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Create Job</button>
            <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
