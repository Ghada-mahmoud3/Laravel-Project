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

                    <!-- Buttons to Accept or Reject the Application -->
                    @if($application->status == 'pending')
                        <form action="{{ route('applications.updateStatus', [$application->id, 'accepted']) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-success">Accept</button>
                        </form>

                        <form action="{{ route('applications.updateStatus', [$application->id, 'rejected']) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
