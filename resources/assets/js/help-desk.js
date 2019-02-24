require('./bootstrap');

window.Vue = require('vue');
Vue.config.productionTip = false

import VueRouter from 'vue-router'

Vue.use(VueRouter)

import routes from './components/help-desk/routes'

const router = new VueRouter({
	routes
})

const BASE_URL = document.getElementById('base_url').content

window.base_url = (uri = '')=>{
	return BASE_URL + uri
}

window.hidePreloader = () => {
	setTimeout(function(){
		$('.preloader').fadeOut()
	}, 1000)
}

const colors = ['lime', 'green', 'emerald', 'teal', 'blue', 'cyan', 'cobalt', 'indigo', 'violet', 'pink', 'magenta', 'crimson', 'red', 'orange', 'amber', 'yellow', 'brown', 'olive', 'steel', 'mauve', 'taupe', 'darkBrown', 'darkCrimson', 'darkMagenta', 'darkIndigo', 'darkCyan', 'darkCobalt', 'darkTeal', 'darkEmerald', 'darkGreen', 'darkOrange', 'darkRed', 'darkPink', 'darkViolet', 'darkBlue', 'lightBlue', 'lightRed', 'lightGreen', 'lighterBlue', 'lightOlive', 'lightPink']

window.setTileBg = ()=>{
	$('[data-role="tile"]').addClass('bg-'+_.sample(colors))
}

require('./metro-init')

require('./components/help-desk/global')

const app = new Vue({
	el : '#app',
	router
});
