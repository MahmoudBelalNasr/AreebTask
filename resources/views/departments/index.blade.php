<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Departments') }}
            <a href="{{ route('departments.create') }}" style="float: right" class="btn btn-secondary">{{ __('Create') }}</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Search bar -->
                    <form action="{{ route('departments.index') }}">
                        <div class="mb-4 flex justify-between">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by id or name" class="form-control">
                            <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </form>
                    <table class="table responsive table-bordered">
                        <!-- Table header -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Total employees</th>
                                <th>Total salaries</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($departments->count() > 0)
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{ $department->id }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->totalUsers }}</td>
                                        <td>{{ $department->totalSalaries }}</td>
                                        <td>
                                            <a href="{{ route('departments.edit', $department->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
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
                <div class="hint-text">Showing page {{ $departments->currentPage() }} of {{ $departments->lastPage() }}</div>
                <ul class="mgr-10">
                    {!! $departments->links() !!}
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
