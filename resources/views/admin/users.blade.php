<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">All Users</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->role }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap flex space-x-2">
                                        <!-- View User Button -->
                                        <a href="{{ route('admin.users.view', $user->id) }}" class="text-blue-500 hover:text-blue-700">
                                            View
                                        </a>

                                        <!-- Change Role Dropdown -->
                                        <form action="{{ route('admin.users.change-role', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <select name="role" onchange="this.form.submit()" class="border rounded ">
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="employer" {{ $user->role === 'employer' ? 'selected' : '' }}>Employer</option>
                                                <option value="candidate" {{ $user->role === 'candidate' ? 'selected' : '' }}>Candidate</option>
                                            </select>
                                        </form>

                                        <!-- Ban/Unban Button -->
                                        <form action="{{ route('admin.users.toggle-ban', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @if ($user->is_banned)
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    Unban
                                                </button>
                                            @else
                                                <button type="submit" class="text-green-500 hover:text-green-700">
                                                    Ban
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>