window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
	console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
window.Vue = require('vue');
Vue.config.productionTip = false
const BASE_URL = document.getElementById('base_url').content
window.base_url = (uri = '')=>{
	return BASE_URL + uri
}
const DOMAIN = document.getElementById('domain').content
window.base_domain = (uri = '')=>{
	return DOMAIN + uri
}
window.baseDomain = (uri = '')=>{
	return DOMAIN + uri
}
window.axios.defaults.baseURL = baseDomain('/api')
require('./fleet/components')
import router from './fleet/router'
import store from './fleet/store'

window.successMsg = (msg) => {
	$.Notify({type: 'success', caption: 'Success', content: msg});
}

window.errorMsg = (msg) => {
	$.Notify({keepOpen: false, type: 'alert', caption: 'Failed', content: msg});
}

window.resetForm = (form) => {
	$(form).find('[type="text"], [type="number"], [type="email"], [type="password"], select[multiple], textarea').val('')
}

window.resetError = (selector, parent) => {
	$(parent).find(selector).next().find('strong').empty().parents('.form-group').removeClass('has-error')
}

window.resetAllError = () => {
	$('.form-group').removeClass('has-error')
	$('span.help-block').find('strong').empty()
}

window.infoMsg = (content, caption = '') => {
	$.Notify({
		keepOpen : true,
		type : 'info',
		content,
		caption
	})
}

window.comingSoon = () => {
	infoMsg('coming soon. menu in maintenance', 'info from developer')
}

window.getDateNow = () => {
	let d = new Date()
	return d.format('yyyy-mm-dd')
}

window.getData = (c, url) => {
	axios('hris/departments/data/'+id).then(res=>{
		c.commit('SET_DEPARTMENT', res.data)
	}).catch(err=>{
		c.dispatch('getDepartment', id)
	})
}

window.getById = (arr, id) => {
	return _.find(arr, (val) => {
		return val.id == id
	})
}

window.handleError = (err, form) => {
	if(err.response.status == 409)
		errorMsg(err.response.data)
	else if(err.response.status == 422){
		errorMsg('Error occured!!!<br>Please check again field in form')
		let errors = err.response.data.errors
		let input;
		for(let key in errors){
			$(form).find('#'+key).parents('.form-group').addClass('has-error').find('strong').html(errors[key][0])
		}
	}else if(err.response.status == 404){
		errorMsg('URL NOT FOUND')
	}else if(err.response.status == 500){
		errorMsg('THERE IS ERROR IN SERVER')
	}else if(err.response.status == 401){
		errorMsg('YOUR SESSION EXPIRED. PLEASE LOGIN AGAIN. REDIRECT IN 3S')
		setTimeout(()=>{
			window.location = baseDomain('/login')
		}, 3000)
	}else if(err.response.status == 419){
		errorMsg('ERROR NOT KNOWN. PAGE RELOADING IN 3S')
		setTimeout(()=>{
			window.location.reload()
		}, 3000)
	}
}

window.showCharms = (id) => {
	let  charm = $(id).data("charm")
	if (charm.element.data("opened") === true) {
		charm.close()
	} else {
		charm.open()
	}
}

const app = new Vue({
	store, router
}).$mount('#app-fleet');
