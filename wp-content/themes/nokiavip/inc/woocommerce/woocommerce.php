<?php
/**
 * WooCommerce compatibility and custom functions
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

// Declare WooCommerce support
add_theme_support( 'woocommerce' );

/**
 * Removes prettyPhoto from single product
 *
 * @since  1.0.0
*/
function saha_remove_woo_prettyphoto() {
    wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
    wp_dequeue_script( 'prettyPhoto' );
    wp_dequeue_script( 'prettyPhoto-init' );
}
add_action( 'wp_enqueue_scripts', 'saha_remove_woo_prettyphoto', 99 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the body element.
 * @return array
 */
function saha_shop_body_classes( $classes ) {

	// Shop Layouts
	$layout 		= saha_mod( PREFIX . 'shop-layouts' );
	$post_layout 	= get_post_layout( get_queried_object_id() );
	if ( is_woocommerce() && $post_layout == 'default' ) {
		if ( $layout == '1c' ) {
			$classes[] = 'layout-1c';
		} elseif ( $layout == '2c-l' ) {
			$classes[] = 'layout-2c-l';
		} else {
			$classes[] = 'layout-2c-r';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'saha_shop_body_classes' );

/**
 * Add classes to WooCommerce product entries.
 *
 * @since  1.0.0
 */
function saha_product_entry_classes( $classes ) {
	global $product, $woocommerce_loop;
	if ( $product && $woocommerce_loop ) {
		if ( $product->get_rating_html() ) {
			$classes[] = 'has-rating';
		}
		$classes[] = 'col';
		$classes[] = saha_grid_class( $woocommerce_loop['columns'] );
	}
	return $classes;
}
add_filter( 'post_class', 'saha_product_entry_classes' );

/**
 * Add classes to WooCommerce single product.
 *
 * @since  1.0.0
 */
function saha_single_product_classes( $classes ) {
	if ( is_product() ) {
		$classes[] = 'single-product';
	}
	return $classes;
}
add_filter( 'post_class', 'saha_single_product_classes' );

/**
 * Add classes to WooCommerce product category.
 *
 * @since  1.0.0
 */
function saha_product_category_classes( $classes ) {
	global $woocommerce_loop;
	$classes[] = 'col';
	$classes[] = saha_grid_class( $woocommerce_loop['columns'] );
	return $classes;
}
add_filter( 'product_cat_class', 'saha_product_category_classes' );

/**
 * Remove enable lightbox settings from Woo Admin panel.
 *
 * @since 1.0.0
 */
function saha_remove_product_settings( $settings ) {
	$remove = array(
		'woocommerce_enable_lightbox'
	);
	foreach( $settings as $key => $val ) {
		if ( isset( $val['id'] ) && in_array( $val['id'], $remove ) ) {
			unset( $settings[$key] );
		}
	}
	return $settings;
}
add_filter( 'woocommerce_product_settings', 'saha_remove_product_settings' );

/**
 * Define WooCommerce image sizes.
 *
 * @since  1.0.0
 */
function saha_woocommerce_image_dimensions() {
	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}

  	$catalog = array(
		'width' 	=> '380',
		'height'	=> '508',
		'crop'		=> 1
	);
	$single = array(
		'width' 	=> '421',
		'height'	=> '563',
		'crop'		=> 1
	);
	$thumbnail = array(
		'width' 	=> '120',
		'height'	=> '120',
		'crop'		=> 0
	);

	// Image sizes
	update_option( 'shop_catalog_image_size',   $catalog );     // Product category thumbs
	update_option( 'shop_single_image_size',    $single );      // Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs

}
add_action( 'after_switch_theme', 'saha_woocommerce_image_dimensions', 1 );

/**
 * Modifies the add to cart button.
 *
 * @since  1.0.0
 */
function saha_add_to_cart_link( $product ) {
	global $product;

	// Product type
	$type = $product->product_type;
	if ( 'variable' == $type ) {
		$icon = 'fa fa-plus';
	} else if ( 'grouped' == $type || !saha_woo_product_instock() ) {
		$icon = 'fa fa-search';
	} else {
		$icon = 'icon-handbag';
	}

	$add_to_cart = sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="btn %s product_type_%s">%s%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $product->product_type ),
		'<i class="'. esc_attr( $icon ) .'"></i>',
		esc_html( $product->add_to_cart_text() )
	);

	return $add_to_cart;
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'saha_add_to_cart_link', 10 );

