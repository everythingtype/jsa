<?php get_header();

global $query_string;
query_posts( $query_string . '&posts_per_page=-1' . '&order=DESC' . '&orderby=menu_order+title' ); 

?>

<div class="projectcategory">
<?php if (have_posts()) : ?>
	<div class="grid">
	<?php while (have_posts()) : the_post(); ?>
		<?php get_template_part('parts/griditem'); ?>
	<?php endwhile; ?>
	</div>
<?php endif; ?>
</div>
<?php get_footer(); ?>
