<template>
    <div :id="'reply-'+id" class="card">
        <div class="card-section">
            <div class="grid-x grid-margin-x">
                <div class="small-9 grid-container">
                    <h6><a :href="'/profiles/'+data.owner.email">
                        {{data.owner.f_name + " " + data.owner.l_name}}
                        <!-- {{$reply->owner->f_name . ' ' . $reply->owner->l_name}} -->
                        </a>  said: {{data.created_at}}...
                    </h6>
                </div>

                <div class="small-3" v-if="signedIn" >
                    <favorite :reply="data"></favorite>
                    <div v-if="canUpdate">
                        <button class="small button" @click="destory"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <div v-if="editing">
                <textarea v-model="body"></textarea>
                <button class="small button" @click="update">Update</button>
                <button class="small button" @click="editing = false">Cancel</button>
            </div>
            <div v-else v-text="body"></div>
            
                <div v-if="canUpdate">
                    <button class="small button" @click="editing = true">Edit</button>
                </div>
        </div>
    </div>

</template>

<script>
    import Favorite from './Favorite.vue';
    export default {
        props: ['data'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            };
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            },
            canUpdate() {
               return this.authorize(user => this.data.user_id == user.id);
                // return this.data.user_id == window.App.user.id;
            }
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });

                this.editing = false;

                flash('updated!');
            },

            destory() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);

                // $(this.$el).fadeOut(300, () => {
                //     flash('Reply Deleted');
                // });

            }
        }
    }
</script>
