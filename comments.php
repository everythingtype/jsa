<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package JSA
 */

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
		<h3 class="comments-title">
			<?php
				printf( _nx( '1 Response', '%1$s Responses', get_comments_number(), 'comments title', 'jsa' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="pagination comment-pagination" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'jsa' ); ?></h1>
			<span class="page-numbers"><?php printf( __( 'Page %1$s of %2$s', 'jsa' ), ( get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1 ), get_comment_pages_count() ); ?></span>
			<?php paginate_comments_links(); ?>
		</nav><!-- .comment-navigation -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style' => 'ol',
					'short_ping' => true,
					'avatar_size' => 40,
					'callback' => 'jsa_comment_callback',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="pagination comment-pagination" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'jsa' ); ?></h1>
			<span class="page-numbers"><?php printf( __( 'Page %1$s of %2$s', 'jsa' ), ( get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1 ), get_comment_pages_count() ); ?></span>
			<?php paginate_comments_links(); ?>
		</nav><!-- .comment-navigation -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'jsa' ); ?></p>
	<?php endif; ?>

	<?php comment_form( array(
			'comment_notes_before' => ''
		)
	); ?>

</div><!-- #comments -->
