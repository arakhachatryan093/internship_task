@extends('layouts.app')

@isset($task)
    @section('title', 'update task ' . $task->name)
@else
    @section('title', 'add task')
@endisset

@section('content')

    <div class="col-md-12" style="width: 72%; margin: auto">
        @isset($task)
            <h1>update task <b>{{ $task->name }}</b></h1>
        @else
            <h1>add task</h1>
        @endisset

        <form method="POST"
              @isset($task)
              action="{{ route('tasks.update', $task) }}"
              @else
              action="{{ route('tasks.store') }}"
            @endisset
        >
            <div>
                @isset($task)
                    @method('PUT')
                @endisset
                @csrf
            </div>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">name: </label>
                    <div class="col-sm-6">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="name" id="name"
                               value="@isset($task){{ $task->name }}@endisset">
                    </div>
                </div>

                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">description: </label>
                    <div class="col-sm-6">
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <textarea name="description" id="description" cols="72"
                                  rows="5">@isset($task){{ $task->description }}@endisset</textarea>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="assigned_to" class="col-sm-2 col-form-label">assigned-to: </label>
                    <select  name="assigned_to" id="assigned_to" style="margin-left: 15px">
                        @foreach($developers as $developer)
                            <option value="{{$developer->id}}">{{$developer->name}}</option>
                        @endforeach
                    </select>
                </div>
              @if(\Illuminate\Support\Facades\Auth::user()->role == "developer")
                <div class="input-group row">

                    <label for="change_status" class="col-sm-2 col-form-label">change status </label>
                    <select  name="change_status" id="change_status" style="margin-left: 15px">
                        <option value="created">created</option>
                        <option value="assigned">assigned</option>
                        <option value="in-progress">in-progress</option>
                        <option value="done">done</option>
                    </select>
               </div>
              @endif
            <button class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
