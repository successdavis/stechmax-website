<template>
    <span>
        <div class="dropdown" :class="[active ? 'is-active' : '', userposition]">
          <div @click="active = !active" class="dropdown-trigger pointer">
              <span aria-haspopup="true" aria-controls="dropdown-menu"><i style="padding-left: 1.2rem;" class="mdi mdi-settings-helper mdi-rotate-90 mdi-36px"></i></span>
<!--                <button class="button" aria-haspopup="true" aria-controls="dropdown-menu"></button>-->
          </div>
          <div class="dropdown-menu" id="dropdown-menu" role="menu">
            <div class="dropdown-content" @click="active = false">
                <slot></slot>
            </div>
          </div>
        </div>

    </span>
</template>

<script>
    export default {
        props: ['position'],
        data () {
            return {
                userposition: this.position ? this.position : 'none', // position values include: is-right, is-left
                active: false,
            }
        }
    }
</script>
