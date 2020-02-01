<template>
    <div v-if="playerOptions.sources[0].src">
        <video-player  class="video-player-box"
             ref="videoPlayer"
             :options="playerOptions"
             :playsinline="true"
             customEventName="customstatechangedeventname"
             @play="onPlayerPlay($event)"
             @pause="onPlayerPause($event)"
             @ended="onPlayerEnded($event)"
             @timeupdate="onPlayerTimeupdate($event)"

             @statechanged="playerStateChanged($event)"
             @ready="playerReadied">
        </video-player>
    </div>    
</template>

<script>
    export default {
        props: ['playerdata'],

        data() {
            return {
                player: '',
                playerOptions: {
                    autoplay: this.playerdata.autoplay,
                    language: 'en',
                    poster: this.playerdata.poster,
                    controls: true,
                    preload: 'auto',
                    // aspectRatio:"16:9", 
                    fluid: true,
                    playbackRates: [0.2, 0.5, 1, 1.5, 2,3,4],
                    sources: [
                        { 
                            src: this.playerdata.source,
                            type: "video/mp4"
                        } 
                    ],
                },
            }
        },

        mounted() {
            Event.$on('paused', () => this.pausePlayer(this.player));
        },

        created() {
            Event.$on('play', () => this.playPlayer(this.player));
        },
        
        methods: {
            pausePlayer(player) {
                console.log(player);
                player.pause();
            },
            playPlayer(player) {
                console.log('Some New stuffs');
                console.log(player);
            },
            onPlayerPlay(player) {
                // console.log('player play!', player)
            },
            
            onPlayerPause(player) {
                player.pause();
                // console.log('player pause!', player)
            },
            // ...player event

              // or listen state event
            playerStateChanged(playerCurrentState) {
                // console.log('player current update state', playerCurrentState)
            },

              // or listen state event
            onPlayerTimeupdate(timeupdate) {
                // console.log('player current update state', playerCurrentState)
            },

              // player is ready
            playerReadied(player) {
                this.player = player;
                console.log('the player is readied', player)
                // you can use it to do something...
                // player.[methods]
                console.log(player.paused());
            },
              // player is ready
            onPlayerEnded(player) {
                console.log('the player is ended', player);
                // you can use it to do something...
                // player.[methods]
            }
        }
    }
</script>