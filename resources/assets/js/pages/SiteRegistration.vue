<template>
	<div class="overlay">
		<p>Hello world</p>
		<div class="row">
			<div class="grid-x grid-container overlay__content" style="max-width: 850px;">

				<div class="medium-8">	
					<div class="switch large">
					  <input class="switch-input" id="yes-no" type="checkbox" name="exampleSwitch">
					  <label class="switch-paddle" for="yes-no">
					    <span class="switch-active" aria-hidden="true">Register an Account</span>
					    <span class="switch-inactive" aria-hidden="true">Login</span>
					  </label>
					</div>
					<form>
					  <div class="grid-container">
					    <div class="grid-x grid-padding-x">
					      <div class="cell">
					        <label>Email or Phone
					          <input type="text" placeholder="Enter your Surname Here">
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Surname
					          <input type="text" placeholder="Enter your Lasname Here">
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Last Name
					          <input type="text" placeholder="Enter your Lasname Here">
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Other Names
					          <input type="text" placeholder="Optional">
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Contact Phone
					          <input type="text" placeholder="Optional">
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Gender
					          <select>
							    <option value="male">Male</option>
							    <option value="Female">Female</option>
							  </select>
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Date of Birth
					          <input type="text" placeholder="Optional">
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Password
					          <input type="text" placeholder="Optional">
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Confirm Password
					          <input type="text" placeholder="Optional">
					        </label>
					      </div>
					    </div>
					  </div>
					</form>
				</div>
				<div class="medium-4">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {

	}
</script>