<script setup>

import {ref,reactive,onBeforeMount,watch } from 'vue'
import { useRouter} from 'vue-router'
import ClipLoader from 'vue-spinner/src/ClipLoader.vue'

const router = useRouter()
let searchTerm=ref('')

onBeforeMount(() => {
    if(!User.loggedIn()){
        router.push({name: 'login'})
    }
    allEmployee()
});


const employees=reactive([])
const filterSearch=reactive([])

const allEmployee= ()=>{
    axios.get('/api/employee')
    .then(res => {
        employees.value=res.data
    })
    .catch(error=> {
            console.log(error)
        }
    )
}

watch(() => employees.value, (currentValue, oldValue) => {
    filterSearch.value = currentValue;
});

watch(searchTerm, (currentValue, oldValue) => {
    filterSearch.value = employees.value.filter(employee=>{
        return employee.name.toLowerCase().match(currentValue.toLowerCase()) || employee.phone.match(currentValue)
    })
});

</script>


<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
            <router-link class="btn btn-primary" to="/salaries">All Salaries</router-link>
            <input type="text" v-model="searchTerm" class="form-control mb-1 mt-3" style="width: 400px;" placeholder="Search here">
                <div class="card shadow-sm my-4">
                        <div class="row">
                        <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                            </div>
                            <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>NID</th>
                                    <th>Phone</th>
                                    <th>Salary</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(employee,index) in filterSearch.value" :key="employee.id">
                                    <td>{{index+1}}</td>
                                    <td>{{employee.name}}</td>
                                    <td>{{employee.email}}</td>
                                    <td>{{employee.nid}}</td>
                                    <td>{{employee.phone}}</td>
                                    <td>{{employee.salary}} $</td>
                                    <td><img v-if="employee.image" :src="'/'+employee.image" class="employee-image"></td>
                                    <td>
                                        <router-link :to="{name: 'paySalary',params: {id:employee.id}}" class="btn btn-primary btn-sm mx-1 mb-1">Pay Salary</router-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div v-if="!filterSearch.value" class="loading">
                                <ClipLoader color="#3742fa"/>
                            </div>

                            </div>

                            <div class="card-footer"></div>
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
