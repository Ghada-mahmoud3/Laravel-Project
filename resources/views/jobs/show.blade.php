@if(auth()->check())
    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <input type="hidden" name="job_id" value="{{ $job->id }}">

        <div class="mb-3">
            <label for="resume" class="form-label">Upload Resume</label>
            <input type="file" name="resume" id="resume" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Apply</button>
    </form>
@else
    <p>Please <a href="{{ route('login') }}">log in</a> to apply for this job.</p>
@endif
