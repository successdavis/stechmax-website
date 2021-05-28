<template>
    <div id="myVideo"></div>
</template>
<script>
    import Player from '@vimeo/player'
    export default {
        components: {Player},
        props: ['videoid'],
        data() {
            return {
                height: 640,
                source: this.videoid,
                player: false
            }
        },

        mounted() {
            this.install()
        },

        methods: {
            install() {
              this.player = new Player( 'myVideo' , {
                  id: this.source,
                  width: 1920,
                  background: false,
                  autoPlay: false,
                  controls: true,
                  responsive: true,
                  speed: true,
                  title: true,

              })
              .on("ended", function() {
                    console.log('video ended!')
                })
            },
        }
    }
</script>