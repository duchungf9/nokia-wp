<?php
/**
 * Enqueue scripts and styles.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Loads the theme styles & scripts.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
function saha_enqueue() {

	// Add js product variation
	$woo = '';
	if ( class_exists('WooCommerce') ) {
        $woo = 'wc-add-to-cart-variation';
    }

	// Load plugins stylesheet
	wp_enqueue_style( 'saha-plugins-style', trailingslashit( get_template_directory_uri() ) . 'assets/css/plugins.min.css' );

	// if WP_DEBUG and/or SCRIPT_DEBUG turned on, load the unminified styles & script.
	if ( ! is_child_theme() && WP_DEBUG || SCRIPT_DEBUG ) {

		// Load main stylesheet
		wp_enqueue_style( 'saha-style', get_stylesheet_uri() );

		// Load custom js plugins.
		wp_enqueue_script( 'saha-plugins', trailingslashit( get_template_directory_uri() ) . 'assets/js/plugins.min.js', array( 'jquery' ), null, true );

		// Load custom js methods.
		wp_enqueue_script( 'saha-main', trailingslashit( get_template_directory_uri() ) . 'assets/js/main.js', array( 'jquery', $woo ), null, true );

	} else {

		// Load main stylesheet
		wp_enqueue_style( 'saha-style', trailingslashit( get_template_directory_uri() ) . 'style.min.css' );

		// Load custom js plugins.
		wp_enqueue_script( 'saha-scripts', trailingslashit( get_template_directory_uri() ) . 'assets/js/saha.min.js', array( 'jquery', $woo ), null, true );

	}

	// If child theme is active, load the stylesheet.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'saha-child-style', get_stylesheet_uri() );
	}

	// Load comment-reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Loads HTML5 Shiv
	wp_enqueue_script( 'saha-html5', trailingslashit( get_template_directory_uri() ) . 'assets/js/html5shiv.min.js', array( 'jquery' ), null, false );
	wp_script_add_data( 'saha-html5', 'conditional', 'lte IE 9' );

}
add_action( 'wp_enqueue_scripts', 'saha_enqueue' );

/**
 * Loads admin scripts.
 *
 * @since 1.0.0
 */
function admin_scripts() {
	// Load JS for use with the walker menu
	wp_enqueue_script('saha-menus-walker-js', trailingslashit( get_template_directory_uri() ) . 'assets/js/menus-walker.js', array('jquery'), '1.0', true );

	// Load CSS for use with the walker menu
	wp_enqueue_style( 'saha-admin-css', trailingslashit( get_template_directory_uri() ) . 'assets/css/admin.css', false, '1.0' );

	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'admin_scripts' );