<script setup>

import {ref,reactive,onBeforeMount,watch,computed } from 'vue'
import { useRouter} from 'vue-router'
import ClipLoader from 'vue-spinner/src/ClipLoader.vue'

const router = useRouter()
let searchTerm=ref('')

onBeforeMount(() => {
    if(!User.loggedIn()){
        router.push({name: 'login'})
    }
    allProduct()
    allCustomer()
    allCategory()
    cartProducts()
});


const products=reactive([])
const customers=reactive([])
const categories=reactive([])
const carts=reactive([])
const filterSearch=reactive([])
const qty=ref(0)
const subtotal=ref(0)

let orderData=reactive({
    customer_id:'',
    pay:'',
    due:'',
    payby:''
})

let errors=reactive({
    customer_id:'',
    pay:'',
    due:'',
    payby:''
})

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

const allCustomer= ()=>{
    axios.get('/api/customer')
    .then(res => {
        customers.value=res.data
    })
    .catch(error=> {
            console.log(error)
        }
    )
}

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

const cartProducts= ()=>{
    axios.get('/api/cart/products')
    .then(res => {
        carts.value=res.data
    })
    .catch(error=> {
            console.log(error)
        }
    )

}

const subProduct=(id)=>{
    filterSearch.value = products.value.filter(product=>{
        return product.category_id == id
    })
}

const storeAllProduct=()=>{
    filterSearch.value = products.value
}

const addToCart=(id)=>{
    axios.get('/api/addToCart/'+id)
    .then(() => {
        cartProducts()
        Notification.cart_success()
    })
    .catch(error=> {
            console.log(error)
        }
    )
}

const removeItem=(id)=>{
    axios.get('/api/cart/remove/'+id)
    .then(() => {
        cartProducts()
        Notification.cart_delete()
    })
    .catch(error=> {
            console.log(error)
        }
    )
}

const increment=(id)=>{
    axios.get('/api/cart/increment/'+id)
    .then(() => {
        cartProducts()
    })
    .catch(error=> {
            console.log(error)
        }
    )
}

const decrement=(id)=>{
    axios.get('/api/cart/decrement/'+id)
    .then(() => {
        cartProducts()
    })
    .catch(error=> {
            console.log(error)
        }
    )
}

const orderdone=()=>{
    orderData.quantity=qty
    orderData.sub_total=subtotal
    orderData.vat=5
    orderData.total=subtotal.value*5/100 + subtotal.value

    axios.post('/api/order/complete',orderData)
    .then(() => {
        Notification.success()
        cartProducts()
        allProduct()
        orderData.customer_id=''
        orderData.pay=''
        orderData.due=''
        orderData.payby=''
    })
    .catch(error=> {
        if(error.response.status === 422){
            errors.customer_id = error.response.data.errors.customer_id ? error.response.data.errors.customer_id[0] : ''
            errors.pay = error.response.data.errors.pay ? error.response.data.errors.pay[0] : ''
            errors.due = error.response.data.errors.due ? error.response.data.errors.due[0] : ''
            errors.payby = error.response.data.errors.payby ? error.response.data.errors.payby[0] : ''
        }
        }
    )
}

watch(() => carts.value, (currentValue, oldValue) => {
    let sum=0
    currentValue.forEach(cart => {
        sum+= parseFloat(cart.product_quantity)
    });
    qty.value=sum

    let total=0
    currentValue.forEach(cart => {
        total+= (parseFloat(cart.product_quantity)* parseFloat(cart.product_price))
    });
    subtotal.value=total

});


watch(() => products.value, (currentValue, oldValue) => {
    filterSearch.value = currentValue;
});

watch(searchTerm, (currentValue, oldValue) => {
    filterSearch.value = products.value.filter(product=>{
        return product.product_name.toLowerCase().match(currentValue.toLowerCase()) || product.product_code.match(currentValue)
    })
});


</script>


