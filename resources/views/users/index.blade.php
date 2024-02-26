<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Employees') }}
            @can('create-own-childs')
                <a href="{{ route('users.create') }}" style="float: right" class="btn btn-secondary">{{ __('Create') }}</a>
            @endcan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Search bar -->
                    <form action="{{ route('users.index') }}">
                        <div class="mb-4 flex justify-between">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by id, name, email or phone" class="form-control">
                            <select class="form-select" name="department">
                                <option value="">Filter by Department (All)</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Salary</th>
                                <th>Department</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count() > 0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->salary }}</td>
                                        <td>{{ $user->department->name }}</td>
                                        <td>
                                            <img src="{{ $user->image }}" alt="User Image" class="h-6 w-6 rounded-full">
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
                <div class="hint-text">Showing page {{ $users->currentPage() }} of {{ $users->lastPage() }}</div>
                <ul class="mgr-10">
                    {!! $users->links() !!}
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
