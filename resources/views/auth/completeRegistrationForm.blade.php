@extends('layouts.app')

@section('content')

<div class="grid-container mt-3">
    <div class="white-bg grid-container">
        <div class="content-area grid-container ">
            <h4 class="center-text">You are almost there...</h4>
            <p class="center-text">You can choose to do this later. <a href=""> skip?</a></p>
            <div>
                <div class="grid-y align-middle mb-3">
                    <avatar-form></avatar-form>
                    <p>Please upload an avater</p>
                </div>

                <form>
                  <div class="grid-container">
                    <div class="grid-x grid-padding-x">
                      <div class="medium-6 cell">
                        <label>Residential Address
                          <input type="text" name="r_address">
                        </label>
                      </div>
                      <div class="medium-6 cell">
                        <label>Marital Status
                          <select name="marital_status">
                              <option value="M">Male</option>
                              <option value="F">Female</option>
                          </select>
                        </label>
                      </div>
                      <div class="medium-6 cell">
                        <label>Country
                          <select name="country">
                              <option >Please Select One</option>
                              <option value="Nig">Nigeria</option>
                          </select>
                        </label>
                      </div>
                      <div class="medium-6 cell">
                        <label>State
                          <select name="state">
                              <option>Please Select One</option>
                              <option value="crs">Cross River</option>
                          </select>
                        </label>
                      </div>
                      <div class="medium-6 cell">
                        <label>LGA
                          <select name="lga">
                              <option>Please Select One</option>
                              <option value="Obudu">Obudu</option>
                          </select>
                        </label>
                      </div>
                      <div class="medium-6 cell">
                        <label>Place of Birth
                          <input type="text" name="pob">
                        </label>
                      </div>
                      <div class="medium-6 cell">
                        <label>Parent/Guardian Name
                          <input type="text" name="g_name">
                        </label>
                      </div>
                      <div class="medium-6 cell">
                        <label>Parent/Guardian Phone No
                          <input type="text" name="g_phone">
                        </label>
                      </div>
                    </div>

                    <button type="Submit" class="medium button expanded success mb-4">Submit</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

