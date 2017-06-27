<?php
/**
 * Flickr Widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Flickr_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-flickr flickr-widget',
			'description' => __( 'Pulls in images from your flickr account.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-flickr',                  // $this->id_base
			__( '&raquo; Flickr', 'saha' ), // $this->name
			$widget_options                 // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$count 		= (int) strip_tags($instance['number']);
		$flickr_id 	= strip_tags($instance['id']);

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			echo '<div class="flickr-widget-wrap">';
				echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' . $count . '&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=' . $flickr_id . '"></script>';
				echo '<p class="flickr_stream_wrap"><a class="follow_btn" href="http://www.flickr.com/photos/' . $flickr_id . '">' . __( 'View stream on flickr', 'saha' ) . '</a></p>';
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

		$instance['title']   	= strip_tags( $new_instance['title'] );
		$instance['count'] 		= (int) strip_tags($new_instance['number']);
		$instance['flickr_id'] 	= strip_tags($new_instance['id']);

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
			'title'   		=> esc_html__( 'Flickr Photos', 'saha' ),
			'id' 			=> '52617155@N08',
			'number'		=> 6
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
			<label for="<?php echo $this->get_field_id('id'); ?>">
				<?php _e('Flickr ID:', 'saha'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo esc_attr( $instance['id'] ); ?>" />
			<small><?php _e('Enter the url of your Flickr page on this site: idgettr.com.', 'saha'); ?></small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">
				<?php _e('Number:', 'saha'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" />
			<small><?php _e('The maximum is 10 images.', 'saha'); ?></small>
		</p>

	<?php

	}

}