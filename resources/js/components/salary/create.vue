<script setup>
import {ref,reactive,onBeforeMount } from 'vue'
import { useRouter, useRoute} from 'vue-router'

const router = useRouter()
const route=useRoute()

onBeforeMount(() => {
    if(!User.loggedIn()){
        router.push({name: 'login'})
    }
    employeeData()
});

let formData=reactive({
    name:'',
    email: '',
    amount:'',
    salary_month:''
})

let errors=reactive({
    amount:'',
    salary_month:''
})


const employeeData=()=>{
    let id=route.params.id
    axios.get('/api/employee/'+id)
    .then(res=>{
        formData.name=res.data.name
        formData.email=res.data.email
        formData.amount=res.data.salary
    })
    .catch(error=>{
        console.log(error)
    })
}

const paySalary= ()=>{
    let id=route.params.id
    axios.post('/api/salary/pay/'+id,formData)
    .then(() => {
        router.push({name: 'salaries'})
        Notification.success()
    })
    .catch(error=> {
        if(error.response.status === 422){
            errors.amount = error.response.data.errors.amount ? error.response.data.errors.amount[0] : ''
            errors.salary_month = error.response.data.errors.salary_month ? error.response.data.errors.salary_month[0] : ''
        }

        }
    )

}


</script>


<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <router-link class="btn btn-primary" to="/salaries">All Salaries</router-link>
                <div class="card shadow-sm my-4">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Pay Salary</h1>
                        </div>
                        <form class="user" @submit.prevent='paySalary' enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Employee Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" v-model="formData.name" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Employee Email</label>
                                        <input type="email" class="form-control" placeholder="Enter Email" v-model="formData.email" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Month</label>
                                        <select class="form-control" v-model="formData.salary_month">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.salary_month">{{errors.salary_month}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Salary</label>
                                        <input type="text" class="form-control" placeholder="Enter Salary" v-model="formData.amount">
                                        <small class="text-danger" v-if="errors.amount">{{errors.amount}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Pay Salary</button>
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
