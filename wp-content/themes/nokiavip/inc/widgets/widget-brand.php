<?php
/**
 * Brand Widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Brand_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-brand brand-widget',
			'description' => __( 'Displays brand logo carousel.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-brand',                   // $this->id_base
			__( '&raquo; Brand', 'saha' ), 	// $this->name
			$widget_options                 // $this->widget_options
		);

		add_action('admin_enqueue_scripts', array($this, 'saha_brand_scripts'));
	}

    /**
     * Upload the Javascripts for the media uploader
     */
    function saha_brand_scripts() {
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
		$effect 		= $instance['effect'];
		$grayscale 		= $instance['grayscale'];
		$count 			= $instance['count'];
		$columns 		= $instance['columns'];
		$target 		= $instance['target'];
		$width 			= isset( $instance['width'] ) ? $instance['width']: '';
		$height 		= isset( $instance['height'] ) ? $instance['height']: '';

		// Effect
		$classes = 'brand-li';
		if ( $effect ) {
			$classes .= ' saha_effect wow ' . $effect;
		}

		// Grayscale
		$classes_gray = 'brand-img';
		if ( $grayscale ) {
			$classes_gray .= ' grayscale';
		}

		$counter = 0;

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			echo'<div class="saha-brand-wrap clr">';
				echo'<ul class="saha-brand owl-carousel owl-theme" data-navigation="'. esc_attr( $navigation ) .'" data-items="'. esc_attr( $columns ) .'">';
					if ( $count !== '0' ) {
						for ( $i=1; $i<=$count; $i++ ) {
							$image_src 		= '';
							$src 			= $instance["src_".$i];
							$alt 			= isset( $instance["alt_".$i] ) ? $instance["alt_".$i]:'';
							$link 			= isset( $instance["link_".$i] ) ? $instance["link_".$i]:'';

							// images
							if ( !empty( $src ) ) {
								$image_src 	= saha_image_resize( $src, $width, $height );
							}

							echo'<li class="'. esc_attr( $classes ) .'" data-wow-delay="'. esc_attr( $counter * 300 ) .'ms">';

								if ( !empty( $image_src ) ) {

									if ( !empty( $link ) ) {
										echo'<a href="'. esc_url( $link ) .'" target="_'. esc_attr( $target ) .'">';
											echo'<img class="'. esc_attr( $classes_gray ) .'" src="'. esc_url( $image_src['url'] ) .'" width="'. esc_attr( $width ) .'" height="'. esc_attr( $height ) .'" alt="'. esc_attr( $alt ) .'" />';
										echo'</a>';
									} else {
										echo'<img class="'. esc_attr( $classes_gray ) .'" src="'. esc_url( $image_src['url'] ) .'" width="'. esc_attr( $width ) .'" height="'. esc_attr( $height ) .'" alt="'. esc_attr( $alt ) .'" />';
									}

								}

							echo'</li>';

							$counter++;

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
		$instance['effect'] 		= !empty( $new_instance['effect'] ) ? strip_tags( $new_instance['effect'] ) : '';
		$instance['grayscale'] 		= !empty( $new_instance['grayscale'] ) ? strip_tags( $new_instance['grayscale'] ) : '';
		$instance['count'] 			= !empty( $new_instance['count'] ) ? strip_tags( $new_instance['count'] ) : 6;
		$instance['columns'] 		= !empty( $new_instance['columns'] ) ? strip_tags( $new_instance['columns'] ) : 6;
		$instance['target'] 		= !empty( $new_instance['target'] ) ? strip_tags( $new_instance['target'] ) : 'blank';
		$instance['width'] 			= !empty( $new_instance['width'] ) ? strip_tags( $new_instance['width'] ) : '';
		$instance['height'] 		= !empty( $new_instance['height'] ) ? strip_tags( $new_instance['height'] ) : '';

		for ( $i=1;$i<=$instance['count'];$i++ ) {
			$instance["src_".$i] 			= $new_instance['src_'.$i];
			$instance["alt_".$i] 			= !empty( $new_instance['alt_'.$i] ) ? strip_tags( $new_instance['alt_'.$i] ) : '';
			$instance["link_".$i] 			= $new_instance['link_'.$i];
			$instance["link_".$i] 			= !empty( $new_instance['link_'.$i] ) ? strip_tags( $new_instance['link_'.$i] ) : '';
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
			'title'   		=> esc_html__( 'Brand', 'saha' ),
			'navigation'	=> esc_html__( 'True', 'saha' ),
			'effect'		=> esc_html__( 'None', 'saha' ),
			'grayscale'		=> esc_html__( 'Yes', 'saha' ),
			'count'			=> 6,
			'columns'		=> 6,
			'target'		=> esc_html__( 'Blank', 'saha' ),
			'width'			=> '',
			'height'		=> '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		for ( $i=1;$i<=20;$i++ ) {
			$src 			= 'src_'.$i;
			$alt 			= 'alt_'.$i;
			$$alt 			= isset( $instance[$alt] ) ? $instance[$alt] : '';
			$link 			= 'link_'.$i;
			$$link 			= isset( $instance[$link] ) ? $instance[$link] : '';
		} ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>">
				<?php _e( 'Images width', 'saha' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $instance['width'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>">
				<?php _e( 'Images height', 'saha' ); ?>
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
			<label for="<?php echo $this->get_field_id('effect'); ?>">
				<?php _e( 'Images Animation:', 'saha' ); ?>
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
			<label for="<?php echo $this->get_field_id('grayscale'); ?>">
				<?php _e( 'Activate Grayscale:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('grayscale'); ?>" id="<?php echo $this->get_field_id('grayscale'); ?>">
				<option value="" <?php if($instance['grayscale'] == '') { ?>selected="selected"<?php } ?>><?php _e( 'No', 'saha' ); ?></option>
				<option value="on" <?php if($instance['grayscale'] == 'on') { ?>selected="selected"<?php } ?>><?php _e( 'Yes', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('target'); ?>">
				<?php _e( 'Links Target:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
				<option value="self" <?php if($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'saha' ); ?></option>
				<option value="target" <?php if($instance['target'] == 'target') { ?>selected="selected"<?php } ?>><?php _e( 'Target', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">
				<?php _e( 'Number of Images:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>">
				<option value="3" <?php if($instance['count'] == '3') { ?>selected="selected"<?php } ?>><?php _e( '3', 'saha' ); ?></option>
				<option value="4" <?php if($instance['count'] == '4') { ?>selected="selected"<?php } ?>><?php _e( '4', 'saha' ); ?></option>
				<option value="5" <?php if($instance['count'] == '5') { ?>selected="selected"<?php } ?>><?php _e( '5', 'saha' ); ?></option>
				<option value="6" <?php if($instance['count'] == '6') { ?>selected="selected"<?php } ?>><?php _e( '6', 'saha' ); ?></option>
				<option value="7" <?php if($instance['count'] == '7') { ?>selected="selected"<?php } ?>><?php _e( '7', 'saha' ); ?></option>
				<option value="8" <?php if($instance['count'] == '8') { ?>selected="selected"<?php } ?>><?php _e( '8', 'saha' ); ?></option>
				<option value="9" <?php if($instance['count'] == '9') { ?>selected="selected"<?php } ?>><?php _e( '9', 'saha' ); ?></option>
				<option value="10" <?php if($instance['count'] == '10') { ?>selected="selected"<?php } ?>><?php _e( '10', 'saha' ); ?></option>
				<option value="11" <?php if($instance['count'] == '11') { ?>selected="selected"<?php } ?>><?php _e( '11', 'saha' ); ?></option>
				<option value="12" <?php if($instance['count'] == '12') { ?>selected="selected"<?php } ?>><?php _e( '12', 'saha' ); ?></option>
				<option value="13" <?php if($instance['count'] == '13') { ?>selected="selected"<?php } ?>><?php _e( '13', 'saha' ); ?></option>
				<option value="14" <?php if($instance['count'] == '14') { ?>selected="selected"<?php } ?>><?php _e( '14', 'saha' ); ?></option>
				<option value="15" <?php if($instance['count'] == '15') { ?>selected="selected"<?php } ?>><?php _e( '15', 'saha' ); ?></option>
				<option value="16" <?php if($instance['count'] == '16') { ?>selected="selected"<?php } ?>><?php _e( '16', 'saha' ); ?></option>
				<option value="17" <?php if($instance['count'] == '17') { ?>selected="selected"<?php } ?>><?php _e( '17', 'saha' ); ?></option>
				<option value="18" <?php if($instance['count'] == '18') { ?>selected="selected"<?php } ?>><?php _e( '18', 'saha' ); ?></option>
				<option value="19" <?php if($instance['count'] == '19') { ?>selected="selected"<?php } ?>><?php _e( '19', 'saha' ); ?></option>
				<option value="20" <?php if($instance['count'] == '20') { ?>selected="selected"<?php } ?>><?php _e( '20', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('columns'); ?>">
				<?php _e( 'Number of Columns:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('columns'); ?>" id="<?php echo $this->get_field_id('columns'); ?>">
				<option value="1" <?php if($instance['columns'] == '1') { ?>selected="selected"<?php } ?>><?php _e( '1', 'saha' ); ?></option>
				<option value="2" <?php if($instance['columns'] == '2') { ?>selected="selected"<?php } ?>><?php _e( '2', 'saha' ); ?></option>
				<option value="3" <?php if($instance['columns'] == '3') { ?>selected="selected"<?php } ?>><?php _e( '3', 'saha' ); ?></option>
				<option value="4" <?php if($instance['columns'] == '4') { ?>selected="selected"<?php } ?>><?php _e( '4', 'saha' ); ?></option>
				<option value="5" <?php if($instance['columns'] == '5') { ?>selected="selected"<?php } ?>><?php _e( '5', 'saha' ); ?></option>
				<option value="6" <?php if($instance['columns'] == '6') { ?>selected="selected"<?php } ?>><?php _e( '6', 'saha' ); ?></option>
				<option value="7" <?php if($instance['columns'] == '7') { ?>selected="selected"<?php } ?>><?php _e( '7', 'saha' ); ?></option>
				<option value="8" <?php if($instance['columns'] == '8') { ?>selected="selected"<?php } ?>><?php _e( '8', 'saha' ); ?></option>
				<option value="9" <?php if($instance['columns'] == '9') { ?>selected="selected"<?php } ?>><?php _e( '9', 'saha' ); ?></option>
				<option value="10" <?php if($instance['columns'] == '10') { ?>selected="selected"<?php } ?>><?php _e( '10', 'saha' ); ?></option>
			</select>
		</p>

		<div class="slider_custom_wrap" style="margin-top:50px;">
			<?php for ( $i=1;$i<=20;$i++ ): $src = 'src_'.$i; $alt = 'alt_'.$i; $link = 'link_'.$i; ?>
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
						<label for="<?php echo $this->get_field_id( $link ); ?>">
							<?php printf( '#%s Image Link:', $i );?>
						</label>
						<input class="widefat" id="<?php echo $this->get_field_id( $link ); ?>" name="<?php echo $this->get_field_name( $link ); ?>" type="text" value="<?php echo esc_attr( $$link ); ?>" />
					</p>
				</div>
			<?php endfor;?>
		</div>

	<?php

	}

}