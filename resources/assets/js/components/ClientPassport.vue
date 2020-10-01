<template>
    <div class="image-container">
        <img
            :src="image"
            class="is-rounded"
            style="width: 24px; height: 24px; cursor: pointer">
        <div class="file">
          <label class="file-label">
            <input class="file-input" id="client-image" type="file" name="resume"  accept="image/*" @change="onChange">
                <i style="cursor: pointer" class="mdi mdi-arrow-up-bold-outline"></i>
          </label>
        </div>
    </div>

<!--    <div class="square-box thumbnail mb-4 mt-3">-->
<!--        <img :src="passport">-->
<!--        <form method="POST" enctype="multipart/form-data">-->
<!--            <image-upload name="image" class="none" @loaded="onLoad"></image-upload>-->
<!--        </form>-->

<!--    </div>-->
</template>

<script>
    import ImageUpload from './ImageUpload.vue';
    export default {
        props: ['client'],

        components: {ImageUpload},

        data() {
            return {
                image: this.client.image_path
            };
        },

        methods: {
            onChange(e) {
                if(! e.target.files.length) return;
                let file = e.target.files[0];

                let reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = e => {
                    // Load Image for preview
                    this.image = e.target.result;
                };

                // Persis to the server
                this.persist(file);
            },

        persist(avatar) {
                let data = new FormData();

                data.append('avatar', avatar);

                axios.post(`api/client/${this.client.id}/image`, data)
                    .then(() => flash('Image Uploaded! ')).catch(() => flash('Unable to upload Image', 'failed'));
            }
        }
    }

</script>
<style scoped>
    .image-container {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
</style>
