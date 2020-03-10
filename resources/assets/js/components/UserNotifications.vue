<template>
    <div class="dropdown is-right" :class="isActive ? 'is-active' : ''">
        <span aria-controls="dropdown-menu6" class="dropdown-trigger icon has-update-mark" @click="toggle">
            <i class="fas fa-bell default"></i>
        </span>
      <div class="dropdown-menu" id="dropdown-menu6" role="menu">
        <div class="dropdown-content">
            <p class="dropdown-item" v-if="! notifications.length">No Notifications</p>
          <div class="dropdown-item" v-for="notification in notifications">
                <a :href="notification.data.link" 
                    v-text="notification.data.message" 
                    @click="markAsRead(notification)">        
                </a>
          </div>
        </div>
      </div>
    </div>


<!-- 
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
 -->



</template>

<script>
    export default {
        data() {
            return { 
                isActive: false,
                notifications: false
            }
        },

        created() {
            axios.get("/profiles/" + window.App.user.email + "/notifications")
                .then(response => this.notifications = response.data);
        },

        methods: {
            toggle() {
                return this.isActive = !this.isActive;
            },
            // "/profiles/{$user->email}/notifications/" . $user->unreadNotifications->first()->id
            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.email + '/notifications/' + notification.id)
            }
        }
    }
</script>
