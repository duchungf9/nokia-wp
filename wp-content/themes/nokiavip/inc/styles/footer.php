<?php
/**
 * Footer color
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_customizer_footer_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function saha_customizer_footer_styles() {

	// Footer Background
	$footer_bg = saha_mod( PREFIX . 'footer-bg' );

	if ( $footer_bg !== customizer_library_get_default( PREFIX . 'footer-bg' ) ) {

		$color = sanitize_hex_color( $footer_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-footer'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Footer Border Top Color
	$footer_border_top = saha_mod( PREFIX . 'footer-border-top' );

	if ( $footer_border_top !== customizer_library_get_default( PREFIX . 'footer-border-top' ) ) {

		$color = sanitize_hex_color( $footer_border_top );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-footer'
			),
			'declarations' => array(
				'border-top-color' => $color
			)
		) );
	}

	// Footer Border Bottom Color
	$footer_border_bottom = saha_mod( PREFIX . 'footer-border-bottom' );

	if ( $footer_border_bottom !== customizer_library_get_default( PREFIX . 'footer-border-bottom' ) ) {

		$color = sanitize_hex_color( $footer_border_bottom );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-footer'
			),
			'declarations' => array(
				'border-bottom-color' => $color
			)
		) );
	}

	// Footer Bottom Border Top Color
	$footer_bottom_border_top = saha_mod( PREFIX . 'footer-bottom-border-top' );

	if ( $footer_bottom_border_top !== customizer_library_get_default( PREFIX . 'footer-bottom-border-top' ) ) {

		$color = sanitize_hex_color( $footer_bottom_border_top );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#footer-bottom'
			),
			'declarations' => array(
				'border-top-color' => $color
			)
		) );
	}

	// Footer Bottom Copyright Color
	$footer_bottom_copyright_color = saha_mod( PREFIX . 'footer-bottom-copyright-color' );

	if ( $footer_bottom_copyright_color !== customizer_library_get_default( PREFIX . 'footer-bottom-copyright-color' ) ) {

		$color = sanitize_hex_color( $footer_bottom_copyright_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#footer-bottom .copyright'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Footer Bottom Links Color
	$footer_bottom_links_color = saha_mod( PREFIX . 'footer-bottom-links-color' );

	if ( $footer_bottom_links_color !== customizer_library_get_default( PREFIX . 'footer-bottom-links-color' ) ) {

		$color = sanitize_hex_color( $footer_bottom_links_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#footer-bottom a',
				'#footer-bottom .footer-nav a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Footer Bottom Links Color Hover
	$footer_bottom_links_color_hover = saha_mod( PREFIX . 'footer-bottom-links-color-hover' );

	if ( $footer_bottom_links_color_hover !== customizer_library_get_default( PREFIX . 'footer-bottom-links-color-hover' ) ) {

		$color = sanitize_hex_color( $footer_bottom_links_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#footer-bottom a:hover',
				'#footer-bottom .footer-nav a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Scroll Top Color
	$scroll_top_color = saha_mod( PREFIX . 'scroll-top-color' );

	if ( $scroll_top_color !== customizer_library_get_default( PREFIX . 'scroll-top-color' ) ) {

		$color = sanitize_hex_color( $scroll_top_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#scroll-top'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Scroll Top Color Hover
	$scroll_top_color_hover = saha_mod( PREFIX . 'scroll-top-color-hover' );

	if ( $scroll_top_color_hover !== customizer_library_get_default( PREFIX . 'scroll-top-color-hover' ) ) {

		$color = sanitize_hex_color( $scroll_top_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#scroll-top:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

}
endif;
add_action( 'saha_customizer_library_styles', 'saha_customizer_footer_styles' );