<?php
/**
 * The template for displaying a single comment or pingback.
 *
 * @package JSA
 */
?>

<?php
global $post;
$comment_body_class = 'comment-body';
if ( $post ) {
	if ( $comment->user_id === $post->post_author ) {
		$comment_body_class = 'comment-body comment-by-post-author';
	}
}
?>
<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
	<article id="div-comment-<?php comment_ID(); ?>" class="<?php echo $comment_body_class; ?>">
		<header class="comment-meta">
			<div class="comment-author vcard">
				<?php if ( 'trackback' == $comment->comment_type || 'pingback' == $comment->comment_type ) { ?>
					<div class="avatar"><i class="jsa-icon-link"></i></div>
				<?php } else { ?>
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				<?php } ?>
				<?php printf( '<b class="fn">%s</b>', get_comment_author_link() ); ?>
			</div><!-- .comment-author -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
			<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'jsa' ); ?></p>
			<?php endif; ?>
		</header><!-- .comment-meta -->

		<div class="comment-content">
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

		<footer class="comment-metadata">
			<?php if ( get_comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ) : ?>
			<span class="comment-reply">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</span>
			<?php endif; ?>
			<span class="comment-time">
			<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
				<time datetime="<?php comment_time( 'c' ); ?>">
					<?php printf( _x( '%1$s at %2$s', '1: date, 2: time' ), get_comment_date(), get_comment_time() ); ?>
				</time>
			</a>
			</span>
			<?php edit_comment_link( __( 'Edit', 'jsa' ), '<span class="edit-comment">', '</span>' ); ?>
		</footer><!-- .comment-metadata -->

	</article><!-- .comment-body -->
<!-- The <li> is closed by WordPress -->
