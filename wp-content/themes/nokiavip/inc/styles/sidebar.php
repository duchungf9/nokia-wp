<?php
/**
 * Sidebar color
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_customizer_sidebar_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function saha_customizer_sidebar_styles() {

	// Sidebar Title Border Bottom Color
	$sidebar_title_border = saha_mod( PREFIX . 'sidebar-title-border-bottom-color' );

	if ( $sidebar_title_border !== customizer_library_get_default( PREFIX . 'sidebar-title-border-bottom-color' ) ) {

		$color = sanitize_hex_color( $sidebar_title_border );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.widget-title'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Sidebar Title Secondary Border Bottom Color
	$sidebar_title_secondary_border = saha_mod( PREFIX . 'sidebar-title-secondary-border-bottom-color' );

	if ( $sidebar_title_secondary_border !== customizer_library_get_default( PREFIX . 'sidebar-title-secondary-border-bottom-color' ) ) {

		$color = sanitize_hex_color( $sidebar_title_secondary_border );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.widget-title::before'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

}
endif;
add_action( 'saha_customizer_library_styles', 'saha_customizer_sidebar_styles' );