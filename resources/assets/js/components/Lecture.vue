<template>
    <div class="course-lecture ">
        <div v-if="editing">
            <form @submit.prevent="update" @keydown="Form.errors.clear()">

                <div class="field">
                  <label class="label">Edit Lecture</label>
                  <div class="control">
                    <input class="input" id="title" type="text" v-model="Form.title">
                  </div>
                    <p class="help is-danger" v-if="Form.errors.has('title')" v-text="Form.errors.get('title')" id="title"></p>
                </div>

                <div class="field is-grouped">
                        <div class="control">
                            <button class="button" @click.prevent="cancel">Cancel</button>
                        </div>
                        <div class="control">
                            <button class="button">Update</button>
                        </div>
                </div>
            </form>
        </div>
        <div class="display-mini-icons" v-else>
            <span><i class="fas fa-book"></i><strong> Lecture {{lecture.order}} : </strong></span>
            <p class="inline" v-text="Form.title"></p>
            <span>
                <i class="far fa-edit mini-icons" @click="editing = true"></i>
                <i class="fas fa-trash mini-icons" @click="remove"></i>
                <form method="POST" enctype="multipart/form-data">
                    <label for="video"><i class="mdi mdi-film"><span v-show="showUpload"> Update Video</span></i></label>
                    <input @change="attachVideo" type="file" id="video" accept="video/*">
                </form>
            </span>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['lecture'],

        data () {
            return {
                editing: false,
                hasVideo: this.lecture.has_video,
                id: this.lecture.id,
                slug: this.lecture.slug,
                Form: new Form ({
                    title: this.lecture.title
                }),
            }
        },

        computed: {
            showUpload(){
                return this.hasVideo ? true : false;
            }
        },

        methods: {
            attachVideo (e) {
                    if(! e.target.files.length) return;
                    let video = e.target.files[0];

                    let data = new FormData();

                    data.append('video', video);

                    axios.post(`/api/${this.slug}/video`, data)
                    .then(data => {
                        flash('Video Uploaded Successfully!');
                        this.hasVideo = true;
                    })
                    .catch(error => {
                        flash('There are some errors with the video you provided','failed');
                    });
            },
            remove () {
                axios.delete(`/manage/${this.slug}/lecture`);

                this.$emit('deleted', this.id);
            },

            update() {
                axios.patch(`/manage/${this.slug}/lecture`, {title: this.Form.title});
                this.editing = false;
            },

            cancel () {
                this.Form.reset();
                this.editing = false;
            }
        }
    }
</script>
