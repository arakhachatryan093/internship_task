<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      if (Auth::user()->role == 'developer'){
          $tasks = Task::all();
          foreach ($tasks as $task){
              $assigned_to = User::where(['id' => $task->assigned_to])->get('name');
              $task->assigned_to = $assigned_to[0]->name;
              $created_by = User::where(['id' => $task->created_by])->get('name');
              $task->created_by = $created_by[0]->name;
          }
          return view('index',[
              'tasks' => $tasks,
          ]);
      }else{
          $user_id = Auth::user()->id;
          $tasks = Task::where(['created_by' => $user_id])->get();
          foreach ($tasks as $task){
              $assigned_to = User::where(['id' => $task->assigned_to])->get('name');
              $task->assigned_to = $assigned_to[0]->name;
              $created_by = User::where(['id' => $task->created_by])->get('name');
              $task->created_by = $created_by[0]->name;
          }
          //dd($tasks);
          return view('index',compact('tasks'));
      }

    }

    public function search(Request $request) {
        $search_val  = $request->search;

        $tasks_found = Task::where('name','LIKE','%'.$search_val.'%')->get();
        dd($search_val);

    }
}
