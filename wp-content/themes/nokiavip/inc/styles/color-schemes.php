<?php
/**
 * Color schemes
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_customizer_color_schemes' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function saha_customizer_color_schemes() {

	$scheme 	= saha_mod( PREFIX . 'color-schemes' );
	$primary 	= saha_mod( PREFIX . 'primary-color-scheme' );
	$secondary 	= saha_mod( PREFIX . 'secondary-color-scheme' );

	// Custom Color
	if ( 'custom' == $scheme ) {
		$color 	= sanitize_hex_color( $primary );
		$color2 = sanitize_hex_color( $secondary );
	}

	// Black
	else if ( 'black' == $scheme ) {
		$color 	= '#000';
		$color2 = '#333';

	// Blue
	} else if ( 'blue' == $scheme ) {
		$color 	= '#4dbefa';
		$color2 = '#1bb0ff';

	// Brown
	} else if ( 'brown' == $scheme ) {
		$color 	= '#a5672a';
		$color2 = '#7e4d1c';

	// Crimson
	} else if ( 'crimson' == $scheme ) {
		$color 	= '#dc143c';
		$color2 = '#ff1f4c';

	// Cyan
	} else if ( 'cyan' == $scheme ) {
		$color 	= '#1fcda8';
		$color2 = '#14b391';

	// Green
	} else if ( 'green' == $scheme ) {
		$color 	= '#27b658';
		$color2 = '#11a142';

	// Orange
	} else if ( 'orange' == $scheme ) {
		$color 	= '#ff9000';
		$color2 = '#ff8e1a';

	// Pink
	} else if ( 'pink' == $scheme ) {
		$color 	= '#e72cb1';
		$color2 = '#dc11a2';

	// Red
	} else if ( 'red' == $scheme ) {
		$color 	= '#fe5252';
		$color2 = '#f33030';

	// Violet
	} else if ( 'violet' == $scheme ) {
		$color 	= '#9543d5';
		$color2 = '#9e30f3';
	}

	// Styles
	if ( 'yellow' != $scheme ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'button',
				'input[type="button"]',
				'input[type="reset"]',
				'input[type="submit"]',
				'.button',
				'.entry-share ul li a:hover',
				'.contact-info-widget li.skype a',
				'.woocommerce-message a',
				'.woocommerce-error a',
				'.woocommerce-info a',
				'.select2-results .select2-highlighted',
				'.header-cart > a .count',
				'.widget_shopping_cart .buttons a.checkout',
				'.widget_price_filter .price_slider_amount .button'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'a:hover',
				'.fixed-header .header-elements > li > a:hover',
				'.site-navigation .dropdown-menu > li > a:hover',
				'.site-navigation .dropdown-menu > li.sfHover > a',
				'.site-navigation .dropdown-menu > li.current-menu-item > a',
				'.site-navigation .dropdown-menu > li.current-menu-item.sfHover > a',
				'.site-navigation .dropdown-menu > li.current-menu-item > a:hover',
				'.site-title .site-breadcrumbs a:hover',
				'article.post .entry-header ul li i',
				'article.post .entry-header ul li a:hover',
				'.loop-nav .title',
				'.related-posts ul li .entry-category',
				'.related-posts ul li .entry-category a',
				'.mailchimp-widget button:hover',
				'.testimonials-slider .testimonial-company a:hover',
				'#footer-bottom .copyright .copyright a:hover',
				'#footer-bottom .footer-nav a:hover',
				'.woocommerce-checkout .woocommerce-info a',
				'.yith-woocompare-widget a.compare:hover',
				'.yith-woocompare-widget a.clear-all:hover',
				'.yith_woocommerce_ajax_search form .sbHolder .sbOptions li a:hover',
				'.yith_woocommerce_ajax_search .autocomplete-suggestion:hover',
				'.yith_woocommerce_ajax_search .autocomplete-suggestion.autocomplete-selected'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'a:hover',
				'.fixed-header .header-elements > li > a:hover'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );

		
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .entry-media:hover .entry-date',
				'article.post .entry-media:hover .entry-date::after',
				'.entry-media:hover i',
				'.quote-entry:hover i',
				'.widget-title::before',
				'.woocommerce .products .grid-view .action-button li a.quick:hover i',
				'.woocommerce .products .list-view .product-details .action-button li a.quick:hover i',
				'.product .onsale',
				'#yith-wcwl-popup-message',
				'.woocommerce-checkout #customer_details h3::before',
				'.review-order-wrapper h3::before',
				'.woocommerce #customer_login h2::before',
				'.woocommerce .addresses h3::before',
				'.widget_price_filter .ui-slider .ui-slider-range'
			),
			'declarations' => array(
				'background-color' => $color2
			)
		) );
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'input[type="checkbox"]:checked:before',
				'#top-bar a:hover',
				'.site-navigation .dropdown-menu > li > a:hover .title:after',
				'.site-navigation .dropdown-menu > li.sfHover > a .title:after',
				'.site-navigation .dropdown-menu > li.current-menu-item > a .title:after',
				'.site-navigation .dropdown-menu > li.current-menu-item.sfHover > a .title:after',
				'.site-navigation .dropdown-menu > li.current-menu-item > a:hover .title:after',
				'.dropdown-menu ul a:hover',
				'.dropdown-menu ul > li.current-menu-item > a',
				'.main-navigation .megamenu > li > a:hover',
				'article.post .more-link:hover',
				'.contact-info-widget i',
				'.custom-links-widget .saha-custom-links li a:hover::before',
				'#footer-bottom .copyright .copyright a',
				'.saha-toolbar .saha-switcher li a.active',
				'.saha-toolbar .saha-switcher li a:hover',
				'.product-details .btn:hover',
				'.product-details .added_to_cart:hover',
				'.woocommerce-tabs p.stars span a:hover',
				'.woocommerce-tabs p.stars span a:focus',
				'.woocommerce-tabs p.stars span a.active',
				'.star-rating span:before',
				'p.stars a',
				'p.stars a:hover',
				'.woocommerce .wishlist_table td.product-add-to-cart a:hover'
			),
			'declarations' => array(
				'color' => $color2
			)
		) );
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'blockquote',
				'.sub-menu',
				'article.post .more-link:hover',
				'.saha-toolbar .saha-switcher li a.active',
				'.saha-toolbar .saha-switcher li a:hover',
				'.product-details .btn:hover',
				'.product-details .added_to_cart:hover',
				'.woocommerce-tabs .tabs li.active a',
				'.woocommerce .wishlist_table td.product-add-to-cart a:hover'
			),
			'declarations' => array(
				'border-color' => $color2
			)
		) );
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.menu-right > li.sfHover .links.sf-with-ul::after',
				'.menu-right > li.sfHover .cart-contents::after',
				'.fixed-header .header-elements > li.sfHover .links.sf-with-ul::after',
				'.fixed-header .header-elements > li.sfHover .cart-contents::after',
				'.site-footer',
				'.woocommerce .products .grid-view:hover'
			),
			'declarations' => array(
				'border-bottom-color' => $color2
			)
		) );
	}

}
endif;
add_action( 'saha_customizer_library_styles', 'saha_customizer_color_schemes' );