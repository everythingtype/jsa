<?php
/**
 * JSA functions and definitions
 *
 * @package JSA
 */

/**
 * The current version of the theme.
 */
define( 'JSA_VERSION', '0.1.0' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 840; /* pixels */
}

if ( ! function_exists( 'jsa_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jsa_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on jsa, use a find and replace
	 * to change 'jsa' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'jsa', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'jsa-grid', 600, 400, true );
	add_image_size( 'jsa-large', 1020, 9999, true );
	add_image_size( 'jsa-large-crop', 1020, 480, true );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image', 'gallery', 'video', 'quote', 'link'
	) );

}
endif; // jsa_setup
add_action( 'after_setup_theme', 'jsa_setup' );

/**
 * Enqueue scripts and styles.
 */
function jsa_scripts() {

	wp_enqueue_style(
		'jsa-style',
		get_stylesheet_uri(),
		array(),
		JSA_VERSION
	);

	if ( SCRIPT_DEBUG || WP_DEBUG ) :

		wp_enqueue_script(
			'jsa-skip-link-focus-fix',
			get_template_directory_uri() . '/js/skip-link-focus-fix.js',
			array(),
			JSA_VERSION,
			true
		);

		wp_enqueue_script(
			'jsa-fitvids',
			get_template_directory_uri() . '/js/jquery.fitvids.js',
			array( 'jquery' ),
			JSA_VERSION,
			true
		);

		wp_enqueue_script(
			'jsa-theme',
			get_template_directory_uri() . '/js/theme.js',
			array( 'jquery', 'jsa-fitvids' ),
			JSA_VERSION,
			true
		);

	else :

		wp_enqueue_script(
			'jsa-scripts',
			get_template_directory_uri() . '/js/jsa.min.js',
			array( 'jquery' ),
			JSA_VERSION,
			true
		);

	endif;

	wp_enqueue_script(
		'jsa-flickity',
		get_template_directory_uri() . '/js/flickity.pkgd.js',
		array( 'jquery' ),
		JSA_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jsa_scripts' );


// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';

// Loop pagination
require get_template_directory() . '/inc/loop-pagination.php';

// Connections (Posts 2 Posts)
require get_template_directory() . '/inc/connections.php';

// Project Post Type
require get_template_directory() . '/plugins/project-post-type/project-post-type.php';
