import { createRouter, createWebHistory } from 'vue-router'
import login from './components/auth/login.vue'
import register from './components/auth/register.vue'
import forgetPassword from './components/auth/forgetPassword.vue'

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
        path: '/forgetPassword',
        name: 'forgetPassword',
        component: forgetPassword
    }
  ]
})

export default router

