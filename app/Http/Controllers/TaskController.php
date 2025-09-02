<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::all();
        $tasks->map(function ($task) {
            $task->status = TaskStatus::find($task->status_id);
            $task->author = User::find($task->created_by_id);
            $task->executor = User::find($task->assigned_to_id);
            return $task;
        });
        return view('task.index', compact('tasks', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('modify');
        $task = new Task();
        $statuses = TaskStatus::paginate();
        $users = User::paginate();
        return view('task.create', compact('task', 'statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:tasks',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable|integer',
            'description' => 'nullable|string'
        ]);

        $task = new Task();
        $task->fill($data);
        $task->created_by_id = $request->user()->id;
        $task->save();

        return redirect()
            ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->status = TaskStatus::find($task->status_id);
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        Gate::authorize('modify');
        $statuses = TaskStatus::paginate();
        $users = User::paginate();
        return view('task.edit', compact('task', 'statuses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => "required|unique:tasks,name,{$task->id}",
            'status_id' => 'required',
            'assigned_to_id' => 'nullable|integer',
            'description' => 'nullable|string'
        ]);

        $task->fill($data);
        $task->save();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        if ($request->user()->id === $task->created_by_id) {
            $task->delete();
            return redirect()->route('tasks.index');
        }
    }
}
