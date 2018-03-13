@component('mail::message')
# {{ $subject }}

{{ $body }}

{{--@component('mail::button', ['url' => 'localhost:8080/email'])--}}
{{--Go to email--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
