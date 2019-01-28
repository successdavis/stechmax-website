<!-- =========================================== -->
<div class="join-mailer text-center grid-container">
  <form method="post" action="/newssubscription">
    @csrf
    <h4>Join Us!</h4>
    <p>to receive updates and latest news direct from our team. Simply enter your email below :</p>
    <div class="input-group">
      <span class="input-group-label">
        <i class="fa fa-envelope"></i>
      </span>
      <input name="email" class="input-group-field" type="email" placeholder="Email" required>
      <button class="button">Join</button>
    </div>
  </form>
</div>


