// ========== Global component ==========
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import LoadingComponent from './components/core/Loading'

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.component('MyPagination', require('laravel-vue-pagination'));
Vue.component('LoadingComponent', LoadingComponent);
// ========== End Global Component ==========

import App from './components/views/App.vue';
import Dashboard from './components/views/Dashboard.vue';
import Student from './components/views/student/Student.vue';
import StudentAdd from './components/views/student/StudentAdd.vue';
import ChildParentComponent from './components/views/child_parent_component/Index.vue';
import ComputedComponent from './components/views/computed/Demo.vue';
import User from './components/views/user/UserList.vue';
import UserAdd from './components/views/user/UserAdd.vue';


const routes = [
    {component: Dashboard, name: 'Dashboard', path: '/'},
    {component: Student, name: 'Student', path: '/students'},
    {component: StudentAdd, name: 'StudentAdd', path: '/students/add'},
    {component: StudentAdd, name: 'StudentStore', path: '/students'},
    {component: User, name: 'User', path: '/users'},
    {component: UserAdd, name: 'UserAdd', path: '/users/add'},
    {component: ChildParentComponent, name: 'test_child_parent_component', path: '/child_parent_component'},
    {component: ComputedComponent, name: 'demo_computed', path: '/computed'}
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

// Create and mount to root
new Vue(Vue.util.extend({router}, App)).$mount('#app');
