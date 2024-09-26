import { createWebHistory, createRouter } from 'vue-router'

import InvoiceIndex from '../components/invoices/Index.vue'
import NotFound from '../components/NotFound.vue'

const routes = [
  { 
    path: '/', 
    component: InvoiceIndex 
  },
  { 
    path: '/:pathMatch(.*)*', 
    component: NotFound 
  },
  
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router