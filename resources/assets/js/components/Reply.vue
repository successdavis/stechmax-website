<template>
    <div :id="'reply-'+id" class="card " :class="isBest ? 'green' : 'default'">
        <div class="card-section">
            <div class="grid-x grid-margin-x">
                <div class="small-9 grid-container">
                    <h6><a :href="'/profiles/'+reply.owner.email">
                        {{reply.owner.f_name + " " + reply.owner.l_name}}
                        <!-- {{$reply->owner->f_name . ' ' . $reply->owner->l_name}} -->
                        </a>  said: {{reply.created_at}}...
                    </h6>
                </div>

                <div class="small-3" v-if="signedIn" >
                    <favorite :reply="reply"></favorite>
                    <div v-if="authorize('owns', reply)">
                        <button class="small button" @click="destroy"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <div v-if="editing">
                <form @submit="update">
                    <textarea v-model="body" required></textarea>
                    <button class="small button">Update</button>
                    <button class="small button" @click="editing = false" type="button">Cancel</button>
                </form>
            </div>
            <div v-else v-text="body"></div>
                <div v-if="authorize('owns', reply)">
                    <button class="small button" @click="editing = true">Edit</button>
                </div>
                <button class="small button" @click="markBestReply" v-if="authorize('owns', reply.thread)">Best Reply</button>
        </div>
    </div>

</template>

<script>
    import Favorite from './Favorite.vue';
    export default {
        props: ['reply'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.reply.id,
                body: this.reply.body,
                isBest: this.reply.isBest,
            };
        },

        created () {
            window.events.$on('best-reply-selected', id => {
                this.isBest = (id === this.id);
            });
        },

        methods: {
            update() {
                axios.patch(
                    '/replies/' + this.id, {
                    body: this.body
                })

                .catch(error => {
                    flash(error.response.reply, 'danger');
                });

                this.editing = false;

                flash('updated!');
            },

            destroy() {
                axios.delete('/replies/' + this.reply.id);

                this.$emit('deleted', this.reply.id);
            },

            markBestReply() {
                axios.post('/replies/' + this.reply.id + '/best');

                window.events.$emit('best-reply-selected', this.reply.id);

            }
        }
    }
</script>
