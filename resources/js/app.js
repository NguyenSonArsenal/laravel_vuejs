// ========== Global component ==========
import Vue from 'vue'; // For storing data gotten from our API
import VueRouter from 'vue-router'; // For navigation and protection of Routes
import VueAxios from 'vue-axios'; // For sending and retrieving data from our API
import axios from 'axios';
import VModal from 'vue-js-modal'

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VModal, { componentName: 'VModal' })
Vue.component('MyPagination', require('laravel-vue-pagination'));
// ========== End Global Component ==========

import App from './views/App.vue';
import router from './routes.js'

// Create and mount to root
new Vue(Vue.util.extend({router}, App)).$mount('#app');
