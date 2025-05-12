<div class="container mt-5">
    <h2>Notifications</h2>

    @foreach(auth()->user()->notifications as $notification)
        <div class="alert alert-info">
            {{ $notification->data['message'] }}
            <small class="text-muted d-block">{{ $notification->created_at->diffForHumans() }}</small>
        </div>
    @endforeach
</div>