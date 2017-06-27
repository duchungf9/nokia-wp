<?php
/**
 * Testimonials widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Testimonials_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-testimonials testimonials-widget',
			'description' => __( 'Displays testimonials slider.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-testimonials',                  // $this->id_base
			__( '&raquo; Testimonials', 'saha' ), // $this->name
			$widget_options                       // $this->widget_options
		);
	
		add_action('admin_enqueue_scripts', array($this, 'saha_testimonials_scripts'));
	}

    /**
     * Upload the Javascripts for the media uploader
     */
    function saha_testimonials_scripts() {
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
		$speed 			= $instance['speed'];
		$count 			= $instance['count'];
		$width 			= isset( $instance['width'] ) ? $instance['width']:'';
		$height 		= isset( $instance['height'] ) ? $instance['height']:'';
		$style 			= isset( $instance['style'] ) ? $instance['style']:'';
		$font_size 		= isset( $instance['font_size'] ) ? $instance['font_size']:'';
		$line_height 	= isset( $instance['line_height'] ) ? $instance['line_height']:'';
		$target 		= isset( $instance['target'] ) ? $instance['target']:'';

		// Class style
		if ( 'white' == $style ) {
			$class = ' white';
		} else if ( 'black' == $style ) {
			$class = ' black';
		} else {
			$class = ' default';
		}

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			echo'<div class="testimonials-slider-wrap clr'. esc_attr( $class ) .'">';
				echo'<ul class="testimonials-slider owl-carousel owl-theme" data-slidespeed="'. esc_attr( $speed ) .'">';
					if ( $count !== '0' ) {
						for ( $i=1; $i<=$count; $i++ ) {
							$image_src 		= '';
							$quote 			= isset( $instance["quote_".$i] ) ? $instance["quote_".$i] : '';
							$author_name 	= isset( $instance["author_name_".$i] ) ? $instance["author_name_".$i]:'';
							$company 		= isset( $instance["company_".$i] ) ? $instance["company_".$i]:'';
							$url 			= isset( $instance["url_".$i] ) ? $instance["url_".$i]:'';
							$src 			= isset( $instance["src_".$i] ) ? $instance["src_".$i]:'';

							$add_style = array();

							if ( '' != $font_size ) {
								$add_style[] = 'font-size: '. $font_size .';';
							}
							if ( '' != $line_height ) {
								$add_style[] = 'line-height: '. $line_height .';';
							}

							$add_style = implode('', $add_style);

							if ( $add_style ) {
								$add_style 	= wp_kses( $add_style, array() );
								$style 		= 'style="'. esc_attr( $add_style ) .'"';
							}

							if ( !empty( $src ) ) {
								$image_src 	= saha_image_resize( $src, $width, $height );
							}

							echo'<li>';

								if ( !empty( $image_src ) ) {
									echo'<div class="testimonial-thumb">';
										echo'<img src="'. esc_url( $image_src['url'] ) .'" width="'. esc_attr( $width ) .'" height="'. esc_attr( $height ) .'" alt="'. esc_attr( $company ) .'" />';
									echo'</div>';
								}

								echo'<div class="testimonial-quote" '. $style .'>';
									echo''. esc_attr( $quote ) .'';
								echo'</div>';

								echo'<div class="testimonial-author">'. esc_attr( $author_name ) .'</div>';

								echo'<div class="testimonial-company">';
									echo'<a href="'. esc_url( $url ) .'" target="_'. esc_attr( $target ) .'">'. esc_attr( $company ) .'</a>';
								echo'</div>';

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
		$instance['speed'] 			= !empty( $new_instance['speed'] ) ? strip_tags( $new_instance['speed'] ) : 7000;
		$instance['count'] 			= !empty( $new_instance['count'] ) ? strip_tags( $new_instance['count'] ) : 3;
		$instance['width'] 			= !empty( $new_instance['width'] ) ? strip_tags( $new_instance['width'] ) : 80;
		$instance['height'] 		= !empty( $new_instance['height'] ) ? strip_tags( $new_instance['height'] ) : 80;
		$instance['style'] 			= !empty( $new_instance['style'] ) ? strip_tags( $new_instance['style'] ) : 'default';
		$instance['font_size'] 		= !empty( $new_instance['font_size'] ) ? strip_tags( $new_instance['font_size'] ) : '';
		$instance['line_height'] 	= !empty( $new_instance['line_height'] ) ? strip_tags( $new_instance['line_height'] ) : '';
		$instance['target'] 		= !empty( $new_instance['target'] ) ? strip_tags( $new_instance['target'] ) : 'blank';

		for ( $i=1;$i<=$instance['count'];$i++ ) {
			$instance["quote_".$i] 			= !empty( $new_instance['quote_'.$i] ) ? strip_tags( $new_instance['quote_'.$i] ) : '';
			$instance["author_name_".$i] 	= !empty( $new_instance['author_name_'.$i] ) ? strip_tags( $new_instance['author_name_'.$i] ) : '';
			$instance["company_".$i] 		= !empty( $new_instance['company_'.$i] ) ? strip_tags( $new_instance['company_'.$i] ) : '';
			$instance["url_".$i] 			= !empty( $new_instance['url_'.$i] ) ? strip_tags( $new_instance['url_'.$i] ) : '';
			$instance["src_".$i] 			= !empty( $new_instance['src_'.$i] ) ? strip_tags( $new_instance['src_'.$i] ) : '';
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
			'title'      		=> esc_html__( 'Testimonials', 'saha' ),
			'speed'				=> '7000',
			'count'				=> '3',
			'width'				=> '80',
			'height'			=> '80',
			'style'				=> esc_html__( 'Default', 'saha' ),
			'font_size'			=> '',
			'line_height'		=> '',
			'target' 			=> 'blank',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		for ( $i=1;$i<=10;$i++ ) {
			$quote 			= 'quote_'.$i;
			$$quote 		= isset( $instance[$quote] ) ? $instance[$quote] : '';
			$src 			= 'src_'.$i;
			$$src 			= isset( $instance[$src] ) ? $instance[$src] : '';
			$author_name 	= 'author_name_'.$i;
			$$author_name 	= isset( $instance[$author_name] ) ? $instance[$author_name] : '';
			$company 		= 'company_'.$i;
			$$company 		= isset( $instance[$company] ) ? $instance[$company] : '';
			$url 			= 'url_'.$i;
			$$url 			= isset( $instance[$url] ) ? $instance[$url] : '';
		}
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>">
				<?php _e('Image Width', 'saha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $instance['width'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>">
				<?php _e('Image Height', 'saha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $instance['height'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('speed'); ?>">
				<?php _e( 'Slide Speed', 'saha' ); ?>
			</label> 
			<input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo esc_attr( $instance['speed'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('style'); ?>">
				<?php _e( 'Style:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>">
				<option value="default" <?php if($instance['style'] == 'default') { ?>selected="selected"<?php } ?>><?php _e( 'Default', 'saha' ); ?></option>
				<option value="white" <?php if($instance['style'] == 'white') { ?>selected="selected"<?php } ?>><?php _e( 'White', 'saha'); ?></option>
				<option value="black" <?php if($instance['style'] == 'black') { ?>selected="selected"<?php } ?>><?php _e( 'Black', 'saha'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'font_size' ); ?>">
				<?php _e('Font Size px, em, %', 'saha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'font_size' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'font_size' ); ?>" type="text" value="<?php echo esc_attr( $instance['font_size'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'line_height' ); ?>">
				<?php _e('Line Height px, em', 'saha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'line_height' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'line_height' ); ?>" type="text" value="<?php echo esc_attr( $instance['line_height'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('target'); ?>">
				<?php _e( 'Link Target:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
				<option value="blank" <?php if($instance['target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'saha' ); ?></option>
				<option value="self" <?php if($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'saha'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>">
				<?php _e('Number of Testimonials:', 'saha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" class="social_icon_custom_count widefat" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $instance['count'] ); ?>" size="3" />
			<small style="font-size: 11px;"><?php _e( 'Enter a number between 1 to 10', 'saha' ); ?></small>
		</p>

		<div class="testimonial_custom_wrap">
			<?php for ( $i=1;$i<=10;$i++ ): $quote = 'quote_'.$i; $author_name = 'author_name_'.$i; $company = 'company_'.$i; $url = 'url_'.$i; $src = 'src_'.$i; ?>
			<div class="testimonial_custom_<?php echo $i;?>" <?php if ( $i>$instance['count'] ):?>style="display:none;"<?php endif;?> style="padding-bottom:30px">
				<p>
					<label for="<?php echo $this->get_field_id( $quote ); ?>">
						<?php printf( '#%s Quote:', $i ); ?>
					</label>
					<textarea style="width:100%;height:100px;" rows="6" id="<?php echo $this->get_field_id( $quote ); ?>" name="<?php echo $this->get_field_name( $quote ); ?>" ><?php echo esc_attr( $$quote ); ?></textarea>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( $author_name ); ?>">
						<?php printf( '#%s Author Name:', $i ); ?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id( $author_name ); ?>" name="<?php echo $this->get_field_name( $author_name ); ?>" type="text" value="<?php echo esc_attr( $$author_name ); ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( $company ); ?>">
						<?php printf( '#%s Company:', $i ); ?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id( $company ); ?>" name="<?php echo $this->get_field_name( $company ); ?>" type="text" value="<?php echo esc_attr( $$company ); ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( $src ); ?>">
						<?php printf( '#%s Author Image:', $i ); ?>
					</label>
		            <small style="font-size: 11px;margin-left: 3px;"><?php _e( 'select image full size', 'saha' ); ?></small>
					<input class="widefat" id="<?php echo $this->get_field_id( $src ); ?>" name="<?php echo $this->get_field_name( $src ); ?>" type="text" size="36" value="<?php echo esc_attr( $$src ); ?>" />
		            <input class="saha_upload_image_button button-primary" type="button" value="<?php _e( 'Upload Image', 'saha' ); ?>" style="margin-top: 10px;" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( $url ); ?>">
						<?php printf( '#%s Author Website URL:', $i ); ?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id( $url ); ?>" name="<?php echo $this->get_field_name( $url ); ?>" type="text" value="<?php echo esc_attr( $$url ); ?>" />
				</p>
			</div>
			<?php endfor;?>
		</div>

	<?php

	}

}