@extends('layouts.app')

@section('title', 'Task ' . $task->name)

@section('content')
    <div class="col-md-12" style="width: 72%; margin: auto">
        <h1>Task {{ $task->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    column
                </th>
                <th>
                    value
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $task->id }}</td>
            </tr>
            <tr>
                <td>name</td>
                <td>{{ $task->name }}</td>
            </tr>

            <tr>
                <td>description</td>
                <td>{{ $task->description }}</td>
            </tr>
            <tr>
                <td>created_by</td>
                <td>{{ $task->created_by }}</td>
            </tr>
            <tr>
                <td>assigned_to</td>
                <td>{{ $task->assigned_to }}</td>
            </tr>
            <tr>
                <td>status</td>
                <td>{{ $task->status }}</td>
            </tr>

            </tbody>
        </table>
    </div>
@endsection
