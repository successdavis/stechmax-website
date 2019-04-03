<template>
    <div class="square-box thumbnail">
        <img :src="avatar">
        <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
            <image-upload name="avatar" class="none" @loaded="onLoad"></image-upload>
        </form>
    </div>
</template>

<script>
    import ImageUpload from './ImageUpload.vue';
    export default {
        props: ['user'],

        components: {ImageUpload},

        data() {
            return {
                avatar: this.user.avatar_path
            };
        },

        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id)
            }
        },

        methods: {
            onLoad(avatar) {
                this.avatar = avatar.src;

                this.persist(avatar.file);
            },
        persist(avatar) {
                let data = new FormData();

                data.append('avatar', avatar);

                axios.post(`/api/users/${this.user.email}/avatar`, data)
                    .then(() => flash('Avatar Uploaded! '));
            }
        }
    }

</script>
