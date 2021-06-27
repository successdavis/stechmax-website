@component('mail::message')

Hello! {{$name}}

 {{$body}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
