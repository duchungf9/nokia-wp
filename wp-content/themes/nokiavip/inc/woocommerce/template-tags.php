<?php
/**
 * Custom template tags used to integrate this theme with WooCommerce.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_loading_search_icon' ) ) :
/**
 * Ajax search loading
 * 
 * @since  1.0.0
 */
function saha_loading_search_icon() { 
	return '"' . get_template_directory_uri() . '/assets/img/search.gif"';
}
endif;

if ( ! function_exists( 'saha_woocommerce_ajax_search_suggestion' ) ) :
/**
 * Extend yith ajax search
 * 
 * @since  1.0.0
 */
function saha_woocommerce_ajax_search_suggestion( $suggestions, $product ) {

    if ( defined( 'YITH_WCAS_PREMIUM' ) ) {
        return $suggestions;
    }

    $suggestions['img'] = $product->get_image( 'shop_thumbnail' );

    $suggestions['price'] = $product->get_price_html();

    return $suggestions;
}
endif;

if ( ! function_exists( 'saha_header_cart' ) ) :
/**
 * Display Header Cart
 * 
 * @since  1.0.0
 */
function saha_header_cart() {
	?>
		<li class="header-cart">
			<?php echo saha_cart_link(); ?>
			<?php echo saha_cart_dropdown(); ?>
		</li>
	<?php
}
endif;

if ( ! function_exists( 'saha_cart_link' ) ) :
/**
 * Cart link
 * 
 * @since  1.0.0
 */
function saha_cart_link() { ?>
	<a class="cart-contents links" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>">
		<span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
		<i class="icon-handbag"></i>
		<span class="text"><?php _e( 'Giỏ Hàng', 'saha' ); ?></span>
		<span class="mobile-count"><?php echo sprintf ( _n( '- %d item', '- %d items', WC()->cart->cart_contents_count, 'saha' ), WC()->cart->cart_contents_count ); ?></span>
	</a>
	<?php
}
endif;

if ( ! function_exists( 'saha_cart_dropdown' ) ) :
/**
 * Cart dropdown
 * 
 * @since  1.0.0
 */
function saha_cart_dropdown() {
	// Return if cart or checkout page
	if ( is_cart() || is_checkout() ) {
		return;
	} ?>

	<ul class="cart-dropdown cartwidget sub-menu">
		<li class="clr">
			<?php the_widget( 'WC_Widget_Cart' ); ?>
		</li>
	</ul>

	<?php
}
endif;

if ( ! function_exists( 'saha_header_compare' ) ) :
/**
 * Display Header compare
 * 
 * @since  1.0.0
 */
function saha_header_compare() {
	?>
		<li class="header-compare">
			<a href="#" class="yith-woocompare-open links"><i class="icon-shuffle"></i><?php echo _e('Compare', 'saha'); ?></a>
		</li>
	<?php
}
endif;

if ( ! function_exists( 'saha_header_wishlist' ) ) :
/**
 * Display Header wishlist
 * 
 * @since  1.0.0
 */
function saha_header_wishlist() {
	?>
		<li class="header-wishlist">
			<a href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>" class="links"><i class="icon-heart"></i><?php echo _e('My Wishlist', 'saha'); ?></a>
		</li>
	<?php
}
endif;

if ( ! function_exists( 'saha_before_content' ) ) :
/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
 * 
 * @since   1.0.0
 */
function saha_before_content() {
	?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
}
endif;

if ( ! function_exists( 'saha_after_content' ) ) :
/**
 * After Content
 * Closes the wrapping divs
 * 
 * @since   1.0.0
 */
function saha_after_content() {
	?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
}
endif;

if ( ! function_exists( 'saha_toolbar_wrapper' ) ) :
/**
 * Toolbar wrapper
 * 
 * @since   1.0.0
 */
function saha_toolbar_wrapper() {
	echo '<div class="saha-toolbar">';
}
endif;

