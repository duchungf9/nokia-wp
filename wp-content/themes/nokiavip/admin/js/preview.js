/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Theme prefix
	var prefix = "saha-";

	/**
	 * Live preview site title & site description
	 */
	wp.customize( "blogname", function( value ) {
		value.bind( function( to ) {
			$( ".site-title a" ).text( to );
		} );
	} );
	wp.customize( "blogdescription", function( value ) {
		value.bind( function( to ) {
			$( ".site-description" ).text( to );
		} );
	} );

	/**
	 * Header color
	 */
	wp.customize( prefix + "header-bg-color", function( value ) {
		value.bind( function( to ) {
			to = to ? to : '#ffffff';
			$( '.site-header' ).css('background-color', to);
		} );
	} );
	wp.customize( prefix + "site-title-color", function( value ) {
		value.bind( function( to ) {
			to = to ? to : '#454545';
			$( '#masthead .site-title a' ).css('color', to);
		} );
	} );
	wp.customize( prefix + "site-desc-color", function( value ) {
		value.bind( function( to ) {
			to = to ? to : '#777777';
			$( '#masthead .site-description' ).css('color', to);
		} );
	} );

} )( jQuery );
