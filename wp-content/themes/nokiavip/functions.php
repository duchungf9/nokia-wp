<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 * 
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Define Theme Prefix
 */
define( 'PREFIX', 'saha-' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1180; /* pixels */
}

if ( ! function_exists( 'saha_content_width' ) ) :
/**
 * Set new content width if user uses 1 column layout.
 *
 * @since  1.0.0
 */
function saha_content_width() {
	global $content_width;

	if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
		$content_width = 1180;
	}
}
endif;
add_action( 'template_redirect', 'saha_content_width' );

if ( ! function_exists( 'saha_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0.0
 */
function saha_theme_setup() {

	// Make the theme available for translation.
	load_theme_textdomain( 'saha', trailingslashit( get_template_directory() ) . 'languages' );

	// Add custom stylesheet file to the TinyMCE visual editor.
	add_editor_style( array( 'assets/css/editor-style.css', saha_font_url() ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// used for Blog
	set_post_thumbnail_size( 300, 200, true );

	// Declare image sizes.
	add_image_size( 'saha-widget-thumb', 60, 60, true );

	// Register custom navigation menu.
	register_nav_menus(
		array(
			'top_menu_left'		=> __( 'Top Menu Left', 'saha' ),
			'main_menu'			=> __( 'Main Menu', 'saha' ),
			'user_menu'			=> __( 'User Menu', 'saha' ),
			'footer_menu'		=> __( 'Footer Menu', 'saha' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See: http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'audio', 'video', 'gallery', 'link', 'quote'
	) );

	// Enable theme-layouts extensions.
	add_theme_support( 'theme-layouts',
		array(
			'1c'   => __( '1 Column Wide (Full Width)', 'saha' ),
			'2c-l' => __( '2 Columns: Content / Sidebar', 'saha' ),
			'2c-r' => __( '2 Columns: Sidebar / Content', 'saha' )
		),
		array( 'customize' => true, 'default' => '2c-l' )
	);

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

}
endif; // saha_theme_setup
add_action( 'after_setup_theme', 'saha_theme_setup' );

if ( ! function_exists( 'saha_reset_default_image_sizes' ) ) :
/**
 * Re-set default image sizes
 *
 * @since  1.0.0
 */
function saha_reset_default_image_sizes() {
	// 'large' size
	update_option( 'large_size_w', 1024 );
	update_option( 'large_size_h', 568 );
	update_option( 'large_crop', 1 );

	// 'medium' size
	update_option( 'medium_size_w', 350 );
	update_option( 'medium_size_h', 210 );
	update_option( 'medium_crop', 1 );
}
endif;
add_action( 'after_switch_theme', 'saha_reset_default_image_sizes' );

/**
 * Registers custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_widget
 */
function saha_widgets_init() {

	// Register about me widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-about-me.php';
	register_widget( 'Saha_About_Me_Widget' );

	// Register ad widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-ads.php';
	register_widget( 'Saha_Ads_Widget' );

	// Register banner widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-banner.php';
	register_widget( 'Saha_Banner_Widget' );

	// Register brand widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-brand.php';
	register_widget( 'Saha_Brand_Widget' );

	// Register contact info widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-contact-info.php';
	register_widget( 'Saha_Contact_Info_Widget' );

	// Register custom links widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-custom-links.php';
	register_widget( 'Saha_Custom_Links_Widget' );

	// Register Facebook widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-facebook.php';
	register_widget( 'Saha_Facebook_Widget' );

	// Register feedburner widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-feedburner.php';
	register_widget( 'Saha_Feedburner_Widget' );

	// Register flickr widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-flickr.php';
	register_widget( 'Saha_Flickr_Widget' );

	// Register icon box widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-icon-box.php';
	register_widget( 'Saha_Icon_Box_Widget' );

	// Register mailchimp widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-mailchimp.php';
	register_widget( 'Saha_MailChimp_Widget' );

	// Register posts carousel widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-posts-carousel.php';
	register_widget( 'Saha_Posts_Carousel_Widget' );

	// Register posts thumbnails widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-posts-thumbnails.php';
	register_widget( 'Saha_Posts_Thumbnails_Widget' );

	// Register slider widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-slider.php';
	register_widget( 'Saha_Slider_Widget' );

	// Register social widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-social.php';
	register_widget( 'Saha_Social_Widget' );

	// Register testimonials widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-testimonials.php';
	register_widget( 'Saha_Testimonials_Widget' );

	// Register twitter widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-twitter.php';
	register_widget( 'Saha_Twitter_Widget' );

	// Register twitter list widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-twitter-list.php';
	register_widget( 'Saha_Twitter_List_Widget' );

	// Register video widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-video.php';
	register_widget( 'Saha_Video_Widget' );

	// Register woo products widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-woo-products.php';
	register_widget( 'Saha_Woo_Products_Widget' );
	
}
add_action( 'widgets_init', 'saha_widgets_init' );

/**
 * Registers widget areas and custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function saha_sidebars_init() {

	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', 'saha' ),
			'id'            => 'primary',
			'description'   => __( 'Main sidebar that appears on the right.', 'saha' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	if ( class_exists('Woocommerce') ) {
		register_sidebar(
			array(
				'name'          => __( 'WooCommerce Sidebar', 'saha' ),
				'id'            => 'woo_sidebar',
				'description'   => __( 'Widgets in this area are used in your WooCommerce sidebar for shop pages and product posts.', 'saha' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	// bbPress
	if ( class_exists( 'bbPress' ) ) {
		register_sidebar(
			array(
				'name'          => __( 'bbPress Sidebar', 'saha' ),
				'id'            => 'bbpress_sidebar',
				'description'   => __( 'Widgets in this area are used in the bbPress sidebar.', 'saha' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'saha' ),
			'id'            => 'footer-1',
			'description'   => __( 'The footer sidebar 1st column.', 'saha' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'saha' ),
			'id'            => 'footer-2',
			'description'   => __( 'The footer sidebar 2nd column.', 'saha' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 3', 'saha' ),
			'id'            => 'footer-3',
			'description'   => __( 'The footer sidebar 3rd column.', 'saha' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 4', 'saha' ),
			'id'            => 'footer-4',
			'description'   => __( 'The footer sidebar 4th column.', 'saha' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	
}
add_action( 'widgets_init', 'saha_sidebars_init' );

if ( ! function_exists( 'saha_get_sidebar' ) ) :
/**
 * Returns the correct sidebar region.
 *
 * @since 1.0.0
 */
function saha_get_sidebar( $sidebar = 'primary' ) {
	// WooCommerce
	if ( class_exists( 'Woocommerce' ) ) {
		if ( is_woocommerce() || is_cart() || is_checkout() ) {
			$sidebar = 'woo_sidebar';
		}
	}

	// bbPress
	elseif ( function_exists('is_bbpress') ) {
		if ( is_bbpress() ) {
			$sidebar = 'bbpress_sidebar';
		}
	}

	// Return the correct sidebar name & add useful hook
	$sidebar = apply_filters( 'saha_get_sidebar', $sidebar );

	// Check meta option after filter so it always overrides
	if ( $meta = get_post_meta( get_the_ID(), 'sidebar', true ) ) {
		$sidebar = $meta;
	}

	// Never show empty sidebar
	if ( ! is_active_sidebar( $sidebar ) ) {
		$sidebar = 'primary';
	} 

	return $sidebar;
}
endif;

/**
 * Returns the correct classname for any specific column grid
 *
 * @since 1.0.0
 */
function saha_grid_class( $col = '4' ) {
	$class = 'span_1_of_'. $col;
	$class = apply_filters( 'saha_grid_class', $class );
	return $class;
}

/**
 * Register Lato Google font.
 *
 * @since  1.0.0
 * @return string
 */
function saha_font_url() {
	
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'saha' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

if ( ! function_exists( 'is_woocommerce_activated' ) ) :
/**
 * Query WooCommerce activation
 *
 * @since  1.0.0
 */
function is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}
endif;

if ( ! function_exists( 'is_polylang_activated' ) ) :
/**
 * Query Polylang activation
 *
 * @since  1.0.0
 */
function is_polylang_activated() {
	return function_exists( 'pll_the_languages' ) ? true : false;
}
endif;

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Custom functions for this page builder.
 */
require trailingslashit( get_template_directory() ) . 'inc/siteorigin-functions.php';

/**
 * Enqueue scripts and styles.
 */
require trailingslashit( get_template_directory() ) . 'inc/scripts.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Page title breadcrumbs.
 */
require trailingslashit( get_template_directory() ) . 'inc/breadcrumbs.php';

/**
 * Custom functions to resizes an image and returns an array containing the resized URL.
 */
require trailingslashit( get_template_directory() ) . 'inc/images-resize.php';

/**
 * Require and recommended plugins list.
 */
require trailingslashit( get_template_directory() ) . 'inc/plugins/plugins.php';
require trailingslashit( get_template_directory() ) . 'inc/plugins/widget-areas.php';

/**
 * Customizer.
 */
require trailingslashit( get_template_directory() ) . 'admin/customizer-library.php';
require trailingslashit( get_template_directory() ) . 'admin/functions.php';

/**
 * Customizer functions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';
require trailingslashit( get_template_directory() ) . 'inc/mods.php';

/**
 * Custom menus walker.
 */
require trailingslashit( get_template_directory() ) . 'inc/menus-walker/init.php';
require trailingslashit( get_template_directory() ) . 'inc/menus-walker/menu-walker.php';

/**
 * Custom metabox.
 */
require trailingslashit( get_template_directory() ) . 'inc/metabox/metabox.php';
require trailingslashit( get_template_directory() ) . 'inc/metabox/gallery-metabox/gallery-metabox.php';

/**
 * We use some part of Hybrid Core to extends our themes.
 *
 * @link  http://themehybrid.com/hybrid-core Hybrid Core site.
 */
require trailingslashit( get_template_directory() ) . 'inc/hybrid/attr.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/breadcrumb-trail.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/theme-layouts.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/entry-views.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/context.php';

/**
 * Load Jetpack compatibility file.
 */
require trailingslashit( get_template_directory() ) . 'inc/jetpack.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( is_woocommerce_activated() ) {
	require trailingslashit( get_template_directory() ) . 'inc/woocommerce/woocommerce.php';
	require trailingslashit( get_template_directory() ) . 'inc/woocommerce/hooks.php';
	require trailingslashit( get_template_directory() ) . 'inc/woocommerce/template-tags.php';
}

/**
 * Load Polylang compatibility file.
 */
if ( ( function_exists( 'is_polylang_activated' ) && ( is_polylang_activated() ) ) ) {
	require trailingslashit( get_template_directory() ) . 'inc/polylang.php';
}

// set up 24 product
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );