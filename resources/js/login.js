// ========== Global component ==========
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
// ========== End Global Component ==========

import AppLogin from './views/backend/Login.vue';

const Login = () => import('./views/backend/components/Login');

const routes = [
  {component: Login, name: 'Login', path: '/management/login'},
];

// export default new VueRouter({ routes, mode: "history" });

// Create and mount to root
new Vue(Vue.util.extend({routes}, AppLogin)).$mount('#app');
