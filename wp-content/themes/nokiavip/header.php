<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-92773774-1', 'auto');
  ga('send', 'pageview');
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '703503076477151'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=703503076477151&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

</script>
</head>

<body <?php body_class(); ?> <?php hybrid_attr( 'body' ); ?>>

<?php
// Mobile menu
saha_mobile_menu(); ?>

<div id="page" class="hfeed site">

	<div class="fixed-header clr" <?php hybrid_attr( 'header' ); ?>>

		<div class="site-header-inner clr">
			<div class="container">
				<?php
					saha_site_branding();

					saha_header_fixed_elements();

					get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template.

					saha_mobile_link();
				?>
			</div>
		</div>

	</div><!-- .fixed-header -->

	<header id="masthead" class="site-header clr" <?php hybrid_attr( 'header' ); ?>>

		<?php saha_top_bar(); ?>
			
		<div class="site-header-inner clr">
			<div class="container">
				<?php
					saha_site_branding();

				?>
				<div class="header-tittle">
					<p class="p1">ĐAM MÊ ĐẲNG CẤP VĨNH CỬU</p>
					<p class="p2">Uy tín & Chất lượng tạo nên thương hiệu NokiaVIP</p>
				</div>
				<div class="header-right">
				<div class="phone-info" style="">
					HOTLINE: 09444 33333
				</div>
				<?php
					saha_header_search();
				?>
				</div>
				<?php
					saha_header_right();
					saha_mobile_link();
				?>
			</div>
		</div>

		<div id="site-navigation-wrap">
			<div class="container">
				<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>
			</div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content clr" <?php hybrid_attr( 'content' ); ?>>

		<?php saha_title(); ?>

		<div id="content-wrap" class="container clr">
