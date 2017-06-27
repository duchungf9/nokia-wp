<?php
/**
 * Slider Widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Slider_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-slider slider-widget',
			'description' => __( 'Diplays a slider with content.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-slider', 					// $this->id_base
			__( '&raquo; Slider', 'saha' ), // $this->name
			$widget_options                 // $this->widget_options
		);

		add_action('admin_enqueue_scripts', array($this, 'saha_slider_scripts'));
	}

    /**
     * Upload the Javascripts for the media uploader
     */
    function saha_slider_scripts() {
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
		$navigation 	= $instance['navigation'];
		$dots 			= $instance['dots'];
		$controls_color = $instance['controls_color'];
		$speed 			= $instance['speed'];
		$count 			= $instance['count'];
		$width 			= isset( $instance['width'] ) ? $instance['width']: '';
		$height 		= isset( $instance['height'] ) ? $instance['height']: '';

		// Class
		$class = '';

		// Controls color
		if ( 'white' == $controls_color ) {
      		$class .= ' white';
		} else if ( 'black' == $controls_color ) {
      		$class .= ' black';
		}

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			echo'<div class="saha-slider-wrap clr'. esc_attr( $class ) .'">';
				echo'<ul class="saha-slider owl-carousel owl-theme" data-navigation="'. esc_attr( $navigation ) .'" data-dots="'. esc_attr( $dots ) .'" data-slidespeed="'. esc_attr( $speed ) .'">';
					if ( $count !== '0' ) {
						for ( $i=1; $i<=$count; $i++ ) {
							$image_src 			= '';
							$src 				= $instance["src_".$i];
							$alt 				= isset( $instance["alt_".$i] ) ? $instance["alt_".$i]:'';
							$content 			= $instance["content_".$i];
							$content_align 		= isset( $instance["content_align_".$i] ) ? $instance["content_align_".$i] : '';
							$content_position 	= isset( $instance["content_position_".$i] ) ? $instance["content_position_".$i] : '';

							// Classes
							$classes = '';

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
					      		$classes .= ' valign-top';
							} else if ( 'top-left' == $content_position ) {
					      		$classes .= ' valign-top-left';
							} else if ( 'top-right' == $content_position ) {
					      		$classes .= ' valign-top-right';
							} else if ( 'middle' == $content_position ) {
					      		$classes .= ' valign-middle';
							} else if ( 'middle-left' == $content_position ) {
					      		$classes .= ' valign-middle-left';
							} else if ( 'middle-right' == $content_position ) {
					      		$classes .= ' valign-middle-right';
							} else if ( 'bottom' == $content_position ) {
					      		$classes .= ' valign-bottom';
							} else if ( 'bottom-left' == $content_position ) {
					      		$classes .= ' valign-bottom-left';
							} else if ( 'bottom-right' == $content_position ) {
					      		$classes .= ' valign-bottom-right';
							}

							if ( !empty( $src ) ) {
								$image_src 	= saha_image_resize( $src, $width, $height );
							}

							echo'<li class="'. esc_attr( $classes ) .'">';

								echo '<div class="slider-content-wrap container">';
									echo '<div class="slider-content">';
										echo do_shortcode( $content );
									echo '</div>';
								echo '</div>';

								if ( !empty( $image_src ) ) {
									echo'<img src="'. esc_url( $image_src['url'] ) .'" width="'. esc_attr( $width ) .'" height="'. esc_attr( $height ) .'" alt="'. esc_attr( $alt ) .'" />';
								}

							echo'</li>';

						}
					}
				echo'</ul>';
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

		$instance['title']      	= strip_tags( $new_instance['title'] );
		$instance['navigation'] 	= !empty( $new_instance['navigation'] ) ? strip_tags( $new_instance['navigation'] ) : 'true';
		$instance['dots'] 			= !empty( $new_instance['dots'] ) ? strip_tags( $new_instance['dots'] ) : 'true';
		$instance['controls_color'] = !empty( $new_instance['controls_color'] ) ? strip_tags( $new_instance['controls_color'] ) : 'white';
		$instance['speed'] 			= !empty( $new_instance['speed'] ) ? strip_tags( $new_instance['speed'] ) : 7000;
		$instance['count'] 			= !empty( $new_instance['count'] ) ? strip_tags( $new_instance['count'] ) : 3;
		$instance['width'] 			= !empty( $new_instance['width'] ) ? strip_tags( $new_instance['width'] ) : '';
		$instance['height'] 		= !empty( $new_instance['height'] ) ? strip_tags( $new_instance['height'] ) : '';

		for ( $i=1;$i<=$instance['count'];$i++ ) {
			$instance["src_".$i] 				= $new_instance['src_'.$i];
			$instance["alt_".$i] 				= !empty( $new_instance['alt_'.$i] ) ? strip_tags( $new_instance['alt_'.$i] ) : '';
			$instance["content_".$i] 			= $new_instance['content_'.$i];
			$instance["content_align_".$i] 		= !empty( $new_instance['content_align_'.$i] ) ? strip_tags( $new_instance['content_align_'.$i] ) : 'center';
			$instance["content_position_".$i] 	= !empty( $new_instance['content_position_'.$i] ) ? strip_tags( $new_instance['content_position_'.$i] ) : 'middle';
		}

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
			'title'   			=> esc_html__( 'Slider', 'saha' ),
			'navigation'		=> true,
			'dots'				=> true,
			'controls_color'	=> esc_html__( 'White', 'saha' ),
			'speed'				=> '7000',
			'count'				=> '3',
			'width'				=> '',
			'height'			=> '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		for ( $i=1;$i<=15;$i++ ) {
			$src 				= 'src_'.$i;
			$alt 				= 'alt_'.$i;
			$$alt 				= isset( $instance[$alt] ) ? $instance[$alt] : '';
			$content 			= 'content_'.$i;
			$content_align 		= 'content_align_'.$i;
			$$content_align 	= isset( $instance[$content_align] ) ? $instance[$content_align] : esc_html__('Center','saha');
			$content_position 	= 'content_position_'.$i;
			$$content_position 	= isset( $instance[$content_position] ) ? $instance[$content_position] : esc_html__('Middle','saha');
		} ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>">
				<?php _e('Images width', 'saha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $instance['width'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>">
				<?php _e('Images height', 'saha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $instance['height'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('navigation'); ?>">
				<?php _e( 'Navigation:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('navigation'); ?>" id="<?php echo $this->get_field_id('navigation'); ?>">
				<option value="true" <?php if($instance['navigation'] == 'true') { ?>selected="selected"<?php } ?>><?php _e( 'True', 'saha' ); ?></option>
				<option value="false" <?php if($instance['navigation'] == 'false') { ?>selected="selected"<?php } ?>><?php _e( 'False', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('dots'); ?>">
				<?php _e( 'Dots:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('dots'); ?>" id="<?php echo $this->get_field_id('dots'); ?>">
				<option value="true" <?php if($instance['dots'] == 'true') { ?>selected="selected"<?php } ?>><?php _e( 'True', 'saha' ); ?></option>
				<option value="false" <?php if($instance['dots'] == 'false') { ?>selected="selected"<?php } ?>><?php _e( 'False', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('controls_color'); ?>">
				<?php _e( 'Controls Color:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('controls_color'); ?>" id="<?php echo $this->get_field_id('controls_color'); ?>">
				<option value="white" <?php if($instance['controls_color'] == 'white') { ?>selected="selected"<?php } ?>><?php _e( 'White', 'saha' ); ?></option>
				<option value="black" <?php if($instance['controls_color'] == 'black') { ?>selected="selected"<?php } ?>><?php _e( 'Black', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('speed'); ?>">
				<?php _e( 'Slide Speed', 'saha' ); ?>
			</label> 
			<input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo esc_attr( $instance['speed'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">
				<?php _e( 'How many slides?', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>">
				<option value="1" <?php if($instance['count'] == '1') { ?>selected="selected"<?php } ?>><?php _e( '1', 'saha' ); ?></option>
				<option value="2" <?php if($instance['count'] == '2') { ?>selected="selected"<?php } ?>><?php _e( '2', 'saha'); ?></option>
				<option value="3" <?php if($instance['count'] == '3') { ?>selected="selected"<?php } ?>><?php _e( '3', 'saha'); ?></option>
				<option value="4" <?php if($instance['count'] == '4') { ?>selected="selected"<?php } ?>><?php _e( '4', 'saha'); ?></option>
				<option value="5" <?php if($instance['count'] == '5') { ?>selected="selected"<?php } ?>><?php _e( '5', 'saha'); ?></option>
				<option value="6" <?php if($instance['count'] == '6') { ?>selected="selected"<?php } ?>><?php _e( '6', 'saha'); ?></option>
				<option value="7" <?php if($instance['count'] == '7') { ?>selected="selected"<?php } ?>><?php _e( '7', 'saha'); ?></option>
				<option value="8" <?php if($instance['count'] == '8') { ?>selected="selected"<?php } ?>><?php _e( '8', 'saha'); ?></option>
				<option value="9" <?php if($instance['count'] == '9') { ?>selected="selected"<?php } ?>><?php _e( '9', 'saha'); ?></option>
				<option value="10" <?php if($instance['count'] == '10') { ?>selected="selected"<?php } ?>><?php _e( '10', 'saha'); ?></option>
				<option value="11" <?php if($instance['count'] == '11') { ?>selected="selected"<?php } ?>><?php _e( '11', 'saha'); ?></option>
				<option value="12" <?php if($instance['count'] == '12') { ?>selected="selected"<?php } ?>><?php _e( '12', 'saha'); ?></option>
				<option value="13" <?php if($instance['count'] == '13') { ?>selected="selected"<?php } ?>><?php _e( '13', 'saha'); ?></option>
				<option value="14" <?php if($instance['count'] == '14') { ?>selected="selected"<?php } ?>><?php _e( '14', 'saha'); ?></option>
				<option value="15" <?php if($instance['count'] == '15') { ?>selected="selected"<?php } ?>><?php _e( '15', 'saha'); ?></option>
			</select>
		</p>

		<div class="slider_custom_wrap" style="margin-top:50px;">
			<?php for ( $i=1;$i<=15;$i++ ): $src = 'src_'.$i; $alt = 'alt_'.$i; $content = 'content_'.$i; $content_align = 'content_align_'.$i; $content_position = 'content_position_'.$i; ?>
				<div class="slider_custom_<?php echo $i;?>" <?php if ( $i>$instance['count'] ):?>style="display:none;"<?php endif;?> style="padding-bottom:10px">
					<p>
			            <label for="<?php echo $this->get_field_id( $src ); ?>">
			            	<?php printf( '#%s Upload Image:', $i );?>
			            </label>
			            <small style="font-size: 11px;margin-left: 3px;"><?php _e( 'select image full size', 'saha' ); ?></small>
			            <input name="<?php echo $this->get_field_name( $src ); ?>" id="<?php echo $this->get_field_id( $src ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_attr( $instance[ $src ] ); ?>" />
            			<input class="saha_upload_image_button button-primary" type="button" value="<?php _e( 'Upload Image', 'saha' ); ?>" style="margin-top: 10px;" />
			        </p>

					<p>
						<label for="<?php echo $this->get_field_id( $alt ); ?>">
							<?php printf( '#%s Image ALT:', $i );?>
						</label>
						<input class="widefat" id="<?php echo $this->get_field_id( $alt ); ?>" name="<?php echo $this->get_field_name( $alt ); ?>" type="text" value="<?php echo esc_attr( $$alt ); ?>" />
					</p>

					<p>
						<label for="<?php echo $this->get_field_id( $content ); ?>">
							<?php printf( '#%s Slider Content:', $i );?>
						</label>
						<textarea rows="15" id="<?php echo $this->get_field_id( $content ); ?>" name="<?php echo $this->get_field_name( $content ); ?>" class="widefat" style="height: 150px;"><?php if( !empty( $instance[ $content ] ) ) { echo $instance[ $content ]; } ?></textarea>
					</p>

					<p>
						<label for="<?php echo $this->get_field_id( $content_align ); ?>">
							<?php printf( '#%s Content Align:', $i );?>
						</label>
						<select class='widefat' name="<?php echo $this->get_field_name( $content_align ); ?>" id="<?php echo $this->get_field_id( $content_align ); ?>">
							<option value="left" <?php if($$content_align == 'left') { ?>selected="selected"<?php } ?>><?php _e( 'Left', 'saha' ); ?></option>
							<option value="center" <?php if($$content_align == 'center') { ?>selected="selected"<?php } ?>><?php _e( 'Center', 'saha' ); ?></option>
							<option value="right" <?php if($$content_align == 'right') { ?>selected="selected"<?php } ?>><?php _e( 'Right', 'saha'); ?></option>
						</select>
					</p>

					<p>
						<label for="<?php echo $this->get_field_id( $content_position ); ?>">
							<?php printf( '#%s Content Position:', $i );?>
						</label>
						<select class='widefat' name="<?php echo $this->get_field_name( $content_position ); ?>" id="<?php echo $this->get_field_id( $content_position ); ?>">
							<option value="top" <?php if($$content_position == 'top') { ?>selected="selected"<?php } ?>><?php _e( 'Top', 'saha' ); ?></option>
							<option value="top-left" <?php if($$content_position == 'top-left') { ?>selected="selected"<?php } ?>><?php _e( 'Top Left', 'saha' ); ?></option>
							<option value="top-right" <?php if($$content_position == 'top-right') { ?>selected="selected"<?php } ?>><?php _e( 'Top Right', 'saha' ); ?></option>
							<option value="middle" <?php if($$content_position == 'middle') { ?>selected="selected"<?php } ?>><?php _e( 'Middle', 'saha' ); ?></option>
							<option value="middle-left" <?php if($$content_position == 'middle-left') { ?>selected="selected"<?php } ?>><?php _e( 'Middle Left', 'saha' ); ?></option>
							<option value="middle-right" <?php if($$content_position == 'middle-right') { ?>selected="selected"<?php } ?>><?php _e( 'Middle Right', 'saha' ); ?></option>
							<option value="bottom" <?php if($$content_position == 'bottom') { ?>selected="selected"<?php } ?>><?php _e( 'Bottom', 'saha'); ?></option>
							<option value="bottom-left" <?php if($$content_position == 'bottom-l') { ?>selected="selected"<?php } ?>><?php _e( 'Bottom Left', 'saha'); ?></option>
							<option value="bottom-right" <?php if($$content_position == 'bottom-right') { ?>selected="selected"<?php } ?>><?php _e( 'Bottom Right', 'saha'); ?></option>
						</select>
					</p>
				</div>
			<?php endfor;?>
		</div>

	<?php
	}
}