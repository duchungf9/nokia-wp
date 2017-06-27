<?php
/**
 * Woo products widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Woo_Products_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-woo-products woo-products-widget',
			'description' => __( 'Displays your WooCommerce products.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-woo-products',                  			// $this->id_base
			__( '&raquo; WooCommerce Products', 'saha' ), 	// $this->name
			$widget_options                    				// $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$include_categories = $instance['include_categories'];
		$exclude_categories = $instance['exclude_categories'];
		$effect 			= $instance['effect'];
		$number 			= $instance['number'];
		$columns 			= $instance['columns'];
		$orderby 			= $instance['orderby'];
		$order 				= $instance['order'];
		$carousel 			= $instance['carousel'];
		$navigation 		= $instance['navigation'];
		$desktopsmall 		= $instance['desktopsmall'];
		$itemstablet 		= $instance['itemstablet'];
		$itemsmobile 		= $instance['itemsmobile'];
		$random 			= rand( 0, 999999 );
		$counter 			= 0;

		// Include categories
		$include_categories = ( 'all' == $include_categories ) ? '' : $include_categories;
		if ( $include_categories ) {
			$include_categories = explode( ',', $include_categories );
			foreach ( $include_categories as $key ) {
				$key = get_term_by( 'slug', $key, 'product_cat' );
			}
		}
			
		// Start Tax Query
		if( ! empty( $include_categories ) && is_array( $include_categories ) ) {
			$include_categories = array(
				'taxonomy'	=> 'product_cat',
				'field'		=> 'slug',
				'terms'		=> $include_categories,
				'operator'	=> 'IN',
			);
		} else {
			$include_categories = '';
		}

		// Exclude categories
		if ( $exclude_categories ) {
			$exclude_categories = explode( ',', $exclude_categories );
			if( ! empty( $exclude_categories ) && is_array( $exclude_categories ) ) {
				foreach ( $exclude_categories as $key ) {
					$key = get_term_by( 'slug', $key, 'product_cat' );
				}

				$exclude_categories = array(
					'taxonomy'	=> 'product_cat',
					'field'		=> 'slug',
					'terms'		=> $exclude_categories,
					'operator'	=> 'NOT IN',
				);
			} else {
				$exclude_categories = '';
			}
		}

		// Classes
		$classes_wrap = 'grid clr';
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
			$carousel = 0;
		}
		if ( $carousel ) {
			$classes_wrap .= ' saha-products owl-carousel owl-theme';
		} else {
			$classes_wrap .= ' saha-row';
		}

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		} ?>
			<div class="woocommerce">
				<ul <?php if ( $carousel ) { ?>id="saha-products-<?php echo esc_attr( $random ); ?>"<?php } ?> class="products <?php echo esc_attr( $classes_wrap ); ?>" <?php if ( $carousel ) { ?>data-navigation="<?php echo esc_attr( $navigation ); ?>" data-items="<?php echo esc_attr( $columns ); ?>" <?php if ( $desktopsmall ) { ?>data-desktopsmall="<?php echo esc_attr( $desktopsmall ); ?>"<?php } ?> <?php if ( $itemstablet ) { ?>data-itemstablet="<?php echo esc_attr( $itemstablet ); ?>"<?php } ?> <?php if ( $itemsmobile ) { ?>data-itemsmobile="<?php echo esc_attr( $itemsmobile ); ?>"<?php } ?><?php } ?>>
					<?php
					$args = array(
						'post_type' 		=> 'product',
						'post_status' 		=> 'publish',
						'posts_per_page' 	=> $number,
						'orderby'			=> $orderby,
						'order'				=> $order,
						'tax_query'			=> array(
							'relation'		=> 'AND',
							$include_categories,
							$exclude_categories,
						),
					);

					$myproducts = new WP_Query( $args );

					if ( $myproducts->have_posts() ) :

						while ( $myproducts->have_posts() ) : $myproducts->the_post();

							global $product, $woocommerce_loop;

							// Store loop count we're currently on
							if ( empty( $woocommerce_loop['loop'] ) ) {
								$woocommerce_loop['loop'] = 0;
							}

							// Store column count for displaying the grid
							if ( empty( $woocommerce_loop['columns'] ) ) {
								$woocommerce_loop['columns'] = $columns;
							}

							// Ensure visibility
							if ( ! $product || ! $product->is_visible() ) {
								return;
							}

							// Increase loop count
							$woocommerce_loop['loop']++;

							// Increase counter
							$counter++;

							// First product
							if ( $counter == 1 ) {
								$counter = '1';
							}

							// Restart counter
							if ( $counter == $columns + 1 ) {
								$counter = '1';
							}

							// Extra post classes
							$classes = array();
							if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
								$classes[] = 'first';
							}
							if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
								$classes[] = 'last';
							}
							if ( $effect ) {
								$classes[] = 'saha_effect wow ' . $effect;
							} ?>

							<li <?php post_class( $classes ); ?> data-wow-delay="<?php echo esc_attr( $counter * 300 ); ?>ms">

								<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

								<a href="<?php the_permalink(); ?>">

									<?php
										do_action( 'woocommerce_before_shop_loop_item_title' );

										do_action( 'woocommerce_shop_loop_item_title' );

										do_action( 'woocommerce_after_shop_loop_item_title' );
									?>
								</a>

								<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

							</li>

						<?php

						endwhile;

					endif; wp_reset_postdata(); ?>
				</ul>
			</div>

			<script type="text/javascript">
				jQuery(document).ready(function() {
					var slider          = jQuery('#saha-products-<?php echo esc_attr( $random ); ?>'),
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

		$instance['title']      		= strip_tags($new_instance['title']);
		$instance['include_categories'] = strip_tags($new_instance['include_categories']);
		$instance['effect'] 			= strip_tags($new_instance['effect']);
		$instance['number'] 			= strip_tags($new_instance['number']);
		$instance['columns'] 			= strip_tags($new_instance['columns']);
		$instance['orderby'] 			= strip_tags($new_instance['orderby']);
		$instance['order'] 				= strip_tags($new_instance['order']);
		$instance['carousel'] 			= strip_tags($new_instance['carousel']);
		$instance['navigation'] 		= strip_tags($new_instance['navigation']);
		$instance['desktopsmall'] 		= strip_tags($new_instance['desktopsmall']);
		$instance['itemstablet'] 		= strip_tags($new_instance['itemstablet']);
		$instance['itemsmobile'] 		= strip_tags($new_instance['itemsmobile']);

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
			'title'     			=> esc_html__( 'Products', 'saha' ),
			'include_categories' 	=> '',
			'exclude_categories' 	=> '',
			'effect'				=> '',
			'number'				=> '8',
			'columns'				=> '4',
			'orderby'				=> esc_html__( 'Date', 'saha' ),
			'order'					=> esc_html__( 'ASC', 'saha' ),
			'carousel'				=> '',
			'navigation'			=> esc_html__( 'True', 'saha' ),
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
			<label for="<?php echo $this->get_field_id( 'include_categories' ); ?>">
				<?php _e( 'Include Categories:', 'saha' ); ?> <small style="font-size: 11px;"><?php _e( 'separate by commas', 'saha' ); ?></small>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'include_categories' ); ?>" name="<?php echo $this->get_field_name( 'include_categories' ); ?>" value="<?php echo esc_attr( $instance['include_categories'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'exclude_categories' ); ?>">
				<?php _e( 'Exclude Categories:', 'saha' ); ?> <small style="font-size: 11px;"><?php _e( 'separate by commas', 'saha' ); ?></small>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'exclude_categories' ); ?>" name="<?php echo $this->get_field_name( 'exclude_categories' ); ?>" value="<?php echo esc_attr( $instance['exclude_categories'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('effect'); ?>">
				<?php _e( 'Products Animation:', 'saha' ); ?>
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
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">
				<?php _e( 'Number of Products:', 'saha' ); ?>
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
		
		<h3 style="margin: 30px 0 0 0;clear: both;"><?php _e( 'Products Carousel', 'saha' ); ?></h3>

		<p>
			<input id="<?php echo $this->get_field_id('carousel'); ?>" name="<?php echo $this->get_field_name('carousel'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['carousel'] ); ?> />
			<label for="<?php echo $this->get_field_id('carousel'); ?>">
				<?php _e( 'Show carousel products?', 'saha' ); ?>
			</label>
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
			<label for="<?php echo $this->get_field_id('desktopsmall'); ?>">
				<?php _e( 'Columns On Small Desktop:', 'saha' ); ?>
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
				<?php _e( 'Columns On Tablet:', 'saha' ); ?>
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
				<?php _e( 'Columns On Mobile:', 'saha' ); ?>
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