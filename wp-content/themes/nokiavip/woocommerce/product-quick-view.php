<?php
/**
 * Image Swap style thumbnail
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product, $post;

if( class_exists( 'YITH_WCWL_Init' ) ) {
	add_action( 'woocommerce_single_product_summary', create_function( '', 'echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );' ), 31 );
}
remove_all_actions( 'woocommerce_product_thumbnails' ); ?>

<div class="single-product product post-<?php the_ID(); ?>" itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>">
    <div class="saha-row">
    
        <div class="product-images col span_1_of_2">
            <?php if ( saha_mod( PREFIX . 'quick-images' ) == 'slider' ) :
        		woocommerce_show_product_sale_flash();
        		woocommerce_show_product_images();
            else:
            	the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array( 'title' => get_the_title( get_post_thumbnail_id() ) ) );
            endif;
            saha_cart_loading(); ?>
        </div>
        
        <div class="product-details col span_1_of_2">
            <h4 class="meta-title"><?php _e('Product Description', 'saha'); ?></h4>
            
			<?php if ( saha_mod( PREFIX . 'quick-product-name' ) ) : ?>
				<h3 class="product-name"><?php the_title(); ?></h3>
			<?php endif;

			if ( saha_mod( PREFIX . 'quick-rating' ) ) :
				woocommerce_template_loop_rating();
			endif;
	
			if ( saha_mod( PREFIX . 'quick-price' ) ) :
				woocommerce_template_single_price();
			endif;
			
			if ( saha_mod( PREFIX . 'quick-descr' ) ) :
				woocommerce_template_single_excerpt();
			endif;
	
			if ( saha_mod( PREFIX . 'quick-add-to-cart' ) ) :
				woocommerce_template_single_add_to_cart();
			endif;
	        
			if ( saha_mod( PREFIX . 'quick-share' ) ) :
				saha_entry_share();
			endif; ?>
            
        </div>

    </div>
</div>