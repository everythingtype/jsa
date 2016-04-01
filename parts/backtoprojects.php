<div class="projectscats">
	<ul>
	<?php

	$terms = get_the_terms( $post->ID, 'jsa_project_categories');

	if ( $terms && ! is_wp_error( $terms ) ) : 

		foreach ( $terms as $term ) :
		$backlink = get_term_link( $term->term_id, 'jsa_project_categories' );
		$backlabel = $term->name; 

	?>

	<li><a href="<?php echo $backlink; ?>"><?php echo $backlabel; ?></a></li>

	<?php endforeach; ?>
<?php else: ?>

	<?php 
		$backlink = get_permalink( get_page_by_path( 'projects' ) );
		$backlabel = 'Projects';
	?>

	<li><a href="<?php echo $backlink; ?>"><?php echo $backlabel; ?></a></li>

<?php endif; ?>
	</ul>
</div>
