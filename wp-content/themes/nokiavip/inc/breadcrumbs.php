<?php
/**
 * Used for site wide breadcrumbs
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

// Start Class
if ( ! class_exists( 'SAHA_Site_Breadcrumbs' ) ) {
	class SAHA_Site_Breadcrumbs {
		private $output    = '';
		private $post_id   = '';
		private $itemscope = '';

		/**
		 * Main constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->itemscope = 'itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"';
			$this->generate_crumbs();
		}

		/**
		 * Outputs the generated breadcrumbs
		 *
		 * @since 1.0.0
		 */
		public function display( $echo = true ) {
			if ( $echo ) {
				echo $this->output;
			} else {
				return $this->output;
			}
		}

		/* Returns crumb link
		 *
		 * @since 1.0.0
		 */
		private function crumb_link( $url, $title, $text ) {
			// Work in progress
		}

		/* Generates the breadcrumbs and updates the $trail var
		 *
		 * @since 1.0.0
		 */
		private function generate_crumbs() {

			// Globals
			global $wp_query, $wp_rewrite;

			// Get post id
			$post_id = absint( $wp_query->get_queried_object_id() );

			// Define main variables
			$breadcrumb = $path = '';
			$trail = array();
			$item_type_scope = $this->itemscope;

			// Home text
			$home_text = saha_mod( PREFIX . 'breadcrumbs-home-title' );
			$home_text = $home_text ? $home_text : '<span>'. __( 'Home', 'saha' ) .'</span>';

			// Default arguments
			$args = apply_filters( 'saha_breadcrumbs_args', array(
				'home_text'       => $home_text,
				'separator'       => '<i class="fa fa-angle-right"></i>',
				'front_page'      => false,
				'show_posts_page' => true,
			) );

			// Extract args for easy variable naming.
			extract( $args );

			/*-----------------------------------------------------------------------------------*/
			/*  - Homepage link
			/*-----------------------------------------------------------------------------------*/
			$trail['trail_start'] = '<span '. $item_type_scope .'><a href="' . home_url() . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" class="trail-begin" itemprop="url"><span itemprop="title">' . $home_text . '</span></a></span>';

			/*-----------------------------------------------------------------------------------*/
			/*  - Front Page
			/*-----------------------------------------------------------------------------------*/
			if ( is_front_page() ) {
				if ( ! $front_page ) {
					$trail = false;
				} elseif ( $show_home ) {
					$trail['trail_end'] = "{$show_home}";
				}
			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Homepage or posts page
			/*-----------------------------------------------------------------------------------*/
			elseif ( is_home() ) {
				$home_page = get_page( $wp_query->get_queried_object_id() );
				if ( is_object( $home_page ) ) {
					$trail = array_merge( $trail, $this->get_post_parents( $home_page->post_parent, '' ) );
					$trail['trail_end'] = '<span itemprop="title">'. get_the_title( $home_page->ID ) .'</span>';
				}
			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Singular: Page, Post, Attachment...etc
			/*-----------------------------------------------------------------------------------*/
			elseif ( is_singular() ) {
				
				// Get singular vars
				$post      = $wp_query->get_queried_object();
				$post_id   = absint( $wp_query->get_queried_object_id() );
				$post_type = $post->post_type;
				$parent    = $post->post_parent;
				
				// If a custom post type, check if there are any pages in its hierarchy based on the slug.
				if ( ! in_array( $post_type, array( 'page', 'post', 'product' ) ) ) {

					$post_type_object = get_post_type_object( $post_type );
					
					// Add $front to the path
					if ( 'post' == $post_type || ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front ) ) {
						$path .= trailingslashit( $wp_rewrite->front );
					}

					// Add slug to $path
					if ( ! empty( $post_type_object->rewrite['slug'] ) ) {
						$path .= $post_type_object->rewrite['slug'];
					}

					// If archive page exists add to trail
					if ( ! empty( $post_type_object->has_archive ) && ! is_singular( 'product' ) ) {

						$trail['post_type_archive'] = '<span '. $item_type_scope .' class="trail-type-archive"><a href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '" itemprop="url"><span itemprop="title">' . $post_type_object->labels->name . '</span></a></span>';

					} else {

						// If $path exists check for parents
						if ( ! empty( $path ) ) {
							$trail = array_merge( $trail, $this->get_post_parents( '', $path ) );
						}

					}

				}

				// Standard Posts
				if ( 'post' == $post_type ) {

					// Main Blog URL
					$page_id = saha_mod( PREFIX . 'blog-page' );
					if ( $page_id ) {
						$page_permalink = get_permalink( $page_id );
						$page_name      = get_the_title( $page_id );
						if ( $page_permalink && $page_name ) {
							$trail['blog'] = '<span '. $item_type_scope .' class="trail-blog-url"> <a href="'. esc_url( $page_permalink ) .'" title="'. esc_attr( $page_name ) .'" itemprop="url"><span itemprop="title">'. $page_name .'</span></a></span>';
						}
					}

					// Categories
					if ( $terms = $this->get_post_terms( $taxonomy = 'category' ) ) {
						$trail['categories'] = '<span class="trail-post-categories">' . $terms .'</span>';
					}

				}

				// Tribe Events Posts
				elseif ( 'tribe_events' == $post_type ) {
					if ( function_exists( 'tribe_get_events_link' ) ) {
						$trail['tribe_events'] = '<span '. $item_type_scope .' class="trail-all-events"><a href="'. tribe_get_events_link() .'" title="'. __( 'All Events', 'saha' ) .'" itemprop="url"><span itemprop="title">'. __( 'All Events', 'saha' ) .'</span></a></span>';
					}
				}

				// Products
				elseif ( is_singular( 'product' ) ) {

					// Get shop data
					$shop_data  = $this->get_shop_data();
					$shop_url   = $shop_data['url'];
					$shop_title = $shop_data['title'];

					// Add shop page to product post
					if ( $shop_url && $shop_title ) {
						$trail['shop'] = '<span '. $item_type_scope .'><a href="' . $shop_url . '" title="' . esc_attr( $shop_title ) . '" itemprop="url"><span itemprop="title">' . $shop_title . '</span></a></span>';
					}

					// Add categories to product post
					if ( $terms = $this->get_post_terms( $taxonomy = 'product_cat' ) ) {
						$trail['categories'] = '<span class="trail-post-categories">' . $terms .'</span>';
					}

					// Add cart to product post
					global $woocommerce;
					if ( $woocommerce && sizeof( $woocommerce->cart->cart_contents ) > 0 ) {
						$cart_id = wc_get_page_id( 'cart' );
						if ( function_exists( 'icl_object_id' ) ) {
							$cart_id = icl_object_id( $cart_id, 'page' );
						}
						$cart_title = get_the_title( $cart_id );
						if ( $cart_id ) {
							$trail['cart'] = '<span '. $item_type_scope .'><a href="' . get_permalink( $cart_id ) . '" title="' . esc_attr( $cart_title ) . '" itemprop="url"><span itemprop="title">' . $cart_title . '</span></a></span>';
						}
					}

				}

				// Pages
				if ( 'page' == $post_type ) {


					// Add shop page to cart
					if ( function_exists( 'is_cart' ) && function_exists( 'is_checkout' )
						&& ( is_cart() || is_checkout() )
					) {

						// Get shop data
						$shop_data  = $this->get_shop_data();
						$shop_url   = $shop_data['url'];
						$shop_title = $shop_data['title'];

						// Add shop link
						if ( $shop_url && $shop_title ) {
							$trail['shop'] = '<span '. $item_type_scope .' class="trail-shop"><a href="'. $shop_url .'" title="'. $shop_title .'" itemprop="url"><span itemprop="title">'. $shop_title .'</span></a></span>';
						}

					}

					// Add cart to checkout
					if ( function_exists( 'is_checkout' ) && is_checkout() ) {
						$cart_id = wc_get_page_id( 'cart' );
						if ( function_exists( 'icl_object_id' ) ) {
							$cart_id = icl_object_id( $cart_id, 'page' );
						}
						$cart_title = get_the_title( $cart_id );
						if ( $cart_id ) {
							$trail['cart'] = '<span '. $item_type_scope .' class="trail-type-archive trail-cart"><a href="' . get_permalink( $cart_id ) . '" title="' . esc_attr( $cart_title ) . '" itemprop="url"><span itemprop="title">' . $cart_title . '</span></a></span>';
						}
					}


				}

				// If the post type path returns nothing and there is a parent, get its parents.
				if ( empty( $path ) && $parent && 'attachment' != $post_type ) {
					$trail = array_merge( $trail, $this->get_post_parents( $parent ) );
				}

				// End trail with post title
				$post_title = get_the_title( $post_id );
				if ( $post_title ) {
					if ( $trim_title = saha_mod( PREFIX . 'breadcrumbs-title-trim' ) ) {
						$post_title = wp_trim_words( $post_title, $trim_title );
					}
					$trail['trail_end'] = $post_title;
				}

			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Archives
			/*-----------------------------------------------------------------------------------*/
			elseif ( is_archive() ) {

				/*-----------------------------------------------------------------------------------*/
				/*  - Post Type Archive
				/*-----------------------------------------------------------------------------------*/
				if ( is_post_type_archive() ) {

					// Shop Archive
					if ( function_exists( 'is_shop' ) && is_shop() ) {
						global $woocommerce;
						if ( sizeof( $woocommerce->cart->cart_contents ) > 0 ) {
							$cart_id = wc_get_page_id( 'cart' );
							if ( function_exists( 'icl_object_id' ) ) {
								$cart_id = icl_object_id( $cart_id, 'page' );
							}
							$cart_title = get_the_title( $cart_id );
							if ( $cart_id ) {
								$trail['cart'] = '<span '. $item_type_scope .' class="trail-type-archive"><a href="' . get_permalink( $cart_id ) . '" title="' . esc_attr( $cart_title ) . '" itemprop="url"><span itemprop="title">' . $cart_title . '</span></a></span>';
							}
						}

						// Get shop page
						$shop_data = $this->get_shop_data();

						// Add shop page title to trail end
						if ( $shop_data['title'] ) {
							$trail['trail_end'] = $shop_data['title'];
						}
						
					}
				
					// Topics Post Type Archive
					elseif ( is_post_type_archive( 'topic' ) ) {

						$forums_link = get_post_type_archive_link( 'forum' );
						$forum_obj   = get_post_type_object( 'forum' );
						$forum_name  = $forum_obj->labels->name;

						if ( $forums_link ) {
							$trail['topics'] = '<span '. $item_type_scope .'><a href="'. $forums_link .'" title="'. $forum_name .'" itemprop="url">'. $forum_name .'</a></span>';
						}

						$trail['trail_end'] = $post_type_object->labels->name;

					// All other post type archives
					} else {

						// Get post type object
						$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

						// Add $front to $path
						if ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front ) {
							$path .= trailingslashit( $wp_rewrite->front );
						}

						// Add slug to $path
						if ( ! empty( $post_type_object->rewrite['archive'] ) ) {
							$path .= $post_type_object->rewrite['archive'];
						}

						// If patch exists check for parents
						if ( ! empty( $path ) ) {
							$trail = array_merge( $trail, $this->get_post_parents( '', $path ) );
						}

						// Add post type name to trail end
						$trail['trail_end'] = $post_type_object->labels->name;

					}
					
				}

				/*-----------------------------------------------------------------------------------*/
				/*  - Taxonomy Archive
				/*-----------------------------------------------------------------------------------*/
				elseif ( ! is_search() && ( is_tax() || is_category() || is_tag() ) ) {

					// Get some taxonomy variables
					$term = $wp_query->get_queried_object();
					$taxonomy = get_taxonomy( $term->taxonomy );
					
					// Woo Product Tax
					if ( function_exists( 'saha_is_woo_tax' ) && saha_is_woo_tax() ) {

						// Get shop data
						$shop_data  = $this->get_shop_data();
						$shop_url   = $shop_data['url'];
						$shop_title = $shop_data['title'];

						// Add shop link
						if ( $shop_page_url && $shop_title ) {
							$trail['shop'] = '<span '. $item_type_scope .' class="trail-shop"><a href="'. $shop_page_url .'" title="'. $shop_title .'" itemprop="url"><span itemprop="title">'. $shop_title .'</span></a></span>';
						}

					}

					// Display main blog page on Categories & archives
					if ( is_category() || is_tag() ) {
						if ( $blog_page = saha_mod( PREFIX . 'blog-page' ) ) {
							$blog_url   = get_permalink( $blog_page );
							$blog_name  = get_the_title( $blog_page );
							if ( function_exists( 'icl_object_id' ) ) {
								$blog_page  = icl_object_id( $blog_page, 'page' );
								$blog_url   = get_permalink( $blog_page );
								$blog_name  = get_the_title( $blog_page );
							}
							$trail['blog'] = '<span '. $item_type_scope .' class="trail-blog-url"><a href="'. $blog_url .'" title="'. $blog_name .'" itemprop="url"><span itemprop="title">'. $blog_name .'</span></a></span>';
						}
					}

					// Get the path to the term archive. Use this to determine if a page is present with it.
					if ( is_category() ) {
						$path = get_option( 'category_base' );
					} elseif ( is_tag() ) {
						$path = get_option( 'tag_base' );
					} else {
						if ( $taxonomy->rewrite['with_front'] && $wp_rewrite->front ) {
							$path = trailingslashit( $wp_rewrite->front );
						}
						$path .= $taxonomy->rewrite['slug'];
					}

					// Get parent pages if they exist
					if ( $path ) {
						$trail = array_merge( $trail, $this->get_post_parents( '', $path ) );
					}

					// Add term parents
					if ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) {
						$trail = array_merge( $trail, $this->get_term_parents( $term ) );
					}

					// Add term name to trail end
					$trail['trail_end'] = $term->name;

				}

				/*-----------------------------------------------------------------------------------*/
				/*  - Author Archive
				/*-----------------------------------------------------------------------------------*/
				elseif ( is_author() ) {

					// If $front has been set, add it to $path.
					if ( ! empty( $wp_rewrite->front ) ) {
						$path .= trailingslashit( $wp_rewrite->front );
					}

					// If an $author_base exists, add it to $path.
					if ( ! empty( $wp_rewrite->author_base ) ) {
						$path .= $wp_rewrite->author_base;
					}

					// If $path exists, check for parent pages.
					if ( ! empty( $path ) ) {
						$trail = array_merge( $trail, $this->get_post_parents( '', $path ) );
					}

					// Add the author's display name to the trail end.
					$trail['trail_end'] = get_the_author_meta( 'display_name', get_query_var( 'author' ) );

				}

				/*-----------------------------------------------------------------------------------*/
				/*  - Time Archive
				/*-----------------------------------------------------------------------------------*/
				elseif ( is_time() ) {

					// Display minute and hour
					if ( get_query_var( 'minute' ) && get_query_var( 'hour' ) ) {
						$trail['trail_end'] = get_the_time( __( 'g:i a', 'saha' ) );
					}

					// Display minute only
					elseif ( get_query_var( 'minute' ) ) {
						$trail['trail_end'] = sprintf( __( 'Minute %1$s', 'saha' ), get_the_time( __( 'i', 'saha' ) ) );
					}

					// Display hour only
					elseif ( get_query_var( 'hour' ) ) {
						$trail['trail_end'] = get_the_time( __( 'g a', 'saha' ) );
					}

				}

				/*-----------------------------------------------------------------------------------*/
				/*  - Date Archive
				/*-----------------------------------------------------------------------------------*/
				elseif ( is_date() ) {

					// If $front is set check for parents
					if ( $wp_rewrite->front ) {
						$trail = array_merge( $trail, $this->get_post_parents( '', $wp_rewrite->front ) );
					}

					// Day archive
					if ( is_day() ) {

						// Display year
						$trail['year'] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'saha' ) ) . '" itemprop="url">' . get_the_time( __( 'Y', 'saha' ) ) . '</a>';

						// Display month
						$trail['month'] = '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( esc_attr__( 'F', 'saha' ) ) . '" itemprop="url">' . get_the_time( __( 'F', 'saha' ) ) . '</a>';

						// Display Time
						$trail['trail_end'] = get_the_time( __( 'j', 'saha' ) );

					}

					// Week archive
					elseif ( get_query_var( 'w' ) ) {

						// Display year
						$trail['year'] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'saha' ) ) . '" itemprop="url">' . get_the_time( __( 'Y', 'saha' ) ) . '</a>';

						// Display week
						$trail['trail_end'] = sprintf( __( 'Week %1$s', 'saha' ), get_the_time( esc_attr__( 'W', 'saha' ) ) );

					}

					// Month archive
					elseif ( is_month() ) {
						$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'saha' ) ) . '" itemprop="url">' . get_the_time( __( 'Y', 'saha' ) ) . '</a>';
						$trail['trail_end'] = get_the_time( __( 'F', 'saha' ) );
					}

					// Year archive
					elseif ( is_year() ) {
						$trail['trail_end'] = get_the_time( __( 'Y', 'saha' ) );
					}

				}
			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Search
			/*-----------------------------------------------------------------------------------*/
			elseif ( is_search() ) {
				$trail['trail_end'] = sprintf( __( 'Search results for &quot;%1$s&quot;', 'saha' ), esc_attr( get_search_query() ) );
			}

			/*-----------------------------------------------------------------------------------*/
			/*  - 404 error page
			/*-----------------------------------------------------------------------------------*/
			elseif ( is_404() ) {
				$trail['trail_end'] = __( '404 Not Found', 'saha' );
			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Tribe Calendar Month
			/*-----------------------------------------------------------------------------------*/
			elseif ( function_exists( 'tribe_is_month' ) && tribe_is_month() ) {
				$trail['trail_end'] = __( 'Events Calendar', 'saha' );
			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Create and return the breadcrumbs
			/*-----------------------------------------------------------------------------------*/

			// Apply filters so developers can alter the trail
			$trail = apply_filters( 'saha_breadcrumbs_trail', $trail );

			// Return trail
			if ( $trail && is_array( $trail ) ) {

				// Open Breadcrumbs
				$breadcrumb = '<div class="site-breadcrumbs">';

				// Separator HTML
				$separator = '<span class="sep">' . $separator . '</span>';

				// Join all trail items into a string
				$breadcrumb .= implode( $separator, $trail );

				// Close breadcrumbs
				$breadcrumb .= '</div>';

			}

			// Update output var
			$this->output = $breadcrumb;

		} // End generate_crumbs

		/**
		 * Display terms
		 *
		 * @since 1.0.0
		 */
		private function get_post_terms( $taxonomy = '' ) {

			// Make sure taxonomy exists
			if ( ! $taxonomy || ! taxonomy_exists( $taxonomy ) ) {
				return null;
			}

			// Get terms
			$list_terms = array();
			$terms      = wp_get_post_terms( get_the_ID(), $taxonomy );
			$itemscope  = $this->itemscope;

			// Return if no terms are found
			if ( ! $terms ) {
				return;
			}

			// Loop through terms
			foreach ( $terms as $term ) {
				$list_terms[] = '<span '. $itemscope .'><a href="'. get_term_link( $term->term_id, $taxonomy ) .'" title="'. esc_attr( $term->name ) .'" class="term-'. $term->term_id .'" itemprop="url"><span itemprop="title">'. $term->name .'</span></a></span>';
			}

			// Sanitize terms
			$terms = ! empty( $list_terms ) ? implode( ', ', $list_terms ) : '';

			// Turn into comma seperated string
			return $terms;

		}

		/**
		 * Searches for post parents and adds them to the trail
		 *
		 * @since 1.0.0
		 */
		private function get_post_parents( $post_id = '', $path = '' ) {

			// Set up an empty trail array.
			$trail = array();

			// If neither a post ID nor path set, return an empty array.
			if ( empty( $post_id ) && empty( $path ) ) {
				return $trail;
			}

			// If the post ID is empty, use the path to get the ID.
			if ( empty( $post_id ) ) {

				// Get parent post by the path.
				$parent_page = get_page_by_path( $path );


				if ( empty( $parent_page ) ) {
					// search on page name (single word)
					$parent_page = get_page_by_title ( $path );
				}

				if ( empty( $parent_page ) ) {
					// search on page title (multiple words)
					$parent_page = get_page_by_title ( str_replace( array('-', '_'), ' ', $path ) );
				}

				// If a parent post is found, set the $post_id variable to it.
				if ( ! empty( $parent_page ) ) {
					$post_id = $parent_page->ID;
				}
			}

			// If a post ID and path is set, search for a post by the given path.
			if ( $post_id == 0 && ! empty( $path ) ) {

				// Separate post names into separate paths by '/'.
				$path = trim( $path, '/' );
				preg_match_all( "/\/.*?\z/", $path, $matches );

				// If matches are found for the path.
				if ( isset( $matches ) ) {

					// Reverse the array of matches to search for posts in the proper order.
					$matches = array_reverse( $matches );

					// Loop through each of the path matches.
					foreach ( $matches as $match ) {

						// If a match is found.
						if ( isset( $match[0] ) ) {

							// Get the parent post by the given path.
							$path = str_replace( $match[0], '', $path );
							$parent_page = get_page_by_path( trim( $path, '/' ) );

							// If a parent post is found, set the $post_id and break out of the loop.
							if ( ! empty( $parent_page ) && $parent_page->ID > 0 ) {
								$post_id = $parent_page->ID;
								break;
							}
						}
					}
				}
			}

			// While there's a post ID, add the post link to the $parents array. */
			while ( $post_id ) {

				// Get the post by ID.
				$page = get_page( $post_id );

				// Add the formatted post link to the array of parents.
				$parents[]  = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '" itemprop="url">' . get_the_title( $post_id ) . '</a>';

				// Set the parent post's parent to the post ID.
				$post_id = $page->post_parent;
			}

			// If we have parent posts, reverse the array to put them in the proper order for the trail.
			if ( isset( $parents ) ) {
				$trail = array_reverse( $parents );
			}

			// Return the trail of parent posts.
			return $trail;

		} // End get_post_parents

		/**
		 * Searches for term parents and adds them to the trail
		 *
		 * @since 1.0.0
		 */
		private function get_term_parents( $term = '' ) {

			// New trail
			$trail = array();

			// Term check
			if ( empty( $term->taxonomy ) ) {
				return $trail;
			}

			// Define parents array and get term taxonomy
			$parents  = array();
			$taxonomy = $term->taxonomy;

			// Get parents
			if ( is_taxonomy_hierarchical( $taxonomy ) && $term->parent != 0 ) {

				// While there is a parent ID, add the parent term link to the $parents array.
				while ( $term->parent != 0 ) {

					// Get term
					$term = get_term( $term->parent, $taxonomy );

					// Add the formatted term link to the array of parent terms.
					$parents[] = '<a href="' . get_term_link( $term, $taxonomy ) . '" title="' . esc_attr( $term->name ) . '" itemprop="url">' . $term->name . '</a>';

				}

				// If we have parent terms, reverse the array to put them in the proper order for the trail.
				if ( ! empty( $parents ) ) {
					$trail = array_reverse( $parents );
				}

			}

			// Return the trail of parent terms.
			return $trail;

		} // End get_term_parents

		/**
		 * Gets Woo Shop data
		 *
		 * @since 1.0.0
		 */
		private function get_shop_data( $return = '' ) {

			// Check if wc_get_page_id function exists
			if ( ! function_exists( 'wc_get_page_id' ) ) {
				return;
			}

			// Define data var
			$data = array(
				'url'   => '',
				'title' => '',
			);

			// Get Woo Shop ID
			$id = wc_get_page_id( 'shop' );

			// Translate ID for WPML
			if ( function_exists( 'icl_object_id' ) ) {
				$id = icl_object_id( $id, 'page' );
			}

			// Get shop url and title
			$data['url'] = get_permalink( $id );
			$data['title'] = apply_filters( 'saha_bcrums_shop_title', get_the_title( $id ) );

			// Return data
			return $data;

		}

	}
} // End SAHA_Site_Breadcrumbs class

