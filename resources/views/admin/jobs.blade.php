<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Jobs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">All Jobs</h3>

                    <!-- Filter Form -->
                    <form method="GET" class="mb-4">
                        <label for="status" class="mr-2">Filter by Status:</label>
                        <select name="status" id="status" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </form>

                    <!-- Jobs Table -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Employer</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap"><a href="/jobs/{{ $job->id }}">{{ $job->title }}</a></td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $job->employer->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        @if ($job->is_approved)
                                            <span class="text-green-500">Approved</span>
                                        @else
                                            <span class="text-red-500">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-blue-500 hover:text-blue-700">Approve</button>
                                        </form>
                                        |
                                        <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $jobs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>