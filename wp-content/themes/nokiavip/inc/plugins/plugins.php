<?php
/**
 * TGM Plugin Lists
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

// Include the TGM_Plugin_Activation class.
require trailingslashit( get_template_directory() ) . 'inc/plugins/class-tgm-plugin-activation.php';

/**
 * Register required and recommended plugins.
 *
 * @since  1.0.0
 */
function saha_register_plugins() {

	$plugins = array(

		array(
			'name'				=> 'Page Builder by SiteOrigin',
			'slug'				=> 'siteorigin-panels', 
			'required'			=> false,
		),

		array(
			'name'				=> 'SiteOrigin Widgets Bundle',
			'slug'				=> 'so-widgets-bundle', 
			'required'			=> false,
		),

		array(
			'name'				=> 'WooCommerce',
			'slug'				=> 'woocommerce', 
			'required'			=> false,
		),

		array(
			'name'				=> 'YITH Woocommerce Compare',
			'slug'				=> 'yith-woocommerce-compare', 
			'required'			=> false,
		),

		array(
			'name'				=> 'YITH WooCommerce Wishlist',
			'slug'				=> 'yith-woocommerce-wishlist', 
			'required'			=> false,
		),

		array(
			'name'				=> 'YITH WooCommerce Ajax Search',
			'slug'				=> 'yith-woocommerce-ajax-search', 
			'required'			=> false,
		),

	);

	$config = array(
		'id'           => 'tgmpa',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'saha_register_plugins' );