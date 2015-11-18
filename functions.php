<?php

require_once( 'functions/connections.php' );
require_once( 'functions/enqueue.php' );
require_once( 'functions/gallery.php' );
require_once( 'functions/menus.php' );
require_once( 'functions/projects.php' );

require_once( 'functions/spellerberg_wpsrcset.php' );

function prefix_query_change( $query ) {

    // Only filter the main query on the front-end
    if ( is_admin() || ! $query->is_main_query() ) {
    	return;
    }

    global $wp;
    $front = false;

	// If the latest posts are showing on the home page
    if ( ( is_home() && empty( $wp->query_string ) ) ) {
    	$front = true;
    }

	// If a static page is set as the home page
    if ( ( $query->get( 'page_id' ) == get_option( 'page_on_front' ) && get_option( 'page_on_front' ) ) || empty( $wp->query_string ) ) {
    	$front = true;
    }

    if ( $front ) :

        $query->set( 'post_type', 'page' );
        $query->set( 'pagename', 'home' ); // Page slug

        // Set properties to match a page
        $query->is_page = 1;

    endif;

}
add_action( 'pre_get_posts', 'prefix_query_change' );


function template_override($template) {

	global $wp_query;

	if( is_home() ) :

		return locate_template('page-home.php');
	
	endif;

	return $template;
}
add_filter('template_include', 'template_override');


?>
