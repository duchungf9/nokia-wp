<?php
/**
 * Add new options for the page builder.
 * 
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

function saha_row_style_fields($fields) {
	$fields['row_effect'] = array(
		'name'        	=> __('Row Effect', 'saha'),
		'type'        	=> 'select',
		'group'       	=> 'attributes',
		'options' 		=> array(
			'' 					=> __('None', 'saha'),
			'bounce' 			=> __('Bounce', 'saha'),
			'flash' 			=> __('Flash', 'saha'),
			'pulse' 			=> __('Pulse', 'saha'),
			'rubberBand' 		=> __('Rubber Band', 'saha'),
			'shake' 			=> __('Shake', 'saha'),
			'swing' 			=> __('Swing', 'saha'),
			'tada' 				=> __('Tada', 'saha'),
			'wobble' 			=> __('Wobble', 'saha'),
			'jello' 			=> __('Jello', 'saha'),
			'bounceIn' 			=> __('Bounce In', 'saha'),
			'bounceInDown' 		=> __('Bounce In Down', 'saha'),
			'bounceInLeft' 		=> __('Bounce In Left', 'saha'),
			'bounceInRight' 	=> __('Bounce In Right', 'saha'),
			'bounceInUp' 		=> __('Bounce In Up', 'saha'),
			'fadeIn' 			=> __('Fade In', 'saha'),
			'fadeInDown' 		=> __('Fade In Down', 'saha'),
			'fadeInDownBig' 	=> __('Fade In Down Big', 'saha'),
			'fadeInLeft' 		=> __('Fade In Left', 'saha'),
			'fadeInLeftBig' 	=> __('Fade In Left Big', 'saha'),
			'fadeInRight' 		=> __('Fade In Right', 'saha'),
			'fadeInRightBig' 	=> __('Fade In Right Big', 'saha'),
			'fadeInUp' 			=> __('Fade In Up', 'saha'),
			'fadeInUpBig' 		=> __('Fade In Up Big', 'saha'),
			'flip' 				=> __('Flip', 'saha'),
			'flipInX' 			=> __('Flip In X', 'saha'),
			'flipInY' 			=> __('Flip In Y', 'saha'),
			'lightSpeedIn' 		=> __('Light Speed In', 'saha'),
			'rotateIn' 			=> __('Rotate In', 'saha'),
			'rotateInDownLeft' 	=> __('Rotate In Down Left', 'saha'),
			'rotateInDownRight' => __('Rotate In Down Right', 'saha'),
			'rotateInUpLeft' 	=> __('Rotate In Up Left', 'saha'),
			'rotateInUpRight' 	=> __('Rotate In Up Right', 'saha'),
			'hinge' 			=> __('Hinge', 'saha'),
			'rollIn' 			=> __('Roll In', 'saha'),
			'zoomIn' 			=> __('Zoom In', 'saha'),
			'zoomInDown' 		=> __('Zoom In Down', 'saha'),
			'zoomInLeft' 		=> __('Zoom In Left', 'saha'),
			'zoomInRight' 		=> __('Zoom In Right', 'saha'),
			'zoomInUp' 			=> __('Zoom In Up', 'saha'),
			'slideInDown' 		=> __('Slide In Down', 'saha'),
			'slideInLeft' 		=> __('Slide In Left', 'saha'),
			'slideInRight' 		=> __('Slide In Right', 'saha'),
			'slideInUp' 		=> __('Slide In Up', 'saha'),
		),
		'priority'    	=> 7,
	);

	$fields['container'] = array(
		'name'        => __('Add Container Class', 'saha'),
		'type'        => 'checkbox',
		'group'       => 'attributes',
		'description' => __('Add the container class to center the row (if you&rsquo;ve activated the fullscreen option).', 'saha'),
		'priority'    => 8,
	);

	$fields['visibility'] = array(
		'name'        => __('Visibility', 'saha'),
		'type'        => 'select',
		'group'       => 'attributes',
		'options' 		=> array(
			'' 							=> __('Default', 'saha'),
			'hidden-tablet' 			=> __('Hidden On Tablet', 'saha'),
			'hidden-tablet-portrait' 	=> __('Hidden On Tablet Portrait', 'saha'),
			'hidden-tablet-landscape' 	=> __('Hidden On Tablet Landscape', 'saha'),
			'hidden-tablet-phone' 		=> __('Hidden On Tablet P. & Phone', 'saha'),
			'hidden-phone' 				=> __('Hidden On Phone', 'saha'),
		),
		'priority'    => 9,
	);

	return $fields;
}
add_filter( 'siteorigin_panels_row_style_fields', 'saha_row_style_fields', 10, 2 );

function saha_widget_style_fields($fields) {
	$fields['widget_effect'] = array(
		'name'        	=> __('Widget Effect', 'saha'),
		'type'        	=> 'select',
		'group'       	=> 'attributes',
		'options' 		=> array(
			'' 					=> __('None', 'saha'),
			'bounce' 			=> __('Bounce', 'saha'),
			'flash' 			=> __('Flash', 'saha'),
			'pulse' 			=> __('Pulse', 'saha'),
			'rubberBand' 		=> __('Rubber Band', 'saha'),
			'shake' 			=> __('Shake', 'saha'),
			'swing' 			=> __('Swing', 'saha'),
			'tada' 				=> __('Tada', 'saha'),
			'wobble' 			=> __('Wobble', 'saha'),
			'jello' 			=> __('Jello', 'saha'),
			'bounceIn' 			=> __('Bounce In', 'saha'),
			'bounceInDown' 		=> __('Bounce In Down', 'saha'),
			'bounceInLeft' 		=> __('Bounce In Left', 'saha'),
			'bounceInRight' 	=> __('Bounce In Right', 'saha'),
			'bounceInUp' 		=> __('Bounce In Up', 'saha'),
			'fadeIn' 			=> __('Fade In', 'saha'),
			'fadeInDown' 		=> __('Fade In Down', 'saha'),
			'fadeInDownBig' 	=> __('Fade In Down Big', 'saha'),
			'fadeInLeft' 		=> __('Fade In Left', 'saha'),
			'fadeInLeftBig' 	=> __('Fade In Left Big', 'saha'),
			'fadeInRight' 		=> __('Fade In Right', 'saha'),
			'fadeInRightBig' 	=> __('Fade In Right Big', 'saha'),
			'fadeInUp' 			=> __('Fade In Up', 'saha'),
			'fadeInUpBig' 		=> __('Fade In Up Big', 'saha'),
			'flip' 				=> __('Flip', 'saha'),
			'flipInX' 			=> __('Flip In X', 'saha'),
			'flipInY' 			=> __('Flip In Y', 'saha'),
			'lightSpeedIn' 		=> __('Light Speed In', 'saha'),
			'rotateIn' 			=> __('Rotate In', 'saha'),
			'rotateInDownLeft' 	=> __('Rotate In Down Left', 'saha'),
			'rotateInDownRight' => __('Rotate In Down Right', 'saha'),
			'rotateInUpLeft' 	=> __('Rotate In Up Left', 'saha'),
			'rotateInUpRight' 	=> __('Rotate In Up Right', 'saha'),
			'hinge' 			=> __('Hinge', 'saha'),
			'rollIn' 			=> __('Roll In', 'saha'),
			'zoomIn' 			=> __('Zoom In', 'saha'),
			'zoomInDown' 		=> __('Zoom In Down', 'saha'),
			'zoomInLeft' 		=> __('Zoom In Left', 'saha'),
			'zoomInRight' 		=> __('Zoom In Right', 'saha'),
			'zoomInUp' 			=> __('Zoom In Up', 'saha'),
			'slideInDown' 		=> __('Slide In Down', 'saha'),
			'slideInLeft' 		=> __('Slide In Left', 'saha'),
			'slideInRight' 		=> __('Slide In Right', 'saha'),
			'slideInUp' 		=> __('Slide In Up', 'saha'),
		),
		'priority'    	=> 7,
	);

	$fields['widget_container'] = array(
		'name'        => __('Add Container Class', 'saha'),
		'type'        => 'checkbox',
		'group'       => 'attributes',
		'description' => __('Add the container class to center the row (if you&rsquo;ve activated the fullscreen option).', 'saha'),
		'priority'    => 8,
	);

	$fields['widget_visibility'] = array(
		'name'        => __('Visibility', 'saha'),
		'type'        => 'select',
		'group'       => 'attributes',
		'options' 		=> array(
			'' 							=> __('Default', 'saha'),
			'hidden-tablet' 			=> __('Hidden On Tablet', 'saha'),
			'hidden-tablet-portrait' 	=> __('Hidden On Tablet Portrait', 'saha'),
			'hidden-tablet-landscape' 	=> __('Hidden On Tablet Landscape', 'saha'),
			'hidden-tablet-phone' 		=> __('Hidden On Tablet P. & Phone', 'saha'),
			'hidden-phone' 				=> __('Hidden On Phone', 'saha'),
		),
		'priority'    => 9,
	);

	return $fields;
}
add_filter( 'siteorigin_panels_widget_style_fields', 'saha_widget_style_fields', 10, 2 );

/**
 * Add classes in front end.
 */
function saha_row_style_attributes( $attributes, $args ) {
    if( !empty( $args['row_effect'] ) ) {
        $attributes['class'][] = 'saha_effect';
        $attributes['class'][] = 'wow';
        $attributes['class'][] = $args['row_effect'];
    }

    if( !empty( $args['container'] ) ) {
        array_push($attributes['class'], 'container');
    }

    if( !empty( $args['visibility'] ) ) {
        array_push($attributes['class'], $args['visibility']);
    }

    return $attributes;
}
add_filter('siteorigin_panels_row_style_attributes', 'saha_row_style_attributes', 10, 2);

function saha_widget_style_attributes( $attributes, $args ) {
    if( !empty( $args['widget_effect'] ) ) {
        $attributes['class'][] = 'saha_effect';
        $attributes['class'][] = 'wow';
        $attributes['class'][] = $args['widget_effect'];
    }

    if( !empty( $args['widget_container'] ) ) {
        array_push($attributes['class'], 'container');
    }

    if( !empty( $args['widget_visibility'] ) ) {
        array_push($attributes['class'], $args['widget_visibility']);
    }

    return $attributes;
}
add_filter('siteorigin_panels_widget_style_attributes', 'saha_widget_style_attributes', 10, 2);