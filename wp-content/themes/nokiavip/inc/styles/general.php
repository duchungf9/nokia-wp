<?php
/**
 * General color
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_customizer_general_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function saha_customizer_general_styles() {

	// Body Background Color
	$body_bg = saha_mod( PREFIX . 'body-bg' );

	if ( $body_bg !== customizer_library_get_default( PREFIX . 'body-bg' ) ) {

		$color = sanitize_hex_color( $body_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Body Color
	$body_color = saha_mod( PREFIX . 'body-color' );

	if ( $body_color != customizer_library_get_default( PREFIX . 'body-color' ) ) {

		$color = sanitize_hex_color( $body_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Heading Color
	$heading_color = saha_mod( PREFIX . 'heading-color' );

	if ( $heading_color != customizer_library_get_default( PREFIX . 'heading-color' ) ) {

		$color = sanitize_hex_color( $heading_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Links Color
	$links_color = saha_mod( PREFIX . 'links-color' );

	if ( $links_color != customizer_library_get_default( PREFIX . 'links-color' ) ) {

		$color = sanitize_hex_color( $links_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Links Color Hover
	$links_color_hover = saha_mod( PREFIX . 'links-color-hover' );

	if ( $links_color_hover != customizer_library_get_default( PREFIX . 'links-color-hover' ) ) {

		$color = sanitize_hex_color( $links_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

}
endif;
add_action( 'saha_customizer_library_styles', 'saha_customizer_general_styles' );