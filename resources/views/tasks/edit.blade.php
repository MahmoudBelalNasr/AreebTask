<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ Route('tasks.update', $task->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="title">Title:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" placeholder="Enter title" title="title" name="title" value="{{ $task->title }}" required>
                                @error('title')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="Description">Description:</label>
                            <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="Description" placeholder="Enter Description" name="description" Description="Description" value="{{ $task->description }}" required>{{ $task->description }}</textarea>
                                @error('Description')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        @if(auth()->user()->isManager())
                            <div class="form-group mb-2">
                                <label class="control-label col-sm-2" for="user_id">Assigned To:</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="user_id" name="user_id" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')<span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="status">Status:</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="status" name="status" required>
                                    <option>Select User</option>
                                    <option value="new" {{ $task->status == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
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
