<?php
/**
 * Social widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Social_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-social social-widget',
			'description' => __( 'Display your social media icons.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-social',                        // $this->id_base
			__( '&raquo; Social Icons', 'saha' ), // $this->name
			$widget_options                       // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$transition 		= $instance['transition'];
		$target 			= $instance['target'];
		$social_services 	= $instance['social_services'];

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			// Display the social icons.
			echo '<ul class="social-icons '. esc_attr( $transition ) .'">';
				// Loop through each social service and display font icon
				foreach( $social_services as $key => $service ) {
					$link = !empty( $service['url'] ) ? $service['url'] : null;
					$name = $service['name'];
					if ( $link ) {
						if ( 'pinterest' == $key ) {
							$key = 'pinterest-p';
						}
						if ( 'youtube' == $key ) {
							$key = 'youtube-play';
						}
						echo '<li class="'. esc_attr( $key ) .'">';
							echo '<a href="'. esc_url( $link ) .'" title="'. esc_attr( $name ) .'" target="_'. esc_attr( $target ) .'">';
								echo '<i class="fa fa-'. esc_attr( $key ) .'"></i>';
							echo '</a>';
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

		$instance['title']      		= strip_tags( $new_instance['title'] );
		$instance['transition'] 		= !empty( $new_instance['transition'] ) ? strip_tags( $new_instance['transition'] ) : 'rotate';
		$instance['target'] 			= !empty( $new_instance['target'] ) ? strip_tags( $new_instance['target'] ) : 'blank';
		$instance['social_services'] 	= $new_instance['social_services'];

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
			'title'      		=> esc_html__( 'Follow us', 'saha' ),
			'transition' 		=> esc_html__( 'Rotate', 'saha' ),
			'target' 			=> 'blank',
			'social_services'	=> array(
				'facebook'		=> array(
					'name'		=> 'Facebook',
					'url'		=> ''
				),
				'flickr'			=> array(
					'name'		=> 'Flickr',
					'url'		=> ''
				),
				'google-plus'	=> array(
					'name'		=> 'GooglePlus',
					'url'		=> ''
				),
				'instagram'		=> array(
					'name'		=> 'Instagram',
					'url'		=> ''
				),
				'linkedin' 		=> array(
					'name'		=> 'LinkedIn',
					'url'		=> ''
				),
				'pinterest' 	=> array(
					'name'		=> 'Pinterest',
					'url'		=> ''
				),
				'tumblr' 		=> array(
					'name'		=> 'Tumblr',
					'url'		=> ''
				),
				'twitter' 		=> array(
					'name'		=> 'Twitter',
					'url'		=> ''
				),
				'youtube' 		=> array(
					'name'		=> 'Youtube',
					'url'		=> ''
				),
				'rss' 			=> array(
					'name'		=> 'RSS',
					'url'		=> ''
				),
				'vimeo-square'	=> array(
					'name'		=> 'Vimeo',
					'url'		=> ''
				),
				'vine'			=> array(
					'name'		=> 'Vine',
					'url'		=> ''
				),
			),
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<script type="text/javascript" >
            jQuery(document).ready(function($) {
				$(document).ajaxSuccess(function(e, xhr, settings) {
					var widget_id_base = 'Saha_Social_Widget';
					if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
						SocialSortServices();
					}
				});
				function SocialSortServices() {
					$('.services-list').each( function() {
						var id = $(this).attr('id');
						$('#'+ id).sortable({
							placeholder: "placeholder",
							opacity: 0.6
						});
					});
				}
				SocialSortServices();
			});
        </script>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('transition'); ?>">
				<?php _e('Transition:', 'saha'); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('transition'); ?>" id="<?php echo $this->get_field_id('transition'); ?>">
				<option value="float" <?php if($instance['transition'] == 'float') { ?>selected="selected"<?php } ?>><?php _e( 'Float', 'saha' ); ?></option>
				<option value="rotate" <?php if($instance['transition'] == 'rotate') { ?>selected="selected"<?php } ?>><?php _e( 'Rotate', 'saha' ); ?></option>
				<option value="zoomout" <?php if($instance['transition'] == 'zoomout') { ?>selected="selected"<?php } ?>><?php _e( 'Zoom Out', 'saha' ); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('target'); ?>">
				<?php _e( 'Link Target:', 'saha' ); ?>
			</label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
				<option value="blank" <?php if($instance['target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'saha' ); ?></option>
				<option value="self" <?php if($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'saha'); ?></option>
			</select>
		</p>

		<h3 style="margin-top:20px;margin-bottom:5px;clear: both;"><?php _e( 'Social Links','saha' ); ?></h3>  
		<small style="display:block;margin-bottom:10px;"><?php _e('Enter the full URL to your social profile','saha'); ?></small>
		<ul id="<?php echo $this->get_field_id( 'social_services' ); ?>" class="services-list">
			<input type="hidden" id="<?php echo $this->get_field_name( 'social_services' ); ?>" value="<?php echo $this->get_field_name( 'social_services' ); ?>">
			<input type="hidden" id="<?php echo wp_create_nonce('Saha_Social_Widget_nonce'); ?>">
			<?php
			$social_services = $instance['social_services'];
			foreach( $social_services as $key => $service ) {
				$url=0;
				if(isset($service['url'])) $url = $service['url'];
				if(isset($service['name'])) $name = $service['name']; ?>
				<li class="<?php echo $this->get_field_id( 'social_services' ); ?>">
					<p>
						<label for="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo esc_attr( $key ) ?>-name"><?php echo esc_attr( $name ); ?>:</label>
						<input type="hidden" id="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo esc_attr( $key ) ?>-url" name="<?php echo $this->get_field_name( 'social_services' ).'['.$key.'][name]'; ?>" value="<?php echo esc_attr( $name ); ?>">
						<input type="url" class="widefat" id="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo esc_attr( $key ) ?>-url" name="<?php echo $this->get_field_name( 'social_services' ).'['.$key.'][url]'; ?>" value="<?php echo esc_url( $url ); ?>" />
					</p>
				</li>
			<?php } ?>
		</ul>

	<?php

	}

}