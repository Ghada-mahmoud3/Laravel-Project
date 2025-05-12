<div class="container mt-5">
    <h1 class="mb-4">Are you sure you want to delete this job?</h1>

    <div class="alert alert-danger">
        <p>This action cannot be undone.</p>
    </div>

    <div class="d-flex gap-2">
        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </form>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</div>
