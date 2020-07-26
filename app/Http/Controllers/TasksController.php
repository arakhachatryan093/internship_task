<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */


    public function index()
    {
        $tasks = Task::all();
        return response()->view('tasks.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $developers = User::where(['role' => 'developer'])->get();
        return response()->view('tasks.create',compact('developers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $task = new Task();
        $task['name'] = $request->name;
        $task['description'] = $request->description;
        $task['assigned_to'] = $request->assigned_to;

        $task['status'] = 'created';

        $task['created_by'] = Auth::user()->id;
        $task->save();

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $assigned_to = User::where(['id' => $task->assigned_to])->get('name');
        $task->assigned_to = $assigned_to[0]->name;
        $created_by = User::where(['id' => $task->created_by])->get('name');
        $task->created_by = $created_by[0]->name;
        return response()->view('tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $statuses = ['created','asigned','in_progress','done'];
        $developers = User::where(['role' => 'developer'])->get();
        return response()->view('tasks.create',[
            'task' => $task,
            'developers' => $developers,
            'statuses' => $statuses
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {

        $task->status = $request->change_status;
        $task->update($request->all());
        return redirect()->route('index');
    }


    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
