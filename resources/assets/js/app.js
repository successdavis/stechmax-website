
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

const compiler = require('vue-template-compiler');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('Flash', require('./components/Flash.vue').default);
Vue.component('paginator', require('./components/paginator.vue').default);
Vue.component('user-notifications', require('./components/UserNotifications.vue').default);
Vue.component('thread-view', require('./pages/Thread.vue').default);
Vue.component('view-all-courses', require('./pages/Courses.vue').default);
Vue.component('user-setting', require('./pages/UserSetting.vue').default);
Vue.component('user-courses', require('./pages/MyCourses.vue').default);
Vue.component('user-payments', require('./pages/MyPayments.vue').default);
Vue.component('manage-invoices', require('./pages/ManageInvoices.vue').default);
Vue.component('create-invoices', require('./pages/CreateInvoices.vue').default);
Vue.component('site-registration', require('./pages/SiteRegistration.vue').default);
Vue.component('account-confirmation', require('./pages/AccountConfirmation.vue').default);
Vue.component('invoice-payments', require('./components/ViewInvoicePayments.vue').default);
Vue.component('add-payment', require('./components/AddPayment.vue').default);
Vue.component('avatar-form', require('./components/AvatarForm.vue').default);
Vue.component('passport-form', require('./components/PassportForm.vue').default);
Vue.component('mega-menu', require('./components/MegaMenu.vue').default);
Vue.component('course-registration', require('./components/CourseRegistration.vue').default);
Vue.component('target-student', require('./components/courseTargetStudent.vue').default);
Vue.component('course-curriculum', require('./components/CourseCurriculum.vue').default);
Vue.component('track-curriculum', require('./components/TrackCurriculum.vue').default);
Vue.component('course-landing', require('./components/CourseLanding.vue').default);
Vue.component('new-user', require('./components/NewUser.vue').default);
Vue.component('view-user', require('./components/ViewUser.vue').default);
Vue.component('users', require('./components/Users.vue').default);
// Vue.component('program-registration', require('./pages/ProgramRegistration.vue').default);
Vue.component('data-table', require('./components/DataTable.vue').default);
// Vue.component('test', require('./components/Test.vue').default);


const app = new Vue({
    el: '#app'
});
 
