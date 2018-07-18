const { mix } = require('laravel-mix');
mix
// ENTERPRISE EDITION
.styles([
	'resources/assets/sass/new-metro.css',
	'resources/assets/metro/build/css/metro-icons.css',
	'resources/assets/sass/tiles.css',
	'resources/assets/sass/responsive.css',
	], 'public/css/enterprise.css')
.combine([
	'resources/assets/metro/js/*.js',
	'resources/assets/metro/js/my-utils/*.js',
	'resources/assets/metro/js/my-widgets/*.js',
	], 'public/js/enterprise-lib.js')
.js('resources/assets/js/enterprise.js', 'public/js')
if(mix.inProduction()){
	mix.version()
	.minify([
		'public/css/enterprise.css'
		], 'public/css')
	.minify([
		'public/js/enterprise.js'
		], 'public/js')
}

// .sass('resources/assets/sass/tiles.scss', 'public/lisun/dist/css')
// .sass('resources/assets/sass/responsive.scss', 'public/lisun/dist/css')


// login hris
mix.js('resources/assets/js/login-hris.js', 'public/js')
// hris
.js('resources/assets/js/hris.js', 'public/js')
// MARKETING IDE
.js('resources/assets/js/marketing-idea.js', 'public/js')
.copy('resources/assets/sass/new-metro.css', 'public/css')
// .styles([
// 	'public/metro/build/transition_effects.min.css',
// 	'public/metro/build/new_preloader.min.css',
// 	'resources/assets/sass/hris-additional.css',
// 	'resources/assets/sass/tiles.css',
// 	], 'public/lisun/dist/css/hris-libraries.min.css')

// FLEET MANAGEMENT
mix.js('resources/assets/js/fleet.js', 'public/js')
.styles([
	'resources/assets/metro/build/css/metro.min.css',
	'resources/assets/metro/build/css/metro-icons.min.css',
	'resources/assets/metro/build/css/metro-responsive.min.css',
	'resources/assets/metro/build/css/metro-schemes.min.css',
	'resources/assets/metro/build/css/metro-colors.min.css',
	'resources/assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css',
	'resources/assets/plugins/font-awesome-animation/font-awesome-animation.min.css',
	], 'public/css/fleet-lib.css')
.scripts([
	'resources/assets/metro/build/js/metro.min.js',
	'resources/assets/metro/build/select2.min.js',
	'resources/assets/plugins/datatables/jquery.dataTables.min.js',
	'resources/assets/js/plugins/dataTables.buttons.min.js',
	'resources/assets/js/plugins/buttons.colVis.min.js',
	'resources/assets/plugins/input-mask/jquery.inputmask.js',
	'resources/assets/plugins/input-mask/jquery.inputmask.date.extensions.js',
	'resources/assets/plugins/input-mask/jquery.inputmask.extensions.js',
	], 'public/js/fleet-lib.js')
if(mix.inProduction()){
	mix.minify('public/css/fleet-lib.css', 'public/css')
	.minify('public/js/fleet-lib.js', 'public/js')
	.minify([
		'public/js/fleet.js'
		], 'public/js')
	.extract(['vue', 'vuex', 'vue-router', 'lodash', 'axios'])
}
// if(mix.inProduction()){
// 	mix
// 	.version()
// 	.extract(['vue', 'vuex', 'vue-router', 'jquery'], 'public/js')
// 	.minify([
// 		'public/css/enterprise.css'
// 		], 'public/css')
// 	.minify([
// 		'public/js/enterprise.js'
// 		], 'public/js')
// }
