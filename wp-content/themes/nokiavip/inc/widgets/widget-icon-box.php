<?php
/**
 * Icon box widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Icon_Box_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-icon-box icon-box-widget',
			'description' => __( 'Add a box with icon.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-icon-box',                  // $this->id_base
			__( '&raquo; Icon Box', 'saha' ), // $this->name
			$widget_options                   // $this->widget_options
		);

		add_action('admin_enqueue_scripts', array($this, 'saha_icon_box_scripts'));
	}

    /**
     * Upload the Javascripts for the color picker
     */
    function saha_icon_box_scripts() {
    	wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$icon 						= $instance['icon'];
		$icon_size 					= $instance['icon_size'];
		$icon_font_size 			= $instance['icon_font_size'];
		$icon_line_height 			= $instance['icon_line_height'];
		$icon_border_radius 		= $instance['icon_border_radius'];
		$icon_bg					= $instance['icon_bg'];
		$icon_bg_hover 				= $instance['icon_bg_hover'];
		$icon_color 				= $instance['icon_color'];
		$icon_color_hover 			= $instance['icon_color_hover'];
		$icon_border_style			= $instance['icon_border_style'];
		$icon_border_width			= $instance['icon_border_width'];
		$icon_border_color 			= $instance['icon_border_color'];
		$icon_border_color_hover	= $instance['icon_border_color_hover'];
		$effect						= $instance['effect'];
		$box_title 					= $instance['box_title'];
		$text						= $instance['text'];
		$apply_link_to				= $instance['apply_link_to'];
		$box_title_link				= $instance['box_title_link'];
		$box_title_target			= $instance['box_title_target'];
		$read_more_link				= $instance['read_more_link'];
		$read_more_target			= $instance['read_more_target'];
		$read_more_text				= $instance['read_more_text'];
		$position					= $instance['position'];

		$classes = 'clr ';

		// Position
		if ( $position ) {
			$classes .= $position;
		}

		// Icon classes
		$icon_classes = '';

		if ( $effect ) {
			$icon_classes .= ' saha_effect wow ' . $effect;
		}

		// If icon color
		if ( $icon_color || $icon_color_hover ) {
			$classes .= ' icon-colored';
		}

		// Data attributes
		$data_attributes = '';

		if ( $icon_bg ) {
			$data_attributes .= 'data-bg="'. $icon_bg .'"';
		}

		if ( $icon_bg_hover ) {
			$data_attributes .= ' data-hover-bg="'. $icon_bg_hover .'"';
		}

		if ( $icon_color ) {
			$data_attributes .= 'data-color="'. $icon_color .'"';
		}

		if ( $icon_color_hover ) {
			$data_attributes .= ' data-hover-color="'. $icon_color_hover .'"';
		}

		if ( $icon_border_color ) {
			$data_attributes .= 'data-border-color="'. $icon_border_color .'"';
		}

		if ( $icon_border_color_hover ) {
			$data_attributes .= ' data-hover-border-color="'. $icon_border_color_hover .'"';
		}

		// Style
		$style = '';

		if ( $icon_size != '35' ) {
			$style .= 'width: '. $icon_size .'px; height: '. $icon_size .'px;';
		}

		if ( $icon_size != '35' && $icon_line_height == '' ) {
			$style .= 'line-height: '. $icon_size .'px;';
		}

		if ( $icon_font_size != '35' ) {
			$style .= 'font-size: '. $icon_font_size .'px;';
		}

		if ( $icon_line_height != '' ) {
			$style .= 'line-height: '. $icon_line_height .'px;';
		}

		if ( $icon_border_radius ) {
			$style .= '-webkit-border-radius: '. $icon_border_radius .'px; -moz-border-radius: '. $icon_border_radius .'px; -ms-border-radius: '. $icon_border_radius .'px; border-radius: '. $icon_border_radius .'px;';
		}

		if ( $icon_bg ) {
			$style .= 'background-color: '. $icon_bg .';';
		}

		if ( $icon_color ) {
			$style .= 'color: '. $icon_color .';';
		}

		if ( $icon_border_style != '#' ) {
			$style .= 'border-style: '. $icon_border_style .';';
		}

		if ( $icon_border_style != '#' && $icon_border_width ) {
			$style .= 'border-width: '. $icon_border_width .'px;';
		}

		if ( $icon_border_style != '#' && $icon_border_color ) {
			$style .= 'border-color: '. $icon_border_color .';';
		}

		if ( $style ) {
			$style = 'style="'. $style .'"';
		}

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

		echo'<div class="saha-box-inner '. esc_attr( $classes ) .'">';
			if ( $icon && $position != 'right' ) {
				echo'<div class="saha-icon-wrap">';
					echo'<div class="saha-icon '. esc_attr( $icon_classes ) .'" '. $data_attributes .' '. $style .'>';
						echo'<i class="'. esc_attr( $icon ) .'"></i>';
					echo'</div>';
				echo'</div>';
			}

			echo'<div class="content">';

				if ( $box_title ) {
					echo'<h2 class="box-title">';

						if ( $apply_link_to == 'box_title' && $box_title_link ) {
							echo'<a href="'. esc_url( $box_title_link ) .'" target="_'. esc_attr( $box_title_target ) .'">';
						}

							echo''. esc_attr( $box_title ) .'';

						if ( $apply_link_to == 'box_title' && $box_title_link ) {
							echo'</a>';
						}

					echo'</h2>';
				}

				echo do_shortcode( $text );

				if ( $apply_link_to == 'read_more' && $read_more_link ) {
					echo'<div class="read-more-wrap">';
						echo'<a class="box-link" href="'. esc_url( $read_more_link ) .'" target="_'. esc_attr( $read_more_target ) .'">'. esc_attr( $read_more_text ) .'</a>';
					echo'</div>';
				}

			echo'</div>';

			if ( $icon && $position == 'right' ) {
				echo'<div class="saha-icon-wrap">';
					echo'<div class="saha-icon '. esc_attr( $icon_classes ) .'" '. $data_attributes .' '. $style .'>';
						echo'<i class="'. esc_attr( $icon ) .'"></i>';
					echo'</div>';
				echo'</div>';
			}
		echo'</div>';

		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['title']      				= strip_tags( $new_instance['title'] );
		$instance['icon'] 						= $new_instance['icon'];
		$instance['icon_size'] 					= $new_instance['icon_size'];
		$instance['icon_font_size'] 			= $new_instance['icon_font_size'];
		$instance['icon_line_height'] 			= $new_instance['icon_line_height'];
		$instance['icon_border_radius'] 		= $new_instance['icon_border_radius'];
		$instance['icon_bg'] 					= $new_instance['icon_bg'];
		$instance['icon_bg_hover'] 				= $new_instance['icon_bg_hover'];
		$instance['icon_color'] 				= $new_instance['icon_color'];
		$instance['icon_color_hover'] 			= $new_instance['icon_color_hover'];
		$instance['icon_border_style'] 			= $new_instance['icon_border_style'];
		$instance['icon_border_width'] 			= $new_instance['icon_border_width'];
		$instance['icon_border_color'] 			= $new_instance['icon_border_color'];
		$instance['icon_border_color_hover'] 	= $new_instance['icon_border_color_hover'];
		$instance['effect'] 					= $new_instance['effect'];
		$instance['box_title'] 					= $new_instance['box_title'];
		$instance['text'] 						= $new_instance['text'];
		$instance['apply_link_to'] 				= $new_instance['apply_link_to'];
		$instance['box_title_link'] 			= $new_instance['box_title_link'];
		$instance['box_title_target'] 			= $new_instance['box_title_target'];
		$instance['read_more_link']				= $new_instance['read_more_link'];
		$instance['read_more_target']			= $new_instance['read_more_target'];
		$instance['read_more_text']				= $new_instance['read_more_text'];
		$instance['position'] 					= $new_instance['position'];

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title'     				=> esc_html__( 'Icon Box', 'saha' ),
			'icon'						=> '',
			'icon_size'					=> '35',
			'icon_font_size'			=> '35',
			'icon_line_height'			=> '',
			'icon_border_radius'		=> '',
			'icon_bg'					=> '',
			'icon_bg_hover'				=> '',
			'icon_color'				=> '',
			'icon_color_hover'			=> '',
			'icon_border_style'			=> esc_html__( 'None', 'saha' ),
			'icon_border_width'			=> '',
			'icon_border_color'			=> '',
			'icon_border_color_hover'	=> '',
			'effect'					=> esc_html__( 'None', 'saha' ),
			'box_title'					=> '',
			'text'						=> '',
			'apply_link_to'				=> '',
			'box_title_link'			=> '',
			'box_title_target'			=> esc_html__( 'Blank', 'saha' ),
			'read_more_link'			=> '',
			'read_more_target'			=> esc_html__( 'Blank', 'saha' ),
			'read_more_text'			=> esc_html__( 'Read More', 'saha' ),
			'position'					=> esc_html__( 'Top', 'saha' ),
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
			    $('#widgets-right .color-picker, .inactive-sidebar .color-picker, .so-content .color-picker').wpColorPicker();

			    // Executes wpColorPicker function after AJAX is fired on saving the widget
			    $(document).ajaxComplete(function() {
			        $('#widgets-right .color-picker, .inactive-sidebar .color-picker').wpColorPicker();
			    });

			    $('select.change').on('change', function(event){
			    	var border_select 	= $('select.border-style'),
			    		border 			= $('p.border-field'),
			    		link_select 	= $('select.apply-link'),
			    		title 			= $('p.title-link-field'),
			    		read 			= $('p.read-more-field');

				    if ( border_select.val() === '#' ) {
				    	border.removeClass('visible');
				    } else {
				    	border.addClass('visible');
				    }

				    if ( link_select.val() === '#' ) {
				    	title.removeClass('visible');
				    	read.removeClass('visible');
				    } else if ( link_select.val() === 'box_title' ) {
				    	title.addClass('visible');
				    	read.removeClass('visible');
				    } else if ( link_select.val() === 'read_more' ) {
				    	read.addClass('visible');
				    	title.removeClass('visible');
				    }
				});

			    $('select.change').each(function() {
			    	var border_select 	= $('select.border-style'),
			    		border 			= $('p.border-field'),
			    		link_select 	= $('select.apply-link'),
			    		title 			= $('p.title-link-field'),
			    		read 			= $('p.read-more-field');

				    if ( border_select.val() === '#' ) {
				    	border.removeClass('visible');
				    } else {
				    	border.addClass('visible');
				    }

				    if ( link_select.val() === '#' ) {
				    	title.removeClass('visible');
				    	read.removeClass('visible');
				    } else if ( link_select.val() === 'box_title' ) {
				    	title.addClass('visible');
				    	read.removeClass('visible');
				    } else if ( link_select.val() === 'read_more' ) {
				    	read.addClass('visible');
				    	title.removeClass('visible');
				    }
				});
			});
		</script>

		<style type="text/css">
			.border-field {display: none;}
			.border-field.visible {display: block;}
			.title-link-field {display: none;}
			.title-link-field.visible {display: block;}
			.read-more-field {display: none;}
			.read-more-field.visible {display: block;}
		</style>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'icon' ); ?>">
				<?php _e( 'Enter the Class of Icon:', 'saha' ); ?> <small style="font-size: 11px;"><a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><?php _e( 'Font Awesome', 'saha' ); ?></a> - <a href="http://thesabbir.github.io/simple-line-icons/" target="_blank"><?php _e( 'Simple Line Icons', 'saha' ); ?></a></small>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" value="<?php echo esc_attr( $instance['icon'] ); ?>" />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'icon_size' ); ?>" style="display: block; margin-bottom: 5px; cursor: default;">
				<?php _e( 'Size of Icon:', 'saha' ); ?>
			</label>
			<input type="number" min="12" max="72" step="" id="<?php echo $this->get_field_id( 'icon_size' ); ?>" name="<?php echo $this->get_field_name( 'icon_size' ); ?>" value="<?php echo esc_attr( $instance['icon_size'] ); ?>" style="max-width:100px; margin-right: 10px;" /> <?php _e( 'px', 'saha' ); ?>
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'icon_font_size' ); ?>" style="display: block; margin-bottom: 5px; cursor: default;">
				<?php _e( 'Font Size of Icon:', 'saha' ); ?>
			</label>
			<input type="number" min="12" max="72" step="" id="<?php echo $this->get_field_id( 'icon_font_size' ); ?>" name="<?php echo $this->get_field_name( 'icon_font_size' ); ?>" value="<?php echo esc_attr( $instance['icon_font_size'] ); ?>" style="max-width:100px; margin-right: 10px;" /> <?php _e( 'px', 'saha' ); ?>
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'icon_line_height' ); ?>" style="display: block; margin-bottom: 5px; cursor: default;">
				<?php _e( 'Line Height of Icon:', 'saha' ); ?>
			</label>
			<input type="number" min="1" max="72" step="" id="<?php echo $this->get_field_id( 'icon_line_height' ); ?>" name="<?php echo $this->get_field_name( 'icon_line_height' ); ?>" value="<?php echo esc_attr( $instance['icon_line_height'] ); ?>" style="max-width:100px; margin-right: 10px;" /> <?php _e( 'px', 'saha' ); ?>
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'icon_border_radius' ); ?>" style="display: block; margin-bottom: 5px; cursor: default;">
				<?php _e( 'Border Radius:', 'saha' ); ?>
			</label>
			<input type="number" min="1" max="100" step="" id="<?php echo $this->get_field_id( 'icon_border_radius' ); ?>" name="<?php echo $this->get_field_name( 'icon_border_radius' ); ?>" value="<?php echo esc_attr( $instance['icon_border_radius'] ); ?>" style="max-width:100px; margin-right: 10px;" /> <?php _e( 'px', 'saha' ); ?>
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'icon_bg' ); ?>" style="display: block; margin-bottom: 5px; cursor: default;">
				<?php _e( 'Background Color:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat color-picker" id="<?php echo $this->get_field_id( 'icon_bg' ); ?>" name="<?php echo $this->get_field_name( 'icon_bg' ); ?>" value="<?php echo esc_attr( $instance['icon_bg'] ); ?>" />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'icon_bg_hover' ); ?>" style="display: block; margin-bottom: 5px; cursor: default;">
				<?php _e( 'Background Color Hover:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat color-picker" id="<?php echo $this->get_field_id( 'icon_bg_hover' ); ?>" name="<?php echo $this->get_field_name( 'icon_bg_hover' ); ?>" value="<?php echo esc_attr( $instance['icon_bg_hover'] ); ?>" />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'icon_color' ); ?>" style="display: block; margin-bottom: 5px; cursor: default;">
				<?php _e( 'Color:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat color-picker" id="<?php echo $this->get_field_id( 'icon_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_color' ); ?>" value="<?php echo esc_attr( $instance['icon_color'] ); ?>" />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'icon_color_hover' ); ?>" style="display: block; margin-bottom: 5px; cursor: default;">
				<?php _e( 'Color Hover:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat color-picker" id="<?php echo $this->get_field_id( 'icon_color_hover' ); ?>" name="<?php echo $this->get_field_name( 'icon_color_hover' ); ?>" value="<?php echo esc_attr( $instance['icon_color_hover'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('icon_border_style'); ?>">
				<?php _e( 'Border Style:', 'saha' ); ?>
			</label>
			<select class='widefat change border-style' name="<?php echo $this->get_field_name('icon_border_style'); ?>" id="<?php echo $this->get_field_id('icon_border_style'); ?>">
				<option value="#" <?php if($instance['icon_border_style'] == '#') { ?>selected="selected"<?php } ?>><?php _e( 'None', 'saha' ); ?></option>
				<option value="solid" <?php if($instance['icon_border_style'] == 'solid') { ?>selected="selected"<?php } ?>><?php _e( 'Solid', 'saha'); ?></option>
				<option value="dashed" <?php if($instance['icon_border_style'] == 'dashed') { ?>selected="selected"<?php } ?>><?php _e( 'Dashed', 'saha'); ?></option>
				<option value="dotted" <?php if($instance['icon_border_style'] == 'dotted') { ?>selected="selected"<?php } ?>><?php _e( 'Dotted', 'saha'); ?></option>
				<option value="double" <?php if($instance['icon_border_style'] == 'double') { ?>selected="selected"<?php } ?>><?php _e( 'Double', 'saha'); ?></option>
				<option value="inset" <?php if($instance['icon_border_style'] == 'inset') { ?>selected="selected"<?php } ?>><?php _e( 'Inset', 'saha'); ?></option>
				<option value="outset" <?php if($instance['icon_border_style'] == 'outset') { ?>selected="selected"<?php } ?>><?php _e( 'Outset', 'saha'); ?></option>
			</select>
		</p>

        <p class="border-field">
			<label for="<?php echo $this->get_field_id( 'icon_border_width' ); ?>" style="display: block; margin-bottom: 5px; cursor: default;">
				<?php _e( 'Border Width:', 'saha' ); ?>
			</label>
			<input type="number" min="1" max="10" step="" id="<?php echo $this->get_field_id( 'icon_border_width' ); ?>" name="<?php echo $this->get_field_name( 'icon_border_width' ); ?>" value="<?php echo esc_attr( $instance['icon_border_width'] ); ?>" style="max-width:100px; margin-right: 10px;" /> <?php _e( 'px', 'saha' ); ?>
		</p>

        <p class="border-field">
			<label for="<?php echo $this->get_field_id( 'icon_border_color' ); ?>" style="display: block; margin-bottom: 5px; cursor: default;">
				<?php _e( 'Border Color:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat color-picker" id="<?php echo $this->get_field_id( 'icon_border_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_border_color' ); ?>" value="<?php echo esc_attr( $instance['icon_border_color'] ); ?>" />
		</p>

        <p class="border-field">
			<label for="<?php echo $this->get_field_id( 'icon_border_color_hover' ); ?>" style="display: block; margin-bottom: 5px; cursor: default;">
				<?php _e( 'Border Color Hover:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat color-picker" id="<?php echo $this->get_field_id( 'icon_border_color_hover' ); ?>" name="<?php echo $this->get_field_name( 'icon_border_color_hover' ); ?>" value="<?php echo esc_attr( $instance['icon_border_color_hover'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('effect'); ?>">
				<?php _e( 'Animation:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('effect'); ?>" id="<?php echo $this->get_field_id('effect'); ?>">
				<option value="" <?php if($instance['effect'] == '') { ?>selected="selected"<?php } ?>><?php _e( 'None', 'saha' ); ?></option>
				<option value="bounce" <?php if($instance['effect'] == 'bounce') { ?>selected="selected"<?php } ?>><?php _e( 'Bounce', 'saha' ); ?></option>
				<option value="flash" <?php if($instance['effect'] == 'flash') { ?>selected="selected"<?php } ?>><?php _e( 'Flash', 'saha' ); ?></option>
				<option value="pulse" <?php if($instance['effect'] == 'pulse') { ?>selected="selected"<?php } ?>><?php _e( 'Pulse', 'saha' ); ?></option>
				<option value="rubberBand" <?php if($instance['effect'] == 'rubberBand') { ?>selected="selected"<?php } ?>><?php _e( 'Rubber Band', 'saha' ); ?></option>
				<option value="shake" <?php if($instance['effect'] == 'shake') { ?>selected="selected"<?php } ?>><?php _e( 'Shake', 'saha' ); ?></option>
				<option value="swing" <?php if($instance['effect'] == 'swing') { ?>selected="selected"<?php } ?>><?php _e( 'Swing', 'saha' ); ?></option>
				<option value="tada" <?php if($instance['effect'] == 'tada') { ?>selected="selected"<?php } ?>><?php _e( 'Tada', 'saha' ); ?></option>
				<option value="wobble" <?php if($instance['effect'] == 'wobble') { ?>selected="selected"<?php } ?>><?php _e( 'Wobble', 'saha' ); ?></option>
				<option value="jello" <?php if($instance['effect'] == 'jello') { ?>selected="selected"<?php } ?>><?php _e( 'Jello', 'saha' ); ?></option>
				<option value="bounceIn" <?php if($instance['effect'] == 'bounceIn') { ?>selected="selected"<?php } ?>><?php _e( 'Bounce In', 'saha' ); ?></option>
				<option value="bounceInDown" <?php if($instance['effect'] == 'bounceInDown') { ?>selected="selected"<?php } ?>><?php _e( 'Bounce In Down', 'saha' ); ?></option>
				<option value="bounceInLeft" <?php if($instance['effect'] == 'bounceInLeft') { ?>selected="selected"<?php } ?>><?php _e( 'Bounce In Left', 'saha' ); ?></option>
				<option value="bounceInRight" <?php if($instance['effect'] == 'bounceInRight') { ?>selected="selected"<?php } ?>><?php _e( 'Bounce In Right', 'saha' ); ?></option>
				<option value="bounceInUp" <?php if($instance['effect'] == 'bounceInUp') { ?>selected="selected"<?php } ?>><?php _e( 'Bounce In Up', 'saha' ); ?></option>
				<option value="fadeIn" <?php if($instance['effect'] == 'fadeIn') { ?>selected="selected"<?php } ?>><?php _e( 'Fade In', 'saha' ); ?></option>
				<option value="fadeInDown" <?php if($instance['effect'] == 'fadeInDown') { ?>selected="selected"<?php } ?>><?php _e( 'Fade In Down', 'saha' ); ?></option>
				<option value="fadeInDownBig" <?php if($instance['effect'] == 'fadeInDownBig') { ?>selected="selected"<?php } ?>><?php _e( 'Fade In Down Big', 'saha' ); ?></option>
				<option value="fadeInLeft" <?php if($instance['effect'] == 'fadeInLeft') { ?>selected="selected"<?php } ?>><?php _e( 'Fade In Left', 'saha' ); ?></option>
				<option value="fadeInLeftBig" <?php if($instance['effect'] == 'fadeInLeftBig') { ?>selected="selected"<?php } ?>><?php _e( 'Fade In Left Big', 'saha' ); ?></option>
				<option value="fadeInRight" <?php if($instance['effect'] == 'fadeInRight') { ?>selected="selected"<?php } ?>><?php _e( 'Fade In Right', 'saha' ); ?></option>
				<option value="fadeInRightBig" <?php if($instance['effect'] == 'fadeInRightBig') { ?>selected="selected"<?php } ?>><?php _e( 'Fade In Right Big', 'saha' ); ?></option>
				<option value="fadeInUp" <?php if($instance['effect'] == 'fadeInUp') { ?>selected="selected"<?php } ?>><?php _e( 'Fade In Up', 'saha' ); ?></option>
				<option value="fadeInUpBig" <?php if($instance['effect'] == 'fadeInUpBig') { ?>selected="selected"<?php } ?>><?php _e( 'Fade In Up Big', 'saha' ); ?></option>
				<option value="flip" <?php if($instance['effect'] == 'flip') { ?>selected="selected"<?php } ?>><?php _e( 'Flip', 'saha' ); ?></option>
				<option value="flipInX" <?php if($instance['effect'] == 'flipInX') { ?>selected="selected"<?php } ?>><?php _e( 'Flip In X', 'saha' ); ?></option>
				<option value="flipInY" <?php if($instance['effect'] == 'flipInY') { ?>selected="selected"<?php } ?>><?php _e( 'Flip In Y', 'saha' ); ?></option>
				<option value="lightSpeedIn" <?php if($instance['effect'] == 'lightSpeedIn') { ?>selected="selected"<?php } ?>><?php _e( 'Light Speed In', 'saha' ); ?></option>
				<option value="rotateIn" <?php if($instance['effect'] == 'rotateIn') { ?>selected="selected"<?php } ?>><?php _e( 'Rotate In', 'saha' ); ?></option>
				<option value="rotateInDownLeft" <?php if($instance['effect'] == 'rotateInDownLeft') { ?>selected="selected"<?php } ?>><?php _e( 'Rotate In Down Left', 'saha' ); ?></option>
				<option value="rotateInDownRight" <?php if($instance['effect'] == 'rotateInDownRight') { ?>selected="selected"<?php } ?>><?php _e( 'Rotate In Down Right', 'saha' ); ?></option>
				<option value="rotateInUpLeft" <?php if($instance['effect'] == 'rotateInUpLeft') { ?>selected="selected"<?php } ?>><?php _e( 'Rotate In Up Left', 'saha' ); ?></option>
				<option value="rotateInUpRight" <?php if($instance['effect'] == 'rotateInUpRight') { ?>selected="selected"<?php } ?>><?php _e( 'Rotate In Up Right', 'saha' ); ?></option>
				<option value="hinge" <?php if($instance['effect'] == 'hinge') { ?>selected="selected"<?php } ?>><?php _e( 'Hinge', 'saha' ); ?></option>
				<option value="rollIn" <?php if($instance['effect'] == 'rollIn') { ?>selected="selected"<?php } ?>><?php _e( 'Roll In', 'saha' ); ?></option>
				<option value="zoomIn" <?php if($instance['effect'] == 'zoomIn') { ?>selected="selected"<?php } ?>><?php _e( 'Zoom In', 'saha' ); ?></option>
				<option value="zoomInDown" <?php if($instance['effect'] == 'zoomInDown') { ?>selected="selected"<?php } ?>><?php _e( 'Zoom In Down', 'saha' ); ?></option>
				<option value="zoomInLeft" <?php if($instance['effect'] == 'zoomInLeft') { ?>selected="selected"<?php } ?>><?php _e( 'Zoom In Left', 'saha' ); ?></option>
				<option value="zoomInRight" <?php if($instance['effect'] == 'zoomInRight') { ?>selected="selected"<?php } ?>><?php _e( 'Zoom In Right', 'saha' ); ?></option>
				<option value="zoomInUp" <?php if($instance['effect'] == 'zoomInUp') { ?>selected="selected"<?php } ?>><?php _e( 'Zoom In Up', 'saha' ); ?></option>
				<option value="slideInDown" <?php if($instance['effect'] == 'slideInDown') { ?>selected="selected"<?php } ?>><?php _e( 'Slide In Down', 'saha' ); ?></option>
				<option value="slideInLeft" <?php if($instance['effect'] == 'slideInLeft') { ?>selected="selected"<?php } ?>><?php _e( 'Slide In Left', 'saha' ); ?></option>
				<option value="slideInRight" <?php if($instance['effect'] == 'slideInRight') { ?>selected="selected"<?php } ?>><?php _e( 'Slide In Right', 'saha' ); ?></option>
				<option value="slideInUp" <?php if($instance['effect'] == 'slideInUp') { ?>selected="selected"<?php } ?>><?php _e( 'Slide In Up', 'saha' ); ?></option>
			</select>
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'box_title' ); ?>">
				<?php _e( 'Title:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'box_title' ); ?>" name="<?php echo $this->get_field_name( 'box_title' ); ?>" value="<?php echo esc_attr( $instance['box_title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>">
				<?php _e( 'Description:' , 'saha') ?>
			</label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" class="widefat" style="height: 150px;"><?php if( !empty( $instance['text'] ) ) { echo $instance['text']; } ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('apply_link_to'); ?>">
				<?php _e( 'Apply Link To:', 'saha' ); ?>
			</label>
			<select class='widefat change apply-link' name="<?php echo $this->get_field_name('apply_link_to'); ?>" id="<?php echo $this->get_field_id('apply_link_to'); ?>">
				<option value="#" <?php if($instance['apply_link_to'] == '#') { ?>selected="selected"<?php } ?>><?php _e( 'No Link', 'saha' ); ?></option>
				<option value="box_title" <?php if($instance['apply_link_to'] == 'box_title') { ?>selected="selected"<?php } ?>><?php _e( 'Box Title', 'saha'); ?></option>
				<option value="read_more" <?php if($instance['apply_link_to'] == 'read_more') { ?>selected="selected"<?php } ?>><?php _e( 'Display Read More', 'saha'); ?></option>
			</select>
		</p>

		<p class="title-link-field">
			<label for="<?php echo $this->get_field_id( 'box_title_link' ); ?>">
				<?php _e( 'Title Link:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'box_title_link' ); ?>" name="<?php echo $this->get_field_name( 'box_title_link' ); ?>" value="<?php echo esc_attr( $instance['box_title_link'] ); ?>" />
		</p>

		<p class="title-link-field">
			<label for="<?php echo $this->get_field_id('box_title_target'); ?>">
				<?php _e( 'Title Link Target:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('box_title_target'); ?>" id="<?php echo $this->get_field_id('box_title_target'); ?>">
				<option value="blank" <?php if($instance['box_title_target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'saha' ); ?></option>
				<option value="self" <?php if($instance['box_title_target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'saha'); ?></option>
			</select>
		</p>

		<p class="read-more-field">
			<label for="<?php echo $this->get_field_id( 'read_more_link' ); ?>">
				<?php _e( 'Read More Link:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'read_more_link' ); ?>" name="<?php echo $this->get_field_name( 'read_more_link' ); ?>" value="<?php echo esc_attr( $instance['read_more_link'] ); ?>" />
		</p>

		<p class="read-more-field">
			<label for="<?php echo $this->get_field_id('read_more_target'); ?>">
				<?php _e( 'Read More Link Target:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('read_more_target'); ?>" id="<?php echo $this->get_field_id('read_more_target'); ?>">
				<option value="blank" <?php if($instance['read_more_target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'saha' ); ?></option>
				<option value="self" <?php if($instance['read_more_target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'saha'); ?></option>
			</select>
		</p>

		<p class="read-more-field">
			<label for="<?php echo $this->get_field_id( 'read_more_text' ); ?>">
				<?php _e( 'Read More Text:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'read_more_text' ); ?>" name="<?php echo $this->get_field_name( 'read_more_text' ); ?>" value="<?php echo esc_attr( $instance['read_more_text'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('position'); ?>">
				<?php _e( 'Box Style:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('position'); ?>" id="<?php echo $this->get_field_id('position'); ?>">
				<option value="top" <?php if($instance['position'] == 'top') { ?>selected="selected"<?php } ?>><?php _e( 'Icon at Top', 'saha' ); ?></option>
				<option value="left" <?php if($instance['position'] == 'left') { ?>selected="selected"<?php } ?>><?php _e( 'Icon at Left', 'saha' ); ?></option>
				<option value="right" <?php if($instance['position'] == 'right') { ?>selected="selected"<?php } ?>><?php _e( 'Icon at Right', 'saha' ); ?></option>
			</select>
		</p>

	<?php

	}

}