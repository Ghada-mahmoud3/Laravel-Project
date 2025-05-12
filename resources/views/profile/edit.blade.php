<div class="container mt-5">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Name</label><br>
            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" required><br><br>
        </div>

        <div class="mb-3">
            <label>Email</label><br>
            <input type="email" class="form-control" value="{{ $user->email ?? '' }}" disabled><br><br>
        </div>

        <div class="mb-3">
            <label>Phone</label><br>
            <input type="text" name="phone" value="{{ old('phone', $candidate->phone ?? '') }}" class="form-control"><br><br>
        </div>

        <div class="mb-3">
            <label>Skills</label><br>
            <textarea name="skills" rows="3" class="form-control">{{ old('skills', $candidate->skills ?? '') }}</textarea><br><br>
        </div>

        <div class="mb-3">
            <label>Bio</label><br>
            <textarea name="bio" rows="3" class="form-control">{{ old('bio', $candidate->bio ?? '') }}</textarea><br><br>
        </div>

        <div class="mb-3">
            <label>Resume (optional)</label><br>
            <input type="file" name="resume" class="form-control"><br>
            @if(!empty($candidate->resume_path))
                <a href="{{ asset('storage/' . $candidate->resume_path) }}" target="_blank">View Current Resume</a>
            @endif
        </div><br><br>

        <button type="submit" class="btn btn-primary">Update Profile</button><br>
    </form>

    <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary w-100 mt-2">Cancel</a>
</div>
