<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 * 
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_favicons_apple_icons' ) ) :
/**
 * This function is used to output the site favicons and apple icons
 */
function saha_favicons_apple_icons() {
	// Favicon - Standard
	$icon = saha_mod( PREFIX . 'favicon' );
	if ( $icon ) {
		echo '<link rel="shortcut icon" href="'. esc_url( wp_get_attachment_url( $icon ) ) . '">';
	}
	// Apple iPhone Icon - 57px
	$icon = saha_mod( PREFIX . 'iphone-icon' );
	if ( $icon ) {
		echo '<link rel="apple-touch-icon-precomposed" href="'. esc_url( wp_get_attachment_url( $icon ) ) . '">';
	}
	// Apple iPad Icon - 76px
	$icon = saha_mod( PREFIX . 'ipad-icon' );
	if ( $icon ) {
		echo '<link rel="apple-touch-icon-precomposed" sizes="76x76" href="'. esc_url( wp_get_attachment_url( $icon ) ) . '">';
	}
	// Apple iPhone Retina Icon - 120px
	$icon = saha_mod( PREFIX . 'iphone-icon-retina' );
	if ( $icon ) {
		echo '<link rel="apple-touch-icon-precomposed" sizes="120x120" href="'. esc_url( wp_get_attachment_url( $icon ) ) . '">';
	}
	// Apple iPad Retina Icon - 114px
	$icon = saha_mod( PREFIX . 'ipad-icon-retina' );
	if ( $icon ) {
		echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'. esc_url( wp_get_attachment_url( $icon ) ) . '">';
	}
}
endif;
add_action( 'wp_head', 'saha_favicons_apple_icons', 1 );

if ( ! function_exists( 'saha_mobile_link' ) ) :
/**
 * Mobile link
 */
function saha_mobile_link() { ?>
	<ul class="mobile-link dropdown-menu">
		<li class="mobile-menu">
			<a href="#"><i class="fa fa-bars"></i><?php _e( 'Open Menu', 'saha' ); ?></a>
		</li>
	</ul>
<?php
}
endif;

if ( ! function_exists( 'saha_mobile_menu' ) ) :
/**
 * Mobile menu
 */
function saha_mobile_menu() { ?>

	<nav class="mobile-nav clr" <?php hybrid_attr( 'menu' ); ?>>
		<div class="close-mobile-nav"><i class="icon-close"></i><?php _e( 'Close Menu', 'saha' ); ?></div>

		<?php if ( has_nav_menu( 'main_menu' ) ) { ?>
			<ul>
				<li class="search-form">
					<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
						<input type="search" id="s" class="field" name="s" autocomplete="off" placeholder="<?php esc_attr_e( 'Search', 'saha' ); ?>" />
						<input type="hidden" name="post_type" value="product">
						<button type="submit" value=""><i class="icon-magnifier"></i></button>
					</form>
				</li>

				<?php if ( saha_mod( PREFIX . 'header-right' ) ) { ?>
					<ul class="buttons">
						<?php
						if ( class_exists( 'YITH_Woocompare' ) && '1' == saha_mod( PREFIX . 'header-compare', '1' ) ) {
							saha_header_compare();
						}

						if ( class_exists( 'YITH_WCWL_Shortcode' ) && '1' == saha_mod( PREFIX . 'header-wishlist', '1' ) ) {
							saha_header_wishlist();
						}

						saha_header_login();

						if ( class_exists( 'Woocommerce' ) && '1' == saha_mod( PREFIX . 'header-cart', '1' ) ) { ?>
							<li>
								<?php echo saha_cart_link(); ?>
							</li>
						<?php } ?>
					</ul>
				<?php }

				wp_nav_menu(
					array(
						'theme_location'  => 'main_menu',
						'container'       => false,
						'fallback_cb'     => false,
						'items_wrap'      => '%3$s',
						'depth'           => 0,
						'walker'          => new Saha_Mobile_Nav_Walker(),
					)
				); ?>
			</ul>
		<?php } ?>
	</nav>
<?php
}
endif;

if ( ! function_exists( 'saha_top_bar' ) ) :
/**
 * Top bar
 */
