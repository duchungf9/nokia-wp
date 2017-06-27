<?php
/**
 * MailChimp Widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_MailChimp_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-mailchimp mailchimp-widget',
			'description' => __( 'Displays mailchimp subscription form.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-mailchimp', 				// $this->id_base
			__( '&raquo; MailChimp', 'saha' ), 	// $this->name
			$widget_options                 	// $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$subscribe_text 	= $instance['subscribe_text'];
		$mailchimpaction 	= $instance['mailchimpaction'];
		$placeholder 		= $instance['placeholder'];

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			if ( $subscribe_text ) { ?>
				<div class="saha-mail-text"><?php echo do_shortcode( $subscribe_text ); ?></div>
			<?php } ?>
			<form action="<?php echo esc_url( $mailchimpaction ); ?>" method="post" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				<input type="email" value="" name="EMAIL" class="required email" placeholder="<?php echo esc_attr( $placeholder ) ?>">
				<button type="submit" value="" name="subscribe"><i class="icon-envelope"></i></button>
			</form>
			
		<?php
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
		$instance['subscribe_text'] 	= $new_instance['subscribe_text'];
		$instance['mailchimpaction'] 	= $new_instance['mailchimpaction'];
		$instance['placeholder'] 		= $new_instance['placeholder'];

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
			'title'   			=> esc_html__( 'Newsletter', 'saha' ),
			'subscribe_text' 	=> esc_html__('Get all latest content delivered to your email a few times a month. Updates and news about all categories will send to you.', 'saha'),
			'mailchimpaction' 	=> '',
			'placeholder' 		=> esc_html__('Your Email', 'saha'),
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
			<label for="<?php echo $this->get_field_id( 'subscribe_text' ); ?>">
				<?php _e('Text:', 'saha'); ?>
			</label>
			<textarea style="height:100px;" class="widefat" id="<?php echo $this->get_field_id( 'subscribe_text' ); ?>" name="<?php echo $this->get_field_name( 'subscribe_text' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['subscribe_text'] ), ENT_QUOTES)); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('mailchimpaction'); ?>">
				<?php _e('MailChimp Form Action:', 'saha'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('mailchimpaction'); ?>" name="<?php echo $this->get_field_name('mailchimpaction'); ?>" type="text" value="<?php echo esc_url( $instance['mailchimpaction'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('placeholder'); ?>">
				<?php _e('Placeholder:', 'saha'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('placeholder'); ?>" name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php echo esc_attr( $instance['placeholder'] ); ?>" />
		</p>

	<?php

	}

}