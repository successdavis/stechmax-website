        
window._ = require('lodash'); window.Popper = require('popper.js').default;
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie. */


window.Vue = require('vue');

let authorizations = require('./authorizations');

window.Vue.prototype.authorize = function (...params) {
    if (! window.App.signedIn) return false;

    if (typeof params[0] === 'string') {
        return authorizations[params[0]](params[1]);
    }

    return params[0](window.App.user);
};



Vue.prototype.signedIn = window.App.signedIn;

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import PortalVue from 'portal-vue';
import Form from './utilities/Form';
import VModal from 'vue-js-modal';

window.Form = Form;

Vue.use(PortalVue);
Vue.use(VModal);



/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
};

window.axios.defaults.headers.common = {
    // 'X-CSRF-TOKEN': window.App.crsfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', {message, level});
};