function saha_top_bar() {
	// Return if top bar is disabled in admin
	if ( !saha_mod( PREFIX . 'top-bar' ) ) :
		return;
	endif; ?>

	<div id="top-bar-wrap" class="clr">
		<div id="top-bar" class="container">
			<?php // Top bar nav left
			if ( saha_mod( PREFIX . 'tb-nav-left', '1' ) ) : ?>
				<div id="top-bar-left" class="top-content">
					<ul class="dropdown-menu sf-menu">
						<?php wp_nav_menu(
							array(
								'theme_location'	=> 'top_menu_left',
								'sort_column'		=> 'menu_order',
								'container'       	=> false,
								'fallback_cb'		=> false,
								'items_wrap'      	=> '%3$s',
								'depth'           	=> 0,
								'walker'          	=> new Saha_Custom_Nav_Walker(),
							)
						); ?>
					</ul>
				</div>
			<?php endif;

			// Top bar social
			if ( saha_mod( PREFIX . 'tb-social-links', '1' ) ) : ?>
				<div id="top-bar-right" class="top-content">
					<?php saha_top_bar_social(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php
}
endif;

if ( ! function_exists( 'saha_top_bar_social' ) ) :
/**
 * Top bar social
 */
function saha_top_bar_social() {
	// Return if social button is disabled in admin
	if ( !saha_mod( PREFIX . 'tb-social-links' ) ) :
		return;
	endif;

	// Get the data set in customizer
	$twitter   	= saha_mod( PREFIX . 'tb-social-twitter' );
	$facebook   = saha_mod( PREFIX . 'tb-social-facebook' );
	$gplus   	= saha_mod( PREFIX . 'tb-social-gplus' );
	$instagram  = saha_mod( PREFIX . 'tb-social-instagram' );
	$pinterest  = saha_mod( PREFIX . 'tb-social-pinterest' );
	$linkedin   = saha_mod( PREFIX . 'tb-social-linkedin' );
	$youtube   	= saha_mod( PREFIX . 'tb-social-youtube' );
	$rss   		= saha_mod( PREFIX . 'tb-social-rss' );

	$target 	= saha_mod( PREFIX . 'tb-social-links-target', 'blank' );

	echo '<ul class="top-bar-social">';
		if ( $twitter ) {
			echo '<li><a href="' . esc_url( $twitter ) . '" class="twitter social-link tooltip-down-left" title="'. __('Follow us on Twitter','saha') .'" target="_'. esc_attr( $target ) .'"><i class="fa fa-twitter"></i></a></li>';
		}
		if ( $facebook ) {
			echo '<li><a href="' . esc_url( $facebook ) . '" class="facebook social-link tooltip-down-left" title="'. __('Follow us on Facebook','saha') .'" target="_'. esc_attr( $target ) .'"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( $gplus ) {
			echo '<li><a href="' . esc_url( $gplus ) . '" class="gplus social-link tooltip-down-left" title="'. __('Follow us on Google+','saha') .'" target="_'. esc_attr( $target ) .'"><i class="fa fa-google-plus"></i></a></li>';
		}
		if ( $instagram ) {
			echo '<li><a href="' . esc_url( $instagram ) . '" class="instagram social-link tooltip-down-left" title="'. __('Follow us on Instagram','saha') .'" target="_'. esc_attr( $target ) .'"><i class="fa fa-instagram"></i></a></li>';
		}
		if ( $pinterest ) {
			echo '<li><a href="' . esc_url( $pinterest ) . '" class="pinterest social-link tooltip-down-left" title="'. __('Follow us on Pinterest','saha') .'" target="_'. esc_attr( $target ) .'"><i class="fa fa-pinterest-p"></i></a></li>';
		}
		if ( $linkedin ) {
			echo '<li><a href="' . esc_url( $linkedin ) . '" class="linkedin social-link tooltip-down-left" title="'. __('Follow us on LinkedIn','saha') .'" target="_'. esc_attr( $target ) .'"><i class="fa fa-linkedin"></i></a></li>';
		}
		if ( $youtube ) {
			echo '<li><a href="' . esc_url( $youtube ) . '" class="youtube social-link tooltip-down-left" title="'. __('Watch our videos','saha') .'" target="_'. esc_attr( $target ) .'"><i class="fa fa-youtube"></i></a></li>';
		}
		if ( $rss ) {
			echo '<li><a href="' . esc_url( $rss ) . '" class="rss social-link tooltip-down-left" title="'. __('Read our RSS feed','saha') .'" target="_'. esc_attr( $target ) .'"><i class="fa fa-rss"></i></a></li>';
		}
	echo '</ul>';
}
endif;

if ( ! function_exists( 'saha_site_branding' ) ) :
/**
 * Site branding for the site.
 * 
 * Display site title by default, but user can change it with their custom logo.
 * They can upload it on Customizer page.
 * 
 * @since  1.0.0
 */
function saha_site_branding() {

	// Get the customizer value.
	$logo_id 		= saha_mod( PREFIX . 'logo' );
	$retina_logo 	= saha_mod( PREFIX . 'retina-logo' );

	// Check if logo available, then display it.
	if ( $logo_id ) :
		echo '<div class="logo" itemscope itemtype="http://schema.org/Brand">' . "\n";
			echo '<a href="' . esc_url( get_home_url() ) . '" itemprop="url" rel="home">' . "\n";
				echo '<img itemprop="logo" src="' . esc_url( wp_get_attachment_url( $logo_id ) ) . '" srcset="' . esc_url( wp_get_attachment_url( $logo_id ) ) . ' 1x ,' . esc_url( wp_get_attachment_url( $retina_logo ) ) . ' 2x" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
			echo '</a>' . "\n";
		echo '</div>' . "\n";

	// If not, then display the Site Title and Site Description.
	else :
		echo '<div class="logo">'. "\n";
			echo '<h1 class="logo-title" ' . hybrid_get_attr( 'site-title' ) . '><a href="' . esc_url( get_home_url() ) . '" itemprop="url" rel="home"><span itemprop="headline">' . esc_attr( get_bloginfo( 'name' ) ) . '</span></a></h1>'. "\n";
		echo '</div>'. "\n";
	endif;

}
endif;

if ( !function_exists( 'saha_header_search' ) ) :
/**
 * Header search
 */
function saha_header_search() {
	// Return if search is disabled in admin
	if ( !saha_mod( PREFIX . 'header-search' ) ) :
		return;
	endif;

	$instance = array(
	    'title' => ''
	);

	// Class
	$style = saha_mod( PREFIX . 'header-search-style' );
	if ( 'ajax' == $style ) {
		$class = 'ajax-search';
	} else {
		$class = 'default-search';
	}

	// display search form
	echo '<div id="header-search" class="'. esc_attr( $class ) .'"><div>';
		if ( class_exists( 'YITH_WCAS' ) && 'ajax' == $style ) {
	        the_widget( 'YITH_WCAS_Ajax_Search_Widget', $instance );
	    } else {
	        get_search_form();
	    }
    echo '</div></div>';
}
endif;

if ( !function_exists( 'saha_header_right' ) ) :
/**
 * Header right elements
 */
function saha_header_right() {
	// Return if right elements is disabled in admin
	if ( !saha_mod( PREFIX . 'header-right' ) ) :
		return;
	endif; ?>

	<ul class="menu-right dropdown-menu sf-menu">
		<?php
		if ( class_exists( 'YITH_Woocompare' ) && '1' == saha_mod( PREFIX . 'header-compare', '1' ) ) {
			saha_header_compare();
		}

		if ( class_exists( 'YITH_WCWL_Shortcode' ) && '1' == saha_mod( PREFIX . 'header-wishlist', '1' ) ) {
			saha_header_wishlist();
		}

		saha_header_login();

		if ( class_exists( 'Woocommerce' ) && '1' == saha_mod( PREFIX . 'header-cart', '1' ) ) {
			saha_header_cart();
		}
		?>
	</ul>
<?php
}
endif;

if ( ! function_exists( 'saha_header_login' ) ) :
/**
 * Header login
 */
function saha_header_login() {
	global $current_user;

	// Return if account is disabled in admin
	if ( !saha_mod( PREFIX . 'header-account' ) ) :
		return;
	endif;

	// Vars
	$account = saha_mod( PREFIX . 'header-account-url' );
	if ( '' != $account ) {
		$account_url = $account;
	} else {
		$account_url = get_permalink( get_option('woocommerce_myaccount_page_id') );
	}

	if ( is_user_logged_in() ) { ?>
		<li class="header-account logged_in <?php if ( has_nav_menu( 'user_menu' ) ) { ?>has-sub<?php } ?>">
			<a href="<?php echo esc_url( $account_url ); ?>" class="links"><i class="icon-user"></i><?php _e( 'My Account', 'saha' ); ?></a>
			<?php if ( has_nav_menu( 'user_menu' ) ) { ?>
				<span class="mobile-icon plus"></span>
				<ul class="user-nav sub-menu">
					<?php wp_nav_menu( array(
						'theme_location' 	=> 'user_menu',
						'container'       	=> false,
						'fallback_cb'		=> false,
						'items_wrap'      	=> '%3$s',
						'depth'           	=> 0,
						'walker'          	=> new Saha_Custom_Nav_Walker(),
					));
					if ( '1' == saha_mod( PREFIX . 'logout-link', '1' ) ) { ?>
						<li><a href="<?php echo wp_logout_url( home_url() ); ?>" class="logout"><i class="<?php echo esc_attr( saha_mod( PREFIX . 'logout-icon' ) ); ?>"></i><?php _e( 'Logout', 'saha' ); ?></a></li>
					<?php } ?>
				</ul>
			<?php } ?>
		</li>

	<?php } else { ?>
		<li class="header-account">
			<a href="<?php echo esc_url( $account_url ); ?>" class="account-link links"><i class="icon-user"></i><?php _e( 'My Account', 'saha' ); ?></a>
		</li>
	<?php }

}
endif;

if ( !function_exists( 'saha_header_fixed_elements' ) ) :
/**
 * Header fixed elements
 */
function saha_header_fixed_elements() {
	// Return if header right is disabled in admin
	if ( !saha_mod( PREFIX . 'header-right' ) ) :
		return;
	endif;

	// display elements
	echo '<ul class="header-elements dropdown-menu sf-menu">';
		echo '<li class="header-search">';
			echo '<a href="#" class="search-link"><i class="fa fa-search"></i></a>';
			saha_header_fixed_search();
		echo '</li>';
		if ( class_exists( 'Woocommerce' ) && '1' == saha_mod( PREFIX . 'header-cart', '1' ) ) {
			saha_header_cart();
		}
	echo '</ul>';
}
endif;

if ( !function_exists( 'saha_header_fixed_search' ) ) :
/**
 * Search form header fixed
 */
function saha_header_fixed_search() {
	// Return if search is disabled in admin
	if ( !saha_mod( PREFIX . 'header-search' ) ) :
		return;
	endif;

	// display search ?>
	<ul class="sub-menu" role="search">
		<li class="clr">
			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
				<input type="text" value="<?php _e( 'Search for...', 'saha' ); ?>" class="form-control" onblur="if(this.value=='')this.value='Search for...'" onfocus="if(this.value=='Search for...')this.value=''" name="s" id="s">
				<input type="hidden" name="post_type" value="product">
				<button type="submit" value=""><i class="icon-magnifier"></i></button>
			</form>
		</li>
	</ul>
<?php
}
endif;

if ( ! function_exists( 'saha_get_title' ) ) :
/**
 * Returns the correct title to display for any post/page/archive.
 *
 * @since 1.0.0
 */
function saha_get_title() {
	global $post;

	// Default title is null
	$title = NULL;
	
	// Homepage - display blog description if not a static page
	if ( is_front_page() && ! is_singular( 'page' ) ) {
		
		if ( get_bloginfo( 'description' ) ) {
			$title = get_bloginfo( 'description' );
		} else {
			return __( 'Recent Posts', 'saha' );
		}

	// Homepage posts page
	} elseif ( is_home() && ! is_singular( 'page' ) ) {

		$title = get_the_title( get_option( 'page_for_posts', true ) );

	}

	// Search => NEEDS to go before archives
	elseif ( is_search() ) {
		global $wp_query;
		$title = ''. $wp_query->found_posts .' '. __( 'Search Results Found', 'saha' );
	}
		
	// Archives
	elseif ( is_archive() ) {

		// Author
		if ( is_author() ) {
			$title = get_the_archive_title();
		}

		// Post Type archive title
		elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}

		// Daily archive title
		elseif ( is_day() ) {
			$title = sprintf( __( 'Daily Archives: %s', 'saha' ), get_the_date() );
		}

		// Monthly archive title
		elseif ( is_month() ) {
			$title = sprintf( __( 'Monthly Archives: %s', 'saha' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'saha' ) ) );
		}

		// Yearly archive title
		elseif ( is_year() ) {
			$title = sprintf( __( 'Yearly Archives: %s', 'saha' ), get_the_date( _x( 'Y', 'yearly archives date format', 'saha' ) ) );
		}

		// Categories/Tags/Other
		else {

			// Get term title
			$title = single_term_title( '', false );

			// Fix for bbPress and other plugins that are archives but use pages
			if ( ! $title ) {
				global $post;
				$title = get_the_title( $post->ID );
			}

		}

	} // End is archive check

	// 404 Page
	elseif ( is_404() ) {

		$title = __( '404: Page Not Found', 'saha' );

	}
	
	// Anything else with a post_id defined
	elseif ( $post->ID ) {

		$title = get_the_title( $post->ID );

	}

	// Backup
	$title = $title ? $title : get_the_title();

	// Apply filters
	$title = apply_filters( 'saha_custom_title', $title );

	// Return title
	return $title;
	
}
endif;

