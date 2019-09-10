<template>
	<div class="overlay">
		<p>Hello world</p>
		<div class="row">
			<div class="grid-x grid-container overlay__content" style="max-width: 850px;">
				<div class="medium-8 text-align-left">
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
					      <button>Submit</button>
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

	};

</script>

<style scoped>
	.text-align-left {
		text-align: left;
	}

	label {
		color: white;
	}

	.reg-form {
		-webkit-box-shadow: 0px 3px 13px 3px rgba(42,40,66,0.78);
		-moz-box-shadow: 0px 3px 13px 3px rgba(42,40,66,0.78);
		box-shadow: 0px 3px 13px 3px rgba(42,40,66,0.78);
	}

</style>