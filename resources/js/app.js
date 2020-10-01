import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueAxios, axios);

import App from './components/App.vue';
import Student from './components/student/Student.vue';
import StudentAdd from './components/student/StudentAdd.vue';

const routes = [
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
];

const router = new VueRouter({
    mode: 'history',
    routes: routes // short for `routes: routes`
});

// Tạo và mount đối tượng root.
new Vue(Vue.util.extend({router}, App)).$mount('#app');

// Tạo xong app!