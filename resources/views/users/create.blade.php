<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Emolyee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ Route('users.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="first_name">First name:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="first_name" placeholder="Enter First name" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="last_name">Last name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="last_name" placeholder="Enter Last name" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}" required>
                                @error('email')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="phone">Phone:</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="phone" placeholder="Enter Phone" name="phone"  value="{{ old('phone') }}">
                                @error('phone')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="salary">Salary:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="salary" placeholder="Enter Salary" name="salary"  value="{{ old('salary') }}">
                                @error('salary')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="department_id">Department:</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="department_id" name="department_id" required>
                                    <option>Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            <input id="image" name="image" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('image')<span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="password">Password:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                                @error('password')<span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label col-sm-2" for="confirm_password">Confirm Password:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="confirm_password" placeholder="Confirm password" name="confirm_password" required>
                                @error('confirm_password')<span class="text-red-500">{{ $message }}</span> @enderror
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
