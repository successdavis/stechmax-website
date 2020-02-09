<template>
	<div>
		<div class="tabs is-boxed is-active is-centered">
		  <ul>
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

<style scoped>
	.tab-details {
		color: black;
	}
</style>