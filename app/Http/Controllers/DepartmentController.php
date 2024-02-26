<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Repositories\DepartmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends Controller
{
    public $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('list-department', auth()->user());

        $departments = $this->departmentRepository->list($request);

        $departments->each(function ($department) {
            $department->totalUsers = $department->users->count();
            $department->totalSalaries = $department->users->sum('salary');
        });

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-department', auth()->user());

        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDepartmentRequest $request)
    {
        Gate::authorize('create-department', auth()->user());

        $this->departmentRepository->create($request);

        return redirect()->route('departments.index')->with('success', 'department created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('update-department', auth()->user());

        $department = $this->departmentRepository->findById($id);

        return view('departments.edit', compact('department'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedepartmentRequest $request, string $id)
    {
        Gate::authorize('update-department', auth()->user());

        $department = $this->departmentRepository->update($request, $id);

        if($department){
            return redirect()->route('departments.index')->with('success', 'department updated successfully.');
        }

        return redirect()->route('departments.index')->with('error', 'Can not updat department.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-department', auth()->user());

        $deleted = $this->departmentRepository->delete($id);

        if($deleted){
            return redirect()->route('departments.index')->with('success', 'department deleted successfully');
        }

        return redirect()->route('departments.index')->with('error', 'Can not delete department.');
    }
}
