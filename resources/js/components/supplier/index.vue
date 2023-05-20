<script setup>

import {ref,reactive,onBeforeMount,computed } from 'vue'
import { useRouter} from 'vue-router'

const router = useRouter()
let searchTerm=ref('')

onBeforeMount(() => {
    if(!User.loggedIn()){
        router.push({name: 'login'})
    }
    allSupplier()
});


const suppliers=reactive([])

const allSupplier= ()=>{
    axios.get('/api/supplier')
    .then(res => {
        suppliers.value=res.data
    })
    .catch(error=> {
            console.log(error)
        }
    )

}

const filterSearch=computed(()=>{
    return suppliers.value.filter(suppliers=>{
        return suppliers.name.toLowerCase().match(searchTerm.value.toLowerCase()) || suppliers.phone.match(searchTerm.value)
    })
})

const deleteSupplier=(id)=>{
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
            axios.delete('/api/supplier/'+id)
            .then(()=>{
                suppliers.value=suppliers.value.filter(suppliers=>{
                    return suppliers.id != id
                })
            })
            .catch(()=>{
                router.push({name: 'suppliers'})
            })

            Swal.fire(
            'Deleted!',
            'Supplier has been deleted.',
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
            <router-link class="btn btn-primary" to="/add-supplier">Add Supplier</router-link>
            <input type="text" v-model="searchTerm" class="form-control mb-1 mt-3" style="width: 400px;" placeholder="Search here">
                <div class="card shadow-sm my-4">
                        <div class="row">
                        <div class="col-lg-12 mb-4">
                        <!-- Simple Tables -->
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Supplier List</h6>
                            </div>
                            <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Shop Name</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(supplier,index) in filterSearch" :key="supplier.id">
                                    <td>{{index+1}}</td>
                                    <td>{{supplier.name}}</td>
                                    <td>{{supplier.email}}</td>
                                    <td>{{supplier.phone}}</td>
                                    <td>{{supplier.shop_name}}</td>
                                    <td><img :src="supplier.image" class="employee-image"></td>
                                    <td>
                                        <router-link :to="{name: 'edit-supplier',params: {id:supplier.id}}" class="btn btn-primary btn-sm mx-1 mb-1">Edit</router-link>
                                        <button @click="deleteSupplier(supplier.id)" class="btn btn-danger btn-sm mb-1">Delete</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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
