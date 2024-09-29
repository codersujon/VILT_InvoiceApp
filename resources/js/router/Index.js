import { createWebHistory, createRouter } from 'vue-router'

import InvoiceIndex from '../components/invoices/Index.vue'
import invoiceNew from '../components//invoices/new.vue'
import invoiceShow from '../components/invoices/show.vue'
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
    path: '/invoice/show/:id',
    component: invoiceShow,
    props: true
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