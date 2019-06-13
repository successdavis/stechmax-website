<div class="grid-x banner align-middle">
  <div class="cell">
    <div class="grid-container top">
      <div class="grid-x grid-margin-x align-middle">
        <div class="cell large-auto">
        <ul>
            @if (count($errors))
                @foreach ($errors->all() as $error)
                    <li style="color: white">{{$error}}</li>
                @endforeach
            @endif
        </ul>
          <form id="reg-form" class="callout home-reg-form" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
            @csrf
            <h2 class="text-center">REGISTER</h2>

            <div class="grid-x grid-margin-x wrap">
              <div class="cell medium-6">
                <div class="floated-label-wrapper">
                  <label for="f_name">First Name</label>
                  <input type="text" value="{{old('f_name')}}" id="f_name" name="f_name" placeholder="Success" required>
                </div>
              </div>

              <div class="cell medium-6">
                <div class="floated-label-wrapper">
                  <label for="l_name">Last Name</label>
                  <input type="text" id="l_name" value="{{old('l_name')}}" name="l_name" placeholder="Techmax" required>
                </div>
              </div>
            </div>

            <div class="floated-label-wrapper">
              <label for="email">Email</label>
              <input type="email" id="email" value="{{old('email')}}" name="email" placeholder="johndoe&#64example.com" required>
            </div>

            <div class="grid-x grid-margin-x wrap">
              <div class="cell medium-6">
                <div class="floated-label-wrapper">
                  <label for="gender">Gender</label>
                  <select id="gender" name="gender">
                    <option value="" disabled selected>Select</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                  </select>
                </div>
              </div>
              <div class="cell medium-6">
                <div class="floated-label-wrapper">
                  <label for="phone">Phone Number</label>
                  <input type="text" value="{{old('phone')}}" id="phone" name="phone" placeholder="Phone Number" required>
                </div>
              </div>
            </div>

            <div class="grid-x grid-margin-x">
              <div class="cell medium-6">
                <div class="floated-label-wrapper">
                  <label for="pass">Password</label>
                  <input type="password" id="pass" name="password" placeholder="Password" required>
                </div>
              </div>
              <div class="cell medium-6">
                <div class="floated-label-wrapper">
                  <label for="password_confirmation">Confirm Password</label>
                  <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Retype password again" required>
                </div>
              </div>
            </div>
            <input class="button expanded red" type="submit" value="SEND">
          </form>

        </div>
        <div  class="cell large-auto text-center">
          <h2 class="float-text">Acquire the Knowledge and skills you need to start your career</h2>
        </div>
      </div>
    </div>
  </div>
</div>
 
