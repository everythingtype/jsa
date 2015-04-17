<?php
/**
 * Project Post Type
 *
 * @package   Project_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package Project_Post_Type
 */
class Project_Post_Type_Registrations {

	public $post_type = 'jsa_projects';

	public $taxonomies = array( 'jsa_project_categories' );

	public function init() {
		// Add the project post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Project_Post_Type_Registrations::register_post_type()
	 * @uses Project_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Projects', 'project-post-type' ),
			'singular_name'      => __( 'Project', 'project-post-type' ),
			'add_new'            => __( 'Add Project', 'project-post-type' ),
			'add_new_item'       => __( 'Add Project', 'project-post-type' ),
			'edit_item'          => __( 'Edit Project', 'project-post-type' ),
			'new_item'           => __( 'New Project', 'project-post-type' ),
			'view_item'          => __( 'View Project', 'project-post-type' ),
			'search_items'       => __( 'Search Projects', 'project-post-type' ),
			'not_found'          => __( 'No projects found', 'project-post-type' ),
			'not_found_in_trash' => __( 'No projects in the trash', 'project-post-type' ),
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail',
			'custom-fields',
			'revisions',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'has_archive'	  => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'projects', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-portfolio'
		);

		$args = apply_filters( 'project_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Project Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Project Categories', 'project-post-type' ),
			'singular_name'              => __( 'Project Category', 'project-post-type' ),
			'menu_name'                  => __( 'Project Categories', 'project-post-type' ),
			'edit_item'                  => __( 'Edit Project Category', 'project-post-type' ),
			'update_item'                => __( 'Update Project Category', 'project-post-type' ),
			'add_new_item'               => __( 'Add New Project Category', 'project-post-type' ),
			'new_item_name'              => __( 'New Project Category Name', 'project-post-type' ),
			'parent_item'                => __( 'Parent Project Category', 'project-post-type' ),
			'parent_item_colon'          => __( 'Parent Project Category:', 'project-post-type' ),
			'all_items'                  => __( 'All Project Categories', 'project-post-type' ),
			'search_items'               => __( 'Search Project Categories', 'project-post-type' ),
			'popular_items'              => __( 'Popular Project Categories', 'project-post-type' ),
			'separate_items_with_commas' => __( 'Separate project categories with commas', 'project-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove project categories', 'project-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used project categories', 'project-post-type' ),
			'not_found'                  => __( 'No project categories found.', 'project-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'project-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'project_post_type_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}