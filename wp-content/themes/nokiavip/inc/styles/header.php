<?php
/**
 * Header color
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_customizer_header_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function saha_customizer_header_styles() {

	// Header Background Color
	$header = saha_mod( PREFIX . 'header-bg' );

	if ( $header != customizer_library_get_default( PREFIX . 'header-bg' ) ) {

		$color = sanitize_hex_color( $header );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header-inner'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Search Border Color
	$search_border = saha_mod( PREFIX . 'header-search-border-color' );

	if ( $search_border != customizer_library_get_default( PREFIX . 'header-search-border-color' ) ) {

		$color = sanitize_hex_color( $search_border );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.yith_woocommerce_ajax_search form',
				'.yith_woocommerce_ajax_search .sbHolder'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Search Color
	$search_color = saha_mod( PREFIX . 'header-search-color' );

	if ( $search_color != customizer_library_get_default( PREFIX . 'header-search-color' ) ) {

		$color = sanitize_hex_color( $search_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.yith_woocommerce_ajax_search #yith-s',
				'.yith_woocommerce_ajax_search .sbSelector',
				'.yith_woocommerce_ajax_search .search_categories',
				'.yith_woocommerce_ajax_search .sbHolder .sbOptions li a',
				'.yith_woocommerce_ajax_search .autocomplete-suggestion'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Search Button Background
	$button_bg = saha_mod( PREFIX . 'header-search-button-bg' );

	if ( $button_bg != customizer_library_get_default( PREFIX . 'header-search-button-bg' ) ) {

		$color = sanitize_hex_color( $button_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.yith_woocommerce_ajax_search #yith-searchsubmit'
			),
			'declarations' => array(
				'background' => $color
			)
		) );
	}

	// Search Button Background Hover
	$button_bg_hover = saha_mod( PREFIX . 'header-search-button-bg-hover' );

	if ( $button_bg_hover != customizer_library_get_default( PREFIX . 'header-search-button-bg-hover' ) ) {

		$color = sanitize_hex_color( $button_bg_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.yith_woocommerce_ajax_search #yith-searchsubmit:hover'
			),
			'declarations' => array(
				'background' => $color
			)
		) );
	}

	// Search Button Color
	$button_color = saha_mod( PREFIX . 'header-search-button-color' );

	if ( $button_color != customizer_library_get_default( PREFIX . 'header-search-button-color' ) ) {

		$color = sanitize_hex_color( $button_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.yith_woocommerce_ajax_search .nav-searchfield::after'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Search Sub Background
	$sub_bg = saha_mod( PREFIX . 'header-search-sub-bg' );

	if ( $sub_bg != customizer_library_get_default( PREFIX . 'header-search-sub-bg' ) ) {

		$color = sanitize_hex_color( $sub_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'form .sbOptions',
				'.autocomplete-suggestions',
				'.autocomplete-suggestion'
			),
			'declarations' => array(
				'background' => $color
			)
		) );
	}

	// Search Sub Border Color
	$sub_border = saha_mod( PREFIX . 'header-search-sub-border-color' );

	if ( $sub_border != customizer_library_get_default( PREFIX . 'header-search-sub-border-color' ) ) {

		$color = sanitize_hex_color( $sub_border );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'form .sbOptions',
				'.yith_woocommerce_ajax_search .autocomplete-suggestions',
				'.yith_woocommerce_ajax_search .autocomplete-suggestion'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Search Sub Color Hover
	$sub_color_hover = saha_mod( PREFIX . 'header-search-sub-color-hover' );

	if ( $sub_color_hover != customizer_library_get_default( PREFIX . 'header-search-sub-color-hover' ) ) {

		$color = sanitize_hex_color( $sub_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.yith_woocommerce_ajax_search form .sbHolder .sbOptions li a:hover',
				'.yith_woocommerce_ajax_search .autocomplete-suggestion:hover',
				'.yith_woocommerce_ajax_search .autocomplete-suggestion.autocomplete-selected'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Right Buttons Color
	$button_color = saha_mod( PREFIX . 'header-buttons-color' );

	if ( $button_color != customizer_library_get_default( PREFIX . 'header-buttons-color' ) ) {

		$color = sanitize_hex_color( $button_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.menu-right .links'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Right Buttons Color
	$button_color_hover = saha_mod( PREFIX . 'header-buttons-color-hover' );

	if ( $button_color_hover != customizer_library_get_default( PREFIX . 'header-buttons-color-hover' ) ) {

		$color = sanitize_hex_color( $button_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.menu-right .links:hover',
				'.menu-right .sfHover .links'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Right Buttons Border Color
	$button_border_color = saha_mod( PREFIX . 'header-buttons-border-color' );

	if ( $button_border_color != customizer_library_get_default( PREFIX . 'header-buttons-border-color' ) ) {

		$color = sanitize_hex_color( $button_border_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.menu-right > li'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Navigation Background
	$nav_bg = saha_mod( PREFIX . 'header-nav-bg' );

	if ( $nav_bg != customizer_library_get_default( PREFIX . 'header-nav-bg' ) ) {

		$color = sanitize_hex_color( $nav_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#site-navigation-wrap'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Navigation Color
	$nav_color = saha_mod( PREFIX . 'header-nav-color' );

	if ( $nav_color != customizer_library_get_default( PREFIX . 'header-nav-color' ) ) {

		$color = sanitize_hex_color( $nav_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-navigation .dropdown-menu > li > a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Navigation Color Hover
	$nav_color_hover = saha_mod( PREFIX . 'header-nav-color-hover' );

	if ( $nav_color_hover != customizer_library_get_default( PREFIX . 'header-nav-color-hover' ) ) {

		$color = sanitize_hex_color( $nav_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-navigation .dropdown-menu > li > a:hover',
				'.site-navigation .dropdown-menu > li.sfHover > a',
				'.site-navigation .dropdown-menu > li.current-menu-item > a',
				'.site-navigation .dropdown-menu > li.current-menu-item.sfHover > a',
				'.site-navigation .dropdown-menu > li.current-menu-item > a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Navigation Icon Color
	$nav_icon_color = saha_mod( PREFIX . 'header-nav-icons-color' );

	if ( $nav_icon_color != customizer_library_get_default( PREFIX . 'header-nav-icons-color' ) ) {

		$color = sanitize_hex_color( $nav_icon_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-navigation .dropdown-menu > li.menu-item-has-children > a .title:after'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Navigation Icon Color Hover
	$nav_icon_color_hover = saha_mod( PREFIX . 'header-nav-icons-color-hover' );

	if ( $nav_icon_color_hover != customizer_library_get_default( PREFIX . 'header-nav-icons-color-hover' ) ) {

		$color = sanitize_hex_color( $nav_icon_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-navigation .dropdown-menu > li > a:hover .title:after',
				'.site-navigation .dropdown-menu > li.sfHover > a .title:after',
				'.site-navigation .dropdown-menu > li.current-menu-item > a .title:after',
				'.site-navigation .dropdown-menu > li.current-menu-item.sfHover > a .title:after',
				'.site-navigation .dropdown-menu > li.current-menu-item > a:hover .title:after'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Sub Menu Background Color
	$sub_menu_bg = saha_mod( PREFIX . 'header-sub-menu-bg' );

	if ( $sub_menu_bg != customizer_library_get_default( PREFIX . 'header-sub-menu-bg' ) ) {

		$color = sanitize_hex_color( $sub_menu_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.sub-menu'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Sub Menu Border Top Color
	$sub_menu_border_top = saha_mod( PREFIX . 'header-sub-menu-border-top-color' );

	if ( $sub_menu_border_top != customizer_library_get_default( PREFIX . 'header-sub-menu-border-top-color' ) ) {

		$color = sanitize_hex_color( $sub_menu_border_top );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.sub-menu'
			),
			'declarations' => array(
				'border-top-color' => $color
			)
		) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.menu-right > li.sfHover .links.sf-with-ul::after',
				'.menu-right > li.sfHover .cart-contents::after'
			),
			'declarations' => array(
				'border-bottom-color' => $color
			)
		) );
	}

	// Sub Menu Links Color
	$sub_menu_links_color = saha_mod( PREFIX . 'header-sub-menu-links-color' );

	if ( $sub_menu_links_color != customizer_library_get_default( PREFIX . 'header-sub-menu-links-color' ) ) {

		$color = sanitize_hex_color( $sub_menu_links_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.dropdown-menu ul a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Sub Menu Links Color Hover
	$sub_menu_links_color_hover = saha_mod( PREFIX . 'header-sub-menu-links-color-hover' );

	if ( $sub_menu_links_color_hover != customizer_library_get_default( PREFIX . 'header-sub-menu-links-color-hover' ) ) {

		$color = sanitize_hex_color( $sub_menu_links_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.dropdown-menu ul a:hover',
				'.dropdown-menu ul > li.current-menu-item > a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Sub Menu Megamenu Title Links Color
	$sub_menu_title_links_color = saha_mod( PREFIX . 'header-megamenu-title-color' );

	if ( $sub_menu_title_links_color != customizer_library_get_default( PREFIX . 'header-megamenu-title-color' ) ) {

		$color = sanitize_hex_color( $sub_menu_title_links_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.main-navigation .megamenu > li > a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Sub Menu Megamenu Title Links Color Hover
	$sub_menu_title_links_color_hover = saha_mod( PREFIX . 'header-megamenu-title-color-hover' );

	if ( $sub_menu_title_links_color_hover != customizer_library_get_default( PREFIX . 'header-megamenu-title-color-hover' ) ) {

		$color = sanitize_hex_color( $sub_menu_title_links_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.main-navigation .megamenu > li > a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Sub Menu Megamenu Border Color
	$sub_menu_megamenu_border_color = saha_mod( PREFIX . 'header-megamenu-border-color' );

	if ( $sub_menu_megamenu_border_color != customizer_library_get_default( PREFIX . 'header-megamenu-border-color' ) ) {

		$color = sanitize_hex_color( $sub_menu_megamenu_border_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.main-navigation .megamenu > li'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Fixed Header Background
	$fixed_header_bg = saha_mod( PREFIX . 'fixed-header-bg' );

	if ( $fixed_header_bg != customizer_library_get_default( PREFIX . 'fixed-header-bg' ) ) {

		$color = sanitize_hex_color( $fixed_header_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.fixed-header'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Fixed Header Border Bottom Color
	$fixed_header_border = saha_mod( PREFIX . 'fixed-header-border-color' );

	if ( $fixed_header_border != customizer_library_get_default( PREFIX . 'fixed-header-border-color' ) ) {

		$color = sanitize_hex_color( $fixed_header_border );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.fixed-header'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Fixed Header Buttons Color
	$fixed_header_buttons_color = saha_mod( PREFIX . 'fixed-header-buttons-color' );

	if ( $fixed_header_buttons_color != customizer_library_get_default( PREFIX . 'fixed-header-buttons-color' ) ) {

		$color = sanitize_hex_color( $fixed_header_buttons_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.fixed-header .header-elements > li > a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Fixed Header Buttons Color Hover
	$fixed_header_buttons_color_hover = saha_mod( PREFIX . 'fixed-header-buttons-color-hover' );

	if ( $fixed_header_buttons_color_hover != customizer_library_get_default( PREFIX . 'fixed-header-buttons-color-hover' ) ) {

		$color = sanitize_hex_color( $fixed_header_buttons_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.fixed-header .header-elements > li > a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Fixed Header Buttons Border Color
	$fixed_header_buttons_border_color = saha_mod( PREFIX . 'fixed-header-buttons-border-color' );

	if ( $fixed_header_buttons_border_color != customizer_library_get_default( PREFIX . 'fixed-header-buttons-border-color' ) ) {

		$color = sanitize_hex_color( $fixed_header_buttons_border_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.fixed-header .header-elements > li > a'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Fixed Header Buttons Border Color Hover
	$fixed_header_buttons_border_color_hover = saha_mod( PREFIX . 'fixed-header-buttons-border-color-hover' );

	if ( $fixed_header_buttons_border_color_hover != customizer_library_get_default( PREFIX . 'fixed-header-buttons-border-color-hover' ) ) {

		$color = sanitize_hex_color( $fixed_header_buttons_border_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.fixed-header .header-elements > li > a:hover'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

}
endif;
add_action( 'saha_customizer_library_styles', 'saha_customizer_header_styles' );