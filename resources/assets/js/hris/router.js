import VueRouter from 'vue-router'
import Vue from 'vue'
Vue.use(VueRouter)
const routes = [
  { path: '/', component: require('./empty') },
  { path: '/departments', component: require('./departments') },
  { path: '/jobs', component: require('./jobs/index') },
  { path: '/employees', component: require('./employees/index'), name : 'employees' },
  { path: '/employees/new', component: require('./employees/new') },
  { path: '/employees/edit/:id', component: require('./employees/edit') },
  { path: '/employees/detail/:id', component: require('./employees/detail') },
  { path: '/employees/non-active', component: require('./employees/non-active') },
  { path: '/accounts', component: require('./accounts/index') },
  { path: '/accounts/new', component: require('./accounts/new') },
  { path: '/accounts/edit/:id', component: require('./accounts/edit') },
  { path: '/accounts/detail/:id', component: require('./accounts/detail') },

  { path: '/attendances', component: require('./attendances/index') },
  { path: '/attendances/new', component: require('./attendances/new') },
  { path: '/attendances/edit/by-employee/:id', component: require('./attendances/edit_filter_employee') },
  { path: '/attendances/edit/:id', component: require('./attendances/edit') },
  { path: '/attendances/x100c', component: require('./attendances/x100c') },
  { path: '/attendances/zt1300', component: require('./attendances/zt1300') },
  { path: '/attendances/by-employee', component: require('./attendances/by-employee') },

  { path: '/over-time', component: require('./over-time/index.vue') },
  { path: '/special-day', component: require('./special-day/index') },
  { path: '/payroll', component: require('./payroll/index') },
  { path: '/payroll/new', component: require('./payroll/new') },
  { path: '/salary-rules', component: require('./salary-rules/index') },
  { path: '/official-travel', component: require('./official-travel/index') },
  { path: '/official-travel/new', component: require('./official-travel/new') },
  { path: '/official-travel/edit/:id', component: require('./official-travel/edit') },
  { path: '/official-travel/detail/:id', component: require('./official-travel/detail') },
  { path: '/mutations', component: require('./mutations/index.vue') },
  { path: '/mutations/new', component: require('./mutations/new.vue') },

  { path: '/salary-group', component: require('./salary-group/index.vue') },

  { path: '/leave-period', component: require('./leave-period/index.vue') },

  { path: '/cash-withdrawal', component: require('./cash-withdrawal/index.vue') },
  { path: '/always-presence', component: require('./always-presence/index.vue') },
]
const base = document.getElementById('hris-base').content
const router = new VueRouter({
  routes,
  mode : 'history',
  base
})

export default router