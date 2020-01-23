<template>
	<div>
		<button @click="$modal.show('quick_login')">Login/Register</button>
		<modal 
			name="quick_login"
			height="auto"
			draggable=".window-header"
			class="scroll"
		> 
			<div>
				<ul class="tabs" data-tabs id="quick_login-tabs">
				  <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Login</a></li>
				  <li class="tabs-title"><a data-tabs-target="panel2" href="#panel2">Register</a></li>
				</ul>

				<div class="tabs-content" data-tabs-content="quick_login-tabs">
				  <div class="tabs-panel is-active" id="panel1">
				    <div v-if="!register">
						Login form goes here
					</div>
				  </div>
				  <div class="tabs-panel" id="panel2">
				    <div v-if="register">
						<form>
							REgister form goes here
						</form>
					</div>
				  </div>
				</div>
			</div>
		</modal>
	</div>
	
</template>

<script>
	export default {
		data () {
			return {
				register: false,
			}
		}
	}
</script>

<style scoped> 
	.scroll {
	    overflow: scroll;
	}
</style>