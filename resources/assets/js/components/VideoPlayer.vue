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
import videojs from 'video.js';

export default {
    name: "VideoPlayer",
    props: {
        options: {
            type: Object,
            default() {
                return {};
            }
        }
    },
    data() {
        return {
            player: null
        }
    },
    mounted() {
        this.player = videojs(this.$refs.videoPlayer, this.options, function onPlayerReady() {
            console.log('onPlayerReady', this);
        })
    },
    beforeDestroy() {
        if (this.player) {
            this.player.dispose()
        }
    },
}
</script>