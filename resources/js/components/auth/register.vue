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
    name:'',
    email: '',
    password: '',
    password_confirmation: ''
})

let errors=reactive({
    name:'',
    email: '',
    password: ''
})

const signup= ()=>{
    axios.post('/api/auth/signup',formData)
    .then(res => {
        User.responseAfterLogin(res)
        Toast.fire({
        icon: 'success',
        title: 'Signed in successfully!'
        })
        router.push({name: 'dashboard'})
    })
    .catch(error=> {
        if(error.response.status === 422){
            errors.name = error.response.data.errors.name ? error.response.data.errors.name[0] : ''
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
                            <h1 class="h4 text-gray-900 mb-4">Register</h1>
                        </div>
                        <form class="user" @submit.prevent='signup'>
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Full Name" v-model="formData.name">
                            <small class="text-danger" v-if="errors.name">{{errors.name}}</small>
                            </div>
                            <div class="form-group">
                            <input type="email" class="form-control" aria-describedby="emailHelp"
                                placeholder="Enter Email Address" v-model="formData.email">
                            <small class="text-danger" v-if="errors.email">{{errors.email}}</small>
                            </div>
                            <div class="form-group">
                            <input type="password" class="form-control" placeholder="Enter Password" v-model="formData.password">
                            <small class="text-danger" v-if="errors.password">{{errors.password}}</small>
                            </div>
                            <div class="form-group">
                            <input type="password" class="form-control"
                                placeholder="Confirm Password" v-model="formData.password_confirmation">
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <router-link to="/" class="font-weight-bold small">Already have an account?</router-link>
                        </div>
                        <div class="text-center">
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
