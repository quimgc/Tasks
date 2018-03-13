@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Timeline de tasques
@endsection


{{--@section('main-content')--}}

    {{--<div>--}}
        {{--<div class="box-header with-border">--}}

            {{--<h3 class="box-title">Timeline</h3>--}}

        {{--</div>--}}

    {{--</div>--}}

    {{--@foreach($task_events as $event)--}}

        {{--<li>User {{$event->user_name}} {{ $event->type }} task {{ $event->task_name }} at {{ $event->time }}</li>--}}

    {{--@endforeach--}}


{{--@endsection--}}

@section('main-content')
    <ul class="timeline">

    @foreach($task_events as $event)


            <li class="time-label">
        <span class="bg-red">
            {{ date("jS F, Y", strtotime($event->time)) }}
        </span>
            </li>

            <li>

                <i class="fa fa-clock-o bg-gray"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i>{{ date('G:i', strtotime($event->time)) }}</span>

                    <h3 class="timeline-header"><a href="/tasks_php/{{$event->id}}">{{ $event->task_name }}</a> </h3>
                    <div class="timeline-body">
                        The owner is: <b> {{ $event->user_name }}</b> and the type of task is: <b>{{ $event->type }}</b>.
                    </div>
                </div>
            </li>

    @endforeach

        <!-- END timeline item -->


    </ul>


@endsection