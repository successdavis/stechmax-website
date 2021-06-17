@component('mail::message')
# Alert!

Hi {{$owner->f_name}},
We are unable to renew your subscription for <b>{{$subscriber->title}} for {{$subscription->invoice->amount}}.</b>
You need to have a valid credit card in your account for this transaction to go through. You can review your payment details on your S-Techmax account. This will help make sure your subscription is renewed smoothly.

We shall try again in on <b>{{Carbon\Carbon::now()->addDays(2)}}</b>, 

<h4>What happens if you don't renew?</h4>
On the expiration date we will remove your subscription from the above course. 

To stop this action, login to your account and turn of auto-renew feature for this course before <b>{{Carbon\Carbon::now()->addDays(5)}}</b>. 

If you need any help, please contact our customer support team. We are available 24/7.
Contact Customer Support

Thanks,<br>
{{ config('app.name') }}
@endcomponent
