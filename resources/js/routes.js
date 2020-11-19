let __DIR__ = './views/backend/components/';
let __BACKEND_URL__ = '/management/';

import VueRouter from "vue-router";

const Login = () => import('./views/backend/Login');
const Dashboard = () => import(__DIR__ + 'Dashboard');
const User = () => import(__DIR__ + 'user/list');
const UserAdd = () => import(__DIR__ + 'user/add');
const UserEdit = () => import(__DIR__ + 'user/edit');
const ChildParentComponent = () => import(__DIR__ + 'child_parent_component/Index');
const ComputedComponent = () => import(__DIR__ + 'computed/Demo');

const routes = [
  {component: Login, name: 'Login', path: __BACKEND_URL__ + 'login'},
  {component: Dashboard, name: 'Dashboard', path: __BACKEND_URL__},
  {component: User, name: 'User', path: __BACKEND_URL__ + 'users'},
  {component: UserAdd, name: 'UserAdd', path: __BACKEND_URL__ + 'users/add'},
  {component: UserEdit, name: 'UserEdit', path: __BACKEND_URL__ + 'users/:id/edit'},
  {component: ChildParentComponent, name: 'test_child_parent_component', path: __BACKEND_URL__ + 'child_parent_component'},
  {component: ComputedComponent, name: 'demo_computed', path: __BACKEND_URL__ + 'computed'}
];

export default new VueRouter({ routes, mode: "history" });