if ( ! function_exists( 'saha_title' ) ) :
/**
 * Render page title.
 *
 * @since 1.0.0
 */
function saha_title() {
	global $post;

	// Var
	$disable_title 	= get_post_meta( $post->ID, 'saha_disable_title', true );
	$title_style 	= get_post_meta( $post->ID, 'saha_title_style', true );
	$title_size 	= get_post_meta( $post->ID, 'saha_title_font_size', true );
	$overlay 		= get_post_meta( $post->ID, 'saha_title_background_overlay', true );
	$opacity 		= get_post_meta( $post->ID, 'saha_title_background_overlay_opacity', true );

	// Get the title
	$title = saha_get_title();

	// Return if there isn't a title or disabled in admin
	if ( !saha_mod( PREFIX . 'page-title' ) || 'on' == $disable_title && is_singular() || !$title ) :
		return;
	endif;

	// Background image
	if ( $title_style == 'background-image' && is_singular() ) {
		$class = ' background-img';
	} else {
		$class = '';
	}

	// Background image
	if ( $opacity != '' ) {
		$opacity = $opacity;
	} else {
		$opacity = '0.5';
	}

	// Display title ?>
	<header class="site-title<?php echo esc_attr( $class ); ?>">

		<div class="container">

			<?php if ( $title_size != '' && $title_style == 'background-image' && is_singular() ) { ?>
				<h1 style="font-size: <?php echo esc_attr( $title_size ); ?>"><?php echo esc_attr( $title ); ?></h1>
			<?php } else { ?>
				<h1><?php echo esc_attr( $title ); ?></h1>
			<?php } ?>

			<?php if ( '1' == saha_mod( PREFIX . 'page-breadcrumbs', '1' ) && $title_style != 'background-image' ) :
				echo saha_breadcrumbs();
			endif; ?>

		</div>

		<?php if ( $overlay != '' && $title_style == 'background-image' && is_singular() ) { ?>
			<span class="background-img-overlay" style="opacity: <?php echo esc_attr( $opacity ); ?>"></span>
		<?php } ?>

	</header>

<?php
}
endif;

