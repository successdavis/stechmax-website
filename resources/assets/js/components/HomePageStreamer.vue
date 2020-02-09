<template>
	<section class="hero is-large">
		<div class="homeStreamer has-overlay">	
			<div class="overlay"></div>
			<img class="bottom-shadow mb-3" src="/public/images/shadow_2.png">
			<div class="overlay__content">
				<h1 class="overlay__content--head mb-2">Begin Your Journey to a Digital Innovation</h1>
				<course-search></course-search>
			</div>
		</div>
		
	</section>
</template>

<style scoped>
	.homeStreamer{
		min-height: calc(100vh - 56px);
		/*min-height: 550px;*/
		background-image: url(/../images/banner.jpg);
		background-size: cover;
	    background-position: center;
	    background-repeat: no-repeat; 
	}
	.bottom-shadow {
		position: absolute;
	    right: 0;
	    bottom: -69px;
	    z-index: -1;
	}

	.search__form {
	    max-width: 60%;
	}

	@media (max-width: 769px) {
		.bottom-shadow {
			display: none;
		}
	}
</style>