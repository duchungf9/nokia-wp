<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-media">
			<a class="thumbnail-link" href="<?php the_permalink(); ?>">
				<?php echo saha_get_posts_images(); ?>
			</a>
			<?php echo saha_get_post_link(); ?>
		</div>
	<?php endif; ?>

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
