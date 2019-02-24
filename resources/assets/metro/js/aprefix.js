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