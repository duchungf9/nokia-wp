<?php
// Template Name: Blog

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" <?php hybrid_attr( 'content' ); ?>>

			<?php $blog = saha_blog_query(); ?>

			<?php if ( $blog->have_posts() ) : ?>

				<?php while ( $blog->have_posts() ) : $blog->the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php saha_pagination( $blog ); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
