let __DIR__ = './components/views/';

import VueRouter from "vue-router";

const Dashboard = () => import(__DIR__ + 'Dashboard');
const User = () => import(__DIR__ + 'user/UserList');
const UserAdd = () => import(__DIR__ + 'user/UserAdd');
const ChildParentComponent = () => import(__DIR__ + 'child_parent_component/Index');
const ComputedComponent = () => import(__DIR__ + 'computed/Demo');

const routes = [
    {component: Dashboard, name: 'Dashboard', path: '/'},
    {component: User, name: 'User', path: '/users'},
    {component: UserAdd, name: 'UserAdd', path: '/users/add'},
    {component: ChildParentComponent, name: 'test_child_parent_component', path: '/child_parent_component'},
    {component: ComputedComponent, name: 'demo_computed', path: '/computed'}
];

export default new VueRouter({ routes, mode: "history" });
