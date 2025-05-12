<div class="container mt-5">
    <h2>My Profile</h2>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Phone:</strong> {{ $candidate->phone ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Skills:</strong> {{ $candidate->skills ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Bio:</strong> {{ $candidate->bio ?? 'N/A' }}</li>
        <li class="list-group-item">
            <strong>Resume:</strong>
            @if(!empty($candidate->resume_path))
                <a href="{{ asset('storage/' . $candidate->resume_path) }}" target="_blank">Download</a>
            @else
                Not uploaded
            @endif
        </li>
    </ul>

    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Edit Profile</a>
</div>
