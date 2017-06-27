<?php if ( is_singular( 'post' ) && saha_mod( PREFIX . 'post-next-prev' ) ) : // If viewing a single post page. ?>

	<div class="loop-nav" role="navigation">
		<?php previous_post_link( '<div class="prev"><span class="title"><span class="icon"><i class="fa fa-long-arrow-left"></i></span>' . __( 'Previous Post', 'saha' ) . '</span><h3>%link</h3></div>', '%title' ); ?>
		<?php next_post_link(     '<div class="next"><span class="title"><span class="icon"><i class="fa fa-long-arrow-right"></i></span>' . __( 'Next Post',     'saha' ) . '</span><h3>%link</h3></div>', '%title' ); ?>
	</div><!-- .loop-nav -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php saha_pagination(); ?>

<?php endif; // End check for type of page being viewed. ?>