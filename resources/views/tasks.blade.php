@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Tasks
@endsection

@section('main-content')

<tasks></tasks>
  <tasks data-tasks="{{ $tasks }}"></tasks>


  <message title="missatge" message="{{$message or ''}}" color="info"></message>

  {{--<message title="Error"> </message>--}}

  {{--<message title="Error" message="Error greu"> </message>--}}

  {{--<message message="Error greu"></message>--}}

  {{--<message></message>--}}

@endsection
