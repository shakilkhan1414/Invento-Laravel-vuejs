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
    details:'',
    amount:'',
    date:''
})

let errors=reactive({
    details:'',
    amount:'',
    date:''
})

const insertExpense= ()=>{
    axios.post('/api/expense',formData)
    .then(() => {
        router.push({name: 'expenses'})
        Notification.success()
    })
    .catch(error=> {
        if(error.response.status === 422){
            errors.details = error.response.data.errors.details ? error.response.data.errors.details[0] : ''
            errors.amount = error.response.data.errors.amount ? error.response.data.errors.amount[0] : ''
            errors.date = error.response.data.errors.date ? error.response.data.errors.date[0] : ''
        }

        }
    )

}


</script>


<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <router-link class="btn btn-primary" to="/expenses">All Expenses</router-link>
                <div class="card shadow-sm my-4">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add Expense</h1>
                        </div>
                        <form class="user" @submit.prevent='insertExpense' enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label>Expense Details</label>
                                        <textarea class="form-control" rows="4" placeholder="Enter Expense Details" v-model="formData.details"></textarea>
                                        <small class="text-danger" v-if="errors.details">{{errors.details}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label>Expense Amount</label>
                                        <input type="text" class="form-control" placeholder="Enter Expense Amount" v-model="formData.amount">
                                        <small class="text-danger" v-if="errors.amount">{{errors.amount}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label>Expense Date</label>
                                        <input type="date" class="form-control" placeholder="Enter Category Name" v-model="formData.date">
                                        <small class="text-danger" v-if="errors.date">{{errors.date}}</small>
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
