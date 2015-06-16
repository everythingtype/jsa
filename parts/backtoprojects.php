<?php

$terms = get_the_terms( $post->ID, 'jsa_project_categories');

if ( $terms && ! is_wp_error( $terms ) ) : 
	$backlink = get_term_link( $terms[0]->term_id, 'jsa_project_categories' );
	$backlabel = $terms[0]->name;
else:
	$backlink = get_permalink( get_page_by_path( 'projects' ) );
	$backlabel = 'Projects';
endif;

?>

<div class="backto">
	<div class="edgemargin">
		<a class="button" href="<?php echo $backlink; ?>"><span>&larr;</span> Back to <?php echo $backlabel; ?></a>
	</div>
</div>