if ( ! function_exists( 'saha_switcher' ) ) :
/**
 * Switcher
 * 
 * @since   1.0.0
 */
function saha_switcher() {
	if ( !saha_mod( PREFIX . 'woo-products-switcher' ) ) :
		return;
	endif;

	echo '<ul class="saha-switcher">';
	    echo '<li class="grid">';
	    	echo '<a href="#" class="grid active" data-mode="grid" title="Grid">';
	    		echo '<i class="icon-grid"></i>';
	    	echo '</a>';
	    echo '</li>';
	    echo '<li class="list">';
	    	echo '<a href="#" class="list" data-mode="list" title="List">';
	            echo '<i class="icon-list"></i>';
	        echo '</a>';
	    echo '</li>';
	echo '</ul>';
}
endif;

if ( ! function_exists( 'saha_number_products' ) ) :
/**
 * Custom number of products switch
 * 
 * @since   1.0.0
 */
function saha_number_products() {
	if ( function_exists( 'wc_get_template' ) ) {
		wc_get_template(  'global/number-products.php' );
	}
}
endif;

if ( ! function_exists( 'saha_toolbar_wrapper_close' ) ) :
/**
 * Toolbar wrapper close
 * 
 * @since   1.0.0
 */
function saha_toolbar_wrapper_close() {
	echo '</div>';
}
endif;

if ( ! function_exists( 'saha_before_loop_item' ) ) :
/**
 * Before shop loop item
 * 
 * @since   1.0.0
 */
function saha_before_loop_item() {
	echo '<div class="product-wrap grid-view">';

		echo '<div class="product-image">';

			// Out of Stock badge
			if ( function_exists( 'saha_woo_product_instock' ) && ! saha_woo_product_instock() ) {
				echo '<div class="outofstock-badge">';
					echo apply_filters( 'saha_woo_outofstock_text', __( 'Out of Stock', 'saha' ) );
				echo '</div>';
			}
}
endif;

if ( ! function_exists( 'saha_after_loop_item' ) ) :
/**
 * After shop loop item
 * 
 * @since   1.0.0
 */
