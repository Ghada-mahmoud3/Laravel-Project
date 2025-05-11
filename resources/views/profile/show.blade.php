<div class="container mt-5">
    <h2>My Profile</h2>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Name:</strong> {{ auth()->user()->name ?? "" }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ auth()->user()->email ?? ""}}</li>
        <li class="list-group-item"><strong>Phone:</strong> {{ auth()->user()->phone ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Skills:</strong> {{ auth()->user()->skills ?? 'N/A' }}</li>
        <li class="list-group-item">
            <strong>Resume:</strong>
            @if(auth()->user()->resume_path ?? "")
                <a href="{{ asset('storage/' . auth()->user()->resume_path) }}" target="_blank">Download</a>
            @else
                Not uploaded
            @endif
        </li>
    </ul>

    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Edit Profile</a>
</div>