/**
 * Helper function display's breadcrumbs
 *
 * @since 1.0.0
 */
function saha_breadcrumbs() {
	
	// Yoast breadcrumbs
	if ( function_exists( 'yoast_breadcrumb' ) && current_theme_supports( 'yoast-seo-breadcrumbs' ) ) {
		return yoast_breadcrumb( '<div class="site-breadcrumbs">', '</div>' );
	}

	// Echo theme breadcrumbs
	$breadcrumbs = new SAHA_Site_Breadcrumbs();
	$breadcrumbs->display();
	
}

/**
 * Filter the ancestors of the yoast seo breadcrumbs
 *
 * @since 1.0.0
 */
function saha_wpseo_breadcrumb_links( $links ) {

	global $post;
	$new_breadcrumb = '';

	// Loop through items
	$types = array( 'post' );
	foreach ( $types as $type ) {
		if ( is_singular( $type ) ) {
			if ( 'post' == $type ) {
				$type = 'blog';
			}
			$page_id = saha_mod( PREFIX . $type .'-page' );
			if ( $page_id ) {
				$page_title     = get_the_title( $page_id );
				$page_permalink = get_permalink( $page_id );
				if ( $page_permalink && $page_title ) {
					$new_breadcrumb[] = array(
						'url'  => $page_permalink,
						'text' => $page_title,
					);
				}
			}
		}
	} // End foreach loop

	// Combine new crumb
	if ( $new_breadcrumb ) {
		array_splice( $links, 1, -2, $new_breadcrumb );
	}

	// Return links
	return $links;

}
add_filter( 'wpseo_breadcrumb_links', 'saha_wpseo_breadcrumb_links' );