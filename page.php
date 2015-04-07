<?php get_header(); ?>

<?php
$posts = get_posts( 
	array( 
		'numberposts' => -1
	) 
); 

foreach( $posts as $post ) :
	setup_postdata( $post );
	get_template_part('parts/griditem');
endforeach;

foreach( $posts as $post ) :
	setup_postdata( $post );
	get_template_part('parts/griditem');
endforeach;

?>


<?php get_footer(); ?>
