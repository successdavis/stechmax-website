<template>
    <div>
        <div v-if="signedIn">
            <label>
                <textarea class="textarea" placeholder="Have something to say" name="body" rows="5" v-model="body" required></textarea>
                <button :disabled="processing" type="submit" class="success button" @click="addReply">POST</button>
            </label>
        </div>
        <div v-else>
            <p class="text-center">Please <a href="/login">Sign In</a> in to participate in the Conversation</p>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                processing: false,
                body: ''
            };
        },

        methods: {
            addReply() {
                this.processing = true;
                axios.post(location.pathname + '/replies', { body: this.body })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                        this.processing = false;
                    })
                    .then(({data}) => {
                        this.body = '';

                        flash('Your reply has been posted.');
                        this.processing = false;
                        this.$emit('created', data);
                    });
            }
        }
    }
</script>