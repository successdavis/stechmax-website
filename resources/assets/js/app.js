
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
Vue.component('target-student', require('./components/courseTargetStudent.vue'));
Vue.component('course-curriculum', require('./components/CourseCurriculum.vue'));
Vue.component('course-landing', require('./components/CourseLanding.vue'));
Vue.component('new-user', require('./components/NewUser.vue'));
Vue.component('view-user', require('./components/ViewUser.vue'));
Vue.component('users', require('./components/Users.vue'));
Vue.component('program-registration', require('./pages/ProgramRegistration.vue'));
Vue.component('testing', require('./components/testing.vue'));


const app = new Vue({
    el: '#app'
});
 
