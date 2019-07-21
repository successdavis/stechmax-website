<template>
    <div class="square-box thumbnail mb-4 mt-3">
        <img :src="passport">
        <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
            <image-upload name="passport" class="none" @loaded="onLoad"></image-upload>
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
                passport: this.user.passport_path
            };
        },

        computed: {
            canUpdate() {
                return this.authorize('isAdmin', user => user.id === this.user.id)
            }
        },

        methods: {
            onLoad(passport) {
                this.passport = passport.src;

                this.persist(passport.file);
            },
        persist(passport) {
                let data = new FormData();

                data.append('passport', passport);

                axios.post(`/api/users/${this.user.username}/passport`, data)
                    .then(() => flash('Passport Uploaded! '));
            }
        }
    }

</script>
