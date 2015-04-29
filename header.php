<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php 
	wp_title( '&ndash;', true, 'right' );
	bloginfo( 'name' ); 
	$site_description = get_bloginfo( 'description', 'display' );

	if ( $paged >= 2 || $page >= 2 )
		echo ' &ndash; ' . sprintf( __( 'Page %s' ), max( $paged, $page ) );
	?></title>

<?php wp_head(); ?>

</head>
<body>

	<h1><a href="/"><span>Joel Sanders Architect</span></a></h1>

	<?php wp_nav_menu( array( 'theme_location' => 'projectsresearch' ) ); ?>
