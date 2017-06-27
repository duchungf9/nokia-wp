<?php
/**
 * Title color
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_customizer_title_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function saha_customizer_title_styles() {

	// Title Background Color
	$title_bg = saha_mod( PREFIX . 'title-bg' );

	if ( $title_bg !== customizer_library_get_default( PREFIX . 'title-bg' ) ) {

		$color = sanitize_hex_color( $title_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-title'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Title Color
	$title_color = saha_mod( PREFIX . 'title-color' );

	if ( $title_color != customizer_library_get_default( PREFIX . 'title-color' ) ) {

		$color = sanitize_hex_color( $title_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-title h1'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Top Bar Color Hover
	$title_border_color = saha_mod( PREFIX . 'title-border-color' );

	if ( $title_border_color != customizer_library_get_default( PREFIX . 'title-border-color' ) ) {

		$color = sanitize_hex_color( $title_border_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-title'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Breadcrumbs Color
	$breadcrumbs_color = saha_mod( PREFIX . 'breadcrumbs-color' );

	if ( $breadcrumbs_color != customizer_library_get_default( PREFIX . 'breadcrumbs-color' ) ) {

		$color = sanitize_hex_color( $breadcrumbs_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-title .site-breadcrumbs',
				'.site-title .site-breadcrumbs a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Breadcrumbs Color Hover
	$breadcrumbs_color_hover = saha_mod( PREFIX . 'breadcrumbs-color-hover' );

	if ( $breadcrumbs_color_hover != customizer_library_get_default( PREFIX . 'breadcrumbs-color-hover' ) ) {

		$color = sanitize_hex_color( $breadcrumbs_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-title .site-breadcrumbs a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	/*
	* Metabox
	*/

	global $post;

	if ( get_post_meta( $post->ID, 'saha_title_style', true ) == 'background-image' && is_singular() ) {

		// Color
		$title_color = get_post_meta( $post->ID, 'saha_title_color', true );

		if ( $title_color != '' ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-title h1'
				),
				'declarations' => array(
					'color' => $title_color
				)
			) );
		}

		// Background Image
		$title_img = get_post_meta( $post->ID, 'saha_title_background_img', true );

		// Generate image URL if using ID
		if ( is_numeric( $title_img ) ) {
			$title_img = wp_get_attachment_image_src( $title_img, 'full' );
			$title_img = $title_img[0];
		}

		if ( $title_img != '' ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-title'
				),
				'declarations' => array(
					'background-image' 			=> 'url('. $title_img .')',
				    'background-position' 		=> '50% 0',
				    'background-attachment' 	=> 'fixed',
				    '-webkit-background-size' 	=> 'cover',
				    '-moz-background-size' 		=> 'cover',
				    '-o-background-size' 		=> 'cover',
				    'background-size' 			=> 'cover'
				)
			) );
		}

		// Height
		$title_height = get_post_meta( $post->ID, 'saha_title_height', true );

		if ( $title_height != '' ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-title'
				),
				'declarations' => array(
					'height' => $title_height
				)
			) );
		}

	}

}
endif;
add_action( 'saha_customizer_library_styles', 'saha_customizer_title_styles' );