<?php
/**
 * Posts color
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'saha_customizer_posts_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function saha_customizer_posts_styles() {

	// Posts Border Bottom Color
	$posts_border_bottom = saha_mod( PREFIX . 'posts-border-bottom-color' );

	if ( $posts_border_bottom !== customizer_library_get_default( PREFIX . 'posts-border-bottom-color' ) ) {

		$color = sanitize_hex_color( $posts_border_bottom );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post',
				'.search article.page'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Posts Date Background
	$date_bg = saha_mod( PREFIX . 'date-bg' );

	if ( $date_bg != customizer_library_get_default( PREFIX . 'date-bg' ) ) {

		$color = sanitize_hex_color( $date_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .entry-media .entry-date',
				'article.post .entry-media .entry-date::after'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Posts Date Background Hover
	$date_bg_hover = saha_mod( PREFIX . 'date-bg-hover' );

	if ( $date_bg_hover != customizer_library_get_default( PREFIX . 'date-bg-hover' ) ) {

		$color = sanitize_hex_color( $date_bg_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .entry-media:hover .entry-date',
				'article.post .entry-media:hover .entry-date::after'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Posts Date Color
	$date_color = saha_mod( PREFIX . 'date-color' );

	if ( $date_color != customizer_library_get_default( PREFIX . 'date-color' ) ) {

		$color = sanitize_hex_color( $date_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .entry-media .entry-date'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Posts Date Color Hover
	$date_color_hover = saha_mod( PREFIX . 'date-color-hover' );

	if ( $date_color_hover != customizer_library_get_default( PREFIX . 'date-color-hover' ) ) {

		$color = sanitize_hex_color( $date_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .entry-media:hover .entry-date'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Meta Color
	$meta_color = saha_mod( PREFIX . 'meta-color' );

	if ( $meta_color != customizer_library_get_default( PREFIX . 'meta-color' ) ) {

		$color = sanitize_hex_color( $meta_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .entry-header ul li',
				'article.post .entry-header ul li a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Meta Color Hover
	$meta_color_hover = saha_mod( PREFIX . 'meta-color-hover' );

	if ( $meta_color_hover != customizer_library_get_default( PREFIX . 'meta-color-hover' ) ) {

		$color = sanitize_hex_color( $meta_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .entry-header ul li a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Meta Icons Color
	$meta_icons_color = saha_mod( PREFIX . 'meta-icons-color' );

	if ( $meta_icons_color != customizer_library_get_default( PREFIX . 'meta-icons-color' ) ) {

		$color = sanitize_hex_color( $meta_icons_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .entry-header ul li i'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// More Link Color
	$more_link_color = saha_mod( PREFIX . 'more-link-color' );

	if ( $more_link_color != customizer_library_get_default( PREFIX . 'more-link-color' ) ) {

		$color = sanitize_hex_color( $more_link_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .more-link',
				'.search article.page .more-link'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// More Link Color Hover
	$more_link_color_hover = saha_mod( PREFIX . 'more-link-color-hover' );

	if ( $more_link_color_hover != customizer_library_get_default( PREFIX . 'more-link-color-hover' ) ) {

		$color = sanitize_hex_color( $more_link_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .more-link:hover',
				'.search article.page .more-link:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// More Link Border Color
	$more_link_border_color = saha_mod( PREFIX . 'more-link-border-color' );

	if ( $more_link_border_color != customizer_library_get_default( PREFIX . 'more-link-border-color' ) ) {

		$color = sanitize_hex_color( $more_link_border_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .more-link',
				'.search article.page .more-link'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// More Link Border Color Hover
	$more_link_border_color_hover = saha_mod( PREFIX . 'more-link-border-color-hover' );

	if ( $more_link_border_color_hover != customizer_library_get_default( PREFIX . 'more-link-border-color-hover' ) ) {

		$color = sanitize_hex_color( $more_link_border_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'article.post .more-link:hover',
				'.search article.page .more-link:hover'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Link Format Icon Background
	$link_format_icon_bg = saha_mod( PREFIX . 'link-format-icon-bg' );

	if ( $link_format_icon_bg != customizer_library_get_default( PREFIX . 'link-format-icon-bg' ) ) {

		$color = sanitize_hex_color( $link_format_icon_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.link-entry i'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Link Format Icon Background Hover
	$link_format_icon_bg_hover = saha_mod( PREFIX . 'link-format-icon-bg-hover' );

	if ( $link_format_icon_bg_hover != customizer_library_get_default( PREFIX . 'link-format-icon-bg-hover' ) ) {

		$color = sanitize_hex_color( $link_format_icon_bg_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.entry-media:hover i'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Link Format Icon Color
	$link_format_icon_color = saha_mod( PREFIX . 'link-format-icon-color' );

	if ( $link_format_icon_color != customizer_library_get_default( PREFIX . 'link-format-icon-color' ) ) {

		$color = sanitize_hex_color( $link_format_icon_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.link-entry i'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Link Format Icon Color Hover
	$link_format_icon_color_hover = saha_mod( PREFIX . 'link-format-icon-color-hover' );

	if ( $link_format_icon_color_hover != customizer_library_get_default( PREFIX . 'link-format-icon-color-hover' ) ) {

		$color = sanitize_hex_color( $link_format_icon_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.entry-media:hover i'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Quote Format Background
	$quote_format_bg = saha_mod( PREFIX . 'quote-format-bg' );

	if ( $quote_format_bg != customizer_library_get_default( PREFIX . 'quote-format-bg' ) ) {

		$color = sanitize_hex_color( $quote_format_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.quote-entry'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Quote Format Color
	$quote_format_color = saha_mod( PREFIX . 'quote-format-color' );

	if ( $quote_format_color != customizer_library_get_default( PREFIX . 'quote-format-color' ) ) {

		$color = sanitize_hex_color( $quote_format_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.quote-entry',
				'.quote-title .quote-content'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Quote Format Icon Background
	$quote_format_icon_bg = saha_mod( PREFIX . 'quote-format-icon-bg' );

	if ( $quote_format_icon_bg != customizer_library_get_default( PREFIX . 'quote-format-icon-bg' ) ) {

		$color = sanitize_hex_color( $quote_format_icon_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.quote-entry i'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Quote Format Icon Background Hover
	$quote_format_icon_bg_hover = saha_mod( PREFIX . 'quote-format-icon-bg-hover' );

	if ( $quote_format_icon_bg_hover != customizer_library_get_default( PREFIX . 'quote-format-icon-bg-hover' ) ) {

		$color = sanitize_hex_color( $quote_format_icon_bg_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.quote-entry:hover i'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Quote Format Icon Color
	$quote_format_icon_color = saha_mod( PREFIX . 'quote-format-icon-color' );

	if ( $quote_format_icon_color != customizer_library_get_default( PREFIX . 'quote-format-icon-color' ) ) {

		$color = sanitize_hex_color( $quote_format_icon_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.quote-entry i'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Quote Format Icon Color Hover
	$quote_format_icon_color_hover = saha_mod( PREFIX . 'quote-format-icon-color-hover' );

	if ( $quote_format_icon_color_hover != customizer_library_get_default( PREFIX . 'quote-format-icon-color-hover' ) ) {

		$color = sanitize_hex_color( $quote_format_icon_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.quote-entry:hover i'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Single Post Border Color
	$single_post_border_color = saha_mod( PREFIX . 'single-post-border-color' );

	if ( $single_post_border_color != customizer_library_get_default( PREFIX . 'single-post-border-color' ) ) {

		$color = sanitize_hex_color( $single_post_border_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.singular-post article.post',
				'.loop-nav',
				'.author-bio',
				'.related-posts',
				'.commentlist .comment-container'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Single Post Blockquote Background
	$single_post_blockquote_bg = saha_mod( PREFIX . 'single-post-blockquote-bg' );

	if ( $single_post_blockquote_bg != customizer_library_get_default( PREFIX . 'single-post-blockquote-bg' ) ) {

		$color = sanitize_hex_color( $single_post_blockquote_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'blockquote'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Single Post Blockquote Color
	$single_post_blockquote_color = saha_mod( PREFIX . 'single-post-blockquote-color' );

	if ( $single_post_blockquote_color != customizer_library_get_default( PREFIX . 'single-post-blockquote-color' ) ) {

		$color = sanitize_hex_color( $single_post_blockquote_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'blockquote'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Single Post Blockquote Border Color
	$single_post_blockquote_border_color = saha_mod( PREFIX . 'single-post-blockquote-border-color' );

	if ( $single_post_blockquote_border_color != customizer_library_get_default( PREFIX . 'single-post-blockquote-border-color' ) ) {

		$color = sanitize_hex_color( $single_post_blockquote_border_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'blockquote'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Single Post Tags Background
	$single_post_tags_bg = saha_mod( PREFIX . 'single-post-tags-bg' );

	if ( $single_post_tags_bg != customizer_library_get_default( PREFIX . 'single-post-tags-bg' ) ) {

		$color = sanitize_hex_color( $single_post_tags_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.singular-post article.post .tag-links a'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Single Post Tags Background Hover
	$single_post_tags_bg_hover = saha_mod( PREFIX . 'single-post-tags-bg-hover' );

	if ( $single_post_tags_bg_hover != customizer_library_get_default( PREFIX . 'single-post-tags-bg-hover' ) ) {

		$color = sanitize_hex_color( $single_post_tags_bg_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.singular-post article.post .tag-links a:hover'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Single Post Tags Color
	$single_post_tags_color = saha_mod( PREFIX . 'single-post-tags-color' );

	if ( $single_post_tags_color != customizer_library_get_default( PREFIX . 'single-post-tags-color' ) ) {

		$color = sanitize_hex_color( $single_post_tags_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.singular-post article.post .tag-links a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Single Post Tags Color Hover
	$single_post_tags_color_hover = saha_mod( PREFIX . 'single-post-tags-color-hover' );

	if ( $single_post_tags_color_hover != customizer_library_get_default( PREFIX . 'single-post-tags-color-hover' ) ) {

		$color = sanitize_hex_color( $single_post_tags_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.singular-post article.post .tag-links a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Single Post Share Background Color
	$single_post_share_bg = saha_mod( PREFIX . 'single-post-share-bg' );

	if ( $single_post_share_bg != customizer_library_get_default( PREFIX . 'single-post-share-bg' ) ) {

		$color = sanitize_hex_color( $single_post_share_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.entry-share'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Single Post Share Title Color
	$single_post_share_title_color = saha_mod( PREFIX . 'single-post-share-title-color' );

	if ( $single_post_share_title_color != customizer_library_get_default( PREFIX . 'single-post-share-title-color' ) ) {

		$color = sanitize_hex_color( $single_post_share_title_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.entry-share .share-title'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Single Post Share Buttons Background Color
	$single_post_share_buttons_bg = saha_mod( PREFIX . 'single-post-share-buttons-bg' );

	if ( $single_post_share_buttons_bg != customizer_library_get_default( PREFIX . 'single-post-share-buttons-bg' ) ) {

		$color = sanitize_hex_color( $single_post_share_buttons_bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.entry-share ul li a'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Single Post Share Buttons Background Color Hover
	$single_post_share_buttons_bg_hover = saha_mod( PREFIX . 'single-post-share-buttons-bg-hover' );

	if ( $single_post_share_buttons_bg_hover != customizer_library_get_default( PREFIX . 'single-post-share-buttons-bg-hover' ) ) {

		$color = sanitize_hex_color( $single_post_share_buttons_bg_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.entry-share ul li a:hover'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Single Post Share Buttons Color
	$single_post_share_buttons_color = saha_mod( PREFIX . 'single-post-share-buttons-color' );

	if ( $single_post_share_buttons_color != customizer_library_get_default( PREFIX . 'single-post-share-buttons-color' ) ) {

		$color = sanitize_hex_color( $single_post_share_buttons_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.entry-share ul li a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Single Post Share Buttons Color Hover
	$single_post_share_buttons_color_hover = saha_mod( PREFIX . 'single-post-share-buttons-color-hover' );

	if ( $single_post_share_buttons_color_hover != customizer_library_get_default( PREFIX . 'single-post-share-buttons-color-hover' ) ) {

		$color = sanitize_hex_color( $single_post_share_buttons_color_hover );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.entry-share ul li a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Single Post Next/Prev Color
	$single_post_next_prev_color = saha_mod( PREFIX . 'single-post-next-prev-color' );

	if ( $single_post_next_prev_color != customizer_library_get_default( PREFIX . 'single-post-next-prev-color' ) ) {

		$color = sanitize_hex_color( $single_post_next_prev_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.loop-nav .title'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Single Post Related Posts Categories Color
	$single_post_related_posts_categories_color = saha_mod( PREFIX . 'single-post-related-posts-categories-color' );

	if ( $single_post_related_posts_categories_color != customizer_library_get_default( PREFIX . 'single-post-related-posts-categories-color' ) ) {

		$color = sanitize_hex_color( $single_post_related_posts_categories_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.related-posts ul li .entry-category a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Single Post Comments Date Color
	$single_post_comments_date_color = saha_mod( PREFIX . 'single-post-comments-date-color' );

	if ( $single_post_comments_date_color != customizer_library_get_default( PREFIX . 'single-post-comments-date-color' ) ) {

		$color = sanitize_hex_color( $single_post_comments_date_color );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.commentlist .comment-info'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

}
endif;
add_action( 'saha_customizer_library_styles', 'saha_customizer_posts_styles' );