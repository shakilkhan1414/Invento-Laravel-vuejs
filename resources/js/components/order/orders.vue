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
    allOrder()
});


const orders=reactive([])
const filterSearch=reactive([])

const allOrder= ()=>{
    axios.get('/api/orders')
    .then(res => {
        orders.value=res.data
    })
    .catch(error=> {
            console.log(error)
        }
    )

}

watch(() => orders.value, (currentValue, oldValue) => {
    filterSearch.value = currentValue;
});

watch(searchTerm, (currentValue, oldValue) => {
    filterSearch.value = orders.value.filter(order=>{
        return order.customer.name.toLowerCase().match(currentValue.toLowerCase()) || order.order_date.toLowerCase().match(currentValue.toLowerCase())
    })
});

</script>


<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
            <input type="text" v-model="searchTerm" class="form-control mb-1 mt-3" style="width: 400px;" placeholder="Search here">
                <div class="card shadow-sm my-4">
                        <div class="row">
                        <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
                            </div>
                            <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Total Amout</th>
                                    <th>Pay</th>
                                    <th>Due</th>
                                    <th>Pay By</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(order,index) in filterSearch.value" :key="order.id">
                                    <td>{{index+1}}</td>
                                    <td>{{order.customer.name}}</td>
                                    <td>{{order.total}}</td>
                                    <td>{{order.pay}}</td>
                                    <td>{{order.due}}</td>
                                    <td>{{order.payby}}</td>
                                    <td>{{order.order_date}}</td>
                                    <td>
                                        <router-link :to="{name: 'view-order',params: {id:order.id}}" class="btn btn-primary btn-sm mx-1 mb-1">View</router-link>
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
