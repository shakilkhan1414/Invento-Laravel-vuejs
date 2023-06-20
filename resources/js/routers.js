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

import addCustomer from './components/customer/create.vue'
import customers from './components/customer/index.vue'
import editCustomer from './components/customer/edit.vue'

import addCategory from './components/category/create.vue'
import categories from './components/category/index.vue'
import editCategory from './components/category/edit.vue'

import addProduct from './components/product/create.vue'
import products from './components/product/index.vue'
import editProduct from './components/product/edit.vue'

import addExpense from './components/expense/create.vue'
import expenses from './components/expense/index.vue'
import editExpense from './components/expense/edit.vue'

import salaryEmployees from './components/salary/employeeList.vue'
import salaries from './components/salary/index.vue'
import paySalary from './components/salary/create.vue'
import editSalary from './components/salary/edit.vue'

import pos from './components/pos/pointofsale.vue'
import orders from './components/order/orders.vue'
import viewOrder from './components/order/view.vue'


const router = createRouter({
  history: createWebHistory("/"),
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
        path: '/customers/create',
        name: 'add-customer',
        component: addCustomer
    },
    {
        path: '/customers',
        name: 'customers',
        component: customers
    },
    {
        path: '/customer/edit/:id',
        name: 'edit-customer',
        component: editCustomer
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
    },
    {
        path: '/expenses/create',
        name: 'add-expense',
        component: addExpense
    },
    {
        path: '/expenses',
        name: 'expenses',
        component: expenses
    },
    {
        path: '/expense/edit/:id',
        name: 'edit-expense',
        component: editExpense
    },
    {
        path: '/salaries',
        name: 'salaries',
        component: salaries
    },
    {
        path: '/salary/employees',
        name: 'salaryEmployees',
        component: salaryEmployees
    },
    {
        path: '/salary/pay/:id',
        name: 'paySalary',
        component: paySalary
    },
    {
        path: '/salary/edit/:id',
        name: 'edit-salary',
        component: editSalary
    },
    {
        path: '/pos',
        name: 'pos',
        component: pos
    },
    {
        path: '/orders',
        name: 'orders',
        component: orders
    },
    {
        path: '/order/view/:id',
        name: 'view-order',
        component: viewOrder
    }
  ]
})

export default router

