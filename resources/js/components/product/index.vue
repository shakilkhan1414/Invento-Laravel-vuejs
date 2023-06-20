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
    allProduct()
});


const products=reactive([])
const filterSearch=reactive([])

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

watch(() => products.value, (currentValue, oldValue) => {
    filterSearch.value = currentValue;
});

watch(searchTerm, (currentValue, oldValue) => {
    filterSearch.value = products.value.filter(product=>{
        return product.product_name.toLowerCase().match(currentValue.toLowerCase()) || product.product_code.match(currentValue)
    })
});

const deleteProduct=(id)=>{
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
            axios.delete('/api/product/'+id)
            .then(()=>{
                products.value=products.value.filter(product=>{
                    return product.id != id
                })
            })
            .catch(()=>{
                router.push({name: 'products'})
            })

            Swal.fire(
            'Deleted!',
            'Product has been deleted.',
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
            <router-link class="btn btn-primary" to="/products/create">Add Product</router-link>
            <input type="text" v-model="searchTerm" class="form-control mb-1 mt-3" style="width: 400px;" placeholder="Search here">
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
                                    <th>Product Code</th>
                                    <th>Category</th>
                                    <th>Supplier</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <th>Root</th>
                                    <th>Buying Date</th>
                                    <th>Quantity</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(product,index) in filterSearch.value" :key="product.id">
                                    <td>{{index+1}}</td>
                                    <td>{{product.product_name}}</td>
                                    <td>{{product.product_code}}</td>
                                    <td>{{product.category.category_name}}</td>
                                    <td>{{product.supplier.name}}</td>
                                    <td>{{product.buying_price}} $</td>
                                    <td>{{product.selling_price}} $</td>
                                    <td>{{product.root}}</td>
                                    <td>{{product.buying_date}}</td>
                                    <td>{{product.product_quantity}}</td>
                                    <td><img :src="'/'+product.image" class="employee-image"></td>
                                    <td>
                                        <router-link :to="{name: 'edit-product',params: {id:product.id}}" class="btn btn-primary btn-sm mx-1 mb-1">Edit</router-link>
                                        <button @click="deleteProduct(product.id)" class="btn btn-danger btn-sm mb-1">Delete</button>
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
