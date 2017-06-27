<?php
/**
 * Contact Info Widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Contact_Info_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-contact-info contact-info-widget',
			'description' => __( 'Adds support for contact info.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-contact-info',                   	// $this->id_base
			__( '&raquo; Contact Info', 'saha' ), 	// $this->name
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
		$text 		= $instance['text'];
		$address 	= $instance['address'];
		$phone 		= $instance['phone'];
		$mobile 	= $instance['mobile'];
		$fax 		= $instance['fax'];
		$email 		= $instance['email'];
		$emailtxt 	= $instance['emailtxt'];
		$web 		= $instance['web'];
		$webtxt 	= $instance['webtxt'];
		$skype 		= $instance['skype'];
		$skypetxt 	= $instance['skypetxt'];

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			echo '<ul class="contact-info-container">';
				if ( $text ) {
					echo '<li class="text">'. esc_attr( $text ) .'</li>';
				}

				if ( $address ) {
					echo '<li class="address">';
						echo '<i class="icon-location-pin"></i>';
						echo '<div class="saha-info-wrap">';
							echo '<span class="saha-contact-title">'. __('Address:', 'saha') .'</span>';
							echo '<span class="saha-contact-text">'. esc_attr( $address ) .'</span>';
						echo '</div>';
					echo '</li>';
				}

				if ( $phone ) {
					echo '<li class="phone">';
						echo '<i class="icon-phone"></i>';
						echo '<div class="saha-info-wrap">';
							echo '<span class="saha-contact-title">'. __('Phone:', 'saha') .'</span>';
							echo '<span class="saha-contact-text">'. esc_attr( $phone ) .'</span>';
						echo '</div>';
					echo '</li>';
				}

				if ( $mobile ) {
					echo '<li class="mobile">';
						echo '<i class="icon-screen-smartphone"></i>';
						echo '<div class="saha-info-wrap">';
							echo '<span class="saha-contact-title">'. __('Mobile:', 'saha') .'</span>';
							echo '<span class="saha-contact-text">'. esc_attr( $mobile ) .'</span>';
						echo '</div>';
					echo '</li>';
				}

				if ( $fax ) {
					echo '<li class="fax">';
						echo '<i class="icon-printer"></i>';
						echo '<div class="saha-info-wrap">';
							echo '<span class="saha-contact-title">'. __('Fax:', 'saha') .'</span>';
							echo '<span class="saha-contact-text">'. esc_attr( $fax ) .'</span>';
						echo '</div>';
					echo '</li>';
				}

				if ( $email ) {
					echo '<li class="email">';
						echo '<i class="icon-envelope"></i>';
						echo '<div class="saha-info-wrap">';
							echo '<span class="saha-contact-title">'. __('Email:', 'saha') .'</span>';
							echo '<span class="saha-contact-text">';
								echo '<a href="mailto:'. esc_attr( $email ) .'">';
									if($emailtxt) {
										echo esc_attr( $emailtxt );
									} else {
										echo esc_attr( $email );
									}
								echo '</a>';
							echo '</span>';
						echo '</div>';
					echo '</li>';
				}

				if ( $web ) {
					echo '<li class="web">';
						echo '<i class="icon-link"></i>';
						echo '<div class="saha-info-wrap">';
							echo '<span class="saha-contact-title">'. __('Website:', 'saha') .'</span>';
							echo '<span class="saha-contact-text">';
								echo '<a href="'. esc_url( $web ) .'">';
									if($webtxt) {
										echo esc_attr( $webtxt );
									} else {
										echo esc_attr( $web );
									}
								echo '</a>';
							echo '</span>';
						echo '</div>';
					echo '</li>';
				}

				if ( $skype ) {
					echo '<li class="skype">';
						echo '<a href="skype:'. esc_attr( $skype ) .'?call" target="_self" class="saha-skype-button">';
							if($skypetxt) {
								echo esc_attr( $skypetxt );
							} else {
								__('Skype', 'saha');
							}
						echo '</a>';
					echo '</li>';
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

		$instance['title']   	= strip_tags( $new_instance['title'] );
		$instance['text'] 		= $new_instance['text'];
		$instance['address'] 	= $new_instance['address'];
		$instance['phone'] 		= $new_instance['phone'];
		$instance['mobile'] 	= $new_instance['mobile'];
		$instance['fax'] 		= $new_instance['fax'];
		$instance['email'] 		= $new_instance['email'];
		$instance['emailtxt']	= $new_instance['emailtxt'];
		$instance['web'] 		= $new_instance['web'];
		$instance['webtxt'] 	= $new_instance['webtxt'];
		$instance['skype'] 		= $new_instance['skype'];
		$instance['skypetxt'] 	= $new_instance['skypetxt'];	

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
			'title'   		=> esc_html__( 'Contact Info', 'saha' ),
			'text' 			=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, aspernatur, velit. Adipisci, animi, molestiae, neque voluptatum non voluptas atque aperiam.',
			'address' 		=> esc_html__('Street Name, FL 54785','saha'),
			'phone' 		=> '621-254-2147',
			'mobile' 		=> '621-254-2147',
			'fax' 			=> '621-254-2147',
			'email' 		=> 'contact@support.com',
			'emailtxt' 		=> 'contact@support.com',
			'web' 			=> 'http://theme-junkie.com/',
			'webtxt' 		=> 'Theme Junkie',
			'skype' 		=> 'Theme Junkie',
			'skypetxt' 		=> esc_html__('Skype Call Us','saha'),
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

			<label for="<?php echo $this->get_field_id('text'); ?>">
				<?php _e('Text:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" value="<?php echo esc_attr( $instance['text'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>">
				<?php _e('Address:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo esc_attr( $instance['address'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('phone'); ?>">
				<?php _e('Phone:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" value="<?php echo esc_attr( $instance['phone'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('mobile'); ?>">
				<?php _e('Mobile:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('mobile'); ?>" name="<?php echo $this->get_field_name('mobile'); ?>" value="<?php echo esc_attr( $instance['mobile'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('fax'); ?>">
				<?php _e('Fax:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" value="<?php echo esc_attr( $instance['fax'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>">
				<?php _e('Email:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo esc_attr( $instance['email'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('emailtxt'); ?>">
				<?php _e('Email Link Text:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('emailtxt'); ?>" name="<?php echo $this->get_field_name('emailtxt'); ?>" value="<?php echo esc_attr( $instance['emailtxt'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('web'); ?>">
				<?php _e('Website URL (with HTTP):', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('web'); ?>" name="<?php echo $this->get_field_name('web'); ?>" value="<?php echo esc_url( $instance['web'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('webtxt'); ?>">
				<?php _e('Website URL Text:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('webtxt'); ?>" name="<?php echo $this->get_field_name('webtxt'); ?>" value="<?php echo esc_attr( $instance['webtxt'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('skype'); ?>">
				<?php _e('Skype:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" value="<?php echo esc_attr( $instance['skype'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('skypetxt'); ?>">
				<?php _e('Skype Text:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('skypetxt'); ?>" name="<?php echo $this->get_field_name('skypetxt'); ?>" value="<?php echo esc_attr( $instance['skypetxt'] ); ?>" />
		</p>

	<?php

	}

}