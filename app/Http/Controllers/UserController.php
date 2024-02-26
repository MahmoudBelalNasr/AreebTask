<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Department;
use App\Models\User;
use App\Repositories\DepartmentRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public $userRepository;
    public $departmentRepository;

    public function __construct(UserRepository $userRepository, DepartmentRepository $departmentRepository)
    {
        $this->userRepository = $userRepository;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('list-own-childs', auth()->user());

        $users = $this->userRepository->list($request);
        $departments = $this->departmentRepository->all();
        return view('users.index', compact('users', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-own-childs', auth()->user());

        $departments = $this->departmentRepository->all();
        return view('users.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        Gate::authorize('create-own-childs', auth()->user());

        $this->userRepository->create($request);

        return redirect()->route('users.index')->with('success', 'user created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userRepository->findById($id);

        Gate::authorize('update-own-childs', $user, $user);

        $departments = Department::all();

        return view('users.edit', compact('user', 'departments'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = $this->userRepository->findById($id);

        Gate::authorize('update-own-childs', $user, $user);

        $user = $this->userRepository->update($request, $id);

        if($user){
            return redirect()->route('users.index')->with('success', 'user updated successfully.');
        }

        return redirect()->route('users.index')->with('error', 'Can not updat user.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userRepository->findById($id);

        Gate::authorize('delete-own-childs', auth()->user(), $user);

        $deleted = $this->userRepository->delete($id);

        if($deleted){
            return redirect()->route('users.index')->with('success', 'user deleted successfully');
        }

        return redirect()->route('users.index')->with('error', 'Can not delete user.');
    }
}
