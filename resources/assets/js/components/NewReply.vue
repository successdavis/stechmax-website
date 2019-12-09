<template>
    <div>
        <div v-if="signedIn">
            <label>
                <textarea placeholder="Have something to say" name="body" rows="5" v-model="body" required></textarea>
                <button type="submit" class="success button" @click="addReply">POST</button>
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
                body: ''
            };
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', { body: this.body })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })
                    .then(({data}) => {
                        this.body = '';

                        flash('Your reply has been posted.');

                        this.$emit('created', data);
                    });
            }
        }
    }
</script>