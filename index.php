<?php get_header(); ?>

<?php

$posts = get_pages( 
	array( 
		'sort_order' => 'ASC',
		'sort_column' => 'menu_order',
		'numberposts' => -1
	) 
); 

foreach( $posts as $post ) :
	setup_postdata( $post );
	get_template_part('parts/griditem');
endforeach;

?>

<?php get_footer(); ?>
