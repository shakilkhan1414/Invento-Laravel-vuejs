

import './bootstrap';
import { createApp } from 'vue';
import router from './routers'



const app = createApp({});

app.use(router)

app.mount('#app');
