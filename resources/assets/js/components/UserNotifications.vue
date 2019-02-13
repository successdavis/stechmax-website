<template>
    <li>
        <a data-toggle="user-notification"><i class="fas fa-bell"></i></a>
        <div class="dropdown-pane" id="user-notification" data-dropdown data-auto-focus="true">
            <p v-if="! notifications.length">No Notifications</p>
            <ul >
                <li v-for="notification in notifications">
                    <a :href="notification.data.link" v-text="notification.data.message" @click="markAsRead(notification)"></a>
                </li>
            </ul>
        </div>
    </li>




</template>

<script>
    export default {
        data() {
            return { notifications: false}
        },

        created() {
            axios.get("/profiles/" + window.App.user.email + "/notifications")
                .then(response => this.notifications = response.data);
        },

        methods: {
            // "/profiles/{$user->email}/notifications/" . $user->unreadNotifications->first()->id
            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.email + '/notifications/' + notification.id)
            }
        }
    }
</script>
