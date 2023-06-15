<script setup>

import {ref,reactive,onBeforeMount,computed } from 'vue'
import { useRouter} from 'vue-router'

const router = useRouter()
let searchTerm=ref('')

onBeforeMount(() => {
    if(!User.loggedIn()){
        router.push({name: 'login'})
    }
    allCategory()
});


const categories=reactive([])

const allCategory= ()=>{
    axios.get('/api/category')
    .then(res => {
        categories.value=res.data
    })
    .catch(error=> {
            console.log(error)
        }
    )

}

const filterSearch=computed(()=>{
    return categories.value.filter(category=>{
        return category.category_name.toLowerCase().match(searchTerm.value.toLowerCase())
    })
})

const deleteCategory=(id)=>{
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
            axios.delete('/api/category/'+id)
            .then(()=>{
                categories.value=categories.value.filter(category=>{
                    return category.id != id
                })
            })
            .catch(()=>{
                router.push({name: 'categories'})
            })

            Swal.fire(
            'Deleted!',
            'Category has been deleted.',
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
            <router-link class="btn btn-primary" to="/categories/create">Add Category</router-link>
            <input type="text" v-model="searchTerm" class="form-control mb-1 mt-3" style="width: 400px;" placeholder="Search here">
                <div class="card shadow-sm my-4">
                        <div class="row">
                        <div class="col-lg-12 mb-4">
                        <!-- Simple Tables -->
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                            </div>
                            <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(category,index) in filterSearch" :key="category.id">
                                    <td>{{index+1}}</td>
                                    <td>{{category.category_name}}</td>
                                    <td>
                                        <router-link :to="{name: 'edit-category',params: {id:category.id}}" class="btn btn-primary btn-sm mx-1 mb-1">Edit</router-link>
                                        <button @click="deleteCategory(category.id)" class="btn btn-danger btn-sm mb-1">Delete</button>
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