if ( ! function_exists( 'saha_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.0.0
 */
function saha_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s" ' . hybrid_get_attr( 'entry-published' ) . '>%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'saha' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard" ' . hybrid_get_attr( 'entry-author' ) . '><a class="url fn n" href="%1$s" itemprop="url"><span itemprop="name">%2$s</span></a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since  1.0.0
 * @return bool
 */
function saha_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'saha_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'saha_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so saha_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so saha_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in saha_categorized_blog.
 *
 * @since 1.0.0
 */
function saha_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'saha_categories' );
}
add_action( 'edit_category', 'saha_category_transient_flusher' );
add_action( 'save_post',     'saha_category_transient_flusher' );

if ( ! function_exists( 'saha_entry_share' ) ) :
/**
 * Social share.
 *
 * @since 1.0.0
 */
function saha_entry_share() {
	global $post; ?>

	<div class="entry-share clr">
		<div class="share-title"><span><?php _e('Share on', 'saha'); ?></span></div>
		<ul>
			<li class="twitter"><a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>&amp;url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>" class="tooltip-up" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
			<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( $post->ID ) ); ?>" class="tooltip-up" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
			<li class="google-plus"><a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>" class="tooltip-up" title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<li class="linkedin"><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&amp;title=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>" class="tooltip-up" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
			<li class="pinterest"><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&amp;media=<?php echo urlencode( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) ); ?>" class="tooltip-up" title="Pinterest" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
		</ul>
	</div>
