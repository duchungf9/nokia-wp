<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<div class="entry-media">
		<?php echo saha_get_post_gallery(); ?>
		<?php if ( saha_mod( PREFIX . 'post-entry-date' ) ) : ?>
			<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>>
				<span class="month"><?php echo get_the_time('M'); ?></span> / <span class="date"><?php echo get_the_time('d'); ?></span>
			</time>
		<?php endif; ?>
	</div>

	<header class="entry-header">

		<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<ul class="entry-meta">
			<?php if ( saha_mod( PREFIX . 'post-entry-author' ) ) : ?>
				<li class="entry-meta-author" <?php hybrid_attr( 'entry-author' ); ?>>
					<i class="icon-user"></i>
					<?php echo esc_html( the_author_posts_link() ); ?>
				</li>
			<?php endif; ?>

			<?php if ( 'post' == get_post_type() && saha_mod( PREFIX . 'post-entry-cat' ) ) : ?>
				<li class="entry-meta-category" <?php hybrid_attr( 'entry-terms', 'category' ); ?>>
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'saha' ) );
						if ( $categories_list && saha_categorized_blog() ) :
					?>
					<i class="icon-folder-alt"></i>
					<?php echo $categories_list; ?>
					<?php endif; // End if categories ?>
				</li>
			<?php endif; ?>

			<li class="entry-meta-comment" <?php hybrid_attr( 'entry-comment' ); ?>>
				<i class="icon-bubbles"></i>
				<?php esc_html( comments_popup_link( __( '0 Comments', 'saha' ), __( '1 Comment',  'saha' ), __( '% Comments', 'saha' ), 'comments-link' ) ); ?>
			</li>
		</ul>
		
	</header>

	<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
		<?php the_excerpt(); ?>
	</div>

	<span class="more-link-wrapper">
		<a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Continue Reading', 'saha' ); ?></a>
	</span>
	
</article><!-- #post-## -->
