import { createRouter, createWebHistory } from 'vue-router'
import login from './components/login.vue'
import register from './components/register.vue'
import forgetPassword from './components/forgetPassword.vue'

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

