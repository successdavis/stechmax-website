<template>
	<div :class="vertical ? 'columns' : ''">
		<div :class="vertical ? 'column is-3' : '' " class="tabs is-boxed is-active is-centered">
		  <ul :class="vertical ? 'vertical' : ''">
		    <li v-for="tab in tabs" :class="{'is-active' : tab.isActive}">
		    	<a :href="tab.href" @click="selectTab(tab)" v-text="tab.name"></a>
		    </li>
		  </ul>
		</div>
		<div class="column tab-details">
			<slot></slot>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			vertical: {default: false}
		},
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

	.vertical {
		flex-direction: column; 
		align-items: flex-start;
	}
</style>