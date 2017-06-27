<?php
/**
 * Banner Widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Banner_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-banner banner-widget',
			'description' => __( 'Displays a banner with text.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-banner',                   // $this->id_base
			__( '&raquo; Banner', 'saha' ), // $this->name
			$widget_options                 // $this->widget_options
		);

		add_action('admin_enqueue_scripts', array($this, 'saha_banner_scripts'));
	}

    /**
     * Upload the Javascripts for the media uploader
     */
    function saha_banner_scripts() {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('upload_media_widget', trailingslashit( get_template_directory_uri() ) . 'inc/widgets/js/upload-media.js', array('jquery'));

        wp_enqueue_style('thickbox');
    }

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$src 				= $instance['src'];
		$alt 				= $instance['alt'];
		$custom_class 		= $instance['custom_class'];
		$image_hover 		= $instance['image_hover'];
		$width 				= $instance['width'];
		$height 			= $instance['height'];
		$content_align 		= $instance['content_align'];
		$content_position 	= $instance['content_position'];
		$content 			= $instance['content'];
		$button 			= $instance['button'];
		$button_style 		= $instance['button_style'];
		$button_link 		= $instance['button_link'];
		$button_target 		= $instance['button_target'];
		$button_text 		= $instance['button_text'];

		// Image url
		$image_src = saha_image_resize( $src, $width, $height );

		// Classes
		$classes = '';

		// Image hover
		if ( '' != $image_hover && 'none' != $image_hover ) {
      		$classes .= $image_hover;
		}

		// If custom class
		if ( $custom_class ) {
      		$classes .= ' '. $custom_class .'';
		}

		// Content align
		if ( 'left' == $content_align ) {
      		$classes .= ' saha-left';
		} else if ( 'center' == $content_align ) {
      		$classes .= ' saha-center';
		} else if ( 'right' == $content_align ) {
      		$classes .= ' saha-right';
		}

		// Content position
		if ( 'top' == $content_position ) {
      		$classes .= '';
		} else if ( 'middle' == $content_position ) {
      		$classes .= ' valign-middle';
		} else if ( 'bottom' == $content_position ) {
      		$classes .= ' valign-bottom';
		}

		// If button
		if ( 'yes' == $button && $button_link ) {
      		$classes .= ' saha-has-button';
		}

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			echo '<div class="saha-banner-wrap clr '. esc_attr( $classes ) .'">';
				echo '<div class="saha-banner-content">';
					echo '<div class="saha-banner-inner">';
						echo do_shortcode( $content );
					echo '</div>';
				echo '</div>';
				if ( 'yes' == $button && $button_link ) {
					echo '<div class="saha-button">';
						echo '<a class="'. esc_attr( $button_style ) .'" href="'. esc_attr( $button_link ) .'" target="_'. esc_attr( $button_target ) .'">'. esc_attr( $button_text ) .'</a>';
					echo '</div>';
				}
				if ( $src ) {
		      		echo '<img alt="'. esc_attr( $alt ) .'" src="'. esc_url( $image_src['url'] ) .'" width="'. esc_attr( $image_src['width'] ) .'" height="'. esc_attr( $image_src['height'] ) .'"/>';
				}
				echo '</div>';
		
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

		$instance['title']   			= strip_tags( $new_instance['title'] );
		$instance['custom_class'] 		= $new_instance['custom_class'];
		$instance['src'] 				= $new_instance['src'];
		$instance['alt'] 				= $new_instance['alt'];
		$instance['image_hover'] 		= $new_instance['image_hover'];
		$instance['width'] 				= $new_instance['width'];
		$instance['height'] 			= $new_instance['height'];
		$instance['content_align'] 		= $new_instance['content_align'];
		$instance['content_position'] 	= $new_instance['content_position'];
		$instance['content'] 			= $new_instance['content'];		
		$instance['button'] 			= $new_instance['button'];		
		$instance['button_style'] 		= $new_instance['button_style'];		
		$instance['button_link'] 		= $new_instance['button_link'];		
		$instance['button_target'] 		= $new_instance['button_target'];		
		$instance['button_text'] 		= $new_instance['button_text'];	

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
			'title'   			=> esc_html__( 'Banner', 'saha' ),
			'custom_class' 		=> '',
			'src' 				=> '',
			'alt' 				=> '',
			'image_hover' 		=> esc_html__('Fade','saha'),
			'width' 			=> '',
			'height' 			=> '',
			'content_align' 	=> esc_html__('Center','saha'),
			'content_position' 	=> esc_html__('Middle','saha'),
			'content' 			=> '',
			'button' 			=> esc_html__('Yes','saha'),
			'button_style' 		=> '',
			'button_link' 		=> '#',
			'button_target' 	=> 'blank',
			'button_text' 		=> esc_html__('Read More','saha'),
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'custom_class' ); ?>">
				<?php _e( 'Custom Wrap Class:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'custom_class' ); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" value="<?php echo esc_attr( $instance['custom_class'] ); ?>" />
		</p>

		<p>
            <label for="<?php echo $this->get_field_id('src'); ?>">
            	<?php _e( 'Upload Image:', 'saha' ); ?>
            </label>
            <small style="font-size: 11px;margin-left: 3px;"><?php _e( 'select image full size', 'saha' ); ?></small>
            <input name="<?php echo $this->get_field_name('src'); ?>" id="<?php echo $this->get_field_id('src'); ?>" class="widefat" type="text" size="36" value="<?php echo esc_attr( $instance['src'] ); ?>" />
            <input class="saha_upload_image_button button-primary" type="button" value="<?php _e( 'Upload Image', 'saha' ); ?>" style="margin-top: 10px;" />
        </p>

        <p>
			<label for="<?php echo $this->get_field_id( 'alt' ); ?>">
				<?php _e( 'Image Alt:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'alt' ); ?>" name="<?php echo $this->get_field_name( 'alt' ); ?>" value="<?php echo esc_attr( $instance['alt'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('image_hover'); ?>">
				<?php _e( 'Image Hover:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('image_hover'); ?>" id="<?php echo $this->get_field_id('image_hover'); ?>">
				<option value="none" <?php if($instance['image_hover'] == 'none') { ?>selected="selected"<?php } ?>><?php _e( 'None', 'saha' ); ?></option>
				<option value="saha-fade" <?php if($instance['image_hover'] == 'saha-fade') { ?>selected="selected"<?php } ?>><?php _e( 'Fade', 'saha' ); ?></option>
				<option value="saha-grow" <?php if($instance['image_hover'] == 'saha-grow') { ?>selected="selected"<?php } ?>><?php _e( 'Grow', 'saha'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>">
				<?php _e('Image Width:', 'saha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $instance['width'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>">
				<?php _e('Image Height:', 'saha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $instance['height'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('content_align'); ?>">
				<?php _e( 'Content Align:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('content_align'); ?>" id="<?php echo $this->get_field_id('content_align'); ?>">
				<option value="left" <?php if($instance['content_align'] == 'left') { ?>selected="selected"<?php } ?>><?php _e( 'Left', 'saha' ); ?></option>
				<option value="center" <?php if($instance['content_align'] == 'center') { ?>selected="selected"<?php } ?>><?php _e( 'Center', 'saha' ); ?></option>
				<option value="right" <?php if($instance['content_align'] == 'right') { ?>selected="selected"<?php } ?>><?php _e( 'Right', 'saha'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('content_position'); ?>">
				<?php _e( 'Content Position:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('content_position'); ?>" id="<?php echo $this->get_field_id('content_position'); ?>">
				<option value="top" <?php if($instance['content_position'] == 'top') { ?>selected="selected"<?php } ?>><?php _e( 'Top', 'saha' ); ?></option>
				<option value="middle" <?php if($instance['content_position'] == 'middle') { ?>selected="selected"<?php } ?>><?php _e( 'Middle', 'saha' ); ?></option>
				<option value="bottom" <?php if($instance['content_position'] == 'bottom') { ?>selected="selected"<?php } ?>><?php _e( 'Bottom', 'saha'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'content' ); ?>">
				<?php _e( 'Content:' , 'saha') ?>
			</label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" class="widefat" style="height: 150px;"><?php if( !empty( $instance['content'] ) ) { echo $instance['content']; } ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('button'); ?>">
				<?php _e( 'Button:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('button'); ?>" id="<?php echo $this->get_field_id('button'); ?>">
				<option value="yes" <?php if($instance['button'] == 'yes') { ?>selected="selected"<?php } ?>><?php _e( 'Yes', 'saha' ); ?></option>
				<option value="no" <?php if($instance['button'] == 'no') { ?>selected="selected"<?php } ?>><?php _e( 'No', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('button_style'); ?>">
				<?php _e( 'Button Style:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('button_style'); ?>" id="<?php echo $this->get_field_id('button_style'); ?>">
				<option value="black" <?php if($instance['button_style'] == 'black') { ?>selected="selected"<?php } ?>><?php _e( 'Black', 'saha' ); ?></option>
				<option value="blue" <?php if($instance['button_style'] == 'blue') { ?>selected="selected"<?php } ?>><?php _e( 'Blue', 'saha' ); ?></option>
				<option value="brown" <?php if($instance['button_style'] == 'brown') { ?>selected="selected"<?php } ?>><?php _e( 'Brown', 'saha' ); ?></option>
				<option value="green" <?php if($instance['button_style'] == 'green') { ?>selected="selected"<?php } ?>><?php _e( 'Green', 'saha' ); ?></option>
				<option value="gold" <?php if($instance['button_style'] == 'gold') { ?>selected="selected"<?php } ?>><?php _e( 'Gold', 'saha' ); ?></option>
				<option value="pink" <?php if($instance['button_style'] == 'pink') { ?>selected="selected"<?php } ?>><?php _e( 'Pink', 'saha' ); ?></option>
				<option value="purple" <?php if($instance['button_style'] == 'purple') { ?>selected="selected"<?php } ?>><?php _e( 'Purple', 'saha' ); ?></option>
				<option value="red" <?php if($instance['button_style'] == 'red') { ?>selected="selected"<?php } ?>><?php _e( 'Red', 'saha' ); ?></option>
				<option value="white" <?php if($instance['button_style'] == 'white') { ?>selected="selected"<?php } ?>><?php _e( 'White', 'saha' ); ?></option>
				<option value="yellow" <?php if($instance['button_style'] == 'yellow') { ?>selected="selected"<?php } ?>><?php _e( 'Yellow', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'button_link' ); ?>">
				<?php _e('Button Link:', 'saha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'button_link' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'button_link' ); ?>" type="text" value="<?php echo esc_url( $instance['button_link'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('button_target'); ?>">
				<?php _e( 'Button Target:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('button_target'); ?>" id="<?php echo $this->get_field_id('button_target'); ?>">
				<option value="blank" <?php if($instance['button_target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'saha' ); ?></option>
				<option value="self" <?php if($instance['button_target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'saha'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>">
				<?php _e('Button Text:', 'saha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'button_text' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $instance['button_text'] ); ?>" size="3" />
		</p>

	<?php

	}

}