const DOMAIN = document.getElementById('domain').content
let prefix = DOMAIN.split('/')
if(prefix[3] === undefined)
	prefix =  '' 
else {
	prefix = prefix.splice(3).join('/')
}
import VueRouter from 'vue-router'
import Vue from 'vue'
Vue.use(VueRouter)
const routes = [
{ path: '/sales-order', component: require('./sales-order') },
{ path: '/drivers', component: require('./drivers') },
{ path: '/sales', component: require('./sales') },
]
const router = new VueRouter({
	base : prefix+'/fleet-management',
	mode : 'history',
	routes
})
router.beforeEach((to, from, next) => {
	if(to.path == '/'){
		$('#my-window').fadeOut()
	}else{
		$('#my-window').fadeIn()
	}
	next()
})

export default router