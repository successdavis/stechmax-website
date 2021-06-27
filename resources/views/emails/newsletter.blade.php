@component('mail::message')

Hello! {{$name}}

 <p>{{$body}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
