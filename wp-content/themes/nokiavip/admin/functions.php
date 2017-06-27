<?php
/**
 * Custom and output functions for the theme customizer 
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_mod' ) ) :
/**
 * Wrap get_theme_mod function
 */
function saha_mod( $name ) {
	// Allow to filter the customizer.
	return apply_filters( 'saha_mod', get_theme_mod( $name, customizer_library_get_default( $name ) ), PREFIX, $name );
}
endif;

/**
 * Custom customizer function.
 *
 * @since  1.0.0
 */
function saha_move_default_customizer( $wp_customize ) {

	// Move section to new panel
	$wp_customize->get_section( 'title_tagline' )->panel       = 'header';
	$wp_customize->get_section( 'header_image' )->panel        = 'header';
	$wp_customize->get_section( 'static_front_page' )->panel   = 'general';
	$wp_customize->get_section( 'colors' )->panel              = 'color';
	$wp_customize->get_section( 'background_image' )->panel    = 'color';

	// Move the Theme Layout
	$wp_customize->get_section( 'layout' )->panel              = 'layouts';
	$wp_customize->get_section( 'layout' )->title              = __( 'Global Layout', 'saha' );
	$wp_customize->get_section( 'layout' )->priority           = 1;

	// Change the title/description/priority
	$wp_customize->get_section( 'title_tagline' )->title       = __( 'Site Title', 'saha' );
	$wp_customize->get_section( 'title_tagline' )->description = __( 'Site title will automatically disapear if you upload a logo.', 'saha' );
	$wp_customize->get_section( 'colors' )->title              = __( 'Background', 'saha' );
	$wp_customize->get_section( 'colors' )->priority           = 1;
	$wp_customize->get_section( 'background_image' )->priority = 2;
	$wp_customize->get_section( 'header_image' )->priority     = 1;

	// Live preview
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Change the priority of Menu panel
	$wp_customize->get_panel( 'nav_menus' )->priority          = 16;

	// Remove sections
	// $wp_customize->remove_control('blogdescription');
	// $wp_customize->remove_control( 'header_textcolor' );
	
}
add_action( 'customize_register', 'saha_move_default_customizer', 99 );

if ( ! function_exists( 'saha_tags_list' ) ) :
/**
 * Retrieve tags list.
 *
 * @since  1.0.0
 * @return array $tags
 */
function saha_tags_list() {

	// Set up empty array.
	$tags = array();

	// Retrieve available tags.
	$tags_obj = get_tags();

	// Set default/empty tag.
	$tags[''] = __( 'Select a tag &hellip;', 'saha' );

	// Display the tags.
	foreach ( $tags_obj as $tag ) {
		$tags[$tag->term_id] = esc_attr( $tag->name );
	}

	return $tags;

}
endif;

if ( ! function_exists( 'saha_cats_list' ) ) :
/**
 * Retrieve categories list.
 *
 * @since  1.0.0
 * @return array $tags
 */
function saha_cats_list() {

	// Set up empty array.
	$cats = array();

	// Retrieve available categories.
	$cats_obj = get_categories();

	// Set default/empty tag.
	$cats[''] = __( 'Select a category &hellip;', 'saha' );

	// Display the tags.
	foreach ( $cats_obj as $cat ) {
		$cats[$cat->term_id] = esc_attr( $cat->name );
	}

	return $cats;

}
endif;

/**
 * Display theme documentation on customizer page.
 *
 * @since  1.0.0
 */
function saha_documentation_link() {

	// Enqueue the script
	wp_enqueue_script(
		PREFIX . 'customizer-doc',
		get_template_directory_uri() . '/admin/js/doc.js',
		array(), '1.0.0',
		true
	);
 
	// Localize the script
	wp_localize_script(
		PREFIX . 'customizer-doc',
		'prefixL10n',
		array(
			'prefixURL'   => esc_url( 'http://docs.theme-junkie.com/saha' ),
			'prefixLabel' => __( 'Documentation', 'saha' ),
		)
	);
 
}
add_action( 'customize_controls_enqueue_scripts', 'saha_documentation_link' );