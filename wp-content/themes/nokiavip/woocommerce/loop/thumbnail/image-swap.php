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

// Return dummy image if no featured image is defined
if ( ! has_post_thumbnail() ) {
    if ( function_exists( 'wc_placeholder_img_src' ) && wc_placeholder_img_src() ) {
        $placeholder = '<img src="'. wc_placeholder_img_src() .'" alt="'. __( 'Placeholder Image', 'saha' ) .'" class="woo-entry-image-main" />';
        $placeholder = apply_filters( 'saha_woo_placeholder_img_html', $placeholder );
        if ( $placeholder ) {
            echo $placeholder;
        }
    }
    return;
}

//Globals
global $product;

// Get first image
$attachment     = get_post_thumbnail_id();
$main_image     = wp_get_attachment_image( $attachment, 'shop_catalog', false, array( 'class' => 'woo-entry-image-main' ) );

// Get Second Image in Gallery
$attachment_ids           = $product->get_gallery_attachment_ids();
$attachment_ids[]         = $attachment; // Add featured image to the array
$secondary_attachment_url = '';

if ( ! empty( $attachment_ids ) ) {
    $attachment_ids = array_unique( $attachment_ids ); // remove duplicate images
    if ( count( $attachment_ids ) > '1' ) {
        if ( $attachment_ids['0'] !== $attachment ) {
            $secondary_img_id = $attachment_ids['0'];
        } elseif ( $attachment_ids['1'] !== $attachment ) {
            $secondary_img_id = $attachment_ids['1'];
        }
    }
}

// Get secondary image output
if ( ! empty( $secondary_img_id ) ) {
    $secondary_image = wp_get_attachment_image( $secondary_img_id, 'shop_catalog', false, array( 'class' => 'woo-entry-image-secondary' ) );
} else {
    $secondary_image = false;
}
            
// Return thumbnail
if ( $main_image && $secondary_image ) : ?>

    <div class="woo-entry-image-swap clr">
        <?php echo $main_image; ?>
        <a class="maikk" href="<?php the_permalink() ?>">Xem chi tiết</a>
        
        <?php echo $secondary_image; ?>
    </div>

<?php else : ?>

    <?php echo $main_image; ?>

<?php endif; ?>