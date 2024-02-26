<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public $taskRepository;

    public $userRepository;

    public function __construct(TaskRepository $taskRepository, UserRepository $userRepository)
    {
        $this->taskRepository = $taskRepository;

        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('list-tasks', auth()->user());

        $tasks = $this->taskRepository->list($request);

        $users = auth()->user()->children()->get();

        return view('tasks.index', compact('tasks', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-tasks', auth()->user());

        $users = auth()->user()->children()->get();

        return view('tasks.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {
        Gate::authorize('create-tasks', auth()->user());

        $this->taskRepository->create($request);

        return redirect()->route('tasks.index')->with('success', 'task created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = $this->taskRepository->findById($id);

        if(auth()->user()->isManager()){
            Gate::authorize('update-tasks', auth()->user());
        }else{
            Gate::authorize('update-own-tasks', $task, $task);
        }

        $users = auth()->user()->children()->get();

        return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = $this->taskRepository->findById($id);

        if(auth()->user()->isManager()){
            Gate::authorize('update-tasks', auth()->user());
        }else{
            Gate::authorize('update-own-tasks', $task, $task);
        }

        $updated = $this->taskRepository->update($request, $id);

        if ($updated) {
            return redirect()->route('tasks.index')->with('success', 'task updated successfully');
        }

        return redirect()->route('tasks.index')->with('error', 'Can not update task.');
    }
}
