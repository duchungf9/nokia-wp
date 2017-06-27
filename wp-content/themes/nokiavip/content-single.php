<?php
// Get the data set in customizer
$date       = saha_mod( PREFIX . 'post-date' );
$author     = saha_mod( PREFIX . 'post-author' );
$cat        = saha_mod( PREFIX . 'post-cat' );
$tag        = saha_mod( PREFIX . 'post-tag' );
$share      = saha_mod( PREFIX . 'post-share' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( has_post_format( 'video' ) ) : ?>

		<div class="entry-format">
			<?php echo saha_get_post_video_html(); ?>
		</div>

	<?php elseif ( has_post_format( 'audio' ) ) : ?>

		<div class="entry-format">
			<?php echo saha_get_post_audio_html(); ?>
		</div>

	<?php elseif ( has_post_format( 'gallery' ) ) : ?>

		<div class="entry-media">
			<?php echo saha_get_post_gallery(); ?>
			<?php if ( $date == '1' ) { ?>
				<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>>
					<span class="month"><?php echo get_the_time('M'); ?></span> / <span class="date"><?php echo get_the_time('d'); ?></span>
				</time>
			<?php } ?>
		</div>

	<?php elseif ( has_post_format( 'link' ) ) :

		if ( has_post_thumbnail() ) : ?>
			<div class="entry-media">
				<?php echo saha_get_posts_images(); ?>
				<?php echo saha_get_post_link(); ?>
			</div>
		<?php endif;

	elseif ( has_post_format( 'quote' ) ) :

		echo saha_get_post_quote();

	 else :

	 	if ( has_post_thumbnail() ) : ?>
			<div class="entry-media">
				<?php echo saha_get_posts_images(); ?>
				<?php if ( $date == '1' ) { ?>
					<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>>
						<span class="month"><?php echo get_the_time('M'); ?></span> / <span class="date"><?php echo get_the_time('d'); ?></span>
					</time>
				<?php } ?>
			</div>
		<?php endif;

	endif; ?>

	<?php if ( !has_post_format( 'quote' ) ) : ?>
		<header class="entry-header">

			<ul class="entry-meta">
				<?php if ( $author == '1' ) { ?>
					<li class="entry-meta-author" <?php hybrid_attr( 'entry-author' ); ?>>
						<i class="icon-user"></i>
						<?php echo esc_html( the_author_posts_link() ); ?>
					</li>
				<?php } ?>

				<?php if ( 'post' == get_post_type() && $cat == '1' ) : ?>
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
	<?php endif; ?>
		
	<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'saha' ),
				'after'  => '</div>',
			) );
		?>
	
	</div>

	<footer class="entry-footer">
		
		<?php if ( $tag == '1' ) {
			$tags = get_the_tags();
			if ( $tags && $tag ) : ?>
				<span class="tag-links" <?php hybrid_attr( 'entry-terms', 'post_tag' ); ?>>
					<?php foreach( $tags as $tag ) : ?>
						<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_attr( $tag->name ); ?></a>
					<?php endforeach; ?>
				</span>
			<?php endif;
		} ?>

	</footer>
	
	<?php
	if ( $share == '1' ) {
		saha_entry_share();
	} ?>
	
</article><!-- #post-## -->
