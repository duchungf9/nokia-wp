<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.1.1
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly

$class = '';

if( defined( 'YITH_WCAS_PREMIUM' ) ) {
    wp_enqueue_script('yith_wcas_frontend' );
    $class='class="yith-search-premium"';
}

?>

<div class="yith-ajaxsearchform-container">
    <label class="screen-reader-text" for="yith-s"><?php _e( 'Search', 'saha' ) ?></label>
    <?php


    $args = array(
        'menu_order'	=> 'ASC',
        'parent'        => 0,
        'hide_empty'	=> 1,
        'hierarchical'	=> 0,
        'depth'         => 0,
        'taxonomy'		=> 'product_cat'
    );

    $product_categories     = get_categories( $args );

    $selected_category = ( isset( $_REQUEST['product_cat']) ) ?  $_REQUEST['product_cat'] : ''; ?>

	<form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>" <?php echo $class ?>>
	    <div>
		    <?php if( ! empty( $product_categories ) ) : ?>
		    <select class="search_categories selectbox" id="search_categories" name="product_cat">
			    <option value="" <?php selected( '', $selected_category ) ?>><?php _e( 'All Categories', 'saha' ) ?></option>
			    <?php foreach( $product_categories as $cat ): ?>
				    <option value="<?php echo esc_attr( $cat->slug ) ?>" <?php selected( $cat->slug, $selected_category ) ?>><?php echo $cat->name ?></option>
			    <?php endforeach; ?>
		    </select>
		    <?php endif ?>

             <?php
            if ( get_option( 'yith_wcas_show_search_list' ) == 'yes' ):

                $selected_search = ( isset( $_REQUEST['post_type'] ) ) ? $_REQUEST['post_type'] : ''; ?>

                <select class="yit_wcas_post_type selectbox" id="yit_wcas_post_type" name="post_type">
                    <option value="product" <?php selected( 'product', $selected_search ) ?>><?php _e( 'Products', 'saha' ) ?></option>
                    <option value="any" <?php selected( 'any', $selected_search ) ?>><?php _e( 'All', 'saha' ) ?></option>
                </select>

            <?php else: ?>
                <input type="hidden" name="post_type" class="yit_wcas_post_type" id="yit_wcas_post_type" value="product" />
            <?php endif; ?>
            
	        <div class="nav-searchfield">
	            <div id="nav-searchfield-container">
	            <input type="search"
	                   value="<?php echo get_search_query() ?>"
	                   name="s"
	                   id="yith-s"
	                   class="yith-s"
	                   placeholder="<?php echo esc_attr( get_option('yith_wcas_search_input_label') ) ?>"
                       data-append-to = ".yith-ajaxsearchform-container .nav-searchfield"
	                   data-loader-icon="<?php echo esc_attr( str_replace( '"', '', apply_filters('yith_wcas_ajax_search_icon', '') ) ) ?>"
	                   data-min-chars="<?php echo esc_attr( get_option('yith_wcas_min_chars') ); ?>" />
	            </div>
	        </div>

		    <input type="submit" id="yith-searchsubmit" value="<?php echo esc_attr( get_option('yith_wcas_search_submit_label') ) ?>" />

	    </div>
	</form>
</div>