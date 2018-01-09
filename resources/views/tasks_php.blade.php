@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Tasks PHP
@endsection


@section('main-content')

    @if (Session::get('status') )
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            {{ Session::get('status') }}
        </div>
    @endif

    <a href="/tasks_php/create" class="btn btn-success" role="button" aria-disabled="true">Create Task</a>

<table class="table table-bordered table-striped">

    <tbody>
    <tr>
        <th>id</th>
        <th>User id</th>
        <th>Task name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>

        @foreach( $tasks as $task )
            <tr>
                <td> {{ $task->id }}</td>
                <td> {{ $task->user_id }}</td>
                <td> {{ $task->name }}</td>
                <td> {{ $task->description }}</td>
                <td>
                    <form action="/tasks_php/{{ $task->id }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="btn-group">
                            <a id="show-task-{{ $task->id}}" href="/tasks_php/{{ $task->id}}" class="btn btn-info" role="button" aria-disabled="true">Show</a>
                            <a id="edit-task-{{ $task->id}}" href="/tasks_php/edit/{{ $task->id}}" class="btn btn-warning" role="button" aria-disabled="true">Edit</a>
                            <button id="delete-task-{{ $task->id}}"type="submit" class="btn btn-danger" role="button" aria-disabled="true">Delete</button>
                        </div>
                    </form>
                </td>
            </tr>

        @endforeach

    </tbody>




</table>

@endsection
