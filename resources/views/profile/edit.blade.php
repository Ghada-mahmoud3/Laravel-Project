<div class="container mt-5">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? "") }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" value="{{ auth()->user()->email ?? "" }}" disabled>
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone ?? "") }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Skills</label>
            <textarea name="skills" rows="3" class="form-control">{{ old('skills', auth()->user()->skills ?? "") }}</textarea>
        </div>

        <div class="mb-3">
            <label>Resume (optional)</label>
            <input type="file" name="resume" class="form-control">
            @if(auth()->user()->resume_path ?? "")
                <a href="{{ asset('storage/' . auth()->user()->resume_path) }}" target="_blank">View Current Resume</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
