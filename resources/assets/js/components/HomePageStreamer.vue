

<!--<template>-->
<!--	<section class="hero is-large">-->
<!--		<div class="homeStreamer has-overlay">	-->
<!--			<div class="overlay"></div>-->
<!--			<img class="bottom-shadow mb-3" src="/public/images/shadow_2.png">-->
<!--			<div class="overlay__content">-->
<!--				<h1 class="overlay__content&#45;&#45;head mb-2">Begin Your Journey to a Digital Innovation</h1>-->
<!--				<div class="search__form section">-->
<!--					<course-search :forum="true" class="form__field"></course-search>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--		-->
<!--	</section>-->
<!--</template>-->

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
	    display: flex;
	    justify-content: center;
	}

	.form__field {
		width: 60%
	}

	@media (max-width: 769px) {
		.search__form {
		    max-width: 100%;
		}
		.bottom-shadow {
			display: none;
		}
	}
</style>
