<?php 

/* Template Name: Projects */ 

get_header(); ?>
<div class="projectcategory">
<div class="grid">
<?php

$projects = get_posts(array(
	'post_type' => 'jsa_projects',
	'posts_per_page' => -1,
	'order' => 'DESC',
	'orderby' => 'menu_order'
));

foreach ( $projects as $post ) : 
	setup_postdata( $post ); 
	get_template_part('parts/griditem');
endforeach;

?>
</div>
</div>
<?php get_footer(); ?>
