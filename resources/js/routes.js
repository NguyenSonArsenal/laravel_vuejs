let __BE_DIR__ = './views/backend/components/';
let __FE_DIR__ = './views/frontend/';
let __BACKEND_URL__ = '/management/';

import VueRouter from "vue-router";

// // ========== BACKEND AREA ==========
const Login = () => import('./views/backend/Login');
const Dashboard = () => import(__BE_DIR__ + 'Dashboard');
const User = () => import(__BE_DIR__ + 'user/list');
const UserAdd = () => import(__BE_DIR__ + 'user/add');
const UserEdit = () => import(__BE_DIR__ + 'user/edit');
const ChildParentComponent = () => import(__BE_DIR__ + 'child_parent_component/Index');
const ComputedComponent = () => import(__BE_DIR__ + 'computed/Demo');


// ========== FRONTEND AREA ==========
const F_HOME = () => import(__FE_DIR__ + 'Home');

const routes = [
  // ========== BACKEND AREA ==========
  {component: Login, name: 'Login', path: __BACKEND_URL__ + 'login'},
  {component: Dashboard, name: 'Dashboard', path: __BACKEND_URL__},
  {component: User, name: 'User', path: __BACKEND_URL__ + 'users'},
  {component: UserAdd, name: 'UserAdd', path: __BACKEND_URL__ + 'users/add'},
  {component: UserEdit, name: 'UserEdit', path: __BACKEND_URL__ + 'users/:id/edit'},
  {component: ChildParentComponent, name: 'test_child_parent_component', path: __BACKEND_URL__ + 'child_parent_component'},
  {component: ComputedComponent, name: 'demo_computed', path: __BACKEND_URL__ + 'computed'},

  // ========== FRONTEND AREA ==========
  {component: F_HOME, name: 'FE_HOME', path:  '/'}
];

export default new VueRouter({ routes, mode: "history" });
