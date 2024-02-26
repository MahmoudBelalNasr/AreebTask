<?php

namespace App\Repositories;

use App\Interfaces\DepartmentInterface;
use App\Models\Department;

class DepartmentRepository implements DepartmentInterface{

    public function list($request)
    {
        $departments = Department::orderBy('id','asc');
        if (request()->filled('search')) {
            $searchTerm = request()->search;
            $departments = $departments->where(function ($query) use ($searchTerm) {
                $query->where('id', 'LIKE', "%$searchTerm%")
                    ->orWhere('name', 'LIKE', "%$searchTerm%");
            });
        }

        return $departments->paginate(10);
    }

    public function all(){
        return Department::all();
    }

    public function findById($id){
        return Department::findOrFail($id);
    }

    public function create($request)
    {
        $validatedData = $request->validated();

        $department = Department::create($validatedData);

        if ($department) {
            return true;
        }

        return false;
    }


    public function update($data, $id)
    {
        $department = $this->findById($id);
        $updated = $department->update($data->validated());

        if($updated){
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $department = $this->findById($id);

        if ($department->users()->exists()) {
            return false;
        }

        return $department->delete();
    }
}
