@extends('layouts.app')

@section('content')

<div class="container mt-3">
    <h4 class="mt-2 title has-text-centered">Submit Payment Details</h4>
    <form class="form" action="{{ route('pay.saveDetails') }}" method="post">
      @csrf
      <div class="grid-x grid-padding-x">
        <div class="cell">
            <label>Payee Name
              <input class="input" type="text" name="payee_name" placeholder="Whats is the name you paid with">
            </label>
        </div>
        <div class="cell">
            <label>Amount Paid
              <input class="input" type="number" name="amount" placeholder="How much did you pay?">
            </label>
        </div>
        <div class="cell">
            <label>Transaction Date
              <input class="input" type="date" name="transaction_date" placeholder="When did you make this payment?">
            </label>
        </div>
        <div class="cell">
            <label>Course Title
              <input class="input" type="text" name="course" placeholder="What course did you paid for">
            </label>
        </div>
      <input type="Submit" value="Send" class="large success button mt-3">
      </div>
    </form>
</div>

</div>
@endsection

