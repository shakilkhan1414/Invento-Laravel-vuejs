<script setup>
import { ref, reactive, onBeforeMount, watch } from "vue";
import { useRouter,useRoute } from "vue-router";
import ClipLoader from "vue-spinner/src/ClipLoader.vue";

const router = useRouter();
const route=useRoute()

onBeforeMount(() => {
    if (!User.loggedIn()) {
        router.push({ name: "login" });
    }
    OrderData()
    OrderDetails()
});

const order = reactive({});
const orderDetails = reactive([]);

const OrderData = () => {
    let id=route.params.id
    axios.get('/api/order/view/'+id)
    .then(res=>{
        order.customer_name=res.data.customer.name
        order.customer_phone=res.data.customer.phone
        order.customer_address=res.data.customer.address ? res.data.customer.address : ''
        order.order_date=res.data.order_date
        order.payby=res.data.payby
        order.sub_total=res.data.sub_total
        order.vat=res.data.vat
        order.total=res.data.total
        order.pay=res.data.pay
        order.due=res.data.due ? res.data.due : 0
    })
    .catch(error=>{
        console.log(error)
    })
};

const OrderDetails = () => {
    let id=route.params.id
    axios.get('/api/order/orderDetails/'+id)
    .then(res=>{
        orderDetails.value=res.data
    })
    .catch(error=>{
        console.log(error)
    })
};


</script>

<template>
    <div>
        <div class="row">
            <router-link to="/orders" class="btn btn-primary"
                >Go Back
            </router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm mt-4 mb-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Order Details
                                        </h1>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <b>Customer Name :</b>
                                                            {{ order.customer_name }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Phone :</b>
                                                            {{ order.customer_phone }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Address :</b>
                                                            {{ order.customer_address }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Date :</b>
                                                            {{
                                                                order.order_date
                                                            }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Pay Through :</b>
                                                            {{ order.payby }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <b>Sub Total :</b>
                                                            {{order.sub_total}} $
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Vat :</b>
                                                            {{ order.total - order.sub_total }} $
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Total :</b>
                                                            {{ order.total }} $
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Pay Amount :</b>
                                                            {{ order.pay }} $
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Due Amount :</b>
                                                            {{ order.due }} $
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">
                                                        Order Details
                                                    </h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table align-items-center table-flush">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>
                                                                    Product Name
                                                                </th>
                                                                <th>
                                                                    Product Code
                                                                </th>
                                                                <th>Image</th>
                                                                <th>Qty</th>
                                                                <th>
                                                                    Unit Price
                                                                </th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="detail in orderDetails.value">
                                                                <td>
                                                                    {{
                                                                        detail.product.product_name
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        detail.product.product_code
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    <img :src="'/' +detail.product.image" id="em_photo"/>
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        detail.product_quantity
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        detail.product_price
                                                                    }}
                                                                    $
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        detail.sub_total
                                                                    }}
                                                                    $
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div v-if="!orderDetails.value" class="loading">
                                                        <ClipLoader color="#3742fa"/>
                                                    </div>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />
                                    <div class="text-center"></div>
                                    <div class="text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