<?php
}
endif;

if ( ! function_exists( 'saha_post_author_box' ) ) :
/**
 * Author post informations.
 *
 * @since  1.0.0
 */
function saha_post_author_box() {

	// Return if there isn't disabled in admin
	if ( !saha_mod( PREFIX . 'post-author-box' ) ) :
		return;
	endif;

	// Bail if not on the single post.
	if ( ! is_single() ) {
		return;
	}

	// Bail if user hasn't fill the Biographical Info field.
	if ( ! get_the_author_meta( 'description' ) ) {
		return;
	}

	// Get the author social information.
	$twitter   = get_the_author_meta( 'twitter' );
	$facebook  = get_the_author_meta( 'facebook' );
	$gplus     = get_the_author_meta( 'gplus' );
	$instagram = get_the_author_meta( 'instagram' );
	$pinterest = get_the_author_meta( 'pinterest' );
?>

	<div class="author-bio clr" <?php hybrid_attr( 'entry-author' ) ?>>
		<div class="author-box-avatar">
			<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'saha_author_bio_avatar_size', 100 ), '', strip_tags( get_the_author() ) ); ?>
		</div>
		<div class="description">
			<h3 class="author-title name">
				<a class="author-name url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" itemprop="url"><span itemprop="name"><?php echo strip_tags( get_the_author() ); ?></span></a>
			</h3>
			<p class="bio" itemprop="description"><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></p>
			<?php if ( $twitter || $facebook || $gplus || $instagram || $pinterest ) : ?>
				<div class="social-links">
					<?php if ( $twitter ) { ?>
						<a href="//twitter.com/<?php echo esc_attr( $twitter ) ?>" class="twitter"><i class="fa fa-twitter"></i></a>
					<?php } ?>
					<?php if ( $facebook ) { ?>
						<a href="<?php echo esc_url( $facebook ); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
					<?php } ?>
					<?php if ( $gplus ) { ?>
						<a href="<?php echo esc_url( $gplus ); ?>" class="gplus"><i class="fa fa-google-plus"></i></a>
					<?php } ?>
					<?php if ( $instagram ) { ?>
						<a href="<?php echo esc_url( $instagram ); ?>" class="instagram"><i class="fa fa-instagram"></i></a>
					<?php } ?>
					<?php if ( $pinterest ) { ?>
						<a href="<?php echo esc_url( $pinterest ); ?>" class="pinterest"><i class="fa fa-pinterest-p"></i></a>
					<?php } ?>
				</div>
			<?php endif; ?>
		</div>
	</div><!-- .author-bio -->

<?php
}
endif;

if ( ! function_exists( 'saha_related_posts' ) ) :
/**
 * Related posts.
 *
 * @since  1.0.0
 */
function saha_related_posts() {
	global $post;

	// Return if there isn't disabled in admin
	if ( !saha_mod( PREFIX . 'related-posts' ) ) :
		return;
	endif;

	// Get the taxonomy terms of the current page for the specified taxonomy.
	$terms = wp_get_post_terms( $post->ID, 'category', array( 'fields' => 'ids' ) );

	// Bail if the term empty.
	if ( empty( $terms ) ) {
		return;
	}
	
	// Posts query arguments.
	$query = array(
		'post__not_in' => array( $post->ID ),
		'tax_query'    => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $terms,
				'operator' => 'IN'
			)
		),
		'posts_per_page' => 4,
		'post_type'      => 'post',
	);

	// Allow dev to filter the query.
	$args = apply_filters( 'saha_related_posts_args', $query );

	// The post query
	$related = new WP_Query( $args );

	if ( $related->have_posts() ) : ?>

		<div class="related-posts">
			<h3 class="entry-post-title"><?php _e( 'You might also like', 'saha' ); ?></h3>
			<ul>
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>
					<li>
						<?php if ( has_post_thumbnail() ) :
							global $post;

							if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
								$width 	= saha_mod( PREFIX . '1c-related-posts-img-width' );
								$height = saha_mod( PREFIX . '1c-related-posts-img-height' );
							} else {
								$width 	= saha_mod( PREFIX . 'related-posts-img-width' );
								$height = saha_mod( PREFIX . 'related-posts-img-height' );
							}

							$image = saha_image_resize( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ), $width, $height, true ); ?>

							<a href="<?php the_permalink(); ?>" class="related-thumb">
								<img src="<?php echo esc_url( $image['url'] ); ?>" width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>" class="entry-thumbnail" alt="<?php echo esc_attr( get_the_title() ); ?>" itemprop="image" />
							</a>
						<?php endif; ?>
						<div class="entry-category" <?php hybrid_attr( 'entry-terms', 'category' ); ?>>
							<?php
								/* translators: used between list items, there is a space after the comma */
								$categories_list = get_the_category_list( __( ', ', 'saha' ) );
								if ( $categories_list && saha_categorized_blog() ) :
							?>
							<?php echo $categories_list; ?>
							<?php endif; // End if categories ?>
						</div>
						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	
	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

