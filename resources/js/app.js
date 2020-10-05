import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueAxios, axios);

import App from './components/App.vue';
import Dashboard from './components/Dashboard.vue';
import Student from './components/student/Student.vue';
import StudentAdd from './components/student/StudentAdd.vue';
import ChildParentComponent from './components/child_parent_component/Index.vue';
import ComputedComponent from './components/computed/Demo.vue';

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