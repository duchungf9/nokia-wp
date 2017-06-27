<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>
<div class="images">
	<?php
	$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
	$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
	$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
		'title' => $image_title
	));
    $attachment_ids 	= $product->get_gallery_attachment_ids();
	$attachment_count 	= count( $attachment_ids );

	if ( $attachment_count > 0 ) {
		$gallery = '[product-gallery]';
	} else {
		$gallery = '';
	} ?>
    
    <div class="product-images-slider main-images">
    	<?php if ( has_post_thumbnail() ) { ?>
        	<div>
                <?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image product-image" title="%s">%s</a>', $image_link, $image_title, $image ), $post->ID ); ?>
                
                <?php if ( saha_mod( PREFIX . 'woo-images-lightbox' ) ) : ?>
					<a href="<?php echo esc_url( $image_link ); ?>" class="gallery-lightbox open-image"><i class="fa fa-expand"></i></a>
				<?php endif; ?>
        	</div>
    	<?php } else { ?>
        	<div>
                <?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image product-image"><img src="%s" /></a>', wc_placeholder_img_src(), wc_placeholder_img_src() ), $post->ID ); ?>
        	</div>
    	<?php }

    	$_i = 0;
        if ( $attachment_count > 0 ) {
			foreach ( $attachment_ids as $id ) {
				$_i++; ?>
				<div>
    				<?php 
        			$image_title 	= esc_attr( get_the_title( $id ) );
        			$image_link  	= wp_get_attachment_url( $id );
                    $image 			= wp_get_attachment_image_src($id, 'shop_single');
                    
                    echo sprintf( '<a href="%s" itemprop="image" class="woocommerce-additional-image product-image" title="%s"><img src="%s" /></a>', $image_link, $image_title, $image[0] ); ?>
                    
                    <?php if ( saha_mod( PREFIX . 'woo-images-lightbox' ) ) : ?>
						<a href="<?php echo esc_url( $image_link ); ?>" class="gallery-lightbox open-image"><i class="fa fa-expand"></i></a>
					<?php endif; ?>
				</div>
			<?php 
			}
		} ?>
    </div>
    
    <script type="text/javascript">
    	var $ = jQuery.noConflict();

		$(document).ready(function() {
			$('.main-images').owlCarousel({
		        singleItem: true,
		        navigation: true,
		    	navigationText: ['<span class="fa fa-angle-left"></span>','<span class="fa fa-angle-right"></span>'],
		        pagination: false,
		        addClassActive: true,
		        afterMove: function(args) {
		            var owlMain 	= $('.main-images').data('owlCarousel');
		            var owlThumbs 	= $('.product-thumbnails').data('owlCarousel');
		            
		            $('.active-thumbnail').removeClass('active-thumbnail')
		            $('.product-thumbnails').find('.owl-item').eq(owlMain.currentItem).addClass('active-thumbnail');
		            if(typeof owlThumbs != 'undefined') {
		            	owlThumbs.goTo(owlMain.currentItem-1);
		            }
		        }
		    });

			$('.main-images a').click(function(e){
				e.preventDefault();
			});
		});
    </script>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
