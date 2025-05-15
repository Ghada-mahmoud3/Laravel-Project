<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('🔔 Notifications') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6">
        <ul class="space-y-4">
            @foreach ($notifications as $notification)
                <li class="p-4 rounded shadow transition-all duration-300 
                    {{ $notification->read_at ? 'bg-gray-100 text-gray-500' : 'bg-white text-black border-l-4 border-indigo-500' }}">
                    {{ $notification->data['message'] }}
                </li>
            @endforeach
        </ul>

        <form method="POST" action="{{ route('notifications.markRead') }}" class="mt-6">
            @csrf
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 transition">
                Mark all as read
            </button>
        </form>
    </div>
</x-app-layout>
