import './bootstrap';
import { createApp } from 'vue';
import router from './routers'
import User from './helpers/User'
window.User=User
import Swal from 'sweetalert2'
window.Swal=Swal
import Notification from './helpers/Notification'
window.Notification=Notification

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  window.Toast=Toast


const app = createApp({});

app.use(router)

app.mount('#app');
