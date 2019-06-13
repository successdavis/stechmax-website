@extends('layouts.app')

@section('content')

<div class="grid-container mt-3">
    <h4>You're almost done, please choose your medium of payment</h4>
    <div class="grid-x grid-margin-x grid-padding-x">
        <div class="medium-6">
          <div class="grid-container">

            @if ($class === false)
                <p>Sorry! At the moment we dont offer online training</p>
                <p class="mb-4">Please check back later. You can choose to enroll for classroom training to study at our esteem institue and share physical interaction with instructors.</p>
                
                <a href="{{$course->path()}}/subscription?class=true" class="medium button">STUDY IN CLASSROOM</a>

                  {{--<followers></followers>--}}
                            {{--Pay <strong>N{{$course->fee}}</strong> for  <strong>{{$course->title}}</strong>.--}}
              {{--Your Training will base online--}}
               {{--<form method="post" action="/pay/{{$course->id}}">--}}
                    {{--@csrf--}}
                    {{--<input type="hidden" name="fullPayment" value="Please Ignore this field if displayed">--}}
                    {{--<button type="submit" class="medium button">Make Payment Now</button>--}}
                {{--</form>--}}

            @else
              Pay <strong>N{{$course->amount}}</strong> for  <strong>{{$course->title}}</strong>.
              Your Training will base offline
              <form method="post" action="{{$course->path()}}/subscription">
                  @csrf
                  <input type="hidden" name="class" value="true" >
                  <input type="hidden" name="pay_module" value="full" placeholder="Please Ignore this field if displayed">
                  <button type="submit" class="medium button">Make Payment Now</button>
              </form>
              <p>You can choose to make your payments installmental, First Installment takes 60% of the total fee and second installment takes 40%.</p>
              <p>60% of N{{$course->amount}} is N{{$course->getFirstInstallment()}} </p>
              <form method="post" action="{{$course->path()}}/subscription">
                  @csrf
                  <input type="hidden" name="class" value="true" placeholder="Please Ignore this field if displayed">
                  <input type="hidden" name="pay_module" value="part">
                  <button type="submit" class="medium button">Pay 60% Fee Now</button>
              </form>
            @endif
          </div>
,        </div>
        <div class="medium-6">
          <div class="grid-container">
            <p>Prefer to pay at the bank or make transfer? please use the details below</p>
            <p><strong>Account Name:</strong> Ikong Simon David</p>
            <p><strong>Account Number:</strong> 0799592449</p>
            <p><strong>Bank:</strong> Access Bank</p>

            <div>
              <p>if you had already made payment, click <a href="{{ route('pay.submitDetails') }}">here</a> to supply payment information</p>
            </div>
          </div>
        </div>
    </div>
    <ul>
    </ul>
</div>

</div>
@endsection

