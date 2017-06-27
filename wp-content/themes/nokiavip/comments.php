<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title entry-post-title">
			<?php
			// Display Comments Title
			$comments_number = number_format_i18n( get_comments_number() );
			if ( '1' == $comments_number ) {
				$comments_title = __( 'This Post Has One Comment', 'saha' );
			} else {
				$comments_title = sprintf( __( 'This Post Has %s Comments', 'saha' ), $comments_number );
			}
			$comments_title = apply_filters( 'saha_comments_title', $comments_title );
			echo esc_attr( $comments_title ); ?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'saha' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'saha' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'saha' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'saha_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'saha' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'saha' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'saha' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'saha' ); ?></p>
	<?php endif; ?>

	<?php
	function modify_comment_form_fields($fields){
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );

		$fields['author'] = '<p class="comment-input"><input type="text" name="author" id="author" value="'. esc_attr( $commenter['comment_author'] ) .'" placeholder="'. __("Name", "saha").'" size="22" tabindex="1"'. ( $req ? ' aria-required="true"' : '' ).' class="input-name" /></p>';

		$fields['email'] = '<p class="comment-input"><input type="text" name="email" id="email" value="'. esc_attr( $commenter['comment_author_email'] ) .'" placeholder="'. __("Email", "saha").'" size="22" tabindex="2"'. ( $req ? ' aria-required="true"' : '' ).' class="input-email" /></p>';

		$fields['url'] = '<p class="comment-input last"><input type="text" name="url" id="url" value="'. esc_attr( $commenter['comment_author_url'] ) .'" placeholder="'. __("Website", "saha").'" size="22" tabindex="3" class="input-website" /></p>';

		return $fields;
	}
	add_filter('comment_form_default_fields','modify_comment_form_fields');

	comment_form(
		array( 
		'title_reply'			=> '<span class="entry-post-title">'. __( 'Leave a comment', 'saha' ).'</span>',
		'title_reply_to'		=> '<span class="entry-post-title">'. __( 'Leave a reply', 'saha' ).'</span>',
		'must_log_in'			=> '<p class="must-log-in">' .  sprintf( __( "You must be %slogged in%s to post a comment.", "saha" ), '<a href="'.wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ).'">', '</a>' ) . '</p>',
		'logged_in_as'			=> '<p class="logged-in-as">' . __( "Logged in as"," saha" ).' <a href="' .admin_url( "profile.php" ).'">'.$user_identity.'</a>. <a href="' .wp_logout_url(get_permalink()).'" title="' . __("Log out of this account", "saha").'">'. __("Log out &raquo;", "saha").'</a></p>',
		'comment_notes_before'	=> false,
		'comment_notes_after'	=> false,
		'comment_field'			=> '<p class="comment-textarea"><textarea name="comment" id="comment" cols="45" rows="8" aria-required="true" required="required" class="textarea-comment" placeholder="'. __("Your Comment Here...", "saha").'"></textarea></p>',
		'id_submit'				=> 'comment-submit',
		'label_submit'			=> __("Post Comment", "saha"),
		)
	); ?>

</div><!-- #comments -->