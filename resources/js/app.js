// ========== Global component ==========
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import LoadingComponent from './components/core/Loading'

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.component('LoadingComponent', LoadingComponent);
Vue.component('MyPagination', require('laravel-vue-pagination'));
// ========== End Global component ==========

import App from './components/views/App.vue';
import Dashboard from './components/views/Dashboard.vue';
import Student from './components/views/student/Student.vue';
import StudentAdd from './components/views/student/StudentAdd.vue';
import ChildParentComponent from './components/views/child_parent_component/Index.vue';
import ComputedComponent from './components/views/computed/Demo.vue';


const routes = [
    {
        path: '/',
        name: 'Dashboard',
        component: Dashboard
    },
    {
        path: '/students',
        name: 'Student',
        component: Student
    },
    {
        path: '/students/add',
        name: 'StudentAdd',
        component: StudentAdd
    },
    {
        path: '/students',
        name: 'StudentStore',
        component: StudentAdd
    },
    {
        path: '/child_parent_component',
        name: 'test_child_parent_component',
        component: ChildParentComponent
    },
    {
        path: '/computed',
        name: 'demo_computed',
        component: ComputedComponent
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

// Create and mount to root
new Vue(Vue.util.extend({router}, App)).$mount('#app');
