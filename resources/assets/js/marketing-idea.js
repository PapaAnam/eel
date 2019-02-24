

// Date Helper
window.getYear = ()=>{
	let d = new Date()
	return d.getFullYear()
}
window.getMonth = ()=>{
	let d = new Date()
	return d.getMonth()+1
}
window._ = require('lodash');
window.axios = require('axios');


// my api
let bas = document.getElementById('domain').content
bas = bas.charAt(bas.length-1) == '/' ? bas.replace(/.$/, '') : bas
window.myApi = axios.create({
	baseURL : bas+'/api/',
})

window.monthName = (month) => {
	if(month == '1') return  'January'
	if(month == '2') return  'February'
	if(month == '3') return  'March'
	if(month == '4') return  'April'
	if(month == '5') return  'May'
	if(month == '6') return  'June'
	if(month == '7') return  'July'
	if(month == '8') return  'August'
	if(month == '9') return  'September'
	if(month == '10') return  'October'
	if(month == '11') return  'November'
	if(month == '12') return  'December'
}


String.prototype.capitalize = function(){
	return this.substr(0,1).toUpperCase()+this.substr(1)
}
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
	console.error('CSRF token not found: https:\/\/laravel.com/docs/csrf#csrf-x-csrf-token');
}
window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.config.productionTip = false
const BASE_URL = document.getElementById('base_url').content
window.base_url = (uri = '')=>{
	return BASE_URL + '/marketing-idea' + uri
}
const DOMAIN = document.getElementById('domain').content
window.base_domain = (uri = '')=>{
	return DOMAIN + uri
}
window.baseDomain = (uri = '')=>{
	return DOMAIN + uri
}
window.axios.defaults.baseURL = base_domain('/marketing-idea')
window.myaxios = axios.create({
	baseURL : base_domain('/api')
})
require('./marketing-idea/components')
import router from './marketing-idea/router'
import store from './marketing-idea/store'
require('./metro-init')
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
	$('.form-control').removeClass('is-invalid')
	$('.invalid-feedback').empty()
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

window.setDatatable = () => {
	$('#datatable').DataTable().destroy()
	setTimeout(()=>{
		$('#datatable').DataTable({
			// responsive : true
		})
	}, 1000)
}

window.getDateNow = () => {
	let d = new Date()
	return d.format('yyyy-mm-dd')
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
			$(form).find('#'+key).addClass('is-invalid').parent().find('.invalid-feedback').html(errors[key][0])
		}
	}else if(err.response.status == 404){
		errorMsg('URL NOT FOUND')
	}else if(err.response.status == 405){
		errorMsg('METHOD NOT ALLOWED')
	}else if(err.response.status == 500){
		errorMsg('THERE IS ERROR IN SERVER')
	}else if(err.response.status == 401){
		errorMsg('YOUR SESSION EXPIRED. PLEASE LOGIN AGAIN. REDIRECT IN 3S')
		setTimeout(()=>{
			window.location = base_domain('/login')
		}, 3000)
	}
}

window.colors = ['lime', 'green', 'emerald', 'teal', 'blue', 'cyan', 'cobalt', 'indigo', 'violet', 'pink', 'magenta', 'crimson', 'red', 'orange', 'amber', 'yellow', 'brown', 'olive', 'steel', 'mauve', 'taupe', 'darkBrown', 'darkCrimson', 'darkMagenta', 'darkIndigo', 'darkCyan', 'darkCobalt', 'darkTeal', 'darkEmerald', 'darkGreen', 'darkOrange', 'darkRed', 'darkPink', 'darkViolet', 'darkBlue', 'lightBlue', 'lightRed', 'lightGreen', 'lighterBlue', 'lightOlive', 'lightPink'];
window.getRandomColor = () => {
	return _.sample(colors)
}

window.fadeOutPreloader = () => {
	setTimeout(() => {
		$('.mac-preloader').fadeOut('slow')
	}, 1500)
}

window.showCharms = (id) => {
	let  charm = $(id).data("charm")
	if (charm.element.data("opened") === true) {
		charm.close()
	} else {
		charm.open()
	}
}

window.notAuthorizedMsg = () => {
	errorMsg('You not authorized')
}

const app = new Vue({
	store, router,
	mounted(){
		metro_init()
	}
}).$mount('#app-marketing-idea');


