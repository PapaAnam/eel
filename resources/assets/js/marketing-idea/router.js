import VueRouter from 'vue-router'
import Vue from 'vue'
Vue.use(VueRouter)
const routes = [
  { path: '/', component: require('./empty') },
  { path: '/catalog', component: require('./catalog/index.vue') },
  { path: '/maps', component: require('./maps/index.vue') },
  { path: '/customer-outlet', component: require('./customer-outlet/index.vue') },
]
const base = document.getElementById('marketing-idea-base').content
const router = new VueRouter({
  routes,
  mode : 'history',
  base
})

export default router