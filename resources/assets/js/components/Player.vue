<template>
    <div v-if="playerOptions.sources[0].src" class="relative-body showNavigation">
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
        <div class="player_navigations">
            <div class="btn_design player_prev" @click="prevVideo">Previous</div>
            <div class="btn_design player_next" @click="nextVideo">Next</div>
        </div>
    </div>    
</template>

<script>
import { videojs, videoPlayer } from "vue-video-player";
import playlistMaker from "videojs-playlist/src/playlist-maker";

const plugin = function(list, item) {
  playlistMaker(this, list, item);
};

videojs.registerPlugin("playlist", plugin);
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
            
            prevVideo() {
                this.player.playlist.previous()
            },

            nextVideo() {
                this.player.playlist.next()
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
                // console.log(player.paused());

                player.playlist([{
                  sources: [{
                    src: 'http://media.w3.org/2010/05/sintel/trailer.mp4',
                    type: 'video/mp4'
                  }],
                  poster: 'http://media.w3.org/2010/05/sintel/poster.png'
                }, {
                  sources: [{
                    src: 'http://media.w3.org/2010/05/bunny/trailer.mp4',
                    type: 'video/mp4'
                  }],
                  poster: 'http://media.w3.org/2010/05/bunny/poster.png'
                }, {
                  sources: [{
                    src: 'http://vjs.zencdn.net/v/oceans.mp4',
                    type: 'video/mp4'
                  }],
                  poster: 'http://www.videojs.com/img/poster.jpg'
                }, {
                  sources: [{
                    src: 'http://media.w3.org/2010/05/bunny/movie.mp4',
                    type: 'video/mp4'
                  }],
                  poster: 'http://media.w3.org/2010/05/bunny/poster.png'
                }, {
                  sources: [{
                    src: 'http://media.w3.org/2010/05/video/movie_300.mp4',
                    type: 'video/mp4'
                  }],
                  poster: 'http://media.w3.org/2010/05/video/poster.png'
                }]);

                player.playlist.autoadvance(5);
            },
              // player is ready
            onPlayerEnded(player) {
                console.log('the player is ended', player);
                // you can use it to do something...
                // player.[methods]
            }
        }
    };
</script>

<style scoped>
    .showNavigation:hover .player_navigations {
        opacity: 1;
    }
    .player_navigations {
        opacity: 0;
        display: flex;
        justify-content: space-between;
        padding: .5em;
        position: absolute;
        z-index: 2;
        color: black;
        width: 100%;
        top: 50%;
        transform: translateY(-50%);
    }

    .btn_design {
        background: rgba(240,100,255,.3);
        color: white;
        padding: .5em;
    }

</style>