
<script setup>

import {ref,reactive,onBeforeMount } from 'vue'
import { useRouter} from 'vue-router'
import ClipLoader from 'vue-spinner/src/ClipLoader.vue'

const router = useRouter()

onBeforeMount(() => {
    if(!User.loggedIn()){
        router.push({name: 'login'})
    }
    getStatData()
    allProduct()

});

let isLoading=ref(false)

const products=reactive([])

let statData=reactive({
    earning:'',
    sell_amount: '',
    total_user: '',
    expense_amount: ''
})

const getStatData= ()=>{
    isLoading.value=true
    axios.get('/api/statistics')
    .then(res => {
        statData.earning=res.data.earning
        statData.sell_amount=res.data.sell_amount
        statData.total_user=res.data.total_user
        statData.expense_amount=res.data.expense_amount
        isLoading.value=false
    })
    .catch(error=> {
            console.log(error)
        }
    )
}

const allProduct= ()=>{
    axios.get('/api/product')
    .then(res => {
        products.value=res.data
    })
    .catch(error=> {
            console.log(error)
        }
    )
}

</script>


<template>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><router-link to="/dashboard">Home</router-link></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
    </div>

    <div v-if="isLoading" class="loading">
        <ClipLoader color="#3742fa"/>
    </div>

    <div v-if="!isLoading">

    <div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
        <div class="card-body">
            <div class="row align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ statData.earning }}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                <span>Since last month</span>
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-primary"></i>
            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Sale Amount</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ statData.sell_amount }}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                <span>Since last years</span>
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-shopping-cart fa-2x text-success"></i>
            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Customer</div>
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ statData.total_user }}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                <span>Since last month</span>
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-users fa-2x text-info"></i>
            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Expense</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ statData.expense_amount }}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                <span>Since yesterday</span>
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-comments fa-2x text-warning"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    </div>

    <div class="card shadow-sm my-4">
        <div class="row">
        <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
            </div>
            <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Buying Price</th>
                    <th>Image</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(product,index) in products.value" :key="product.id">
                    <td>{{index+1}}</td>
                    <td>{{product.product_name}}</td>
                    <td>{{product.category.category_name}}</td>
                    <td>{{product.supplier.name}}</td>
                    <td>{{product.buying_price}} $</td>
                    <td><img :src="'/'+product.image" class="employee-image"></td>
                    <td>
                        <span class="badge badge-success" v-if="product.product_quantity  >= 1 ">Available</span>
                        <span class="badge badge-danger" v-else>Stock Out </span>
                    </td>

                </tr>
                </tbody>
            </table>
            <div v-if="!products.value" class="loading">
                <ClipLoader color="#3742fa"/>
            </div>

            </div>

            <div class="card-footer"></div>
        </div>
        </div>
    </div>
</div>

</div>
    <!--Row-->

</template>
