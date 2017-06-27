<?php
/**
 * Posts Thumbnails Widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Posts_Thumbnails_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-posts-thumbnails posts-thumbnails-widget',
			'description' => __( 'Shows a listing of your recent or random posts.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-posts-thumbnails', 					// $this->id_base
			__( '&raquo; Posts Thumbnails', 'saha' ), 	// $this->name
			$widget_options                 			// $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$number 		= $instance['number'];
		$order 			= $instance['order'];
		$img_height 	= ( !empty( $instance['img_height'] ) ) ? intval( $instance['img_height'] ) : '65';
		$img_width 		= ( !empty( $instance['img_width'] ) ) ? intval( $instance['img_width'] ) : '65';
		$image 			= isset( $instance['image'] ) ? $instance['image'] : '';
		$post_type 		= $instance['post_type'];

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		} ?>

			<ul class="clr">
				<?php
				global $post;
				$args = array(
					'post_type'			=> $post_type,
					'numberposts'		=> $number,
					'orderby'			=> $order,
					'no_found_rows'		=> true,
					'suppress_filters'	=> false,
					'meta_key'			=> '_thumbnail_id',
				);
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) : setup_postdata($post);

				if( has_post_thumbnail() ) {
					$featured_image = saha_image_resize( wp_get_attachment_url( get_post_thumbnail_id() ), $img_width, $img_height ); ?>

					<li>
						<?php if ( $image !== '1' ) { ?>
							<a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="recent-posts-thumbnail">
								<img src="<?php echo esc_url( $featured_image['url'] ); ?>" alt="<?php echo the_title(); ?>" />
							</a>
						<?php } ?>

						<a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="recent-posts-title"><?php echo the_title(); ?></a>

						<div class="info-wrap">
							<div class="recent-posts-date"><i class="icon-clock"></i><?php echo get_the_date(); ?></div>
							<div class="recent-posts-comments"><i class="icon-bubbles"></i><?php echo comments_popup_link( __( '0', 'saha' ), __( '1',  'saha' ), __( '%', 'saha' ), 'comments-link' ); ?></div>
						</div>
					</li>
				<?php }

				endforeach; wp_reset_postdata(); ?>

			</ul>

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

		$instance['title']   		= strip_tags( $new_instance['title'] );
		$instance['number'] 		= strip_tags($new_instance['number']);
		$instance['order'] 			= strip_tags($new_instance['order']);
		$instance['img_height'] 	= strip_tags($new_instance['img_height']);
		$instance['img_width'] 		= strip_tags($new_instance['img_width']);
		$instance['image'] 			= strip_tags($new_instance['image']);
		$instance['post_type'] 		= strip_tags($new_instance['post_type']);

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
			'title'   		=> esc_html__( 'Recent Posts', 'saha' ),
			'post_type'		=> 'post',
			'number'		=> '3',
			'order'			=> 'ASC',
			'image'			=> '',
			'img_height'	=> '65',
			'img_width'		=> '65',
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
			<label for="<?php echo $this->get_field_id('post_type'); ?>">
				<?php _e( 'Post Type?', 'saha' ); ?>
			</label> 
			<br />
			<select class='widefat' name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>">
				<option value="post" <?php if($instance['post_type'] == 'post') { ?>selected="selected"<?php } ?>><?php _e( 'Post', 'saha' ); ?></option>
				<?php
				//get post_typeonomies
				$args=array('public' => true,'_builtin' => false, 'exclude_from_search' => false); 
				$output = 'names'; // or objects
				$operator = 'and'; // 'and' or 'or'
				$get_post_types = get_post_types($args,$output,$operator);
				foreach ($get_post_types as $get_post_type ) {
					if( $get_post_type != 'post' && $get_post_type !== 'faq' ){ ?>
					<option value="<?php echo $get_post_type; ?>" id="<?php $get_post_type; ?>" <?php if($instance['post_type'] == $get_post_type) { ?>selected="selected"<?php } ?>><?php echo ucfirst( $get_post_type ); ?></option>
				<?php } } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>">
				<?php _e( 'Random or Recent?', 'saha' ); ?>
			</label>
			<br />
			<select class='widefat' name="<?php echo $this->get_field_name('order'); ?>" id="<?php echo $this->get_field_id('order'); ?>">
				<option value="ASC" <?php if($instance['order'] == 'ASC') { ?>selected="selected"<?php } ?>><?php _e( 'Recent', 'saha' ); ?></option>
				<option value="rand" <?php if($instance['order'] == 'rand') { ?>selected="selected"<?php } ?>><?php _e( 'Random', 'saha' ); ?></option>
				<option value="comment_count" <?php if($instance['order'] == 'comment_count' ) { ?>selected="selected"<?php } ?>><?php _e( 'Most Comments', 'saha' ); ?></option>
				<option value="modified" <?php if($instance['order'] == 'modified' ) { ?>selected="selected"<?php } ?>><?php _e( 'Last Modified', 'saha' ); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">
				<?php _e( 'Number to Show', 'saha' ); ?>
			</label> 
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance['number']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('img_width'); ?>">
				<?php _e( 'Image Width', 'saha' ); ?>
			</label> 
			<input class="widefat" id="<?php echo $this->get_field_id('img_width'); ?>" name="<?php echo $this->get_field_name('img_width'); ?>" type="text" value="<?php echo $instance['img_width']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('img_height'); ?>">
				<?php _e( 'Image Height', 'saha' ); ?>
			</label> 
			<input class="widefat" id="<?php echo $this->get_field_id('img_height'); ?>" name="<?php echo $this->get_field_name('img_height'); ?>" type="text" value="<?php echo $instance['img_height']; ?>" />
		</p>

		<p style="clear: both;">
			<input id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['image'] ); ?> />
			<label for="<?php echo $this->get_field_id('image'); ?>">
				<?php _e( 'Disable Featured Image?', 'saha' ); ?>
			</label>
		</p>

	<?php

	}

}