<?php
/**
 * Top Bar color
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_customizer_top_bar_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function saha_customizer_top_bar_styles() {

	// Top Bar Background Color
	$tb_bg = saha_mod( PREFIX . 'tb-bg' );

	if ( $tb_bg !== customizer_library_get_default( PREFIX . 'tb-bg' ) ) {

		$color = sanitize_hex_color( $tb_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#top-bar-wrap'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Top Bar Color
	$tb_color = saha_mod( PREFIX . 'tb-color' );

	if ( $tb_color != customizer_library_get_default( PREFIX . 'tb-color' ) ) {

		$color = sanitize_hex_color( $tb_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#top-bar a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Top Bar Color Hover
	$tb_color_hover = saha_mod( PREFIX . 'tb-color-hover' );

	if ( $tb_color_hover != customizer_library_get_default( PREFIX . 'tb-color-hover' ) ) {

		$color = sanitize_hex_color( $tb_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#top-bar a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Top Bar Border Color
	$tb_border_color = saha_mod( PREFIX . 'tb-border-color' );

	if ( $tb_border_color != customizer_library_get_default( PREFIX . 'tb-border-color' ) ) {

		$color = sanitize_hex_color( $tb_border_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#top-bar-wrap',
				'.top-bar-social li'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

}
endif;
add_action( 'saha_customizer_library_styles', 'saha_customizer_top_bar_styles' );