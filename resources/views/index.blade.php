
@extends('layouts.app')
@section('content')
@if(\Illuminate\Support\Facades\Auth::user()->role == "manager")

    <a class="btn btn-success" type="button" href="{{ route('tasks.create') }}">create a task</a>
@endif

<form action="{{route('search')}}" method="POST" role="search">
    @csrf
    <div style="margin-left: 10px;">
        <!-- Search form -->
        <div style=" width: 150px; margin-bottom: 10px;">
            <input name="search" id="search" class="form-control" type="text" placeholder="Search" aria-label="Search">
        </div>
                <button type="submit" class="btn btn-success">
                    search
                </button>
    </div>
    <br>
</form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">assigned-to</th>
            <th scope="col" >created_by</th>
            <th scope="col" >description</th>
            <th scope="col" colspan="3" style="text-align: center" >actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($tasks as $task)
        <tr>
            <th scope="row">{{$task->id}}</th>
            <td>{{$task->name}}</td>
            <td>{{$task->assigned_to}}</td>
            <td>{{$task->created_by}}</td>
            <td colspan="3">{{$task->description}}</td>
            @if(\Illuminate\Support\Facades\Auth::user()->role == "manager")
            <td>
                <div class="btn-group" role="group">
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                        <a class="btn btn-success" type="button" href="{{ route('tasks.show', $task) }}">show</a>
                        <a class="btn btn-warning" type="button" href="{{ route('tasks.edit', $task) }}">update</a>
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="del"></form>
                </div>
            </td>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->role == "developer")
                <td>
                    <div class="btn-group" role="group">
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            <a class="btn btn-success" type="button" href="{{ route('tasks.show', $task) }}">show</a>
                            <a class="btn btn-warning" type="button" href="{{ route('tasks.edit', $task) }}">change status</a>
                        </form>
                    </div>
                </td>
            @endif
        </tr>
        @endforeach

        </tbody>
    </table>

@endsection
