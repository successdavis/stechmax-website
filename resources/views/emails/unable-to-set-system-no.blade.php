@component('mail::message')
# SYSTEM ERROR

Hello! {{$user->f_name . ' ' . $user->l_name}}
<p>The system was unable to allocate a system number to a Classroom Subscriber for the course {{$subscriber->title}} </p>
<p>Please find below Subscriber's Information</p>
<p>First Name: {{$subscriber->f_name}}</p>
<p>Last Name: {{$subscriber->l_name}}</p>
<p>Student Id: {{$subscriber->user_id}}</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
