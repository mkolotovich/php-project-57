<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = TaskStatus::paginate();
        return view('status.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('modify');
        $status = new TaskStatus();
        return view('status.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'name' => 'required|unique:task_statuses',
        ], $messages = ['unique' => 'Статус с таким именем уже существует']);

        $data = $validator->validated();

        $status = new TaskStatus();
        $status->fill($data);
        $status->save();
        flash(__('status.created'))->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::authorize('modify');
        $status = TaskStatus::findOrFail($id);
        return view('status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $status = TaskStatus::findOrFail($id);
        $data = $request->validate([
            'name' => "required|unique:task_statuses,name,{$status->id}",
        ]);

        $status->fill($data);
        $status->save();
        flash(__('status.editSuccess'))->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        $task = Task::where('status_id', $taskStatus->id)->first();
        if ($task) {
            flash(__('status.error'))->error();
            return redirect()->route('task_statuses.index');
        }
        $taskStatus->delete();
        flash(__('status.removed'))->success();
        return redirect()->route('task_statuses.index');
    }
}
