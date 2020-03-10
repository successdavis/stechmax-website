<template>
	<li>
      <a class="has-icon has-submenu-icon" :class="active ? 'is-active' : ''" @click="active = !active">
      	<span class="icon">
      		<i class="fas fa-angle-double-down"></i>
      	</span>
      	<span class="menu-item-label">
      		<span v-text="name" class="has-text-grey-lighter"></span>
  			<i v-if="active" class="fas fa-minus"></i>
  			<i v-else class="fas fa-plus"></i>
      	</span>
      </a>
      <ul v-show="active">
        <slot></slot>
      </ul>
    </li>
</template>

<script>
	export default {
		props: ['name'],
		data () {
			return {
				active: false,
			}
		}
	}
</script>