function saha_after_loop_item() {
	global $product, $woocommerce;

			// Action buttons
			echo '<div class="action-button">';

				echo '<ul>';
					echo '<li>'; 
						if ( class_exists( 'YITH_WCWL_Shortcode' ) ) {
							echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
						}
					echo '</li>';

					echo '<li>'; 
						if ( class_exists( 'YITH_Woocompare' ) ) {
					        $action_add = 'yith-woocompare-add-product';
					        $url_args	= array(
					            'action' 	=> $action_add,
					            'id' 		=> $product->id
					        );
					        echo '<a href="'. wp_nonce_url( add_query_arg( $url_args ), $action_add ) .'" class="compare tooltip-up" title="'. __( 'Compare Product', 'saha' ) .'" data-product_id="'. esc_attr( $product->id ) .'">'. __( 'Compare', 'saha' ) .'</a>';
						}
					echo '</li>';

					echo '<li>';
					    echo '<a href="#" class="quick tooltip-up" data-prodid="'. esc_attr( $product->id ) .'" title="'. __( 'Quick View', 'saha' ) .'"><i class="icon-magnifier"></i></a>';
					echo '</li>';
				echo '</ul>';

			echo '</div>';

		echo '</div>';

		echo '<div class="product-details">';

			// Title
			echo '<a href="'. get_the_permalink() .'" class="title">'. get_the_title() .'</a>';

			// Price/Rating
			echo '<div class="inner">';
				woocommerce_template_loop_price();
				woocommerce_template_loop_rating();
			echo '</div>';

			// Button add to cart
			woocommerce_template_loop_add_to_cart();

		echo '</div>';

	echo '</div>';

	// List view
	if ( saha_mod( PREFIX . 'woo-products-switcher' ) && is_woocommerce() ) :
		echo '<div class="product-wrap list-view">';

			echo '<div class="product-image">';

				// Out of Stock badge
				if ( function_exists( 'saha_woo_product_instock' ) && ! saha_woo_product_instock() ) {
					echo '<div class="outofstock-badge">';
						echo apply_filters( 'saha_woo_outofstock_text', __( 'Out of Stock', 'saha' ) );
					echo '</div>';
				}

				// Images
				echo '<a href="'. get_the_permalink() .'">';
					saha_product_thumbnail();
					saha_cart_loading();
				echo '</a>';

			echo '</div>';

			echo '<div class="product-details">';

				// Title
				echo '<a href="'. get_the_permalink() .'" class="title">'. get_the_title() .'</a>';

				// Price/Rating
				echo '<div class="inner">';
					woocommerce_template_loop_price();
					woocommerce_template_loop_rating();
				echo '</div>';

				// Product excerpt
				woocommerce_template_single_excerpt();

				// Button add to cart
				echo '<div class="buttons">';
					woocommerce_template_loop_add_to_cart();
				echo '</div>';

				// Action buttons
				echo '<ul class="action-button">';
					echo '<li>'; 
						if ( class_exists( 'YITH_WCWL_Shortcode' ) ) {
							echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
						}
					echo '</li>';

					echo '<li>'; 
						if ( class_exists( 'YITH_Woocompare' ) ) {
					        $action_add = 'yith-woocompare-add-product';
					        $url_args	= array(
					            'action' 	=> $action_add,
					            'id' 		=> $product->id
					        );
					        echo '<a href="'. wp_nonce_url( add_query_arg( $url_args ), $action_add ) .'" class="compare tooltip-up" title="'. __( 'Compare Product', 'saha' ) .'" data-product_id="'. esc_attr( $product->id ) .'">'. __( 'Compare', 'saha' ) .'</a>';
						}
					echo '</li>';

					echo '<li>';
					    echo '<a href="#" class="quick tooltip-up" data-prodid="'. esc_attr( $product->id ) .'" title="'. __( 'Quick View', 'saha' ) .'"><i class="icon-magnifier"></i></a>';
					echo '</li>';
				echo '</ul>';

			echo '</div>';

		echo '</div>';
	endif;
}
endif;

if ( ! function_exists( 'saha_cart_loading' ) ) :
/**
 * Add loading when a product is in the cart
 * 
 * @since   1.0.0
 */
function saha_cart_loading() {
	global $product, $woocommerce;

	$items_in_cart = array();

	if($woocommerce->cart->get_cart() && is_array($woocommerce->cart->get_cart())) {
		foreach($woocommerce->cart->get_cart() as $cart) {
			$items_in_cart[] = $cart['product_id'];
		}
	}

	$in_cart = in_array(get_the_ID(), $items_in_cart);

	if ( $in_cart ) {
		echo '<span class="cart-loading added in_cart"><i class="icon-check"></i></span>';
	} else {
		echo '<span class="cart-loading"><i class="fa fa-spinner"></i></span>';
	}
}
endif;

if ( ! function_exists( 'saha_product_thumbnail' ) ) :
/**
 * Remove loop product thumbnail function and add our own
 * 
 * @since   1.0.0
 */
function saha_product_thumbnail() {
	if ( function_exists( 'wc_get_template' ) ) {
		wc_get_template(  'loop/thumbnail/image-swap.php' );
	}
}
endif;

if ( ! function_exists( 'saha_product_quick_view' ) ) :
/**
 * Ajax quick view
 * 
 * @since   1.0.0
 */
function saha_product_quick_view() {
	if ( empty( $_POST['prodid'] ) ) {
		echo 'Error: Absent product id';
		die();
	}

	$args = array(
		'p'			=> $_POST['prodid'],
		'post_type' => 'product'
	);

	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) : $the_query->the_post();
			wc_get_template( 'product-quick-view.php' );
		endwhile;
		wp_reset_query();
		wp_reset_postdata();
	} else {
		echo 'No posts were found!';
	}

	die();
}
endif;

