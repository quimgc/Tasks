@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Show PHP
@endsection


@section('main-content')
    <form action="/tasks_php/{{ $task->id }}" method="POST">

<table class="table table-bordered table-striped">


    <tr>
        <th>id</th>
        <th>User id</th>
        <th>Task name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>




            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">




                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->user_id }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description}}</td>
                    <td>
                        <form action="/tasks_php/{{ $task->id }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="btn-group">
                                <a href="/tasks_php" class="btn btn-info" role="button" aria-disabled="true">Back</a>
                                <a href="/tasks_php/edit/{{ $task->id}}" class="btn btn-warning" role="button" aria-disabled="true">Edit</a>
                                <button type="submit" class="btn btn-danger" role="button" aria-disabled="true">Delete</button>

                            </div>
                        </form>

                    </td>

                </tr>



</table>
    </form>

@endsection
