<!-- Job Management Page for Employers -->
<div class="container mt-5">
    <h2>Manage Your Jobs</h2>

    @foreach($jobs as $job)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <strong>{{ $job->title }}</strong><br>
                    <span>Posted on: {{ $job->created_at->format('M d, Y') }}</span>
                </div>
                <div class="d-flex gap-2">
                    <!-- Edit Button -->
                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <!-- Delete Button with Confirmation -->
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
