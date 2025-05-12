    <div class="container mt-5">
        <h1 class="mb-4">Job Search</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('jobs.search') }}" class="mb-5">
            <div class="row g-3">
                <!-- Keyword Search -->
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control" placeholder="Search by keyword" value="{{ request()->keyword }}">
                </div>

                <!-- Location Dropdown -->
                <div class="col-md-3">
                    <select name="location" class="form-control">
                        <option value="">Select Location</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location }}" {{ request()->location == $location ? 'selected' : '' }}>{{ $location }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Category Dropdown -->
                <div class="col-md-3">
                    <select name="category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ request()->category == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Experience Level Dropdown -->
                <div class="col-md-2">
                    <select name="experienceLevel" class="form-control">
                        <option value="">Select Experience</option>
                        @foreach ($experienceLevels as $level)
                            <option value="{{ $level }}" {{ request()->experienceLevel == $level ? 'selected' : '' }}>{{ $level }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <!-- Salary Range -->
                <div class="col-md-3">
                    <input type="text" name="salaryRange" class="form-control" placeholder="Salary range (e.g., 50000-70000)" value="{{ request()->salaryRange }}">
                </div>

                <!-- Date Picker (Calendar) -->
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control" value="{{ request()->date }}">
                </div>

                <!-- Search Button -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>

                <!-- Reset Button -->
                <div class="col-md-2">
                    <button type="button" class="btn btn-secondary w-100" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </form>

        <!-- Job Listings -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($jobs as $job)
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <strong><a href="show/{{ $job->id}}" class="card-title">{{ $job->title }}</a></strong>
                            <p class="card-text">{{ Str::limit($job->description, 120) }}</p>
                            <p class="text-muted">Location: {{ $job->location }} | Category: {{ $job->category }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on: {{ $job->created_at->format('Y-m-d') }}
                        </div>
                    </div>
                </div>
                <br>
                <hr>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $jobs->links() }}
        </div>
    </div>

    <script>
        
        function resetForm() {
            document.querySelector('form').reset();
            window.location.href = "{{ route('jobs.search') }}";
        }
    </script>
