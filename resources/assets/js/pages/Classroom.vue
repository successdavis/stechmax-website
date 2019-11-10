<template>
    <div>
        <div class="off-canvas-wrapper">
            <div class="off-canvas position-left reveal-for-medium" id="offCanvas" data-off-canvas>
                <!-- Close button -->
                <button class="close-button" aria-label="Close menu" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                </button>

                <ul class="accordion" data-accordion data-multi-expand="true">
                    <li v-for="section in sections" class="accordion-item is-active" data-accordion-item>
                        <a href="#" class="accordion-title"><i class="fas fa-grip-horizontal" style="padding-right:1em;"></i><span v-text=" section.title"></span></a>

                        <!-- Accordion tab content: it would start in the open state due to using the `is-active` state class. -->
                        <div class="accordion-content" data-tab-content>
                            <div class="grid-x grid-padding-x" v-for="lecture in section.lectures">
                                <div class="small-1">
                                    <i class="far fa-play-circle"></i>
                                </div>
                                <div class="small-11 lecture">
                                    <span v-text="lecture.title"></span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>

            <div class="off-canvas-content" data-off-canvas-content> 
                <button type="button" class="button" data-toggle="offCanvas">Open Menu</button>
                <div class="">
                    <video-player :options="videoOptions"/> 
                </div>
            </div>
            <!-- ==================================================================== -->
            <ul class="tabs" data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge-delay="500" data-tabs id="deeplinked-tabs">
              <li class="tabs-title is-active"><a href="#panel1d" aria-selected="true">Overview</a></li>
              <li class="tabs-title"><a href="#panel2d">Q A</a></li>
              <li class="tabs-title"><a href="#panel3d">Transcript</a></li>
              <li class="tabs-title"><a href="#panel4d">Notice</a></li>
            </ul>

            <div class="tabs-content" data-tabs-content="deeplinked-tabs">
              <div class="tabs-panel is-active" id="panel1d">
                <p>Section Under Maintenance</p>
              </div>
              <div class="tabs-panel" id="panel2d">
                <p>Section Under Maintenance.</p>
              </div>
              <div class="tabs-panel" id="panel3d">
                <p>Section Under Maintenance</p>
              </div>
              <div class="tabs-panel" id="panel4d">
                <p>Section Under Maintenance</p>
              </div>
            </div>
        </div>


    </div>
</template>

<script>
import VideoPlayer from "../components/VideoPlayer.vue";

export default {
    props: ['course', 'sections'],
    name: "Classroom",
    components: {
        VideoPlayer
    },
    data() {
        return { 
            videoOptions: {
                autoplay: true,
                controls: true,
                // aspectRatio:"16:9", 
                fluid: true,
                playbackRates: [0.2, 0.5, 1, 1.5, 2,3,4],
                sources: [
                    { 
                        src: "http://success.test/storage/videos/1.mp4",
                        type: "video/mp4"
                    },
                    { 
                        src: "http://success.test/storage/videos/1.mp4",
                        type: "video/mp4"
                    },
                ]
            }
        };
    },

    // created () {
    //          axios.get(`/api/${this.course.id}/lessonvideourl`)
    //             .then(
    //                 response => response.data,
                    
    //                 );
    //     },
};
</script>

<style scoped="">
    .lecture {
        font-weight: bolder;
        cursor: pointer;
        margin-bottom: 1em;
        padding-left: .7em;
    }

    li {
        list-style: none;
    }

</style>