if ( ! function_exists( 'saha_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since  1.0.0
 */
function saha_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" <?php hybrid_attr( 'comment' ); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment-container">
			<p <?php hybrid_attr( 'comment-content' ); ?>><?php _e( 'Pingback:', 'saha' ); ?> <span <?php hybrid_attr( 'comment-author' ); ?>><span itemprop="name"><?php comment_author_link(); ?></span></span> <?php edit_comment_link( __( '(Edit)', 'saha' ), '<span class="edit-link">', '</span>' ); ?></p>
		</article>
	<?php
		break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" <?php hybrid_attr( 'comment' ); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment-container">

			<div class="comment-avatar">
				<?php echo get_avatar( $comment, apply_filters( 'saha_comment_avatar_size', 100 ) ); ?>
			</div>

			<div class="comment-body">
				<div class="comment-wrapper">
						
					<div class="comment-head">
						<span class="name" <?php hybrid_attr( 'comment-author' ); ?>><span itemprop="name"><?php echo get_comment_author_link(); ?></span></span>

						<?php edit_comment_link( __('edit', 'saha' ) ); ?>
					</div><!-- comment-head -->
					
					<div class="comment-content comment-entry" <?php hybrid_attr( 'comment-content' ); ?>>
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'saha' ); ?></p>
						<?php endif; ?>

						<?php comment_text(); ?>

						<div class="comment-info">
							<?php
								printf( '<span class="date"><time datetime="%1$s" ' . hybrid_get_attr( 'comment-published' ) . '>%2$s</time></span>',
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( __( '%1$s at %2$s', 'saha' ), get_comment_date(), get_comment_time() )
								);
							?>
							<span class="reply">
								<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'saha' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</span><!-- .reply -->
						</div>
					</div><!-- .comment-content -->

				</div>
			</div>

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'saha_get_posts_images' ) ) :
/**
 * Return posts images
 *
 * @since 1.0.0
 */
function saha_get_posts_images() {
	global $post;

	if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
		$width 	= saha_mod( PREFIX . '1c-posts-img-width' );
		$height = saha_mod( PREFIX . '1c-posts-img-height' );
	} else {
		$width 	= saha_mod( PREFIX . 'posts-img-width' );
		$height = saha_mod( PREFIX . 'posts-img-height' );
	}

	$featured_image = saha_image_resize( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ), $width, $height, true ); ?>

	<img src="<?php echo esc_url( $featured_image['url'] ); ?>" width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>" alt="<?php echo get_the_title(); ?>" />
	<?php
}
endif;

if ( ! function_exists( 'saha_get_post_video' ) ) :
/**
 * Returns post video
 *
 * @since 1.0.0
 */
function saha_get_post_video( $post_id = '' ) {

	// Define video variable
	$video = '';

	// Get correct ID
	$post_id = $post_id ? $post_id : get_the_ID();

	// Embed
	if ( $meta = get_post_meta( $post_id, 'saha_post_video_embed', true ) ) {
		$video = $meta;
	}

	// Check for self-hosted first
	elseif ( $meta = get_post_meta( $post_id, 'saha_post_self_hosted_media', true ) ) {
		$video = $meta;
	}

	// Check for saha_post_video custom field
	elseif ( $meta = get_post_meta( $post_id, 'saha_post_video', true ) ) {
		$video = $meta;
	}

	// Check for post oembed
	elseif ( $meta = get_post_meta( $post_id, 'saha_post_oembed', true ) ) {
		$video = $meta;
	}

	// Apply filters for child theming
	$video = apply_filters( 'saha_get_post_video', $video );

	// Return data
	return $video;

}
endif;

if ( ! function_exists( 'saha_post_video_html' ) ) :
/**
 * Echo post video HTML
 *
 * @since 1.0.0
 */
function saha_post_video_html( $video = '' ) {
	echo saha_get_post_video_html( $video );
}
endif;

if ( ! function_exists( 'saha_get_post_video_html' ) ) :
/**
 * Returns post video HTML
 *
 * @since 1.0.0
 */
function saha_get_post_video_html( $video = '' ) {

	// Get video
	$video = $video ? $video : saha_get_post_video();

	// Return if video is empty
	if ( empty( $video ) ) {
		return;
	}

	// Check post format for standard post type
	if ( 'post' == get_post_type() && 'video' != get_post_format() ) {
		return;
	}

	// Check if it's an embed or iframe

	// Get oembed code and return
	if ( ! is_wp_error( $oembed = wp_oembed_get( $video ) ) && $oembed ) {
		return '<div class="responsive-video-wrap">'. $oembed .'</div>';
	}

	// Display using apply_filters if it's self-hosted
	else {

		$video = apply_filters( 'the_content', $video );

		// Add responsive video wrap for youtube/vimeo embeds
		if ( strpos( $video, 'youtube' ) || strpos( $video, 'vimeo' ) ) {
			return '<div class="responsive-video-wrap">'. $video .'</div>';
		}
		
		// Else return without responsive wrap
		else {
			return $video;
		}

	}

}
endif;

