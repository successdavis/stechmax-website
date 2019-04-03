
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('Flash', require('./components/Flash.vue'));
Vue.component('paginator', require('./components/paginator.vue'));
Vue.component('user-notifications', require('./components/UserNotifications.vue'));
Vue.component('thread-view', require('./pages/Thread.vue'));
Vue.component('avatar-form', require('./components/AvatarForm.vue'));
Vue.component('mega-menu', require('./components/MegaMenu.vue'));
Vue.component('course-registration', require('./components/CourseRegistration.vue'));

const app = new Vue({
    el: '#app'
});
 
