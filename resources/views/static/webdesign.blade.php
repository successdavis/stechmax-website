@extends('layouts.app')

@section('content')
<!-- ============================Hero Section========================-->
<section class="hero is-medium  is-bold header-bg is-centered">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
         Fast | Efficient | Reliable
      </h1>
      <h2 class="subtitle">
        Now is the right time to take your business to the next level
      </h2>
    </div>
  </div>
</section>
<!-- =============================Cards================================== -->
<div class="container">
  <div class="columns is-multiline is-centered">
    <div class="column is-4">
        <div class="card">
          <div class="card-content">
          <figure class="image is-256x256">
            <img class="" src="{{asset('/images/payment-gateway.jpg')}}">
          </figure>
          <header class="card-header">
            <p class="card-header-title is-centered">
              <a>Payment Integration</a>
            </p>
          </header>
          <div class="content">
            We Integrate Payment Gateway Reliable and Provide Save Checkout Experience.
            <a href="#">@Stechmax</a>. 
            <br>
            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
          </div>
        </div>
        <!-- <footer class="card-footer">
          <button class="button is-small is-fullwidth"><a>Request a Quote</a></button>
        </footer> -->
      </div>
    </div>

    <div class="column is-4">
      <div class="card">
        
        <div class="card-content">
          <figure class="image is-256x256">
        <img class="" src="{{ asset('/images/eCommerce.jpg') }}">
      </figure>

      <header class="card-header">
          <p class="card-header-title is-centered">
            <a>eCommerce</a>
          </p>
        </header>          <div class="content">
            Sell Your Products or Ideas Online. Get Your Store Running and Ready to Receive Payments.
            <a href="#">@Stechmax</a>. 
            <br>
            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
          </div>
        </div>
        <!-- <footer class="card-footer">
          <button class="button is-small is-fullwidth"><a>Request a Quote</a></button>
        </footer> -->
      </div>
    </div>

    <div class="column is-4">
      <div class="card">
        
        <div class="card-content">
          <figure class="image is-256x256">
        <img class="" src="{{asset('/images/Development-Fast.png')}}">
          </figure>
          <header class="card-header">
              <p class="card-header-title is-centered">
                <a>Web Design & Development</a>
              </p>
            </header>
              <div class="content">
            Learn to Build Websites from beginer-Experts, Using In-demand Tchnologies.
            <a href="#">@Stechmax</a>. 
            <br>
            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
          </div>
        </div>
        <!-- <footer class="card-footer">
          <button class="button is-small is-fullwidth"><a>Request a Quote</a></button>
        </footer> -->
      </div>
    </div>

    <div class="column is-4">

      <div class="card">
        
        <div class="card-content">
          <figure class="image is-256x256">
            <img class="" src="{{asset('/images/SEO.png')}}">
          </figure>
          <header class="card-header">
          <p class="card-header-title is-centered">
            <a>SEO</a>
          </p>
        </header>
          <div class="content">
            Increase Your Site Traffic and Visibility to Users on Search Engines.
            <a href="#">@Stechmax</a>. 
            <br>
            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
          </div>
        </div>
        <!-- <footer class="card-footer">
          <button class="button is-small is-fullwidth"><a>Request a Quote</a></button>
        </footer> -->
      </div>
    </div>

    <div class="column is-4">
      <div class="card">
        <div class="card-content">
          <figure class="image is-256x256">
            <img class="" src="{{asset('/images/header.png')}}">
          </figure>
          <header class="card-header">
            <p class="card-header-title is-centered">
              <a>Web Portal</a>
            </p>
          </header>
          <div class="content">
            With our UI/UX and Server Side Experts, we Design Great Portals for Registration, Login, Dashboards, and More.
            <a href="#">@Stechmax</a>. 
            <br>
            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
          </div>
        </div>
        <!-- <footer class="card-footer">
          <button class="button is-small is-fullwidth"><a>Request a Quote</a></button>
        </footer> -->
      </div>
    </div>

    <div class="column is-4">
      <div class="card">
        <div class="card-content">
          <figure class="image is-256x256">
            <img class="" src="{{asset('/images/webdev.jpg')}}">
          </figure>
        <header class="card-header">
          <p class="card-header-title is-centered">
            <a>Web Design Training</a>
          </p>
        </header>
          <div class="content">
             Learn to Build Websites from beginer-Experts, Using In-demand Tchnologies.
            <a href="#">@Stechmax</a>. 
            <br>
            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
          </div>
        </div>
        <!-- <footer class="card-footer">
          <button class="button is-small is-fullwidth"><a>Request a Quote</a></button>
        </footer> -->
      </div>
    </div>
  </div>
</div>
@endsection
