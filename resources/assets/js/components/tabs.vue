<template>
	<div>
		<div class=" is-centered">
		  <ul class="tabset">
		    <li v-for="tab in tabs" :class="{'is-active' : tab.isActive}">
		    	<a :href="tab.href" @click="selectTab(tab)" v-text="tab.name"></a>
		    </li>
		  </ul>
		</div>
		<div class="tab-details">
			<slot></slot>
		</div>
	</div>
</template>

<script>
	export default {
		data () {
			return {
				tabs: [],
			}
		},
		created () {
			this.tabs = this.$children
		},

		methods: {
			selectTab(selectedTab) {
				this.tabs.forEach(tab => {
					tab.isActive = (tab.name  == selectedTab.name);
				});
			}
		}
	};
</script>

<style>
	.tabset {
		display: flex;
		justify-content: space-around;
		color: black;
		margin-left: 0;
	}

	ul li {
		display: inline-block;
		padding: .5em 0;
	}

	.tab-details {
		color: black;
	}
</style>