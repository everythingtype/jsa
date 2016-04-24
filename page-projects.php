<?php 

/* Template Name: Projects */ 

get_header(); ?>
<div class="projectcategory">

	<h2 class="mobiletitle"><?php the_title(); ?></h2>

	<?php if( have_rows('projects') ): ?>

		<div class="grid">

			<?php while ( have_rows('projects') ) : the_row(); ?>

			<?php

				$project_object = get_sub_field('project');
				$post = $project_object;
				setup_postdata( $post );

//				print_r($post);
				$postStatus = $post->post_status;

				if ( $postStatus == 'publish' ) get_template_part('parts/griditem');

				wp_reset_postdata();


			?>

			<?php endwhile; ?>

		</div>

	<?php endif; ?>

</div>

<?php get_footer(); ?>
