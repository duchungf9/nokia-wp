<?php
/**
 * Tabbed widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Tabs_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-tabs',
			'description' => __( 'Display popular posts, recent posts, recent comments and tags in tabs.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-tabs',                  // $this->id_base
			__( '&raquo; Tabs', 'saha' ), // $this->name
			$widget_options               // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$number = $instance['number'];

		// Output the theme's $before_widget wrapper.
		echo $before_widget;
		?>
		
			<div class="tabs-widget">
				<div class="saha-top">
					<ul class="tabs-nav">
						<li class="active"><a href="#tab1" title="<?php esc_attr_e( 'Latest', 'saha' ); ?>"><i class="icon-clock"></i></a></li>
						<li><a href="#tab2" title="<?php esc_attr_e( 'Comments', 'saha' ); ?>"><i class="icon-bubbles"></i></a></li>        
						<li><a href="#tab3" title="<?php esc_attr_e( 'Tags', 'saha' ); ?>"><i class="icon-tag"></i></a></li>
					</ul>
				</div>

				<div class="tabs-container">
					<div class="tab-content" id="tab1">
						<ul>
							<?php echo saha_latest_posts( $number ); ?>
						</ul>
					</div>

					<div class="tab-content" id="tab2">
						<ul>
							<?php echo saha_most_commented( $number );?>
						</ul>
					</div>

					<div class="tab-content saha-tagcloud" id="tab3">
						<?php wp_tag_cloud( $args = array('largest' => 11,'number' => 25,'orderby'=> 'count', 'order' => 'DESC' )); ?>
					</div>
				</div>
			</div>

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

		$instance['number'] = strip_tags( $new_instance['number'] );

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
			'number'  => 5,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">
				<?php _e( 'Number Of Items To Show', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo absint( $instance['number'] ); ?>" />
		</p>

	<?php

	}

}

/**
 * Post Thumbnails size
 *
 * @since  1.0.0
 */
if ( function_exists( 'add_image_size' ) ){
	add_image_size( 'saha-small', 110, 75, true );
}

/**
 * Recent Posts
 *
 * @since  1.0.0
 */
function saha_latest_posts( $number = 5, $thumb = true ) {

	// Posts query arguments.
	$args = array(
		'posts_per_page' => $number,
		'orderby'        => 'comment_count',
		'post_type'      => 'post'
	);

	// The post query
	$popular = new WP_Query( $args );

	global $post;

	if ( $popular->have_posts() ) {

		while ( $popular->have_posts() ) :
			$popular->the_post(); ?>

			<li>
				<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) { ?>	
					<div class="saha-post-thumbnail">
						<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo the_post_thumbnail( 'saha-small' ); ?></a>
					</div>
				<?php } ?>
				<h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo esc_attr( get_the_title() ); ?></a></h2>
				<span class="saha-date"><i class="icon-clock"></i><?php echo esc_html( get_the_date() ); ?></span>
			</li>

		<?php endwhile;

	}

	// Reset the query.
	wp_reset_postdata();

}

/**
 * Most commented posts
 *
 * @since 1.0.0
 */
function saha_most_commented( $number = 5, $avatar_size = 55 ) {

	$comments = get_comments('status=approve&number='.$number);

	foreach ($comments as $comment) { ?>

		<li>
			<div class="saha-post-thumbnail" style="width:<?php echo esc_attr( $avatar_size ); ?>px">
				<?php echo get_avatar( $comment, $avatar_size ); ?>
			</div>
			<a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID ) ); ?>#comment-<?php echo $comment->comment_ID; ?>">
				<?php echo strip_tags($comment->comment_author); ?>: <?php echo wp_html_excerpt( $comment->comment_content, 80 ); ?>...
			</a>
		</li>

	<?php }

}