if ( ! function_exists( 'saha_get_post_audio' ) ) :
/**
 * Returns post audio
 *
 * @since 1.0.0
 */
function saha_get_post_audio( $id = '' ) {

	// Define video variable
	$audio = '';

	// Get correct ID
	$id = $id ? $id : get_the_ID();

	// Check for self-hosted first
	if ( $self_hosted = get_post_meta( $id, 'saha_post_self_hosted_media', true ) ) {
		$audio = $self_hosted;
	}

	// Check for saha_post_audio custom field
	elseif ( $post_video = get_post_meta( $id, 'saha_post_audio', true ) ) {
		$audio = $post_video;
	}

	// Check for post oembed
	elseif ( $post_oembed = get_post_meta( $id, 'saha_post_oembed', true ) ) {
		$audio = $post_oembed;
	}

	// Apply filters for child theming
	$audio = apply_filters( 'saha_get_post_audio', $audio );

	// Return data
	return $audio;

}
endif;

if ( ! function_exists( 'saha_get_post_audio_html' ) ) :
/**
 * Returns post audio
 *
 * @since 1.0.0
 */
function saha_get_post_audio_html( $audio = '' ) {

	// Get video
	$audio = $audio ? $audio : saha_get_post_audio();

	// Return if video is empty
	if ( empty( $audio ) ) {
		return;
	}

	// Get oembed code and return
	if ( ! is_wp_error( $oembed = wp_oembed_get( $audio ) ) && $oembed ) {
		return '<div class="responsive-audio-wrap">'. $oembed .'</div>';
	}

	// Display using apply_filters if it's self-hosted
	else {
		return apply_filters( 'the_content', $audio );
	}

}
endif;

if ( ! function_exists( 'saha_get_gallery_ids' ) ) :
/**
 * Retrieve attachment IDs
 *
 * @since 1.0.0
 */
function saha_get_gallery_ids( $post_id = '' ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$attachment_ids = get_post_meta( $post_id, '_easy_image_gallery', true );
	if ( $attachment_ids ) {
		$attachment_ids = explode( ',', $attachment_ids );
		return array_filter( $attachment_ids );
	}
}
endif;

if ( ! function_exists( 'saha_gallery_count' ) ) :
/**
 * Return gallery count
 *
 * @since 1.0.0
 */
function saha_gallery_count() {
	$ids = saha_get_gallery_ids();
	return count( $ids );
}
endif;

if ( ! function_exists( 'saha_gallery_is_lightbox_enabled' ) ) :
/**
 * Check if lightbox is enabled
 *
 * @since 1.0.0
 */
function saha_gallery_is_lightbox_enabled() {
	if ( 'on' == get_post_meta( get_the_ID(), '_easy_image_gallery_link_images', true ) ) {
		return true;
	}
}
endif;

if ( ! function_exists( 'saha_get_post_gallery' ) ) :
/**
 * Returns post gallery
 *
 * @since 1.0.0
 */
function saha_get_post_gallery() {

	// Get attachments
	$attachments = saha_get_gallery_ids();

	// If there aren't attachments return nothing
	if( empty( $attachments ) ) {
		return;
	}

	if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
		$width 	= saha_mod( PREFIX . '1c-posts-img-width' );
		$height = saha_mod( PREFIX . '1c-posts-img-height' );
	} else {
		$width 	= saha_mod( PREFIX . 'posts-img-width' );
		$height = saha_mod( PREFIX . 'posts-img-height' );
	} ?>

	<div class="gallery-format owl-carousel owl-theme clr">
		<?php
		// Loop through each attachment ID
		foreach ( $attachments as $attachment ) :
			// Get image
			$featured_image = saha_image_resize( wp_get_attachment_url( $attachment ), $width, $height, true );
			// Get image alt tag
			$attachment_alt = strip_tags( get_post_meta( $attachment, '_wp_attachment_image_alt', true ) );

			// Display image with lightbox
			if ( saha_gallery_is_lightbox_enabled() == 'on' ) { ?>
				<a href="<?php echo esc_url( wp_get_attachment_url( $attachment ) ); ?>" class="gallery-lightbox">
					<img src="<?php echo esc_url( $featured_image['url'] ); ?>" width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>" alt="<?php echo esc_attr( $attachment_alt ); ?>" />
				</a>
			<?php } else if ( !is_singular() ) { ?>
				<a href="<?php the_permalink(); ?>">
					<img src="<?php echo esc_url( $featured_image['url'] ); ?>" width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>" alt="<?php echo esc_attr( $attachment_alt ); ?>" />
				</a>
			<?php } else { ?>
				<img src="<?php echo esc_url( $featured_image['url'] ); ?>" width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>" alt="<?php echo esc_attr( $attachment_alt ); ?>" />
			<?php }
		endforeach; ?>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'saha_get_post_link' ) ) :
