import { createWebHistory, createRouter } from 'vue-router'

import InvoiceIndex from '../components/invoices/Index.vue'
import invoiceNew from '../components//invoices/new.vue'
import NotFound from '../components/NotFound.vue'

const routes = [
  { 
    path: '/', 
    component: InvoiceIndex 
  },
  {
    path: '/invoice/new',
    component: invoiceNew
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