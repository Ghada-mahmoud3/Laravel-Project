<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('🔔 Notifications') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6">
        <ul class="space-y-4">
            @foreach ($notifications as $notification)
                <li class="bg-white p-4 rounded shadow">
                    {{ $notification->data['message'] }}
                </li>
            @endforeach
        </ul>

        <form method="POST" action="{{ route('notifications.markRead') }}">
            @csrf
            <button type="submit" class="text-sm text-blue-600 hover:underline">Mark all as read</button>
        </form>
    </div>
</x-app-layout>