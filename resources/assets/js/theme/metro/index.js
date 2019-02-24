import colors from './colors'
window.colors = colors
import mif from './mif-ani'
window.mif = mif
// LOAD GRID
require('./grid/index.js')
require('./sidebar/index.js')
require('./app-bar/index.js')
Vue.component('metro', require('./metro'))
Vue.component('layout', require('./layout'))
Vue.component('navbar', require('./navbar'))
Vue.component('container', require('./container'))
Vue.component('judul', require('./judul'))
Vue.component('tile-group', require('./tile-group'))
Vue.component('tile', require('./tile'))
Vue.component('tile-iconic', require('./tile-iconic'))
Vue.component('charm', require('./charm'))
Vue.component('window', require('./window'))
Vue.component('window-caption', require('./window-caption'))
Vue.component('window-content', require('./window-content'))
Vue.component('tag', require('./tag'))
Vue.component('modal', require('./modal'))
Vue.component('skin', require('./skin'))
Vue.component('skin-btn', require('./skin-btn'))

// FORM
require('./form')

Vue.component('select2', require('./select2'))
Vue.component('btn', require('./btn'))
require('./tab-control')