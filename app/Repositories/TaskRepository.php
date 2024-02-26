<?php

namespace App\Repositories;

use App\Interfaces\TaskInterface;
use App\Models\Task;

class TaskRepository implements TaskInterface{

    public function list($request)
    {
        $user = auth()->user();

        if ($user->isManager()) {
            $childrenIds = $user->children()->pluck('id')->toArray();
            $tasks = Task::whereIn('user_id', $childrenIds)->orderBy('id', 'asc');
        }else{
            $tasks = Task::where('user_id', $user->id)->orderBy('id', 'asc');
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $tasks = $tasks->where(function ($query) use ($searchTerm) {
                $query->where('id', 'LIKE', "%$searchTerm%")
                    ->orWhere('title', 'LIKE', "%$searchTerm%")
                    ->orWhere('description', 'LIKE', "%$searchTerm%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->status;
            $tasks = $tasks->where('status', $status);
        }

        if ($request->filled('user')) {
            $user_id = $request->user;
            $tasks = $tasks->where('user_id', $user_id);
        }

        return $tasks->paginate(10);
    }

    public function all()
{
        return Task::all();
    }
    public function findById($id){
        return Task::findOrFail($id);
    }

    public function create($request)
    {
        $validatedData = $request->validated();

        $task = Task::create($validatedData);

        if ($task) {
            return true;
        }

        return false;
    }

    public function update($data, $id)
    {
        $task = $this->findById($id);
        $updated = $task->update($data->validated());

        if($updated){
            return true;
        }
        return false;
    }

}
