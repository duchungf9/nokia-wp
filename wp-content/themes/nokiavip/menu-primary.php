<?php
// Check if there's a menu assigned to the 'main_menu' location.
if ( ! has_nav_menu( 'main_menu' ) ) {
	return;
} ?>

<nav class="site-navigation main-navigation clr" <?php hybrid_attr( 'menu' ); ?>>
	<ul class="menu-primary-items dropdown-menu sf-menu">
		<?php wp_nav_menu(
			array(
				'theme_location'  => 'main_menu',
				'link_before'     => '<span class="title">',
				'link_after'      => '</span>',
				'container'       => false,
				'fallback_cb'     => false,
				'items_wrap'      => '%3$s',
				'depth'           => 0,
				'walker'          => new Saha_Custom_Nav_Walker(),
			)
		); ?>
	</ul>
</nav><!-- .site-navigation -->