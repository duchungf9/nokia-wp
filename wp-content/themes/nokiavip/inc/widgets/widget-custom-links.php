<?php
/**
 * Custom Links Widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Custom_Links_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-custom-links custom-links-widget',
			'description' => __( 'Displays custom links.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-custom-links',                   	// $this->id_base
			__( '&raquo; Custom Links', 'saha' ), 	// $this->name
			$widget_options                 		// $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$count 		= $instance['count'];
		$target 	= $instance['target'];

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			echo '<ul class="saha-custom-links">';
				if ( $count !== '0' ) {
					for ( $i=1; $i<=$count; $i++ ) {
						$url 	= isset( $instance["url_".$i] ) ? $instance["url_".$i] : '';
						$text 	= isset( $instance["text_".$i] ) ? $instance["text_".$i]:'';

						echo '<li>';
							echo '<a href="'. esc_url( $url ) .'" target="_'. esc_attr( $target ) .'">'. esc_attr( $text ) .'</a>';
						echo '</li>';

					}
				}
			echo '</ul>';

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
		$instance['count'] 				= !empty( $new_instance['count'] ) ? strip_tags( $new_instance['count'] ) : 5;
		$instance['target'] 			= !empty( $new_instance['target'] ) ? strip_tags( $new_instance['target'] ) : 'blank';
		for ( $i=1;$i<=$instance['count'];$i++ ) {
			$instance["url_".$i] 		= !empty( $new_instance['url_'.$i] ) ? strip_tags( $new_instance['url_'.$i] ) : '';
			$instance["text_".$i] 		= !empty( $new_instance['text_'.$i] ) ? strip_tags( $new_instance['text_'.$i] ) : '';
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
			'title'   			=> esc_html__( 'Useful Links', 'saha' ),
			'count'				=> '5',
			'target' 			=> esc_html__( 'Blank', 'saha' ),
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		for ( $i=1;$i<=15;$i++ ) {
			$url 			= 'url_'.$i;
			$$url 			= isset( $instance[$url] ) ? $instance[$url] : '';
			$text 			= 'text_'.$i;
			$$text 			= isset( $instance[$text] ) ? $instance[$text] : '';
		}
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
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
			<label for="<?php echo $this->get_field_id('count'); ?>">
				<?php _e( 'Number of Custom Links:', 'saha' ); ?>
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

		<div class="custom_links_wrap">
			<?php for ( $i=1;$i<=15;$i++ ): $url = 'url_'.$i; $text = 'text_'.$i; ?>
			<div class="custom_links_<?php echo $i;?>" <?php if ( $i>$instance['count'] ):?>style="display:none;"<?php endif;?> style="padding-bottom:30px">
				<p>
					<label for="<?php echo $this->get_field_id( $url ); ?>">
						<?php printf( '#%s URL:', $i );?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id( $url ); ?>" name="<?php echo $this->get_field_name( $url ); ?>" type="text" value="<?php echo esc_attr( $$url ); ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( $text ); ?>">
						<?php printf( '#%s Text:', $i );?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id( $text ); ?>" name="<?php echo $this->get_field_name( $text ); ?>" type="text" value="<?php echo esc_attr( $$text ); ?>" />
				</p>
			</div>
			<?php endfor;?>
		</div>

	<?php

	}

}