@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="section">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          <div class="section">
            <h4 class="is-size-3 has-text-centered">You have choosed to study {{$course->title}}

              @if($class===true)
                online and at our ICT Centre.
              @else
                online only.
              @endif

            </h4>
            <p class="has-text-centered">Just one more step to go, Please choose your method of payment,</p>
            @if ($class === true)
              <p class="is-size-3 has-text-centered">
                Amount Payable &#8358; 
                {{$course->getClassAmountDiscount()}} 
              </p>
            @else
              <p class="is-size-3 has-text-centered">
                Amount Payable &#8358; {{$course->getDiscountAmount()}} 
              </p>
            @endif
          </div>

          <div class="columns is-multiline">
            <div class="column is-6">
              <div class="is-size-3">(1) Method 1: Pay with your MasterCard/Verve Card</div>
{{--  --}}
              <p>Click button below to make payment using your Debit Card (Master or Visa Card)</p>
                <div class="mb-2">

                  @if($debitCards->isNotEmpty())
                  <form method="post" action="{{$course->path()}}/paystackwithcard">
                      @csrf
                    <div class="select">
                      <select name="signature">
                          @foreach($debitCards as $card)
                          <option  value="{{$card->signature}}">{{$card->bank . ' - ' . $card->last4}}</option>
                          @endforeach
                      </select>
                    </div>
                    <input type="hidden" name="class" value="{!!$class ? 1 : 0!!}" >
                    <button type="submit" class="button is-primary">PAY WITH SELECTED CARD</button>
                  </form>

                  @endif
                  <form method="post" action="{{$course->path()}}/paystack">
                      @csrf
                      <input type="hidden" name="class" value="{!!$class ? 1 : 0!!}" >
                      <button type="submit" class="small large button is-success">
                        PAY WITH NEW CARD
                      </button>
                  </form>
                </div>
{{--  --}}
                {{-- Check if course support part payment then display --}}

                @if ($course->supportPartPayment())
                  @if ($class === true)
                    <h4>You can Pay installmental (1st 60% = &#8358; {{$course->getFirstInstallment('',true)}} )</h4>
                  @else
                    <h4>You can Pay installmental (1st 60% = &#8358; {{$course->getFirstInstallment()}} )</h4>
                  @endif                
                  <form method="post" action="{{$course->path()}}/paystackpart">
                      @csrf
                      <input type="hidden" name="class" value="{!!$class ? 1 : 0!!}" >
                      <button type="submit" class="small button"><img src="{{asset('/images/paystack.png')}}"></button>
                  </form>
                @endif
            </div>
            {{-- Display account numbers here --}}
            <div class="column is-6">
                <div class="is-size-3">(2) Method 2: Bank Deposit/Transfer</div>
                <p><strong>Account Name:</strong> Ikong Simon David</p>
                <p><strong>Account Number:</strong> 0799592449</p>
                <p><strong>Bank:</strong> Access Bank</p>
                <br>
                <p><strong>Account Name:</strong> Ikong Simon David</p>
                <p><strong>Account Number:</strong> 2254361184</p>
                <p><strong>Bank:</strong> Zenith Bank</p>
                <br>
                <h3 class="is-size-4">After payment please do one of the following:</h3>
                <div>a. snap and send your evidence of payment to support@stechmax.com</div>
                <div>b. Text depositor name, payment date, amount paid to 09032378855</div>
                <div>c. Click 
                  <a href="{{ route('pay.submitDetails') }}">here to supply payment details</a>
                </div>
            </div>
            
          </div>
      </div>
    </div>
@endsection

