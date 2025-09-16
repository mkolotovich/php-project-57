<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::paginate();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('modify');
        $label = new Label();
        return view('label.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'name' => 'required|unique:labels',
            'description' => 'nullable|string'
        ], $messages = ['unique' => 'Метка с таким именем уже существует']);

        $data = $validator->validated();

        $label = new Label();
        $label->fill($data);
        $label->save();
        flash(__('label.created'))->success();
        return redirect()->route('labels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        Gate::authorize('modify');
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        $data = $request->validate([
            'name' => "required|unique:labels,name,{$label->id}",
            'description' => 'nullable|string'
        ]);

        $label->fill($data);
        $label->save();
        flash(__('label.editSuccess'))->success();
        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        $task = $label->tasks;
        if (count($task) > 0) {
            flash(__('label.error'))->error();
            return redirect()->route('labels.index');
        }
        $label->delete();
        flash(__('label.remove'))->success();
        return redirect()->route('labels.index');
    }
}
