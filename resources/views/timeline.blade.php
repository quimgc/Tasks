@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Timeline de tasques
@endsection


@section('main-content')

    <div>
        <div class="box-header with-border">

            <h3 class="box-title">Timeline</h3>

        </div>

    </div>

    @foreach($task_events as $event)

        <li>User {{$event->user_name}} {{ $event->type }} task {{ $event->task_name }} at {{ $event->time }}</li>

    @endforeach


@endsection
