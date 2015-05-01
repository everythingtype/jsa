<?php
/**
 * Connections for Posts 2 Posts
 *
 * https://github.com/scribu/wp-posts-to-posts/wiki
 *
 * @package JSA
 */

/**
 * Register connections for "Related" content
 */
 function jsa_p2p_register_connections() {

	// Posts
	p2p_register_connection_type( array(
		'name' => 'posts_to_posts',
		'from' => 'post',
		'to' => 'post',
		'reciprocal' => true,
		'title' => array(
		    'from' => __( 'Related Posts', 'jsa' ),
		    'to' => __( 'Related Posts', 'jsa' )
		  )
	) );

	p2p_register_connection_type( array(
		'name' => 'posts_to_pages',
		'from' => 'post',
		'to' => 'page',
		'title' => array(
		    'from' => __( 'Related Pages', 'jsa' ),
		    'to' => __( 'Related Posts', 'jsa' )
		  )
	) );
	p2p_register_connection_type( array(
		'name' => 'posts_to_jsa_projects',
		'from' => 'post',
		'to' => 'jsa_projects',
		'title' => array(
		    'from' => __( 'Related Projects', 'jsa' ),
		    'to' => __( 'Related Posts', 'jsa' )
		  )
	) );

	// Pages
	p2p_register_connection_type( array(
		'name' => 'pages_to_pages',
		'from' => 'page',
		'to' => 'page',
		'reciprocal' => true,
		'title' => array(
		    'from' => __( 'Related Pages', 'jsa' ),
		    'to' => __( 'Related Pages', 'jsa' )
		  )
	) );
	p2p_register_connection_type( array(
		'name' => 'pages_to_jsa_projects',
		'from' => 'page',
		'to' => 'jsa_projects',
		'title' => array(
		    'from' => __( 'Related Projects', 'jsa' ),
		    'to' => __( 'Related Pages', 'jsa' )
		  )
	) );

	// Projects
	p2p_register_connection_type( array(
		'name' => 'jsa_projects_to_jsa_projects',
		'from' => 'jsa_projects',
		'to' => 'jsa_projects',
		'reciprocal' => true,
		'title' => array(
		    'from' => __( 'Related Projects', 'jsa' ),
		    'to' => __( 'Related Projects', 'jsa' )
		  )
	) );
}
add_action( 'p2p_init', 'jsa_p2p_register_connections' );

/**
 * Display related content
 */
function jsa_p2p_the_related() {
	echo jsa_p2p_get_related();
}

/**
 * Get related content
 */
function jsa_p2p_get_related() {
	global $post;
	$output = '';
	$postType = get_post_type( $post );

	if ( $postType == "post" ) :

		$output .= jsa_p2p_get_related_posts( 'posts_to_posts', 'Related posts' );
		$output .= jsa_p2p_get_related_posts( 'posts_to_pages', 'Related pages' );
		$output .= jsa_p2p_get_related_posts( 'posts_to_jsa_projects', 'Related projects' );

	elseif ( $postType == "page"):

		$output .= jsa_p2p_get_related_posts( 'pages_to_pages', 'Related pages' );
		$output .= jsa_p2p_get_related_posts( 'posts_to_pages', 'Related posts' );
		$output .= jsa_p2p_get_related_posts( 'pages_to_jsa_projects', 'Related projects' );

	elseif ( $postType == "jsa_projects"):

		$output .= jsa_p2p_get_related_posts( 'jsa_projects_to_jsa_projects', 'Related projects' );
		$output .= jsa_p2p_get_related_posts( 'posts_to_jsa_projects', 'Related posts' );
		$output .= jsa_p2p_get_related_posts( 'pages_to_jsa_projects', 'Related pages' );

	endif;

	if ( $output !== '' ) :
		$output = '<div class="related-posts">' . $output . '</div>';
	endif;

	return $output;
}

/**
 * Get connection output
 */
function jsa_p2p_get_related_posts( $connectionName, $label ) {

	$output = '';
	if ( $connectionName && $label) :
		$connected_posts = p2p_type( $connectionName )->get_connected();
		if ( $connected_posts->have_posts() ) :
			$loop = '';
			while ( $connected_posts->have_posts() ) : $connected_posts->the_post();
				$loop .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
			endwhile;

			if ( $loop !== '' ) :
				$output .= "<div id=\"related-posts-$connectionName\" class=\"related-posts-type\">\n";
				$output .= '<h3>' . $label . '</h3><ul>' . $loop . '</ul></div>';
			endif;

		endif;

		wp_reset_postdata();
	endif;
	return $output;
}