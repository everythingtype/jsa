<?php
/**
 * Projects Gallery
 *
 * @package JSA
 */
?>

<?php
/* Retrieves all the terms from the taxonomy portfolio_category
 * http://codex.wordpress.org/Function_Reference/get_categories
 */

$args = array(
	'type' => 'jsa_projects',
	'orderby' => 'name',
	'order' => 'ASC',
	'taxonomy' => 'jsa_project_categories'
);

$categories = get_categories( $args );

foreach( $categories as $category ) :

	$args = array(
		'posts_per_page' => 1,
		'post_type' => 'jsa_projects',
		'jsa_project_categories' => $category->slug,
		'no_found_rows' => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false
	);

	$the_query = new WP_Query( $args );

	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="gallery-cell">
			<div class="project">
				<h3><?php echo $category->name; ?></h3>
				<?php the_post_thumbnail( 'jsa-large-crop' ); ?>
			</div>
		</div>
		<?php endif; ?>
	<?php endwhile;

endforeach;

// Reset Post Data
wp_reset_postdata();