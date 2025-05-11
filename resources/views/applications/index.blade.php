<div class="container mt-5">
    <h2>My Applications</h2>

    @foreach($applications as $application)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <strong>{{ $application->job->title }}</strong><br>
                    Applied on: {{ $application->created_at->format('M d, Y') }}<br>
                    Status: 
                    <span class="badge 
                        {{ 
                            $application->status == 'accepted' ? 'bg-success' : 
                            ($application->status == 'rejected' ? 'bg-danger' : 
                            ($application->status == 'cancelled' ? 'bg-secondary' : 'bg-warning')) 
                        }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
                <div>
                    <a href="{{ asset('storage/' . $application->resume_path) }}" class="btn btn-sm btn-outline-primary" target="_blank">Resume</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
