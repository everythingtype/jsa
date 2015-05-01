<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package JSA
 */

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function jsa_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'jsa' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'jsa_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function jsa_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'jsa_setup_author' );

/**
 * Use a template for individual comment output
 *
 * @param object $comment Comment to display.
 * @param int    $depth   Depth of comment.
 * @param array  $args    An array of arguments.
 */
function jsa_comment_callback( $comment, $args, $depth ) {
	include( locate_template( 'comment.php' ) );
}

/**
 * Add HTML5 placeholders for each default comment field
 *
 * @param array $fields
 * @return array $fields
 */
function jsa_comment_fields( $fields ) {

    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields['author'] =
        '<p class="comment-form-author">
        	<label for="author">' . __( 'Name', 'jsa' ) . '</label>
            <input required minlength="3" maxlength="30" placeholder="' . __( 'Name *', 'jsa' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';

    $fields['email'] =
        '<p class="comment-form-email">
        	<label for="email">' . __( 'Email', 'jsa' ) . '</label>
            <input required placeholder="' . __( 'Email *', 'jsa' ) . '" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';

    $fields['url'] =
        '<p class="comment-form-url">
        	<label for="url">' . __( 'Website', 'jsa' ) . '</label>
            <input placeholder="' . __( 'Website', 'jsa' ) . '" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" />
        </p>';

    return $fields;
}
add_filter( 'comment_form_default_fields', 'jsa_comment_fields' );

/**
 * Add HTML5 placeholder to the comment textarea.
 *
 * @param string $comment_field
 * @return string $comment_field
 */
 function jsa_commtent_textarea( $comment_field ) {

    $comment_field =
        '<p class="comment-form-comment">
            <textarea required placeholder="' . __( 'Comment *', 'jsa' ) . '" id="comment" name="comment" cols="45" rows="6" aria-required="true"></textarea>
        </p>';

    return $comment_field;
}
add_filter( 'comment_form_field_comment', 'jsa_commtent_textarea' );

/**
 * Remove JetPack contact form styles
 */
function jsa_grunion_style() {
	wp_dequeue_style( 'grunion.css' );
	wp_deregister_style( 'grunion.css' );
}
add_action( 'wp_print_styles', 'jsa_grunion_style' );