<script setup>
import {ref,reactive,onBeforeMount } from 'vue'
import { useRouter, useRoute} from 'vue-router'

const router = useRouter()
const route=useRoute()

onBeforeMount(() => {
    if(!User.loggedIn()){
        router.push({name: 'login'})
    }
    getTermData()
    ProductData()

});

let formData=reactive({
    product_name:'',
    product_code: '',
    root: '',
    buying_price: '',
    selling_price:'',
    category_id:'',
    supplier_id:'',
    buying_date:'',
    image:'',
    product_quantity:'',
    newImage:''
})

let errors=reactive({
    product_name:'',
    product_code: '',
    root: '',
    buying_price: '',
    selling_price:'',
    category_id:'',
    supplier_id:'',
    buying_date:'',
    image:'',
    product_quantity:''
})

let categories=reactive([])
let suppliers=reactive([])


const ProductData=()=>{
    let id=route.params.id
    axios.get('/api/product/'+id)
    .then(res=>{
        formData.product_name=res.data.product_name
        formData.product_code=res.data.product_code
        formData.root=res.data.root
        formData.buying_price=res.data.buying_price
        formData.selling_price=res.data.selling_price
        formData.category_id=res.data.category_id
        formData.supplier_id=res.data.supplier_id
        formData.buying_date=res.data.buying_date
        formData.product_quantity=res.data.product_quantity
        if (!res.data.image) {
            formData.image=res.data.image
        }
        else{
            formData.image="/"+res.data.image
        }

    })
    .catch(error=>{
        console.log(error)
    })
}

const getTermData=()=>{
    axios.get('/api/category')
    .then(res => {
        categories.value=res.data
    })

    axios.get('/api/supplier')
    .then(res => {
        suppliers.value=res.data
    })
}

const updateProduct= ()=>{
    let id=route.params.id
    axios.patch('/api/product/'+id,formData)
    .then(() => {
        router.push({name: 'products'})
        Notification.success()
    })
    .catch(error=> {
        if(error.response.status === 422){
            errors.product_name = error.response.data.errors.product_name ? error.response.data.errors.product_name[0] : ''
            errors.product_code = error.response.data.errors.product_code ? error.response.data.errors.product_code[0] : ''
            errors.root = error.response.data.errors.root ? error.response.data.errors.root[0] : ''
            errors.buying_price = error.response.data.errors.buying_price ? error.response.data.errors.buying_price[0] : ''
            errors.selling_price = error.response.data.errors.selling_price ? error.response.data.errors.selling_price[0] : ''
            errors.category_id = error.response.data.errors.category_id ? error.response.data.errors.category_id[0] : ''
            errors.supplier_id = error.response.data.errors.supplier_id ? error.response.data.errors.supplier_id[0] : ''
            errors.buying_date = error.response.data.errors.buying_date ? error.response.data.errors.buying_date[0] : ''
            errors.image = error.response.data.errors.image ? error.response.data.errors.image[0] : ''
            errors.product_quantity = error.response.data.errors.product_quantity ? error.response.data.errors.product_quantity[0] : ''
        }

        }
    )

}

const imageUpload=(event)=>{
    let file=event.target.files[0]
    if(file.size > 1048770){
        Notification.image_validation()
    }
    else{
        let reader=new FileReader()
        reader.onload= event=>{
            formData.newImage=event.target.result
            formData.image=formData.newImage
        }
        reader.readAsDataURL(file)

    }

}


</script>


<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <router-link class="btn btn-primary" to="/products">All Product</router-link>
                <div class="card shadow-sm my-4">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Update Product</h1>
                        </div>
                        <form class="user" @submit.prevent='updateProduct' enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Product Name" v-model="formData.product_name">
                                        <small class="text-danger" v-if="errors.product_name">{{errors.product_name}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Product Code</label>
                                        <input type="text" class="form-control" placeholder="Enter Product Code" v-model="formData.product_code">
                                        <small class="text-danger" v-if="errors.product_code">{{errors.product_code}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Product Category</label>
                                        <select class="form-control" v-model="formData.category_id">
                                            <option :key="category.id" :value="category.id" v-for="category in categories.value">{{ category.category_name }}</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.category_id">{{errors.category_id}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Product Supplier</label>
                                        <select class="form-control" v-model="formData.supplier_id">
                                            <option :key="supplier.id" :value="supplier.id" v-for="supplier in suppliers.value">{{ supplier.name }}</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.supplier_id">{{errors.supplier_id}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label>Product Root</label>
                                        <input type="text" class="form-control" placeholder="Enter Product Root" v-model="formData.root">
                                        <small class="text-danger" v-if="errors.root">{{errors.root}}</small>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Buying Price</label>
                                        <input type="text" class="form-control" placeholder="Enter Buying Price" v-model="formData.buying_price">
                                        <small class="text-danger" v-if="errors.buying_price">{{errors.buying_price}}</small>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Selling Price</label>
                                        <input type="text" class="form-control" placeholder="Enter Selling Price" v-model="formData.selling_price">
                                        <small class="text-danger" v-if="errors.selling_price">{{errors.selling_price}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="buying_date">Buying Date</label>
                                        <input type="date" class="form-control" placeholder="Enter Buying Date" v-model="formData.buying_date" id="buying_date">
                                        <small class="text-danger" v-if="errors.buying_date">{{errors.buying_date}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Product Quantity</label>
                                        <input type="text" class="form-control" placeholder="Enter Quantity" v-model="formData.product_quantity">
                                        <small class="text-danger" v-if="errors.product_quantity">{{errors.product_quantity}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-8">
                                        <div class="form-row">
                                            <div class="col-md-9">
                                                <label for="image">Employee Image</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" @change="imageUpload">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                                </div>
                                        <small class="text-danger" v-if="errors.image">{{errors.image}}</small>
                                            </div>
                                            <div class="col-md-3" v-if="formData.image">
                                                <img :src="formData.image" style="height: 70px; width: 100%; object-fit: cover;">
                                            </div>
                                        </div>

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
