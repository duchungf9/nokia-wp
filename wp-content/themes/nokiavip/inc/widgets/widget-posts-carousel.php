<?php
/**
 * Posts carousel widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Posts_Carousel_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-posts-carousel posts-carousel-widget',
			'description' => __( 'Displays your posts in carousel.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-posts-carousel',                  	// $this->id_base
			__( '&raquo; Posts Carousel', 'saha' ), 	// $this->name
			$widget_options                    			// $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$exclude_categories 	= $instance['exclude_categories'];
		$effect 				= $instance['effect'];
		$navigation 			= $instance['navigation'];
		$number 				= $instance['number'];
		$columns 				= $instance['columns'];
		$width 					= $instance['width'];
		$height 				= $instance['height'];
		$orderby 				= $instance['orderby'];
		$order 					= $instance['order'];
		$excerpt 				= $instance['excerpt'];
		$center 				= $instance['center'];
		$date 					= $instance['date'];
		$author 				= $instance['author'];
		$category 				= $instance['category'];
		$comment 				= $instance['comment'];
		$more 					= $instance['more'];
		$desktopsmall 			= $instance['desktopsmall'];
		$itemstablet 			= $instance['itemstablet'];
		$itemsmobile 			= $instance['itemsmobile'];
		$random 				= rand( 0, 999999 );

		global $post;

		// Exclude categories
		if ( $exclude_categories ) {
			$exclude_categories = explode( ',', $exclude_categories );
			if( ! empty( $exclude_categories ) && is_array( $exclude_categories ) ) {
				foreach ( $exclude_categories as $key ) {
					$key = get_term_by( 'slug', $key, 'category' );
				}

				$exclude_categories = array(
					'taxonomy'	=> 'category',
					'field'		=> 'slug',
					'terms'		=> $exclude_categories,
					'operator'	=> 'NOT IN',
				);
			} else {
				$exclude_categories = '';
			}
		}

		// Classes
		$classes = 'saha-posts-carousel-wrap';

		// Effect
		if ( $effect ) {
			$classes .= ' saha_effect wow ' . $effect;
		}

		// Center
		if ( $center ) {
			$classes .= ' center';
		}

		$counter = 0;

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		} ?>

			<div id="saha-posts-carousel-<?php echo esc_attr( $random ); ?>" class="saha-posts-carousel clr owl-carousel owl-theme" data-navigation="<?php echo esc_attr( $navigation ); ?>" data-items="<?php echo esc_attr( $columns ); ?>" <?php if ( $desktopsmall ) { ?>data-desktopsmall="<?php echo esc_attr( $desktopsmall ); ?>"<?php } ?> <?php if ( $itemstablet ) { ?>data-itemstablet="<?php echo esc_attr( $itemstablet ); ?>"<?php } ?> <?php if ( $itemsmobile ) { ?>data-itemsmobile="<?php echo esc_attr( $itemsmobile ); ?>"<?php } ?>>
				<?php
				$args = array(
					'post_type' 		=> 'post',
					'post_status' 		=> 'publish',
					'posts_per_page' 	=> $number,
					'orderby'			=> $orderby,
					'order'				=> $order,
					'tax_query'			=> array(
						'relation'		=> 'AND',
						$exclude_categories,
					),
				);

				$myposts = new WP_Query( $args );

				if ( $myposts->have_posts() ) :

					while ( $myposts->have_posts() ) : $myposts->the_post();

						// Images
						$featured_image = saha_image_resize( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ), $width, $height, true ); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?> data-wow-delay="<?php echo esc_attr( $counter * 300 ); ?>ms" <?php hybrid_attr( 'post' ); ?>>

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="entry-media">
									<a class="thumbnail-link" href="<?php the_permalink(); ?>">
										<img src="<?php echo esc_url( $featured_image['url'] ); ?>" width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>" alt="<?php echo get_the_title(); ?>" />
									</a>
									<?php if ( $date != '1' ) { ?>
										<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>>
											<span class="month"><?php echo get_the_time('M'); ?></span> / <span class="date"><?php echo get_the_time('d'); ?></span>
										</time>
									<?php } ?>
								</div>
							<?php endif; ?>

							<header class="entry-header">

								<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

								<?php if ( $author != '1' || $category != '1' || $comment != '1' ) { ?>
									<ul class="entry-meta">
										<?php if ( $author != '1' ) { ?>
											<li class="entry-meta-author" <?php hybrid_attr( 'entry-author' ); ?>>
												<i class="icon-user"></i>
												<?php echo esc_html( the_author_posts_link() ); ?>
											</li>
										<?php } ?>

										<?php if ( $category != '1' ) { ?>
											<li class="entry-meta-category" <?php hybrid_attr( 'entry-terms', 'category' ); ?>>
												<?php
													/* translators: used between list items, there is a space after the comma */
													$categories_list = get_the_category_list( __( ', ', 'saha' ) );
													if ( $categories_list && saha_categorized_blog() ) :
												?>
												<i class="icon-folder-alt"></i>
												<?php echo $categories_list; ?>
												<?php endif; // End if categories ?>
											</li>
										<?php } ?>

										<?php if ( $comment != '1' ) { ?>
											<li class="entry-meta-comment" <?php hybrid_attr( 'entry-comment' ); ?>>
												<i class="icon-bubbles"></i>
												<?php esc_html( comments_popup_link( __( '0 Comments', 'saha' ), __( '1 Comment',  'saha' ), __( '% Comments', 'saha' ), 'comments-link' ) ); ?>
											</li>
										<?php } ?>
									</ul>
								<?php } ?>
								
							</header>

							<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
								<?php echo wp_trim_words( get_the_content() , $excerpt ); ?>
							</div>

							<?php if ( $more != '1' ) { ?>
								<span class="more-link-wrapper">
									<a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Continue Reading', 'saha' ); ?></a>
								</span>
							<?php } ?>
							
						</article>

					<?php $counter++;

					endwhile;

				endif; wp_reset_postdata(); ?>
			</div>

			<script type="text/javascript">
				jQuery(document).ready(function() {
				    var slider          = jQuery('#saha-posts-carousel-<?php echo esc_attr( $random ); ?>'),
				        navigation      = slider.data('navigation'),
				        items           = slider.data('items'),
				        desktopsmall    = slider.data('desktopsmall'),
				        itemstablet     = slider.data('itemstablet'),
				        itemsmobile     = slider.data('itemsmobile');

				    slider.owlCarousel({
				        items: items,
				        itemsDesktop : [1199,items],
				        itemsDesktopSmall : [1024,desktopsmall],
				        itemsTablet: [768,itemstablet],
				        itemsMobile : [568,itemsmobile],
				        navigation : navigation,
				        navigationText: ['<span class="fa fa-angle-left"></span>','<span class="fa fa-angle-right"></span>'],
				        pagination: false,
				    });
				});
			</script>

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

		$instance['title']      			= strip_tags( $new_instance['title'] );
		$instance['effect'] 				= strip_tags($new_instance['effect']);
		$instance['exclude_categories'] 	= strip_tags($new_instance['exclude_categories']);
		$instance['navigation'] 			= strip_tags($new_instance['navigation']);
		$instance['number'] 				= strip_tags($new_instance['number']);
		$instance['columns'] 				= strip_tags($new_instance['columns']);
		$instance['orderby'] 				= strip_tags($new_instance['orderby']);
		$instance['width'] 					= strip_tags($new_instance['width']);
		$instance['height'] 				= strip_tags($new_instance['height']);
		$instance['order'] 					= strip_tags($new_instance['order']);
		$instance['excerpt'] 				= strip_tags($new_instance['excerpt']);
		$instance['center'] 				= strip_tags($new_instance['center']);
		$instance['date'] 					= strip_tags($new_instance['date']);
		$instance['author'] 				= strip_tags($new_instance['author']);
		$instance['category'] 				= strip_tags($new_instance['category']);
		$instance['comment'] 				= strip_tags($new_instance['comment']);
		$instance['more'] 					= strip_tags($new_instance['more']);
		$instance['desktopsmall'] 			= strip_tags($new_instance['desktopsmall']);
		$instance['itemstablet'] 			= strip_tags($new_instance['itemstablet']);
		$instance['itemsmobile'] 			= strip_tags($new_instance['itemsmobile']);

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
			'title'     			=> esc_html__( 'Latest Posts', 'saha' ),
			'effect'				=> '',
			'exclude_categories' 	=> '',
			'navigation'			=> esc_html__( 'True', 'saha' ),
			'number'				=> '8',
			'columns'				=> '4',
			'width'					=> '',
			'height'				=> '',
			'orderby'				=> esc_html__( 'Date', 'saha' ),
			'order'					=> esc_html__( 'ASC', 'saha' ),
			'excerpt'				=> '20',
			'center'				=> '',
			'date'					=> '',
			'author'				=> '',
			'category'				=> '',
			'comment'				=> '',
			'more'					=> '',
			'desktopsmall'			=> '',
			'itemstablet'			=> '',
			'itemsmobile'			=> '',
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
			<label for="<?php echo $this->get_field_id( 'exclude_categories' ); ?>">
				<?php _e( 'Exclude Categories:', 'saha' ); ?> <small style="font-size: 11px;"><?php _e( 'separate by commas', 'saha' ); ?></small>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'exclude_categories' ); ?>" name="<?php echo $this->get_field_name( 'exclude_categories' ); ?>" value="<?php echo esc_attr( $instance['exclude_categories'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('effect'); ?>">
				<?php _e( 'Posts Effect:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('effect'); ?>" id="<?php echo $this->get_field_id('effect'); ?>">
				<option value="" <?php if($instance['effect'] == '') { ?>selected="selected"<?php } ?>><?php _e( 'None', 'saha' ); ?></option>
				<option value="bounce" <?php if($instance['effect'] == 'bounce') { ?>selected="selected"<?php } ?>><?php _e( 'bounce', 'saha' ); ?></option>
				<option value="flash" <?php if($instance['effect'] == 'flash') { ?>selected="selected"<?php } ?>><?php _e( 'flash', 'saha' ); ?></option>
				<option value="pulse" <?php if($instance['effect'] == 'pulse') { ?>selected="selected"<?php } ?>><?php _e( 'pulse', 'saha' ); ?></option>
				<option value="rubberBand" <?php if($instance['effect'] == 'rubberBand') { ?>selected="selected"<?php } ?>><?php _e( 'rubberBand', 'saha' ); ?></option>
				<option value="shake" <?php if($instance['effect'] == 'shake') { ?>selected="selected"<?php } ?>><?php _e( 'shake', 'saha' ); ?></option>
				<option value="swing" <?php if($instance['effect'] == 'swing') { ?>selected="selected"<?php } ?>><?php _e( 'swing', 'saha' ); ?></option>
				<option value="tada" <?php if($instance['effect'] == 'tada') { ?>selected="selected"<?php } ?>><?php _e( 'tada', 'saha' ); ?></option>
				<option value="wobble" <?php if($instance['effect'] == 'wobble') { ?>selected="selected"<?php } ?>><?php _e( 'wobble', 'saha' ); ?></option>
				<option value="jello" <?php if($instance['effect'] == 'jello') { ?>selected="selected"<?php } ?>><?php _e( 'jello', 'saha' ); ?></option>
				<option value="bounceIn" <?php if($instance['effect'] == 'bounceIn') { ?>selected="selected"<?php } ?>><?php _e( 'bounceIn', 'saha' ); ?></option>
				<option value="bounceInDown" <?php if($instance['effect'] == 'bounceInDown') { ?>selected="selected"<?php } ?>><?php _e( 'bounceInDown', 'saha' ); ?></option>
				<option value="bounceInLeft" <?php if($instance['effect'] == 'bounceInLeft') { ?>selected="selected"<?php } ?>><?php _e( 'bounceInLeft', 'saha' ); ?></option>
				<option value="bounceInRight" <?php if($instance['effect'] == 'bounceInRight') { ?>selected="selected"<?php } ?>><?php _e( 'bounceInRight', 'saha' ); ?></option>
				<option value="bounceInUp" <?php if($instance['effect'] == 'bounceInUp') { ?>selected="selected"<?php } ?>><?php _e( 'bounceInUp', 'saha' ); ?></option>
				<option value="fadeIn" <?php if($instance['effect'] == 'fadeIn') { ?>selected="selected"<?php } ?>><?php _e( 'fadeIn', 'saha' ); ?></option>
				<option value="fadeInDown" <?php if($instance['effect'] == 'fadeInDown') { ?>selected="selected"<?php } ?>><?php _e( 'fadeInDown', 'saha' ); ?></option>
				<option value="fadeInDownBig" <?php if($instance['effect'] == 'fadeInDownBig') { ?>selected="selected"<?php } ?>><?php _e( 'fadeInDownBig', 'saha' ); ?></option>
				<option value="fadeInLeft" <?php if($instance['effect'] == 'fadeInLeft') { ?>selected="selected"<?php } ?>><?php _e( 'fadeInLeft', 'saha' ); ?></option>
				<option value="fadeInLeftBig" <?php if($instance['effect'] == 'fadeInLeftBig') { ?>selected="selected"<?php } ?>><?php _e( 'fadeInLeftBig', 'saha' ); ?></option>
				<option value="fadeInRight" <?php if($instance['effect'] == 'fadeInRight') { ?>selected="selected"<?php } ?>><?php _e( 'fadeInRight', 'saha' ); ?></option>
				<option value="fadeInRightBig" <?php if($instance['effect'] == 'fadeInRightBig') { ?>selected="selected"<?php } ?>><?php _e( 'fadeInRightBig', 'saha' ); ?></option>
				<option value="fadeInUp" <?php if($instance['effect'] == 'fadeInUp') { ?>selected="selected"<?php } ?>><?php _e( 'fadeInUp', 'saha' ); ?></option>
				<option value="fadeInUpBig" <?php if($instance['effect'] == 'fadeInUpBig') { ?>selected="selected"<?php } ?>><?php _e( 'fadeInUpBig', 'saha' ); ?></option>
				<option value="flip" <?php if($instance['effect'] == 'flip') { ?>selected="selected"<?php } ?>><?php _e( 'flip', 'saha' ); ?></option>
				<option value="flipInX" <?php if($instance['effect'] == 'flipInX') { ?>selected="selected"<?php } ?>><?php _e( 'flipInX', 'saha' ); ?></option>
				<option value="flipInY" <?php if($instance['effect'] == 'flipInY') { ?>selected="selected"<?php } ?>><?php _e( 'flipInY', 'saha' ); ?></option>
				<option value="lightSpeedIn" <?php if($instance['effect'] == 'lightSpeedIn') { ?>selected="selected"<?php } ?>><?php _e( 'lightSpeedIn', 'saha' ); ?></option>
				<option value="rotateIn" <?php if($instance['effect'] == 'rotateIn') { ?>selected="selected"<?php } ?>><?php _e( 'rotateIn', 'saha' ); ?></option>
				<option value="rotateInDownLeft" <?php if($instance['effect'] == 'rotateInDownLeft') { ?>selected="selected"<?php } ?>><?php _e( 'rotateInDownLeft', 'saha' ); ?></option>
				<option value="rotateInDownRight" <?php if($instance['effect'] == 'rotateInDownRight') { ?>selected="selected"<?php } ?>><?php _e( 'rotateInDownRight', 'saha' ); ?></option>
				<option value="rotateInUpLeft" <?php if($instance['effect'] == 'rotateInUpLeft') { ?>selected="selected"<?php } ?>><?php _e( 'rotateInUpLeft', 'saha' ); ?></option>
				<option value="rotateInUpRight" <?php if($instance['effect'] == 'rotateInUpRight') { ?>selected="selected"<?php } ?>><?php _e( 'rotateInUpRight', 'saha' ); ?></option>
				<option value="hinge" <?php if($instance['effect'] == 'hinge') { ?>selected="selected"<?php } ?>><?php _e( 'hinge', 'saha' ); ?></option>
				<option value="rollIn" <?php if($instance['effect'] == 'rollIn') { ?>selected="selected"<?php } ?>><?php _e( 'rollIn', 'saha' ); ?></option>
				<option value="zoomIn" <?php if($instance['effect'] == 'zoomIn') { ?>selected="selected"<?php } ?>><?php _e( 'zoomIn', 'saha' ); ?></option>
				<option value="zoomInDown" <?php if($instance['effect'] == 'zoomInDown') { ?>selected="selected"<?php } ?>><?php _e( 'zoomInDown', 'saha' ); ?></option>
				<option value="zoomInLeft" <?php if($instance['effect'] == 'zoomInLeft') { ?>selected="selected"<?php } ?>><?php _e( 'zoomInLeft', 'saha' ); ?></option>
				<option value="zoomInRight" <?php if($instance['effect'] == 'zoomInRight') { ?>selected="selected"<?php } ?>><?php _e( 'zoomInRight', 'saha' ); ?></option>
				<option value="zoomInUp" <?php if($instance['effect'] == 'zoomInUp') { ?>selected="selected"<?php } ?>><?php _e( 'zoomInUp', 'saha' ); ?></option>
				<option value="slideInDown" <?php if($instance['effect'] == 'slideInDown') { ?>selected="selected"<?php } ?>><?php _e( 'slideInDown', 'saha' ); ?></option>
				<option value="slideInLeft" <?php if($instance['effect'] == 'slideInLeft') { ?>selected="selected"<?php } ?>><?php _e( 'slideInLeft', 'saha' ); ?></option>
				<option value="slideInRight" <?php if($instance['effect'] == 'slideInRight') { ?>selected="selected"<?php } ?>><?php _e( 'slideInRight', 'saha' ); ?></option>
				<option value="slideInUp" <?php if($instance['effect'] == 'slideInUp') { ?>selected="selected"<?php } ?>><?php _e( 'slideInUp', 'saha' ); ?></option>
			</select>
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
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">
				<?php _e( 'Number of Posts:', 'saha' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" size="3" />
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
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>">
				<?php _e( 'Images Width:', 'saha' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $instance['width'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>">
				<?php _e( 'Images Height:', 'saha' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $instance['height'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('orderby'); ?>">
				<?php _e( 'Order By:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('orderby'); ?>" id="<?php echo $this->get_field_id('orderby'); ?>">
				<option value="date" <?php if($instance['orderby'] == 'date') { ?>selected="selected"<?php } ?>><?php _e( 'Date', 'saha' ); ?></option>
				<option value="title" <?php if($instance['orderby'] == 'title') { ?>selected="selected"<?php } ?>><?php _e( 'Title', 'saha' ); ?></option>
				<option value="modified" <?php if($instance['orderby'] == 'modified') { ?>selected="selected"<?php } ?>><?php _e( 'Last Modified', 'saha' ); ?></option>
				<option value="rand" <?php if($instance['orderby'] == 'rand') { ?>selected="selected"<?php } ?>><?php _e( 'Random', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>">
				<?php _e( 'Order:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('order'); ?>" id="<?php echo $this->get_field_id('order'); ?>">
				<option value="asc" <?php if($instance['order'] == 'asc') { ?>selected="selected"<?php } ?>><?php _e( 'ASC', 'saha' ); ?></option>
				<option value="desc" <?php if($instance['order'] == 'desc') { ?>selected="selected"<?php } ?>><?php _e( 'DESC', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt' ); ?>">
				<?php _e( 'Custom Excerpt:', 'saha' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'excerpt' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'excerpt' ); ?>" type="text" value="<?php echo esc_attr( $instance['excerpt'] ); ?>" size="3" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('center'); ?>" name="<?php echo $this->get_field_name('center'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['center'] ); ?> />
			<label for="<?php echo $this->get_field_id('center'); ?>">
				<?php _e( 'Center the text?', 'saha' ); ?>
			</label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('date'); ?>" name="<?php echo $this->get_field_name('date'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['date'] ); ?> />
			<label for="<?php echo $this->get_field_id('date'); ?>">
				<?php _e( 'Hide posts date', 'saha' ); ?>
			</label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('author'); ?>" name="<?php echo $this->get_field_name('author'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['author'] ); ?> />
			<label for="<?php echo $this->get_field_id('author'); ?>">
				<?php _e( 'Hide posts author', 'saha' ); ?>
			</label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['category'] ); ?> />
			<label for="<?php echo $this->get_field_id('category'); ?>">
				<?php _e( 'Hide posts category', 'saha' ); ?>
			</label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('comment'); ?>" name="<?php echo $this->get_field_name('comment'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['comment'] ); ?> />
			<label for="<?php echo $this->get_field_id('comment'); ?>">
				<?php _e( 'Hide posts comment', 'saha' ); ?>
			</label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('more'); ?>" name="<?php echo $this->get_field_name('more'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['more'] ); ?> />
			<label for="<?php echo $this->get_field_id('more'); ?>">
				<?php _e( 'Hide more button', 'saha' ); ?>
			</label>
		</p>
		
		<h3 style="margin: 30px 0 0 0;clear: both;"><?php _e( 'Number of Columns in Responsive', 'saha' ); ?></h3>

		<p>
			<label for="<?php echo $this->get_field_id('desktopsmall'); ?>">
				<?php _e( 'Small Desktop:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('desktopsmall'); ?>" id="<?php echo $this->get_field_id('desktopsmall'); ?>">
				<option value="" <?php if($instance['desktopsmall'] == '') { ?>selected="selected"<?php } ?>><?php _e( 'Default', 'saha' ); ?></option>
				<option value="1" <?php if($instance['desktopsmall'] == '1') { ?>selected="selected"<?php } ?>><?php _e( '1', 'saha' ); ?></option>
				<option value="2" <?php if($instance['desktopsmall'] == '2') { ?>selected="selected"<?php } ?>><?php _e( '2', 'saha' ); ?></option>
				<option value="3" <?php if($instance['desktopsmall'] == '3') { ?>selected="selected"<?php } ?>><?php _e( '3', 'saha' ); ?></option>
				<option value="4" <?php if($instance['desktopsmall'] == '4') { ?>selected="selected"<?php } ?>><?php _e( '4', 'saha' ); ?></option>
				<option value="5" <?php if($instance['desktopsmall'] == '5') { ?>selected="selected"<?php } ?>><?php _e( '5', 'saha' ); ?></option>
				<option value="6" <?php if($instance['desktopsmall'] == '6') { ?>selected="selected"<?php } ?>><?php _e( '6', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('itemstablet'); ?>">
				<?php _e( 'Tablet:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('itemstablet'); ?>" id="<?php echo $this->get_field_id('itemstablet'); ?>">
				<option value="" <?php if($instance['itemstablet'] == '') { ?>selected="selected"<?php } ?>><?php _e( 'Default', 'saha' ); ?></option>
				<option value="1" <?php if($instance['itemstablet'] == '1') { ?>selected="selected"<?php } ?>><?php _e( '1', 'saha' ); ?></option>
				<option value="2" <?php if($instance['itemstablet'] == '2') { ?>selected="selected"<?php } ?>><?php _e( '2', 'saha' ); ?></option>
				<option value="3" <?php if($instance['itemstablet'] == '3') { ?>selected="selected"<?php } ?>><?php _e( '3', 'saha' ); ?></option>
				<option value="4" <?php if($instance['itemstablet'] == '4') { ?>selected="selected"<?php } ?>><?php _e( '4', 'saha' ); ?></option>
				<option value="5" <?php if($instance['itemstablet'] == '5') { ?>selected="selected"<?php } ?>><?php _e( '5', 'saha' ); ?></option>
				<option value="6" <?php if($instance['itemstablet'] == '6') { ?>selected="selected"<?php } ?>><?php _e( '6', 'saha' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('itemsmobile'); ?>">
				<?php _e( 'Mobile:', 'saha' ); ?>
			</label>
			<select class='widefat' name="<?php echo $this->get_field_name('itemsmobile'); ?>" id="<?php echo $this->get_field_id('itemsmobile'); ?>">
				<option value="" <?php if($instance['itemsmobile'] == '') { ?>selected="selected"<?php } ?>><?php _e( 'Default', 'saha' ); ?></option>
				<option value="1" <?php if($instance['itemsmobile'] == '1') { ?>selected="selected"<?php } ?>><?php _e( '1', 'saha' ); ?></option>
				<option value="2" <?php if($instance['itemsmobile'] == '2') { ?>selected="selected"<?php } ?>><?php _e( '2', 'saha' ); ?></option>
				<option value="3" <?php if($instance['itemsmobile'] == '3') { ?>selected="selected"<?php } ?>><?php _e( '3', 'saha' ); ?></option>
				<option value="4" <?php if($instance['itemsmobile'] == '4') { ?>selected="selected"<?php } ?>><?php _e( '4', 'saha' ); ?></option>
				<option value="5" <?php if($instance['itemsmobile'] == '5') { ?>selected="selected"<?php } ?>><?php _e( '5', 'saha' ); ?></option>
				<option value="6" <?php if($instance['itemsmobile'] == '6') { ?>selected="selected"<?php } ?>><?php _e( '6', 'saha' ); ?></option>
			</select>
		</p>

	<?php

	}

}