<template>

    <div class="callout alert-flash" v-show="show">
        <h5>Success</h5>
        <p>{{ body }}</p>
    </div>
    
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return{
                body: this.message,
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', messsage => this.flash(message));
        },

        methods: {
            flash(message) {
                this.body = message;
                this.show = true;

                 this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    }
</script>

<style type="text/css">
    
    .alert-flash {
        position: fixed;
        right: 25px;
        background: blue;
        bottom: 25px;
    }

</style>
