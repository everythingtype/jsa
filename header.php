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

	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon.ico">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-180.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-152.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-144.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-120.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-76.png" />
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-60.png" />
	<meta name="application-name" content="<?php bloginfo( 'name' ); ?>"/> 
	<meta name="msapplication-TileColor" content="#000000"/> 
	<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-144.png"/>

<?php wp_head(); ?>

</head>
<body>

<div class="minwidth">

<?php if ( is_home() || is_front_page() ) get_template_part('parts/splash'); ?>

<div class="topheader">
	
	<div class="wpadminbarspacer"></div>

	<div class="topheadermargin">

		<h1><a href="/home/"><?php get_template_part('parts/logo'); ?><span>Joel Sanders Architect</span></a></h1>

		<div class="nav">

			<div class="secondarynav">
				<?php dynamic_sidebar( 'secondarynav' ); ?>
			</div>

			<div class="topnav">
				<?php dynamic_sidebar('topnav'); ?>
			</div>

			<?php if ( is_singular('jsa_projects') ) get_template_part('parts/projecttitle'); ?>

		</div>

	</div>

</div>



<div class="layout">

<div class="headerspacer"></div>