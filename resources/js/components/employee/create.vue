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
                <router-link class="btn btn-primary" to="/employees">All Employees</router-link>
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add Employee</h1>
                        </div>
                        <form class="user" @submit.prevent='insertEmployee' enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter Name" v-model="formData.name">
                                        <small class="text-danger" v-if="errors.name">{{errors.name}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" placeholder="Enter Email" v-model="formData.email">
                                        <small class="text-danger" v-if="errors.email">{{errors.email}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter Address" v-model="formData.address">
                                        <small class="text-danger" v-if="errors.address">{{errors.address}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter NID" v-model="formData.nid">
                                        <small class="text-danger" v-if="errors.nid">{{errors.nid}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter Phone" v-model="formData.phone">
                                        <small class="text-danger" v-if="errors.phone">{{errors.phone}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter Salary" v-model="formData.salary">
                                        <small class="text-danger" v-if="errors.salary">{{errors.salary}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="joining_date">Joining Date</label>
                                        <input type="date" class="form-control" placeholder="Enter Joining Date" v-model="formData.joining_date" id="joining_date">
                                        <small class="text-danger" v-if="errors.joining_date">{{errors.joining_date}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="customFile">Employee Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <small class="text-danger" v-if="errors.image">{{errors.image}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
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
