import './bootstrap';
import { createApp } from 'vue';
import router from './routers'
import User from './helpers/User'
window.User=User


const app = createApp({});

app.use(router)

app.mount('#app');
