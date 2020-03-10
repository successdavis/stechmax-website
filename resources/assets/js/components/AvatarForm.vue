<template>
    <div>
        <img :src="avatar" class="is-rounded">
        <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
            <image-upload name="avatar" class="is-rounded none" @loaded="onLoad"></image-upload>
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
                return this.authorize(user => user.id === this.user.id, 'isAdmin')
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

                axios.post(`/api/users/${this.user.username}/avatar`, data)
                    .then(() => flash('Avatar Uploaded! '));
            }
        }
    }

</script>
