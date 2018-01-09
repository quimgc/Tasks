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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/tasks_php/{{ $task->id }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <a href="/tasks_php" class="btn btn-info" role="button" aria-disabled="true">Back</a>

        <button type="submit" class="btn btn-danger" role="button" aria-disabled="true">Delete</button>

    </form>
    <form role="form" action="/tasks_php/{{ $task->id }}" method="POST" onsubmit="submit()">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}

        <h3>User</h3>
        <select name="user_id" id="user_id" class="form-control" dusk="user_id">
            @foreach ($users as $user)
                @if ( $task->user_id == $user->id )
                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                @else
                    <option value="{{ $user->id }}" >{{ $user->name }}</option>
                @endif
            @endforeach
        </select>
        <h3>Task name</h3>
        <input dusk="name" type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ $task->name }}">
        <h3>Description</h3>
        <input dusk="description" type="text" class="form-control" placeholder="Enter description" name="description" value="{{ $task->description }}">
        <br>
            <button type="submit" class="btn btn-primary">Save Changes</button>



    </form>


@endsection

{{--@section('main-content')--}}
    {{--<form role="form" action="/tasks_php/{{ $task->id }}" method="POST" onsubmit="submit()">--}}
        {{--<input type="hidden" name="_method" value="PUT">--}}
        {{--{{ csrf_field() }}--}}

    {{--<table class="table table-bordered table-striped">--}}

        {{--<tr>--}}
            {{--<th>User id</th>--}}
            {{--<th>Task name</th>--}}
            {{--<th>Description</th>--}}
            {{--<th>Actions</th>--}}
        {{--</tr>--}}

        {{--<tr>--}}

                {{--<td>--}}
                    {{--<select name="user_id" id="user_id" class="form-control">--}}
                        {{--@foreach ($users as $user)--}}
                            {{--@if ( $task->user_id == $user->id )--}}
                                {{--<option value="{{ $user->id }}" selected>{{ $user->name }}</option>--}}
                            {{--@else--}}
                                {{--<option value="{{ $user->id }}" >{{ $user->name }}</option>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--<input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ $task->name }}">--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--<textarea name="description">{{ $task->description }}</textarea>--}}
                {{--</td>--}}

            {{--<td>--}}

                {{--<button type="submit" class="btn btn-warning">Edit</button>--}}
            {{--</form>--}}
                {{--<form action="/tasks_php/{{ $task->id }}" method="POST">--}}
                    {{--<input type="hidden" name="_method" value="DELETE">--}}
                    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

                        {{--<a href="/tasks_php" class="btn btn-info" role="button" aria-disabled="true">Back</a>--}}

                        {{--<button type="submit" class="btn btn-danger" role="button" aria-disabled="true">Delete</button>--}}

                {{--</form>--}}

            {{--</td>--}}
        {{--</tr>--}}

    {{--</table>--}}

{{--@endsection--}}