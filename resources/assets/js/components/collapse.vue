<template>
    <div class="card">
    <header class="card-header">
      <p class="card-header-title" v-text="title">
        
      </p>
      <a class="card-header-icon" aria-label="more options" @click="toggleContent">
        <span class="icon" >
          <i class="fas fa-angle-down" aria-hidden="true" ></i>
        </span>
      </a>
    </header>
    <div class="card-content" v-show="isOpen">
      <div class="content">
          <slot name="content"></slot>
      </div>
    </div>
    <footer class="card-footer" v-show="showfooter">
        <slot name="footer"></slot>
    </footer>
  </div>
</template>

<script>
  export default {
    props: {
      title: {required: true},
      footer: {default: false},
      open: {default: false},
    },
    data () {
      return {
          isOpen: this.open,
          showfooter: this.footer
      }
    },

    methods: {
        toggleContent() {
            return this.isOpen == true ? this.isOpen = false : this.isOpen = true;
        }
    }
  }
</script>