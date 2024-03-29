import VueRouter from 'vue-router'
// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Task from './pages/task/Tasks'
import TaskAdd from './pages/task/TaskAdd'
import TaskEdit from './pages/task/TaskEdit'
import Dashboard from './pages/user/Dashboard'
import AdminDashboard from './pages/admin/Dashboard'
// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
  // USER ROUTES
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true
    }
  },
  {
    path: '/tasks',
    name: 'task',
    component: Task,
    meta: {
      auth: true
    }
  },
  {
    path: '/task/edit',
    name: 'task.edit',
    component: TaskEdit,
    meta: {
      auth: true
    }
  },
  // ADMIN ROUTES
  {
    path: '/admin',
    name: 'admin.dashboard',
    component: AdminDashboard,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
  {
    path: '/task/add',
    name: 'task.add',
    component: TaskAdd,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'} 
    }
  },
  {
    path: '/user/create',
    name: 'user.create',
    component: Register,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
  {
    path: '/user/edit',
    name: 'user.edit',
    component: Register,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  }
]
const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})
export default router