<script setup>

import {ref,reactive,onBeforeMount } from 'vue'
import { useRouter} from 'vue-router'

const router = useRouter()

onBeforeMount(() => {
    if(User.loggedIn()){
        router.push({name: 'dashboard'})
    }

});

const formData=reactive({
    email: '',
    password: ''
})

let errors=reactive({
    email: '',
    password: ''
})

const login= ()=>{
    axios.post('/api/auth/login',formData)
    .then(res => {
        User.responseAfterLogin(res)
        Toast.fire({
        icon: 'success',
        title: 'Logged in successfully!'
        })
        router.push({name: 'dashboard'})
    })
    .catch(error=> {
        if(error.response.status === 401){
            Toast.fire({
            icon: 'warning',
            title: 'Invalid Email or Password!'
            })
        }
        else if(error.response.status === 422){
            errors.email = error.response.data.errors.email ? error.response.data.errors.email[0] : ''
            errors.password = error.response.data.errors.password ? error.response.data.errors.password[0] : ''
        }
        }
    )

}


</script>

<template>
    <div>
        <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card shadow-sm my-5">
            <div class="card-body p-0">
                <div class="row">
                <div class="col-lg-12">
                    <div class="login-form">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                    </div>
                    <form class="user" @submit.prevent="login">
                        <div class="form-group">
                        <input type="email" class="form-control" aria-describedby="emailHelp"
                            placeholder="Enter Email Address" v-model="formData.email">
                            <small class="text-danger" v-if="errors.email">{{errors.email}}</small>
                        </div>
                        <div class="form-group">
                        <input type="password" class="form-control"  v-model="formData.password" placeholder="Enter Password">
                        <small class="text-danger" v-if="errors.password">{{errors.password}}</small>
                        </div>
                        <div class="form-group">
                        <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                            <input type="checkbox" class="custom-control-input" id="customCheck">
                            <label class="custom-control-label" for="customCheck">Remember
                            Me</label>
                        </div>
                        </div>
                        <div class="form-group">
                        <button class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <router-link to="/register" class="font-weight-bold small">Create an Account!</router-link>
                    </div>
                    <div class="text-center">
                        <router-link to="/forget-password" class="font-weight-bold small">Forget Password?</router-link>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

</template>

<style>

</style>
