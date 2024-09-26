import './bootstrap';

import { createApp } from 'vue';
import router from './router/Index';
import App from './components/app.vue'

createApp(App).use(router).mount('#app')