if ( ! function_exists( 'saha_before_single_product' ) ) :
/**
 * Before single product
 * 
 * @since   1.0.0
 */
function saha_before_single_product() {
	echo '<div class="saha-row clr">';
		echo '<div class="col span_1_of_2">';
}
endif;

if ( ! function_exists( 'saha_after_single_product_image' ) ) :
/**
 * After single product image
 * 
 * @since   1.0.0
 */
function saha_after_single_product_image() {
		echo '</div>';
		echo '<div class="col span_1_of_2">';
}
endif;

if ( ! function_exists( 'saha_after_add_to_cart' ) ) :
/**
 * After add to cart
 * 
 * @since   1.0.0
 */
function saha_after_add_to_cart() {
	global $product, $woocommerce;

	echo '<ul class="action-button">';
		echo '<li>'; 
			if ( class_exists( 'YITH_WCWL_Shortcode' ) ) {
				echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
			}
		echo '</li>';

		echo '<li>'; 
			if ( class_exists( 'YITH_Woocompare' ) ) {
		        $action_add = 'yith-woocompare-add-product';
		        $url_args	= array(
		            'action' 	=> $action_add,
		            'id' 		=> $product->id
		        );
		        echo '<a href="'. wp_nonce_url( add_query_arg( $url_args ), $action_add ) .'" class="compare tooltip-up" title="'. __( 'Compare Product', 'saha' ) .'" data-product_id="'. esc_attr( $product->id ) .'">'. __( 'Compare', 'saha' ) .'</a>';
			}
		echo '</li>';
	echo '</ul>';
}
endif;

if ( ! function_exists( 'saha_woo_share' ) ) :
/**
 * Woo share
 * 
 * @since   1.0.0
 */
function saha_woo_share() {
	if ( saha_mod( PREFIX . 'woo-share' ) ) :
		echo saha_entry_share();
	endif;
}
endif;

if ( ! function_exists( 'saha_after_single_product' ) ) :
/**
 * After single product
 * 
 * @since   1.0.0
 */
function saha_after_single_product() {
		echo '</div>';
	echo '</div>';
}
endif;

if ( ! function_exists( 'saha_login_wrap_before' ) ) :
/**
 * Before my account login
 * 
 * @since   1.0.0
 */
function saha_login_wrap_before() {
	echo '<div class="saha-loginform-wrap">';
}
endif;

if ( ! function_exists( 'saha_login_wrap_after' ) ) :
/**
 * After my account login
 * 
 * @since   1.0.0
 */
function saha_login_wrap_after() {
	echo '</div>';
}
endif;

if ( ! function_exists( 'saha_before_subcategory' ) ) :
/**
 * Before subcategory
 * 
 * @since   1.0.0
 */
function saha_before_subcategory() {
	echo '<div class="product-wrap grid-view">';
}
endif;

if ( ! function_exists( 'saha_after_subcategory' ) ) :
/**
 * After subcategory
 * 
 * @since   1.0.0
 */
function saha_after_subcategory() {
	echo '</div>';
}
endif;

if ( ! function_exists( 'saha_upsell_display' ) ) :
/**
 * Upsells
 * Replace the default upsell function with our own which displays the correct number product columns
 * 
 * @since   1.0.0
 */
function saha_upsell_display() {
	woocommerce_upsell_display( -1, 3 );
}
endif;

if ( ! function_exists( 'saha_before_order_review' ) ) :
/**
 * Checkout page before order review
 * 
 * @since   1.0.0
 */
function saha_before_order_review() {
	echo '<div class="review-order-wrapper">';
}
endif;

if ( ! function_exists( 'saha_after_order_review' ) ) :
/**
 * Checkout page after order review
 * 
 * @since   1.0.0
 */
function saha_after_order_review() {
	echo '</div>';
}
endif;