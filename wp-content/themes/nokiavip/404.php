<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="not-found">

				<div class="page-content">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found!', 'saha' ); ?></h1>
					<p><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'saha' ); ?></p>

					<div class="error-text">4<span>0</span>4</div>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>