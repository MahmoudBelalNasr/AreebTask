<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ Route('tasks.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="title">Title:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" placeholder="Enter title" title="title" name="title" value="{{ old('title') }}" required>
                                @error('title')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="Description">Description:</label>
                            <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="Description" placeholder="Enter Description" name="description" Description="Description" value="{{ old('Description') }}" required>{{ old('Description') }}</textarea>
                                @error('Description')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="user_id">Assigned To:</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="user_id" name="user_id" required>
                                    <option>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="status">Status:</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="status" name="status" required>
                                    <option>Select User</option>
                                    <option value="new" {{ old('new') == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="pending" {{ old('pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ old('completed') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button style="background: #198754;" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
