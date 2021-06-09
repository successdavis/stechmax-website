<template>
    <div id="myVideo"></div>
</template>
<script>
    import Player from '@vimeo/player'
    export default {
        components: {Player},
        props: ['videoid','autoplay'],
        data() {
            return {
                source: this.videoid,
                player: false,
                auto: this.autoplay,
                testcomponent: '',
            }
        },

        mounted() {
            this.install();
        },

        methods: {
            install() {
              this.player = new Player( 'myVideo' , {
                  id: this.source,
                  width: 640,
                  background: false,
                  autoPlay: false,
                  controls: true,
                  responsive: true,
                  speed: true,
                  title: true,
                  autoplay: this.auto,

              }).on('ended', () => {
                this.$emit('videoend');
              })
            },
        }
    }
</script>