<template>

    <div>
     <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/dashboard">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page">POS</li>
              </ol>
            </div>

            <div class="row mb-3">

              <div class="col-xl-5 col-lg-5">
                <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Order Items</h6>
                    <router-link to="/customers/create" class="btn btn-sm btn-info text-light">Add Customer</router-link>

                  </div>

                  <div class="table-responsive" style="font-size: 12px;">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th>Name</th>
                          <th>Qty</th>
                          <th>Unit</th>
                          <th>Total</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr v-for="cart in carts.value" :key="cart.id">
                        <td>{{ cart.product_name }}</td>
                        <td>
                            <button @click.prevent="increment(cart.id)" class="btn btn-sm btn-success">+</button>
                            <input type="text" class="border border-info cartInput" readonly="" :value="cart.product_quantity">
                            <button  @click.prevent="decrement(cart.id)" class="btn btn-sm btn-danger" v-if="cart.product_quantity >= 2">-</button>
                            <button class="btn btn-sm btn-danger" v-else="" disabled="">-</button>

                            </td>
                            <td>{{ cart.product_price  }}</td>
                            <td>{{ cart.sub_total }}</td>
                        <td><a @click="removeItem(cart.id)" class="btn btn-sm btn-primary cursor-pointer text-light">X</a></td>
                        </tr>

                            </tbody>
                            </table>
                            </div>
                            <div class="card-footer">
                        <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
                        <strong>{{ qty }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
                        <strong>{{ subtotal }} $</strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
                        <strong>5%</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Total :
                        <strong>{{ subtotal*5/100 + subtotal}} $</strong>
                        </li>

                        </ul>
                        <br>

                        <form @submit.prevent="orderdone">
                            <div class="form-group">
                                <label>Customer</label>
                                <select class="form-control" v-model="orderData.customer_id">
                                <option :value="customer.id" v-for="customer in customers.value">{{customer.name }} <span v-if="customer.phone">({{customer.phone}})</span></option>
                                </select>
                                <small class="text-danger" v-if="errors.customer_id">{{errors.customer_id}}</small>
                            </div>

                            <div class="form-group">
                                <label>Pay</label>
                                <input type="text" class="form-control" v-model="orderData.pay">
                                <small class="text-danger" v-if="errors.pay">{{errors.pay}}</small>
                            </div>

                            <div class="form-group">
                                <label>Due</label>
                                <input type="text" class="form-control" v-model="orderData.due">
                                <small class="text-danger" v-if="errors.due">{{errors.due}}</small>
                            </div>

                            <div class="form-group">
                                <label>Pay By</label>
                                <select class="form-control" v-model="orderData.payby">
                                    <option value="HandCash">Hand Cash </option>
                                    <option value="Cheaque">Cheaque </option>
                                    <option value="GiftCard">Gift Card </option>
                                </select>
                                <small class="text-danger" v-if="errors.payby">{{errors.payby}}</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>

                  </div>

                </div>
              </div>


              <div class="col-xl-7 col-lg-7">
                <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" @click="storeAllProduct()">All Product </a>
                        </li>


                        <li class="nav-item" v-for="category in categories.value" :key="category.id">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="subProduct(category.id)" >{{ category.category_name }}</a>
                        </li>


                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="card-body">
                    <input type="text" v-model="searchTerm" class="form-control mb-2" style="width: 560px;" placeholder="Search Product">

                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearch.value" :key="product.id">
                                <button class="btn btn-sm" @click.prevent="addToCart(product.id)">
                                <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                    <img :src="product.image" id="em_photo" class="card-img-top">
                                    <div class="card-body">
                                    <h6 class="card-title">{{ product.product_name }}</h6>
                            <span class="badge badge-success" v-if="product.product_quantity  >= 1 ">Available {{ product.product_quantity }}  </span>
                            <span class="badge badge-danger" v-else=" ">Stock Out </span>

                                    </div>
                                </div></button>

                            </div>
                            </div>

                        </div>

                        </div>

                        <div class="tab-pane fade card-body" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <input type="text" v-model="searchTerm" class="form-control mb-2" style="width: 560px;" placeholder="Search Product">

                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearch.value" :key="product.id">
                                <button class="btn btn-sm" @click.prevent="addToCart(product.id)">
                                <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                    <img :src="product.image" id="em_photo" class="card-img-top">
                                    <div class="card-body">
                                    <h6 class="card-title">{{ product.product_name }}</h6>
                                    <span class="badge badge-success" v-if="product.product_quantity  >= 1 ">Available {{ product.product_quantity }}  </span>
                                    <span class="badge badge-danger" v-else=" ">Stock Out </span>

                                    </div>
                                    </div>
                                </button>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div v-if="!filterSearch.value" class="loading pb-3">
                        <ClipLoader color="#3742fa"/>
                    </div>

                  </div>

                </div>
              </div>
            </div>

          </div>

  </template>


<style type="text/css" scoped>
  #em_photo{
    height: 100px;
    width: 135px;
  }
</style>
