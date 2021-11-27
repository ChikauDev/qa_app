require('./bootstrap');
require('./fontawesome');

window.Vue = require('vue').default;

import Vue from 'vue';
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.css';
import Authorization from './authorization/authorize'

Vue.use(VueIziToast);
Vue.use(Authorization);

Vue.component('user-info', require('./components/UserInfo.vue').default);
// Vue.component('answers', require('./components/Answers.vue').default);
Vue.component('favorite', require('./components/Favorite.vue').default);
Vue.component('accept', require('./components/Accept.vue').default);
Vue.component('vote', require('./components/Vote.vue').default);
Vue.component('question-page', require('./pages/QuestionPage.vue').default);

const app = new Vue({
    el: '#app',
});
