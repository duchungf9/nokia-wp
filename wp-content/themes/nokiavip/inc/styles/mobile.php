<?php
/**
 * Mobile color
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_customizer_mobile_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function saha_customizer_mobile_styles() {

	// Header Border Bottom Color
	$header_border_color = saha_mod( PREFIX . 'mobile-header-border-color' );

	if ( $header_border_color != customizer_library_get_default( PREFIX . 'mobile-header-border-color' ) ) {

		$color = sanitize_hex_color( $header_border_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header .site-header-inner'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Link Color
	$link_color = saha_mod( PREFIX . 'mobile-link-color' );

	if ( $link_color != customizer_library_get_default( PREFIX . 'mobile-link-color' ) ) {

		$color = sanitize_hex_color( $link_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-link > li a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Link Color Hover
	$link_color_hover = saha_mod( PREFIX . 'mobile-link-color-hover' );

	if ( $link_color_hover != customizer_library_get_default( PREFIX . 'mobile-link-color-hover' ) ) {

		$color = sanitize_hex_color( $link_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-link > li a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Mobile Nav Background
	$mobile_nav_bg = saha_mod( PREFIX . 'mobile-nav-bg' );

	if ( $mobile_nav_bg != customizer_library_get_default( PREFIX . 'mobile-nav-bg' ) ) {

		$color = sanitize_hex_color( $mobile_nav_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-nav'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Mobile Nav Background
	$mobile_nav_bg = saha_mod( PREFIX . 'mobile-nav-bg' );

	if ( $mobile_nav_bg != customizer_library_get_default( PREFIX . 'mobile-nav-bg' ) ) {

		$color = sanitize_hex_color( $mobile_nav_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-nav'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Mobile Nav Close Title Background
	$close_title_bg = saha_mod( PREFIX . 'mobile-nav-close-title-bg' );

	if ( $close_title_bg != customizer_library_get_default( PREFIX . 'mobile-nav-close-title-bg' ) ) {

		$color = sanitize_hex_color( $close_title_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-nav .close-mobile-nav'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Mobile Nav Close Title Color
	$close_title_color = saha_mod( PREFIX . 'mobile-nav-close-title-color' );

	if ( $close_title_color != customizer_library_get_default( PREFIX . 'mobile-nav-close-title-color' ) ) {

		$color = sanitize_hex_color( $close_title_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-nav .close-mobile-nav'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Mobile Nav Search Form Border Color
	$search_border_color = saha_mod( PREFIX . 'mobile-nav-search-form-border-color' );

	if ( $search_border_color != customizer_library_get_default( PREFIX . 'mobile-nav-search-form-border-color' ) ) {

		$color = sanitize_hex_color( $search_border_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-nav .search-form input'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Mobile Nav Search Form Color
	$search_color = saha_mod( PREFIX . 'mobile-nav-search-form-color' );

	if ( $search_color != customizer_library_get_default( PREFIX . 'mobile-nav-search-form-color' ) ) {

		$color = sanitize_hex_color( $search_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-nav .search-form input'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Mobile Nav Search Form Button Color
	$search_button_color = saha_mod( PREFIX . 'mobile-nav-search-form-button-color' );

	if ( $search_button_color != customizer_library_get_default( PREFIX . 'mobile-nav-search-form-button-color' ) ) {

		$color = sanitize_hex_color( $search_button_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-nav .search-form button'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Mobile Nav Links Color
	$links_color = saha_mod( PREFIX . 'mobile-nav-links-color' );

	if ( $links_color != customizer_library_get_default( PREFIX . 'mobile-nav-links-color' ) ) {

		$color = sanitize_hex_color( $links_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-nav li a',
				'.mobile-nav li .mobile-icon'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Mobile Nav Links Color Hover
	$links_color_hover = saha_mod( PREFIX . 'mobile-nav-links-color-hover' );

	if ( $links_color_hover != customizer_library_get_default( PREFIX . 'mobile-nav-links-color-hover' ) ) {

		$color = sanitize_hex_color( $links_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-nav li a:hover',
				'.mobile-nav li .mobile-icon:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Mobile Nav Sub Menu Background
	$sub_menu_bg = saha_mod( PREFIX . 'mobile-nav-sub-menu-bg' );

	if ( $sub_menu_bg != customizer_library_get_default( PREFIX . 'mobile-nav-sub-menu-bg' ) ) {

		$color = sanitize_hex_color( $sub_menu_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mobile-nav ul.sub-menu'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

}
endif;
add_action( 'saha_customizer_library_styles', 'saha_customizer_mobile_styles' );