@component('mail::message')

Hello! {{$owner->f_name . ' ' . $owner->l_name}}

 'You have subscribe to "' 
            . {{$subscriber->title}}
            . '". You are assigned to use System '
            . {{$subscription->system_no}};


Thanks,<br>
{{ config('app.name') }}
@endcomponent
