@extends('layouts.app')

@section('content')

<div class="grid-container">
    <h4>You're almost done, Choose a plan you will love to subscribe to</h4>
    <div class="grid-x grid-margin-x grid-padding-x">
        @foreach ($plans as $plan)
        <div class="plans-card cell small-2 medium-4 bg-white">
            <div class="grid-container">
                <div class="plans-card--header">
                    <h4>{{$plan->name}}</h4>
                </div>
                <p>{{$plan->description}}</p>
                <div>
                   <strong>Fee:</strong> N{{$plan->price}}
                </div>
                <form method="post" action="/pay/{{$course->id}}">
                    @csrf
                    <input type="hidden" name="plan_code" value="{{$plan->plan_code}}">
                    <button type="submit" class="plans--card--btn medium button align-left">Enroll Now</a>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <ul>
    </ul>
</div>

</div>
@endsection
