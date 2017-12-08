@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Create task
@endsection

@section('main-content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Task:</h3>
        </div>
        <form role="form" action="/tasks_php" method="POST">
            {{ csrf_field() }}

            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

            <div class="box-body">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="name">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
                </div>
                <div class="form-group">
                    <label for="name">User</label>

                    <select name="user_id" id="user_id" class="form-control">
                        @foreach ($users as $user)
                            @if ( Auth::user()->id == $user->id )
                                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                            @else
                                <option value="{{ $user->id }}" >{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>

@endsection
