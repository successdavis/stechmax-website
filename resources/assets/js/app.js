import Vue from 'vue'
window.Vue = Vue;
require('./bootstrap');

const compiler = require('vue-template-compiler');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('Flash', require('./components/Flash.vue').default);
Vue.component('paginator', require('./components/paginator.vue').default);
Vue.component('tabs', require('./components/tabs.vue').default);
Vue.component('tab', require('./components/tab.vue').default);
Vue.component('nav-bar', require('./components/NavBar.vue').default);
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
Vue.component('reset-passwords', require('./pages/ResetPassword.vue').default);
Vue.component('billing', require('./pages/Billing.vue').default);
Vue.component('courses-catalogue', require('./pages/CoursesCatalogue.vue').default);
Vue.component('bank-detail', require('./pages/BankDetail.vue').default);

Vue.component('test', require('./pages/Test.vue').default);


Vue.component('study-room', require('./pages/StudyRoom.vue').default);

Vue.component('invoice-payments', require('./components/ViewInvoicePayments.vue').default);
Vue.component('add-payment', require('./components/AddPayment.vue').default);
Vue.component('user-add-payment', require('./components/UserAddPayment.vue').default);
Vue.component('avatar-form', require('./components/AvatarForm.vue').default);
Vue.component('passport-form', require('./components/PassportForm.vue').default);
Vue.component('client-passport', require('./components/ClientPassport.vue').default);
Vue.component('mega-menu', require('./components/MegaMenu.vue').default);
Vue.component('lower-nav', require('./components/LowerNav.vue').default);
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
Vue.component('data-table2', require('./components/datatable2.vue').default);
Vue.component('home-streamer', require('./components/HomePageStreamer.vue').default);
Vue.component('course-search', require('./components/courseSearch.vue').default);
Vue.component('course-streamer', require('./components/ShowCourseStreamer.vue').default);
Vue.component('promo-video', require('./components/CourseProVideo.vue').default);
Vue.component('vid-player', require('./components/Player.vue').default);
Vue.component('contactform', require('./components/contactform.vue').default);

Vue.component('course-content', require('./components/content.vue').default);
Vue.component('section-topic', require('./components/ContentTopic.vue').default);
Vue.component('studyroom-lecture', require('./components/studyroomLecture.vue').default);
Vue.component('steppers', require('./components/Steppers.vue').default);
Vue.component('step', require('./components/step.vue').default);
Vue.component('coporate-registration', require('./components/coporateRegistration.vue').default);
Vue.component('collapse', require('./components/collapse.vue').default);
Vue.component('forum-page', require('./pages/ForumPage.vue').default);
Vue.component('new-thread', require('./components/NewThread.vue').default);
Vue.component('menu-dropdown', require('./components/menuDropDown.vue').default);
Vue.component('menu-dropdown', require('./components/menuDropDown.vue').default);
Vue.component('course-review', require('./components/courseReview.vue').default);
Vue.component('image-carousel', require('./components/carousel.vue').default);
Vue.component('paystack-payment', require('./components/paystack.vue').default);
Vue.component('clients-datatable', require('./pages/Clients.vue').default);
Vue.component('optionsbtn', require('./components/optionsbtn.vue').default);
Vue.component('message', require('./components/message.vue').default);


const app = new Vue({
    el: '#app'
});

