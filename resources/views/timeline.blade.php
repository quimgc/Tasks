@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Timeline de tasques
@endsection


@section('main-content')
    <ul class="timeline">

    @foreach($task_events as $event)


            <li class="time-label">
        <span class="bg-red">
            {{ date("jS F, Y", strtotime($event->time)) }}
        </span>
            </li>

            <li>
                @if ( $event->type == "created")
                    <i class="fa fa-clock-o bg-grey"></i>
                @elseif($event->type == "saved")
                    <i class="fa fa-save bg-green"></i>
                @elseif($event->type == "updated")
                    <i class="fa fa-edit bg-blue"></i>
                    @elseif($event->type == "deleted")
                    <i class="fa  fa-trash bg-red"></i>
                @endif
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i>{{ date('G:i', strtotime($event->time)) }}</span>
                    <h3 class="timeline-header"><a href="/tasks_php/{{ json_decode($event->task)->id }}">{{ $event->task_name }}</a> </h3>
                    <div class="timeline-body">
                        The owner is: <b> {{ $event->user_name }}</b> and the type of task is: <b>{{ $event->type }}</b>.
                    </div>
                </div>
            </li>

    @endforeach

        <!-- END timeline item -->


    </ul>


@endsection
{{--@section('main-content')--}}
    {{--<ul class="timeline">--}}
        {{--@foreach($task_events as $event)--}}
            {{--<li class="time-label">--}}
        {{--<span class="bg-red">--}}
            {{--{{date('j F, Y', strtotime($event->time))}}--}}
        {{--</span>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--@if ( $event->type == "created")--}}
                    {{--<i class="fa fa-clock-o bg-blue"></i>--}}
                {{--@elseif($event->type == "saved")--}}
                    {{--<i class="fa fa-save bg-blue"></i>--}}
                    {{--<option value="{{ $user->id }}" >{{ $user->name }}</option>--}}
                    {{--@elseif($event->type == "updated")--}}
                    {{--<i class="fa fa-edit bg-blue"></i>--}}

                {{--@endif--}}
                {{--<i class="fa fa-envelope bg-blue"></i>--}}
                {{--<div class="timeline-item">--}}
                    {{--<span class="time"><i class="fa fa-clock-o"></i>{{date('G:i', strtotime($event->time))}}</span>--}}

                    {{--<h3 class="timeline-header"><a href="/tasks_php/{{$event->id}}">{{ $event->task_name }}</a> </h3>--}}

                    {{--<div class="timeline-body">--}}
                        {{--The owner is: <b> {{ $event->user_name }}</b> and the type of task is: <b>{{ $event->type }}</b>.--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</li>--}}
        {{--@endforeach--}}
    {{--</ul>--}}
{{--@endsection--}}