/**
 * Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 *
 * @since  1.0.0
 */
function saha_cart_link_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	saha_cart_link();

	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;
}
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'saha_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'saha_cart_link_fragment' );
}

/**
 * Change onsale text.
 *
 * @since 1.0.0
 */
function saha_sale_flash( $text, $post, $_product ) {
	return '<span class="onsale">'. __( 'Sale', 'saha' ) .'</span>';
}
add_filter( 'woocommerce_sale_flash', 'saha_sale_flash', 10, 3 );

/**
 * Check if product is in stock
 *
 * @since 1.0.0
 */
function saha_woo_product_instock( $post_id = '' ) {
	global $post;
	$post_id      = $post_id ? $post_id : $post->ID;
	$stock_status = get_post_meta( $post_id, '_stock_status', true );
	if ( 'instock' == $stock_status ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Related Products Args
 *
 * @since 1.0.0
 */
function saha_related_products_args( $args ) {
	$args = apply_filters( 'saha_related_products_args', array(
		'posts_per_page' => 3,
		'columns'        => 3,
	) );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'saha_related_products_args' );

/**
 * Product gallery thumnail columns.
 *
 * @since  1.0.0
 */
function saha_thumbnail_columns() {
	return intval( apply_filters( 'saha_product_thumbnail_columns', 4 ) );
}
add_filter( 'woocommerce_product_thumbnails_columns', 'saha_thumbnail_columns' );

/**
 * Products per page
 *
 * @since  1.0.0
 */
function saha_products_per_page() {
	$num_prod = ( isset( $_GET['products-per-page'] ) ) ? $_GET['products-per-page'] : apply_filters( 'saha_products_per_page', saha_mod( PREFIX . 'woo-products-per-page' ) );

    if ( $num_prod == 'all' ) {
        $num_prod = wp_count_posts( 'product' )->publish;
    }

    return $num_prod;
}
add_filter( 'loop_shop_per_page', 'saha_products_per_page' );

/**
 * Default loop columns on product archives
 *
 * @since  1.0.0
 */
function saha_loop_columns() {
	return apply_filters( 'saha_loop_columns', saha_mod( PREFIX . 'woo-products-columns' ) );
}
add_filter( 'loop_shop_columns', 'saha_loop_columns' );

/**
 * Limit cross sells to 2
 *
 * @since  1.0.0
 */
function saha_cross_sells_limit() {
	return 2;
}
add_filter( 'woocommerce_cross_sells_total', 'saha_cross_sells_limit' );

/**
 * Remove WooCommerce Grid/List view extensions
 *
 * @since  1.0.0
 */
function saha_remove_gridlist_styles() {
    wp_dequeue_style( 'grid-list-button' );
}
add_action( 'wp_enqueue_scripts', 'saha_remove_gridlist_styles', 30 );

/**
 * WooCommerce pages layout
 *
 * @since  1.0.0
 */
function saha_woo_layouts( $layout ) {

	$post_layout = get_post_layout( get_queried_object_id() );

	if ( is_woocommerce() ) {
		if ( 'default' == $post_layout ) {
			$layout = '2c-l';
		}
	}

	if ( is_cart() || is_checkout() ) {
		if ( 'default' == $post_layout ) {
			$layout = '1c';
		}
	}

	return $layout;
}
add_filter( 'theme_mod_theme_layout', 'saha_woo_layouts', 15 );

/**
 * WooCommerce search widget
 *
 * @since  1.0.0
 */
function saha_product_search_form( $form ) {

	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
		<label class="screen-reader-text" for="s">' . __( 'Search for:', 'saha' ) . '</label>
		<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search for products', 'saha' ) . '" />
		<input type="submit" id="searchsubmit" value="&#xe090;" />
		<input type="hidden" name="post_type" value="product" />
	</form>';

	return $form;
}
add_filter( 'get_product_search_form', 'saha_product_search_form' );
