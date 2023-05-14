<script setup>

import {ref,reactive,onBeforeMount } from 'vue'
import { useRouter} from 'vue-router'

const router = useRouter()

onBeforeMount(() => {
    if(!User.loggedIn()){
        router.push({name: 'login'})
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
            <div class="col-xl-12 col-lg-12 col-md-12">
            <router-link class="btn btn-primary" to="/add-employee">Add Employee</router-link>
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Employees</h1>
                            <hr>
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
