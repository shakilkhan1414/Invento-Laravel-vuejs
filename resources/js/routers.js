import { createRouter, createWebHistory } from 'vue-router'
import login from './components/auth/login.vue'
import register from './components/auth/register.vue'
import forgetPassword from './components/auth/forgetPassword.vue'
import dashboard from './components/dashboard.vue'
import logout from './components/auth/logout.vue'

import addEmployee from './components/employee/create.vue'
import employees from './components/employee/index.vue'
import editEmployee from './components/employee/edit.vue'

import addSupplier from './components/supplier/create.vue'
import suppliers from './components/supplier/index.vue'
import editSupplier from './components/supplier/edit.vue'

import addCategory from './components/category/create.vue'
import categories from './components/category/index.vue'
import editCategory from './components/category/edit.vue'

import addProduct from './components/product/create.vue'
import products from './components/product/index.vue'
import editProduct from './components/product/edit.vue'


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
    },
    {
        path: '/employees/create',
        name: 'add-employee',
        component: addEmployee
    },
    {
        path: '/employees',
        name: 'employees',
        component: employees
    },
    {
        path: '/employee/edit/:id',
        name: 'edit-employee',
        component: editEmployee
    },
    {
        path: '/suppliers/create',
        name: 'add-supplier',
        component: addSupplier
    },
    {
        path: '/suppliers',
        name: 'suppliers',
        component: suppliers
    },
    {
        path: '/supplier/edit/:id',
        name: 'edit-supplier',
        component: editSupplier
    },
    {
        path: '/categories/create',
        name: 'add-category',
        component: addCategory
    },
    {
        path: '/categories',
        name: 'categories',
        component: categories
    },
    {
        path: '/category/edit/:id',
        name: 'edit-category',
        component: editCategory
    },
    {
        path: '/products/create',
        name: 'add-product',
        component: addProduct
    },
    {
        path: '/products',
        name: 'products',
        component: products
    },
    {
        path: '/product/edit/:id',
        name: 'edit-product',
        component: editProduct
    }
  ]
})

export default router

