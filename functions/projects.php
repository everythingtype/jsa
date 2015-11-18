<?php

// Post Type

function create_jsa_project() {
	register_post_type( 'jsa_projects',
		array(
			'labels' => array(
				'name' => 'Projects',
				'menu_name' => 'Projects',
				'singular_name' => 'Project',
				'all_items' => 'All Projects',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Project',
				'edit' => 'Edit',
				'edit_item' => 'Edit Project',
				'new_item' => 'New Project',
				'view' => 'View',
				'view_item' => 'View Project',
				'search_items' => 'Search Projects',
				'not_found' => 'No Projects found',
				'not_found_in_trash' => 'No Projects found in Trash',
				'parent' => 'Parent'
			),
			'public' => true,
			'supports' => array( 'title','editor','author','thumbnail','custom-fields','revisions','page-attributes' ),
			'rewrite' => array('slug' => 'project'),
			'has_archive' => true
		)
	);
}

add_action( 'init', 'create_jsa_project' );


// Taxonomy

function create_jsa_project_categories() {

	$labels = array(
		'name'              => _x( 'Project Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Project Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Project Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Project Category' ),
		'update_item'       => __( 'Update Project Category' ),
		'add_new_item'      => __( 'Add New Project Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Categories' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'projects'),
	);

	register_taxonomy( 'jsa_project_categories', array( 'jsa_projects' ), $args );

}

add_action( 'init', 'create_jsa_project_categories', 0 );


function date_compare($a, $b) {
    $t1 = strtotime($a['startDate']);
    $t2 = strtotime($b['startDate']);
    return $t1 - $t2;
}

?>
