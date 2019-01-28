@extends('layouts.app')

@section('content')

<div class="grid-container">
    <h4>You're almost done, please choose your medium of payment</h4>
    <div class="grid-x grid-margin-x grid-padding-x">
        <div class="medium-6">
          <div class="grid-container">
            @if ($class == false)
              Pay <strong>N{{$course->fee}}</strong> for  <strong>{{$course->title}}</strong>.
              Your Training will base online
               <form method="post" action="/pay/{{$course->id}}">
                    @csrf
                    <input type="hidden" name="fullPayment" value="Please Ignore this field if displayed">
                    <button type="submit" class="medium button">Make Payment Now</button>
                </form>
            @else
              Pay <strong>N{{$course->fee}}</strong> for  <strong>{{$course->title}}</strong>.
              Your Training will base offline
              <form method="post" action="/pay/{{$course->id}}">
                  @csrf
                  <input type="hidden" name="class" value="true" >
                  <input type="hidden" name="fullPayment" value="Please Ignore this field if displayed">
                  <button type="submit" class="medium button">Make Payment Now</button>
              </form>
              <p>You can choose to make your payments installmental, First Installment takes 60% of the total fee and second installment takes 40%.</p>
              <p>60% of N{{$course->fee}} is N{{$course->getFirstInstallment()}} </p>
              <form method="post" action="/pay/{{$course->id}}">
                  @csrf
                  <input type="hidden" name="class" value="true" >
                  <input type="hidden" name="partPayment" value="Please Ignore this field if displayed">
                  <button type="submit" class="medium button">Pay 60% Fee Now</button>
              </form>
            @endif
          </div>
,        </div>
        <div class="medium-6">
          <div class="grid-container">
            <p>Prefer to pay at the bank? please use the details below</p>
            <p><strong>Account Name:</strong> Ikong Simon David</p>
            <p><strong>Account Number:</strong> 0981147294</p>
            <p><strong>Bank:</strong> Ecobank</p>

            <div>
              <p>if you had already made payment, click <a href="">here</a> to supply payment information</p>
            </div>
          </div>
        </div>
    </div>
    <ul>
    </ul>
</div>

</div>
@endsection

