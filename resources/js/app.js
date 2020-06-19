require('./bootstrap');
window.Vue = require('vue');

Vue.component('email-submit-form', require('./components/EmailSubmitForm.vue').default);
const app = new Vue({
    el: '#app',



});
