@extends('layouts.app')
@section('pageTitle')
  Customer Satisfaction Survey
@endsection
@section('content')
    @if(session()->has('thanks'))

        <div class="container">
            <div class="section has-text-centered">
                <p class="title has-text-centered">{{session()->pull('thanks')}}</p>
            </div>
        </div>
    @else
        <div class="container">
        <div class="section">
                <h2 class="has-text-centered title">Customer Satisfaction Survey</h2>
                <p>Please take a moment to help us improve our service by answering these questions</p>
            <form class="content" method="post" action="{{$token}}">
                @csrf
                <p>1. How satisfied are you with the service you recieved from Us?</p>
                <div class="control">
                  <label class="radio">
                    <input value="5" type="radio" name="satisfaction_rate" required>
                    Very satisfied
                  </label>
                  <label class="radio">
                    <input value="4" type="radio" name="satisfaction_rate">
                    Satisfied
                  </label>
                  <label class="radio" >
                    <input value="3" type="radio" name="satisfaction_rate">
                    Neither satisfied nor unsatisfied
                  </label>
                  <label class="radio" >
                    <input value="2" type="radio" name="satisfaction_rate">
                    Unsatisfied
                  </label>
                  <label class="radio" >
                    <input value="1" type="radio" name="satisfaction_rate">
                    Very Unsatisfied
                  </label>
                </div>
                <p class="pt-2">2. What can we do to make the experience better</p>
                <textarea required name="suggestion" class="textarea"></textarea>
                <p class="pt-2">3. How likely are you to recommend Success Techmax to your friends, family or colleagues?</p>

                <div style="display: flex; justify-content: space-evenly;">
                    <p><span>&#128544;</span> Not recommended</p>
                    <span style="display: flex; flex-direction: column">
                        <input required value="1" type="radio" id="1" name="recommendation_rate" required>
                        <label for="1">1</label>
                    </span>
                    <span style="display: flex; flex-direction: column">
                        <input value="2" type="radio" id="2" name="recommendation_rate">
                        <label for="2">2</label>
                    </span>
                    <span style="display: flex; flex-direction: column">
                        <input value="3" type="radio" id="3" name="recommendation_rate">
                        <label for="3">3</label>
                    </span>
                    <span style="display: flex; flex-direction: column">
                        <input value="4" type="radio" id="4" name="recommendation_rate">
                        <label for="4">4</label>
                    </span>
                    <span style="display: flex; flex-direction: column">
                        <input value="5" type="radio" id="5" name="recommendation_rate">
                        <label for="5">5</label>
                    </span>
                    <p>Highly recommended <span>&#128516</span></p>
                </div>

                <p class="pb-2">4. Thank you so much for answering. If you're inclined, we'd love if you'd add some comments on why you scored us the way you did, so we can continue to improve</p>
                <textarea name="testimonial" class="textarea" required></textarea>
                <div class="pt-3">
                    <button type="submit" class="button is-medium is-success">Success</button>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection
