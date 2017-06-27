<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package zeeDynamic
 */
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta name="google-site-verification" content="ygjoV_5GkQ5HjrU_fCTVK03tsd3pIDK6qY8ibqX2YCM" />
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NQRZM2K');</script>
<!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQRZM2K"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<script type='text/javascript'>window._sbzq||function(e){e._sbzq=[];var t=e._sbzq;t.push(["_setAccount",56516]);var n=e.location.protocol=="https:"?"https:":"http:";var r=document.createElement("script");r.type="text/javascript";r.async=true;r.src=n+"//static.subiz.com/public/js/loader.js";var i=document.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)}(window);</script>
	<div id="page" class="hfeed site">
		
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'zeedynamic' ); ?></a>
		
		<div id="header-top" class="header-bar-wrap"><?php do_action( 'zeedynamic_header_bar' ); ?></div>
		
		<header id="masthead" class="site-header clearfix" role="banner">
			
			<div class="header-main container clearfix">
						
				<div id="logo" class="site-branding clearfix">
				
					<?php zeedynamic_site_title(); ?>
				
				</div><!-- .site-branding -->
				
				<div class="header-widgets clearfix">
					
					<?php // Display Header Widgets
					if( is_active_sidebar( 'header' ) ) : 
			
						dynamic_sidebar( 'header' );
						
					endif; ?>
					
				</div><!-- .header-widgets -->

			
			</div><!-- .header-main -->	

			<div id="main-navigation-wrap" class="primary-navigation-wrap">
			
				<nav id="main-navigation" class="primary-navigation navigation clearfix" role="navigation">
					<?php 
						// Display Main Navigation
						wp_nav_menu( array(
							'theme_location' => 'primary', 
							'container' => false, 
							'menu_class' => 'main-navigation-menu', 
							'echo' => true, 
							'fallback_cb' => 'zeedynamic_default_menu')
						);
					?>
				</nav><!-- #main-navigation -->
				
			</div>
		
		</header><!-- #masthead -->
		
		<?php zeedynamic_breadcrumbs(); ?>
		
		<div id="content" class="site-content container clearfix">
		
			<?php zeedynamic_header_image(); ?>