<script setup>
import {ref,reactive,onBeforeMount } from 'vue'
import { useRouter, useRoute} from 'vue-router'

const router = useRouter()
const route=useRoute()

onBeforeMount(() => {
    if(!User.loggedIn()){
        router.push({name: 'login'})
    }
    employeeData()
});

let formData=reactive({
    name:'',
    email: '',
    address: '',
    nid: '',
    phone:'',
    salary:'',
    joining_date:'',
    image:'',
    newImage:''
})

let errors=reactive({
    name:'',
    email: '',
    address: '',
    nid: '',
    phone:'',
    salary:'',
    joining_date:'',
    image:''
})


const employeeData=()=>{
    let id=route.params.id
    axios.get('/api/employee/'+id)
    .then(res=>{
        formData.name=res.data.name
        formData.email=res.data.email
        formData.address=res.data.address
        formData.nid=res.data.nid
        formData.phone=res.data.phone
        formData.salary=res.data.salary
        formData.joining_date=res.data.joining_date
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

const updateEmployee= ()=>{
    let id=route.params.id
    axios.patch('/api/employee/'+id,formData)
    .then(() => {
        router.push({name: 'employees'})
        Notification.success()
    })
    .catch(error=> {
        if(error.response.status === 422){
            errors.name = error.response.data.errors.name ? error.response.data.errors.name[0] : ''
            errors.email = error.response.data.errors.email ? error.response.data.errors.email[0] : ''
            errors.address = error.response.data.errors.address ? error.response.data.errors.address[0] : ''
            errors.nid = error.response.data.errors.nid ? error.response.data.errors.nid[0] : ''
            errors.phone = error.response.data.errors.phone ? error.response.data.errors.phone[0] : ''
            errors.salary = error.response.data.errors.salary ? error.response.data.errors.salary[0] : ''
            errors.joining_date = error.response.data.errors.joining_date ? error.response.data.errors.joining_date[0] : ''
            errors.image = error.response.data.errors.image ? error.response.data.errors.image[0] : ''
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
                <router-link class="btn btn-primary" to="/employees">All Employees</router-link>
                <div class="card shadow-sm my-4">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Update Employee</h1>
                        </div>
                        <form class="user" @submit.prevent='updateEmployee' enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter Name" v-model="formData.name">
                                        <small class="text-danger" v-if="errors.name">{{errors.name}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" placeholder="Enter Email" v-model="formData.email">
                                        <small class="text-danger" v-if="errors.email">{{errors.email}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter Address" v-model="formData.address">
                                        <small class="text-danger" v-if="errors.address">{{errors.address}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter NID" v-model="formData.nid">
                                        <small class="text-danger" v-if="errors.nid">{{errors.nid}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter Phone" v-model="formData.phone">
                                        <small class="text-danger" v-if="errors.phone">{{errors.phone}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter Salary" v-model="formData.salary">
                                        <small class="text-danger" v-if="errors.salary">{{errors.salary}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="joining_date">Joining Date</label>
                                        <input type="date" class="form-control" placeholder="Enter Joining Date" v-model="formData.joining_date" id="joining_date">
                                        <small class="text-danger" v-if="errors.joining_date">{{errors.joining_date}}</small>
                                    </div>
                                    <div class="col-md-6">
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
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
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
