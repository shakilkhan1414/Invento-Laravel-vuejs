<script setup>
import {ref,reactive,onBeforeMount } from 'vue'
import { useRouter} from 'vue-router'

const router = useRouter()

onBeforeMount(() => {
    if(!User.loggedIn()){
        router.push({name: 'login'})
    }

});

let formData=reactive({
    category_name:''
})

let errors=reactive({
    category_name:''
})

const insertCategory= ()=>{
    axios.post('/api/category',formData)
    .then(() => {
        router.push({name: 'categories'})
        Notification.success()
    })
    .catch(error=> {
        if(error.response.status === 422){
            errors.category_name = error.response.data.errors.category_name ? error.response.data.errors.category_name[0] : ''
        }

        }
    )

}


</script>


<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <router-link class="btn btn-primary" to="/categories">All Categories</router-link>
                <div class="card shadow-sm my-4">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add Category</h1>
                        </div>
                        <form class="user" @submit.prevent='insertCategory' enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" placeholder="Enter Category Name" v-model="formData.category_name">
                                        <small class="text-danger" v-if="errors.category_name">{{errors.category_name}}</small>
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
