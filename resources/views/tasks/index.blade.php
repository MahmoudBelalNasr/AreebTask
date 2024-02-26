<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('tasks') }}
            @can('create-tasks')
                <a href="{{ route('tasks.create') }}" style="float: right" class="btn btn-secondary">{{ __('Create') }}</a>
            @endcan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Search bar -->
                    <form action="{{ route('tasks.index') }}">
                        <div class="mb-4 flex justify-between">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by id, Title, Description" class="form-control">
                             <select class="form-select" name="status">
                                <option value="">Filter by Status (All)</option>
                                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <select class="form-select" name="user">
                                <option value="">Filter by Users (All)</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </form>
                    <table class="table responsive table-bordered">
                        <!-- Table header -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($tasks->count() > 0)
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td style="color: {{ $task->status === 'completed' ? 'green' : ($task->status === 'new' ? 'orange' : 'red') }}">{{ $task->status }}</td>
                                        <td>{{ $task->user->name }}</td>
                                        <td>
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center text-danger">No Results</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clearfix">
                <div class="hint-text">Showing page {{ $tasks->currentPage() }} of {{ $tasks->lastPage() }}</div>
                <ul class="mgr-10">
                    {!! $tasks->links() !!}
                </ul>
            </div>
        </div>
    </div>

    <script>
    </script>

</x-app-layout>

