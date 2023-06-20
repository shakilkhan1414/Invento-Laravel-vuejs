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
    allSalary()
});


const salaries=reactive([])
const filterSearch=reactive([])

const allSalary= ()=>{
    axios.get('/api/salary')
    .then(res => {
        salaries.value=res.data
    })
    .catch(error=> {
            console.log(error)
        }
    )

}

watch(() => salaries.value, (currentValue, oldValue) => {
    filterSearch.value = currentValue;
});

watch(searchTerm, (currentValue, oldValue) => {
    filterSearch.value = salaries.value.filter(salary=>{
        return salary.employee.name.toLowerCase().match(currentValue.toLowerCase()) || salary.salary_month.toLowerCase().match(currentValue.toLowerCase()) || salary.salary_year.toLowerCase().match(currentValue.toLowerCase())
    })
});

const deleteSalary=(id)=>{
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            axios.delete('/api/salary/'+id)
            .then(()=>{
                salaries.value=salaries.value.filter(salary=>{
                    return salary.id != id
                })
            })
            .catch(()=>{
                router.push({name: 'salaries'})
            })

            Swal.fire(
            'Deleted!',
            'Salary has been deleted.',
            'success'
            )
        }
    })

}

</script>


<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
            <router-link class="btn btn-primary" to="/salary/employees">Pay Salary</router-link>
            <input type="text" v-model="searchTerm" class="form-control mb-1 mt-3" style="width: 400px;" placeholder="Search here">
                <div class="card shadow-sm my-4">
                        <div class="row">
                        <div class="col-lg-12 mb-4">
                        <!-- Simple Tables -->
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Salary List</h6>
                            </div>
                            <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(salary,index) in filterSearch.value" :key="salary.id">
                                    <td>{{index+1}}</td>
                                    <td>{{salary.employee.name}}</td>
                                    <td>{{salary.salary_month}}</td>
                                    <td>{{salary.salary_year}}</td>
                                    <td>{{salary.amount}} $</td>
                                    <td>{{salary.salary_date}}</td>
                                    <td>
                                        <router-link :to="{name: 'edit-salary',params: {id:salary.id}}" class="btn btn-primary btn-sm mx-1 mb-1">Edit</router-link>
                                        <button @click="deleteSalary(salary.id)" class="btn btn-danger btn-sm mb-1">Delete</button>
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