/**
 * Returns post link
 *
 * @since 1.0.0
 */
function saha_get_post_link() { ?>
	<div class="link-entry clr">
		<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'saha_link_format', true ) ); ?>" target="_<?php echo esc_attr( get_post_meta( get_the_ID(), 'saha_link_format_target', true ) ); ?>"><i class="icon-link"></i></a>
	</div>
<?php
}
endif;

if ( ! function_exists( 'saha_get_post_quote' ) ) :
/**
 * Returns post quote
 *
 * @since 1.0.0
 */
function saha_get_post_quote() {

	// Quote
	$quote = get_post_meta( get_the_ID(), 'saha_quote_format', true ) ?>

	<div class="quote-entry clr">
		<i class="fa fa-quote-left"></i>
		<div class="quote-title">
			<span class="quote-content">
				<?php if ( !is_singular() ) { ?>
					<a href="<?php the_permalink(); ?>" class="quote-content"><?php echo esc_attr( $quote ); ?></a>
				<?php } else {
					echo esc_attr( $quote );
				} ?>
			</span>
			<span class="quote-author"><?php the_title(); ?></span>
		</div>
	</div>

<?php
}
endif;

if ( ! function_exists( 'saha_pagination' ) ) :
/**
 * Pagination
 *
 * @since  1.0.0
 */
function saha_pagination( $query = '' ) {
		
	$prev_arrow = is_rtl() ? '→' : '←';
	$next_arrow = is_rtl() ? '←' : '→';

	// Get global $query
	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	// Set vars
	$total	= $query->max_num_pages;
	$big	= 999999999;

	// Display pagination
	if ( $total > 1 ) {

		// Get current page
		if ( $current_page = get_query_var( 'paged' ) ) {
			$current_page = $current_page;
		} elseif ( $current_page = get_query_var( 'page' ) ) {
			$current_page = $current_page;
		} else {
			$current_page = 1;
		}

		// Get permalink structure
		if ( get_option( 'permalink_structure' ) ) {
			$format = 'page/%#%/';
		} else {
			$format = '&paged=%#%';
		}

		// Midsize
		$mid_size = '3';

		// Output pagination
		echo paginate_links( array(
			'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'		=> $format,
			'current'		=> max( 1, $current_page ),
			'total'			=> $total,
			'mid_size'		=> $mid_size,
			'type'			=> 'list',
			'prev_text'		=> $prev_arrow,
			'next_text'		=> $next_arrow,
		));
	}
}
endif;

if ( ! function_exists( 'saha_footer_widgets' ) ) :
/**
 * Footer Widgets
 *
 * @since  1.0.0
 */
function saha_footer_widgets() {

	// Return if footer widggets is disabled in admin
	if ( !saha_mod( PREFIX . 'footer-widgets' ) ) :
		return;
	endif;

	echo '<div id="footer-widgets" class="clr">';
		echo '<div class="footer-column footer-column-1">';
			dynamic_sidebar('footer-1');
		echo '</div>';
		
		echo '<div class="footer-column footer-column-2">';
			dynamic_sidebar('footer-2');
		echo '</div>';
		
		echo '<div class="footer-column footer-column-3">';
			dynamic_sidebar('footer-3');
		echo '</div>';
		
		echo '<div class="footer-column footer-column-4">';
			dynamic_sidebar('footer-4');
		echo '</div>';		
	echo '</div>';
	
}
endif;

if ( ! function_exists( 'saha_footer_bottom' ) ) :
/**
 * Footer Bottom
 *
 * @since  1.0.0
 */
function saha_footer_bottom() {

	// Return if footer bottom is disabled in admin
	if ( !saha_mod( PREFIX . 'footer-bottom' ) ) :
		return;
	endif;

	// Get the customizer data 
	$footer_text = saha_mod( PREFIX . 'footer-text' );

	// Polylang integration
	if ( is_polylang_activated() ) {
		$footer_text = pll__( saha_mod( PREFIX . 'footer-text' ) );
	}

	// Display the data
	echo '<div id="footer-bottom" class="clr">';
		echo '<div class="copyright">' . stripslashes( $footer_text ) . '</div>';
		if ( has_nav_menu( 'footer_menu' ) ) {
			echo '<div class="footer-nav">';
				echo '<ul>';
					echo ''. wp_nav_menu( array(
						'theme_location'	=> 'footer_menu',
						'sort_column'		=> 'menu_order',
						'container'       	=> false,
						'fallback_cb'		=> false,
						'items_wrap'      	=> '%3$s',
						'depth'           	=> 0,
						'walker'          	=> new Saha_Custom_Nav_Walker(),
					)) .'';
				echo '</ul>';
			echo '</div>';
		}
	echo '</div>';
	
}
endif;

if ( ! function_exists( 'saha_blog_query' ) ) :
/**
 * Blog query
 *
 * @since  1.0.0
 */
function saha_blog_query() {

	// Pagination
	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	} else if ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	} else {
		$paged = 1;
	}

	// Arguments
	$args = array(
		'post_type' => 'post',
		'paged'     => $paged
	);

	// Query
	$query = new WP_Query( $args );

	return $query;
	
}
endif;