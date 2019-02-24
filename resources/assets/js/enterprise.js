window._ = require('lodash')
window.showCharms = (id) => {
	let  charm = $(id).data("charm")
	if (charm.element.data("opened") === true) {
		charm.close()
	} else {
		charm.open()
	}
}

window.Vue = require('vue')
Vue.config.productionTip = false

const BASE_URL = document.getElementById('base_url').content

window.base_url = (uri = '')=>{
	return BASE_URL + uri
}
window.axios.defaults.baseURL = base_url('/')
// my api
let bas = document.getElementById('domain').content
bas = bas.charAt(bas.length-1) == '/' ? bas.replace(/.$/, '') : bas
window.myApi = axios.create({
	baseURL : bas+'/api/',
})

require('./metro-init')
require('./enterprise/components')

const app = new Vue({
	el: '#app'
})
