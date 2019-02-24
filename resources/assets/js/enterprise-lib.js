(function( factory ) {
	if ( typeof define === 'function' && define.amd ) {
		define([ 'jquery' ], factory );
	} else {
		factory( jQuery );
	}
}(function( jQuery ) { 
	'use strict';

	var $ = jQuery;

	window.METRO_VERSION = '3.0.17';
	require('./../metro/js/requirements.js')
	require('./../metro/js/global.js')
	require('./../metro/js/initiator.js')
	require('./../metro/js/widget.js')
	require('./../metro/js/my-utils/core-utils.js')
	require('./../metro/js/my-widgets/*.js')

	return $.Metro.init();
}));