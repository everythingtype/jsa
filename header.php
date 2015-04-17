<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package JSA
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'jsa' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="col-width clearfix">

			<div class="site-branding">
				<h1 class="site-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo get_template_directory_uri() . '/images/jsa-logo.png'; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" width="128" height="56">
					</a>
				</h1>
			</div>

			<nav class="main-navigation clearfix" role="navigation">
				<ul class="nav-work">
					<li><a href="#">Projects</a></li>
					<li><a href="#">Research</a></li>
				</ul>
				<ul class="nav-company">
					<li><a href="#">About</a></li>
					<li><a href="#">News</a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="#">Search</a></li>
				</ul>
			</nav>

		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content clearfix">
