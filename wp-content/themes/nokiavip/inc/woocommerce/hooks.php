<?php
/**
 * WooCommerce hooks.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

// Disable WooCommerce style
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Disable WooCommerce title
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Ajax search loading
add_filter( 'yith_wcas_ajax_search_icon', 					'saha_loading_search_icon' 						);

// Extend yith ajax search
add_filter( 'yith_wcas_suggestion', 						'saha_woocommerce_ajax_search_suggestion', 		10, 2 );

// Layout
remove_action( 'woocommerce_before_main_content', 			'woocommerce_output_content_wrapper',     		10 );
remove_action( 'woocommerce_after_main_content',  			'woocommerce_output_content_wrapper_end', 		10 );
remove_action( 'woocommerce_before_main_content', 			'woocommerce_breadcrumb', 						20 );
remove_action( 'woocommerce_before_shop_loop',    			'wc_print_notices',               				10 );
remove_action( 'woocommerce_before_shop_loop',    			'woocommerce_result_count',               		20 );
remove_action( 'woocommerce_before_shop_loop',    			'woocommerce_catalog_ordering',           		30 );
remove_action( 'woocommerce_after_shop_loop',     			'woocommerce_pagination',                 		10 );
add_action( 'woocommerce_before_main_content',    			'saha_before_content',                			10 );
add_action( 'woocommerce_after_main_content',     			'saha_after_content',                 			10 );

add_action( 'woocommerce_after_shop_loop',        			'woocommerce_pagination',                 		30 );

add_action( 'woocommerce_before_shop_loop',    				'wc_print_notices',               				 8 );
add_action( 'woocommerce_before_shop_loop',       			'saha_toolbar_wrapper',                			 9 );
add_action( 'woocommerce_before_shop_loop',       			'saha_switcher',           						10 );
add_action( 'woocommerce_before_shop_loop',       			'woocommerce_catalog_ordering',           		10 );
add_action( 'woocommerce_before_shop_loop',       			'saha_number_products',               			20 );
add_action( 'woocommerce_before_shop_loop',      			'saha_toolbar_wrapper_close',        	 		31 );

// Remove loop product thumbnail function and add our own
remove_action( 'woocommerce_before_shop_loop_item_title', 	'woocommerce_template_loop_product_thumbnail', 	10 );
add_action( 'woocommerce_before_shop_loop_item_title', 		'saha_product_thumbnail', 						10 );

// Products
remove_action( 'woocommerce_shop_loop_item_title', 			'woocommerce_template_loop_product_title', 		10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 	'woocommerce_template_loop_rating', 			 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 	'woocommerce_template_loop_price', 				10 );
remove_action( 'woocommerce_after_single_product_summary', 	'woocommerce_upsell_display',   				15 );
add_action( 'woocommerce_before_shop_loop_item_title', 		'saha_cart_loading', 							10 );
add_action( 'woocommerce_after_single_product_summary',    	'saha_upsell_display',       					15 );

// Before/After shop loop item
remove_action( 'woocommerce_after_shop_loop_item',    		'woocommerce_template_loop_add_to_cart',    	10 );
add_action( 'woocommerce_before_shop_loop_item',    		'saha_before_loop_item',        				10 );
add_action( 'woocommerce_after_shop_loop_item',  		   	'saha_after_loop_item', 						10 );

// Single product
add_action( 'woocommerce_before_single_product_summary',    'saha_before_single_product',        			10 );
add_action( 'woocommerce_before_single_product_summary', 	'saha_after_single_product_image', 			 	20 );
add_action( 'woocommerce_after_add_to_cart_button', 		'saha_after_add_to_cart', 			 			10 );
add_action( 'woocommerce_single_product_summary', 			'saha_woo_share', 			 					50 );
add_action( 'woocommerce_after_single_product_summary',  	'saha_after_single_product', 					 5 );

// My Account
if ( get_option( 'woocommerce_enable_myaccount_registration' ) !== 'yes' ) :
	add_action('woocommerce_before_customer_login_form', 		'saha_login_wrap_before'						);
	add_action('woocommerce_after_customer_login_form', 		'saha_login_wrap_after'							);
endif;

// Categories products
add_action( 'woocommerce_before_subcategory', 				'saha_before_subcategory', 						10 );
add_action( 'woocommerce_after_subcategory',    			'saha_after_subcategory',       				10 );

// Ajax quick view
add_action('wp_ajax_saha_product_quick_view', 				'saha_product_quick_view'						);
add_action('wp_ajax_nopriv_saha_product_quick_view', 		'saha_product_quick_view'						);

// Checkout page
add_action( 'woocommerce_checkout_after_customer_details',  'saha_before_order_review',        				10 );
add_action( 'woocommerce_checkout_after_order_review',  	'saha_after_order_review', 						10 );