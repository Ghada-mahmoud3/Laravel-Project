{{-- Job Details Card --}}
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h3 class="card-title">{{ $job->title }}</h3>
        <p>{{ Str::limit($job->description, 150) }}</p>
        <p><strong>Category:</strong> {{ $job->category }}</p>
        <p><strong>Location:</strong> {{ $job->location }}</p>
        <p><strong>Experience:</strong> {{ $job->experience_level }}</p>
        <p><strong>Salary:</strong> {{ $job->salary_min }} - {{ $job->salary_max }}</p>
        <p><strong>Work Type:</strong> {{ $job->work_type }}</p>
        <p><strong>Application Deadline:</strong> {{ \Carbon\Carbon::parse($job->application_deadline)->format('d-m-Y') }}</p>
    </div>
</div>

<br><br><br>

@if(\Carbon\Carbon::now()->lessThanOrEqualTo(\Carbon\Carbon::parse($job->application_deadline)))
    <!-- Application Form -->
    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <input type="hidden" name="job_id" value="{{ $job->id }}">

        <div class="mb-3">
            <label for="email" class="form-label">Email</label><br>
            <input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" required><br><br>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label><br>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. +201234567890" required><br><br>
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Upload Resume</label><br>
            <input type="file" name="resume" id="resume" class="form-control" accept=".pdf,.doc,.docx" required><br><br>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Additional Message (optional)</label><br>
            <textarea name="message" id="message" class="form-control" rows="8"></textarea><br><br>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Apply</button>
        </div>
    </form>
@else
    <form class="mb-5" style="opacity: 0.5; pointer-events: none;">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label><br>
            <input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" disabled><br><br>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label><br>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. +201234567890" disabled><br><br>
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Upload Resume</label><br>
            <input type="file" name="resume" id="resume" class="form-control" accept=".pdf,.doc,.docx" disabled><br><br>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Additional Message (optional)</label><br>
            <textarea name="message" id="message" class="form-control" rows="8" disabled></textarea><br><br>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary" disabled>Apply</button>
        </div>
    </form>
    <p class="text-danger">The application deadline for this job has passed.</p>
@endif


<br>
<a href="{{ route('jobs.search') }}" class="btn btn-secondary">Return to Search</a>
