(function( $ ) {
	'use strict';

	$(document).ready( function() {
		// Tabs menu
		$( '.drozd-tabs li a' ).on('click', function(e) {
			e.preventDefault();
			$( '.drozd-tabs li a' ).removeClass( 'active' );
			$(this).addClass( 'active' );
			var tab = $(this).attr( 'href' );
			$( '.drozd-settings-tabs' ).removeClass( 'active' );
			$( '.settings-tabs' ).find( tab ).addClass( 'active' );
		});








	});

})( jQuery );