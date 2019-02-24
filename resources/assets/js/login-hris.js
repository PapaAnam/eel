const BASE_URL = document.getElementById('base_url').content
window.base_url = (uri = '')=>{
	return BASE_URL + uri
}
window._ = require('lodash')
window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.baseURL = BASE_URL
const token = document.head.querySelector('meta[name="csrf-token"]')
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}
window.Vue = require('vue')
Vue.config.productionTip = false
Vue.component('login-hris', require('./login-hris/index.vue'))
const app = new Vue({}).$mount('#login-hris')