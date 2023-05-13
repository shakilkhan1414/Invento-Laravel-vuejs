import { createRouter, createWebHistory } from 'vue-router'
import login from './components/auth/login.vue'
import register from './components/auth/register.vue'
import forgetPassword from './components/auth/forgetPassword.vue'
import dashboard from './components/dashboard.vue'
import logout from './components/auth/logout.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: login
    },
    {
        path: '/register',
        name: 'register',
        component: register
    },
    {
        path: '/forget-password',
        name: 'forget-password',
        component: forgetPassword
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: dashboard
    },
    {
        path: '/logout',
        name: 'logout',
        component: logout
    }
  ]
})

export default router

