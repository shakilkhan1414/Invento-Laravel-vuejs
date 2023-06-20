<script setup>

import {ref,reactive,onBeforeMount } from 'vue'
import { useRouter} from 'vue-router'

const router = useRouter()

onBeforeMount(() => {
    if(User.loggedIn()){
        router.push({name: 'dashboard'})
    }

});

const forgotPassword= ()=>{


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
                        <h1 class="h4 text-gray-900 mb-4">Forget Password</h1>
                    </div>
                    <form class="user"  @submit.prevent="forgotPassword">
                        <div class="form-group">
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                            placeholder="Enter Existing Email Address">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Forget Password</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <router-link to="/" class="font-weight-bold small">Back to Login!</router-link>
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

