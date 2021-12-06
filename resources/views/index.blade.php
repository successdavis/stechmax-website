@extends('layouts.app')
@section('pageTitle')
  Success Techmax - Best ICT Training Centre Obudu, Cross River State
@endsection
@section('content')
    @include('layouts.home-hero')

<div class="container">
    <div class="section">
      <h3 class="is-size-3 has-text-centered">Who We are</h3>
      Since 2013, Success Computers now known as Success Techmax has grown to become the #1 IT Company within her globe. We offer much more than just IT. We offer Business Technology Solutions. Our IT & Business Services help your company keep up with the constant changes in your industry by making your business more adaptable and therefore more competitive.
    </div>
</div>

<div class="container">
      <h2 class="is-size-3 has-text-centered">What We Do</h2>
    
    <div class="section columns is-multiline has-text-centered">
      <div class="column is-4">
        <h3 class="is-size-4">Digital Print Press</h3>
        <p>Affordable & Quality Printing and Branding in vibrant full colour, delivered to your doorstep as fast as 3 to 4 business days. Satisfaction Guaranteed</p>
        <a href="https://print.stechmax.com" target="_blank" class="button is-success mt-3">Go to page</a>
      </div>
      <hr>
      <div class="column is-4">
        <h3 class="is-size-4">Digital Marketing Agency</h3>
        <p>We create effective websites & graphics that capture your brand and maximize your revenue to help grow your business and achieve your goals.</p>
        <a href="https://website.stechmax.com" target="_blank" class="button is-success mt-3">Go to page</a>
      </div>
      <hr>
      <div class="column is-4">
        <h3 class="is-size-4">Video Studio</h3>
        <p>Elevates brands through video production & photography</p>
        <a href="https://studio.stechmax.com" target="_blank" class="button is-success mt-3">Go to page</a>
      </div>
      <hr>
      <div class="column is-4">
        <h3 class="is-size-4">E-Store</h3>
        <p>Buy Electronics, office supplies and UK Used Laptops and have it delivered to your doorsteps</p>
        <a href="https://store.stechmax.com" target="_blank" class="button is-success mt-3">Go to page</a>
      </div>
      <hr>
      <div class="column is-4">
        <h3 class="is-size-4">IT Training Institution</h3>
        <p>We’re S-Techmax, the premier global IT learning community. A certificate from Stechmax speaks volume about you.</p>
        <a href="/learning" class="button is-success mt-3">Go to page</a>
      </div>
      <hr>
      <div class="column is-4">
        <h3 class="is-size-4">One Cafe</h3>
        <p>Your one stop Cafe' for all Internet Services, Photocopy and Typesetting</p>
        <a href="https://blog.stechmax.com" target="_blank" class="button is-success mt-3">Go to page</a>
      </div>

    </div>
</div>

<section class="hero is-medium is-link">
  <div class="hero-body">
    <p class="title">
      Why Choose us?
    </p>
    <p class="subtitle">
      Our business grows when your's succeed, which is why we put our customer's satisfaction first.
    </p>
  </div>
</section>

<div class="section">
  <h3 class="title has-text-centered">What our customers say</h3>

  <div class="columns is-multiline">
    <div class="column is-4">  
      <div class="box has-text-white-ter">
          <p>
              <span class="font-bold has-text-primary is-size-5">
                  “
              </span>
              For some people, I'm sure S-Techmax is just a side show in their business, but for us, it's a critical part of our success. We have increased revenue 30% since using S-Techmax Services.
              <span class="font-bold has-text-primary is-size-5">
                  ”
              </span>
          </p>
          <div class="is-flex is-align-items-center is-justify-content-start mt-2">
              <div class="is-flex is-flex-direction-column ml-2 is-align-content-space-between">
                  <span class="font-semibold has-text-weight-bold">
                      Dave Maxwell
                  </span>
              </div>
          </div>
      </div>
    </div>
    <div class="column is-4">  
      <div class="box has-text-white-ter">
          <p>
              <span class="font-bold has-text-primary is-size-5">
                  “
              </span>
              Simply the best ICT Company you can count on for reliable and quality service.
              <span class="font-bold has-text-primary is-size-5">
                  ”
              </span>
          </p>
          <div class="is-flex is-align-items-center is-justify-content-start mt-2">
              <div class="is-flex is-flex-direction-column ml-2 is-align-content-space-between">
                  <span class="font-semibold has-text-weight-bold">
                      Mr. Mathias Oturie
                  </span>
              </div>
          </div>
      </div>
    </div>
    <div class="column is-4">  
      <div class="box has-text-white-ter">
          <p>
              <span class="font-bold has-text-primary is-size-5">
                  “
              </span>
              I like the way you give attention to product details and customer communication. Good job, keep it going.
              <span class="font-bold has-text-primary is-size-5">
                  ”
              </span>
          </p>
          <div class="is-flex is-align-items-center is-justify-content-start mt-2">
              <div class="is-flex is-flex-direction-column ml-2 is-align-content-space-between">
                  <span class="font-semibold has-text-weight-bold">
                      Margaret Uzor
                  </span>
              </div>
          </div>
      </div>
    </div>
  </div>

</div>

    <h3 id="message" class="has-text-centered is-size-3">Talk to us</h3>
    <contactform></contactform>
    @include('layouts.footer')
@endsection
