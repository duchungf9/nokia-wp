<?php
/**
 * About Me Widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_About_Me_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-about-me about-me-widget',
			'description' => __( 'Adds a about me widget.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-about-me',                            // $this->id_base
			__( '&raquo; About Me', 'saha' ), // $this->name
			$widget_options                        // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$center 			= $instance['center'];
		$avatar 			= $instance['avatar'];
		$name 				= $instance['name'];
		$text 				= $instance['text'];
		$social_style 		= $instance['social_style'];
		$target 			= $instance['target'];
		$social_services 	= $instance['social_services'];

		// Center class
		if( $center != '' ) {
			$class = ' center';
		}

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			echo '<div class="about-me'. esc_attr( $class ) .'">';

				echo '<div class="about-me-avatar clr">';
					if ( $avatar ) {
						echo '<img src="'. esc_url( $avatar ) .'" alt="">';
					}

					if ( $name ) {
						echo '<h3 class="about-me-name">'. esc_attr( $name ) .'</h3>';
					}
				echo '</div>';

				if ( $text ) {
					echo '<div class="about-me-text clr">'. esc_attr( $text ) .'</div>';
				}

				if ( $social_services ) {
					echo '<ul class="about-me-social style-'. esc_attr( $social_style ) .'">';
						// Loop through each social service and display font icon
						foreach( $social_services as $key => $service ) {
							$link 			= !empty( $service['url'] ) ? $service['url'] : null;
							$social_name 	= $service['name'];

							if ( $link ) {
								if ( 'youtube' == $key ) {
									$key = 'youtube-play';
								}
								echo '<li class="'. esc_attr( $key ) .'"><a href="'. esc_url( $link ) .'" title="'. esc_attr( $social_name ) .'" target="_'.esc_attr( $target ).'"><i class="fa fa-'. esc_attr( $key ) .'"></i></a></li>';
							}
						}
					echo '</ul>';
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
		$instance['center'] 			= (bool) $new_instance['center'];
		$instance['avatar'] 			= esc_url( $new_instance['avatar'] );
		$instance['name'] 				= esc_attr( $new_instance['name'] );
		$instance['text'] 				= stripslashes( $new_instance['text'] );
		$instance['social_style'] 		= esc_attr( $new_instance['social_style'] );
		$instance['target'] 			= esc_attr( $new_instance['target'] );
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
			'title'   			=> esc_html__( 'About Me', 'saha' ),
			'center' 			=> '',
			'avatar' 			=> get_template_directory_uri(). '/assets/img/about-avatar.png',
			'name'  			=> esc_html__( 'John Doe', 'saha' ),
			'text' 				=> 'Lorem ipsum ex vix illud nonummy novumtatio et his. At vix patrioque scribentur at fugitertissi ext scriptaset verterem molestiae.',
			'social_style' 		=> 'color',
			'target' 			=> 'blank',
			'social_services'	=> array(
				'facebook'		=> array(
					'name'		=> 'Facebook',
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
				'twitter' 		=> array(
					'name'		=> 'Twitter',
					'url'		=> ''
				),
				'youtube' 		=> array(
					'name'		=> 'Youtube',
					'url'		=> ''
				),	
			),
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<script type="text/javascript" >
            jQuery(document).ready(function($) {
                $(document).ajaxSuccess(function(e, xhr, settings) {
                    var widget_id_base = 'Saha_About_Me_Widget';
                    if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=Saha_About_Me_Widget' + widget_id_base) != -1) {
                        AboutSortServices();
                    }
                });
                function AboutSortServices() {
                    $('.services-list').each( function() {
                        var id = $(this).attr('id');
                        $('#'+ id).sortable({
                            placeholder: "placeholder",
                            opacity: 0.6
                        });
                    });
                }
                AboutSortServices();
            });
        </script>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'center' ); ?>">
				<input type="checkbox" name="<?php echo $this->get_field_name( 'center' ); ?>" id="<?php echo $this->get_field_id( 'center' ); ?>" <?php checked( $instance['center'] ); ?> />
				<?php _e( 'Center Elements', 'saha' ); ?>
			</label>
		</p>

		<p>
		    <label for="<?php echo $this->get_field_id( 'avatar' ); ?>">
		    	<?php _e('Avatar:', 'saha') ?>
		    </label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'avatar' ); ?>" name="<?php echo $this->get_field_name( 'avatar' ); ?>" value="<?php echo esc_url( $instance['avatar'] ); ?>" />
		</p>

		<p>
		    <label for="<?php echo $this->get_field_id( 'name' ); ?>">
		    	<?php _e('Name:', 'saha') ?>
		    </label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo esc_attr( $instance['name'] ); ?>" />
		</p>

		<p>
		    <label for="<?php echo $this->get_field_id( 'text' ); ?>">
		    	<?php _e('Text:', 'saha') ?>
		    </label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" value="<?php echo esc_attr( $instance['text'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_style'); ?>">
				<?php _e('Social Style:', 'saha'); ?>
			</label>
			<br />
			<select class='widget-select widefat' name="<?php echo $this->get_field_name('social_style'); ?>" id="<?php echo $this->get_field_id('social_style'); ?>">
				<option value="color" <?php if($instance['social_style'] == 'color') { ?>selected="selected"<?php } ?>><?php _e( 'Color', 'saha' ); ?></option>				
				<option value="light" <?php if($instance['social_style'] == 'light') { ?>selected="selected"<?php } ?>><?php _e( 'Light', 'saha' ); ?></option>
				<option value="dark" <?php if($instance['social_style'] == 'dark') { ?>selected="selected"<?php } ?>><?php _e( 'Dark', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('target'); ?>">
				<?php _e( 'Social Link Target:', 'saha' ); ?>
			</label>
			<br />
			<select class='widget-select widefat' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
				<option value="blank" <?php if($instance['target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'saha' ); ?></option>
				<option value="self" <?php if($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'saha'); ?></option>
			</select>
		</p>

		<h3 style="margin-top:20px;margin-bottom:5px;"><?php _e( 'Social Links','saha' ); ?></h3>  
		<small style="display:block;margin-bottom:10px;"><?php _e('Enter the full URL to your social profile','saha'); ?></small>

		<ul id="<?php echo $this->get_field_id( 'social_services' ); ?>" class="services-list">
			<input type="hidden" id="<?php echo $this->get_field_name( 'social_services' ); ?>" value="<?php echo $this->get_field_name( 'social_services' ); ?>">
			<input type="hidden" id="<?php echo wp_create_nonce('Saha_About_Me_Widget_nonce'); ?>">
			<?php
			$social_services = $instance['social_services'];
			foreach( $social_services as $key => $service ) {
				$url=0;
				if(isset($service['url'])) $url 	= $service['url'];
				if(isset($service['name'])) $name 	= $service['name']; ?>

				<li id="<?php echo $this->get_field_id( $service ); ?>_0<?php echo $key ?>">
					<p>
						<label for="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $key ?>-name"><?php echo esc_attr( $name ); ?>:</label>
						<input type="hidden" id="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $key ?>-url" name="<?php echo $this->get_field_name( 'social_services' ).'['.$key.'][name]'; ?>" value="<?php echo esc_attr( $name ); ?>">
						<input type="url" class="widefat" id="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $key ?>-url" name="<?php echo $this->get_field_name( 'social_services' ).'['.$key.'][url]'; ?>" value="<?php echo esc_url( $url ); ?>" />
					</p>
				</li>

			<?php } ?>
		</ul>

	<?php

	}

}