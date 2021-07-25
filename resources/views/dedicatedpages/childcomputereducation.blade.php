@extends('layouts.app')
@section('pageTitle')
  Success Techmax - Child Education Training
@endsection

@section('head')
  <script src="https://www.google.com/recaptcha/api.js?render=6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM"></script>
@endsection

@section('content')
  <section class="hero is-medium is-link">
    <div class="hero-body">
      <p class="title has-text-centered">
         Quality education is one of the best gifts you can give your child to secure their future.
      </p>
      <div class="has-text-centered">
        <a class="button is-large is-success" href="#registration">Register Now</a>
      </div>
    </div>
  </section>
<section class="section container">

    <div class="columns">
      <div class="column is-4">
        <img src="{{url('/images/early-child-computer-education.jpg')}}">
      </div>
      <div class="column">
        <section class="content">
          <h2 class="is-size-4">What is Early Child Computer Education?</h2>
          <p>Is it good for children to start using computers from an early age? Yes, the world has become heavily reliant on computers, and there are advantages to exposing children to computers. studies have shown that children who use computers from an early age have several advantages which include: Boost Problem-solving Skills, Introduces educational skills, Develop Literacy and Numeracy Skills, Prepares children for future computer use, Increases self-esteem and self-confidence, Stimulates language comprehension, Improves long-term memory and manual dexterity, Success Techmax Early Child Digital Skills focuses on training a child in the core and basic use of Computers and other tech-related tools. The program prepares your child to stay fit with the evolving technology. We have put in place all necessary tools to help a child learn with ease and faster which include the use of a projector, Not more than two students per computer system, One-on-One Training, Educational Games, Focus on Details, Planned Curriculum, Effective Lessons, and Certification. Quality learning requires a safe, friendly environment, qualified and motivated teachers, and instruction in languages students can understand. It also requires that learning outcomes be monitored and feedback into instruction.

</p>
        </section>
        <section class="content">
          <h2 class="is-size-4">Who is eligible for this program?</h2>
          <p>A child within the age of 7 - 13 Years can apply for this program</p>
        </section>
        <section class="content">
          <h2 class="is-size-4">How the program works</h2>
          <p><strong>After School Training</strong>: Classess are hold after school by 3:30pm - 5:30pm daily.</p>
          <p><strong>Holiday Training</strong>: Classess are hold during holidays by 8:30am - 1:00pm Daily</p>
        </section>
      </div>
    </div>

</section>
  <section class="hero is-small is-success">
    <div class="hero-body">
      <p class="title has-text-centered">
        You child deserves a better future. 
      </p>
      <p class="subtitle has-text-centered">
        Our Child Education curriculum makes it easier for you to give your child the best education there is
      </p>
    </div>
  </section>

  <section class="container">
    <div class="content section">
      <div class="columns">
        <div class="column">
          <h2 class="is-size-3">Programme Benefits</h2>
          <ul>
            <li>Boost Problem Solving-Skills</li>
            <li>Develop Good Habit</li>
            <li>Develop Literacy and Numeracy Skills</li>
            <li>Develop Emotional Resilience</li>
            <li>Enjoy a successful Future</li>
            <li>Develop a lifelong love for learning</li>
            <li>Stimulates Language Comprehension</li>
          </ul>
        </div>
        <div class="column">
          <h2 class="is-size-3">Programme Features</h2>
          <ul>
            <li>Certification</li>
            <li>Effective Lessons</li>
            <li>Planned Curriculum</li>
            <li>One Student One Computer System</li>
            <li>Focus on Details </li>
            <li>One-on-One Training with Student</li>
            <li>Educational Games</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="hero is-small is-primary">
    <div class="hero-body">
      <p class="title has-text-centered">
        Technology is increasing people’s quality of life 
      </p>
      <p class="subtitle has-text-centered">
        What's stoping you from enrolling your child today? Enroll Below
      </p>
    </div>
  </section>

  <section class="container">
    <div class="section" id="registration">
          @guest
            <div class="mt-3" id="registration-login">
                <h2 class="has-text-centered is-size-3">Early Child Computer Education Registration Form</h2>
                <p class="has-text-centered"><strong>Use parent email as child's email address</strong></p>
                <div>
                    <site-registration registerroute="/childcomputereducation#registration" loginroute="childcomputereducation#registration" mode="register"></site-registration>
                </div>
            </div>

            <div>
              
            </div>
          
          @else
            <div class="mb-2">
              <h2 class="has-text-centered is-size-3 title">Subscription Plan</h2>
              <div class="columns has-text-centered">
                <div class="column is-primary has-background-light">
                  <h3 class="is-size-3"><span>&#x20A6;</span>N5,000</h3>
                  <p class="has-text-centered is-size-4">1 Month</p>
                  <a href="/childcomputereducation-errolment?duration=1" class="button has-background-success is-large">Enroll Now</a>
                </div>
                <div class="column has-background-info">
                  <h3 class="is-size-3 has-text-white"><span>&#x20A6;</span>N12,000</h3>
                  <p class="has-text-centered is-size-4 has-text-white">3 Month</p>
                  <a href="/childcomputereducation-errolment?duration=3" class="button has-background-white is-large">Enroll Now</a>
                </div>
                <div class="column has-background-success">
                  <h3 class="is-size-3"><span>&#x20A6;</span>N18,000</h3>
                  <p class="has-text-centered is-size-4">6 Month</p>
                  <a href="/childcomputereducation-errolment?duration=6" class="button has-background-info is-large has-text-white">Enroll Now</a>
                </div>
              </div>
            </div>
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
                <div>b. Text depositor name, payment date, amount paid to 09050635633</div>
                <div>c. Click 
                  <a href="{{ route('pay.submitDetails') }}">here to supply payment details</a>
                </div>
          @endguest
    </div>
  </section>
@endsection
