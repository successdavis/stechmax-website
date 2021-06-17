@component('mail::message')
# Alert!

Hi {{$owner->f_name}},

You subscription to <b>{{$subscriber->title}} was successfully renewed for {{$subscription->subscriber->amount}}.</b>

<h2>Thank You</h2>

Need help?

Thanks,<br>
{{ config('app.name') }}
@endcomponent
