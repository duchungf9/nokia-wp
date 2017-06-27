<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) { ?>
	<div id="product-pager" class="product-thumbnails">
		<?php
		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
        
		$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
		$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
		$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), array(
			'title' => $image_title
		));

        if ( has_post_thumbnail() ) {
        	echo sprintf( '<a href="%s" title="%s" class="active-thumbnail">%s</a>', $image_link, $image_title, $image );
        } else {
	    	echo sprintf( '<a href="%s" class="active-thumbnail"><img src="%s" /></a>', wc_placeholder_img_src(), wc_placeholder_img_src() );    
        }
        
		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array(); 

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		} ?>
	</div>
        <script type="text/javascript">
        	var $ = jQuery.noConflict();

			$(document).ready(function() {
				$('.product-thumbnails').owlCarousel({
			        items : 3,
		        	itemsCustom: [[0, 2], [479,2], [619,3], [768,3], [1200, 3], [1600, 3]],
			        transitionStyle: 'fade',
			        navigation : true,
			        navigationText: ['<span class="fa fa-angle-left"></span>','<span class="fa fa-angle-right"></span>'],
			        addClassActive: true,
			        pagination: false,
			    }); 
			    
			    $('.product-thumbnails .owl-item').click(function(e) {
		            var owlMain 	= $('.main-images').data('owlCarousel');
		            var owlThumbs 	= $('.product-thumbnails').data('owlCarousel');
		            owlMain.goTo($(e.currentTarget).index());
			    });
			    
			    $('.product-thumbnails a').click(function(e) {
				    e.preventDefault();
			    });
		    });
        </script>
        	
	<?php
}