// ========== Global component ==========
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
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
