<template>
    <div class="box">
      <article class="media">
        <div class="media-content">
          <div class="content">
            <p :class="read_at ? 'read' : ''">
              <strong :class="read_at ? 'read' : ''"  v-text="message.fullname"></strong> | <small>{{getHumanDate(message.created_at)}}</small>
              <br>
              <span v-text="message.message"></span>
            </p>
          </div>
            <span :class="read_at ? 'read' : ''">
              <span v-text="message.phone"></span> |
              <span v-text="message.email"></span>
            </span>
          <nav class="level is-mobile">
            <div class="level-left">
              <a :disabled="read_at" @click="markAsRead" class="button small">Mark as read</a>
            </div>
          </nav>
        </div>
      </article>
    </div>
</template>
<script>
    import moment from 'moment';
    export default {
        // components: { moment },
        props: {
          message: {
              required: true,
          }
        },

        data () {
            return {
                read_at: this.message.read_at,
            }
        },

        methods: {
            markAsRead(){
                axios.patch(`mark-message-as-read/${this.message.id}`)
                .then(() => {
                    this.read_at = true;
                })
                .catch(() => {
                    flash('Command failed','failed');
                })
            },

            getHumanDate (date) {
                return moment(date).fromNow();
            }
        }
    }
</script>
<style scoped>

    .read {
        color: lightgray
    }

</style>
