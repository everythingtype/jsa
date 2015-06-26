<?php get_header(); ?>
<?php if (have_posts()) : ?>
	<div class="pagetemplate">
		<?php while (have_posts()) : the_post(); ?>
			<div class="edgemargin">
			<div class="pagecontent">

				<?php if ( !is_page('contact') ) :?>
					<h2><?php the_title(); ?></h2>
				<?php endif; ?>

				<?php the_content(); ?>

			</div>
		</div>

			<?php 
				$related = p2p_type('pages_to_jsa_projects')->get_connected(); 

				if ( $related->have_posts() ) : ?>
				<div class="edgemargin">
					<h2>Related Projects</h2>
				</div>
					<div class="grid">
					<?php while ( $related->have_posts() ) : 
						$related->the_post();
						get_template_part('parts/griditem');
					endwhile;

					wp_reset_postdata(); 
			?>
					</div>
			<?php endif; ?>


		<?php endwhile; ?>
	</div>
<?php endif; ?>
<?php get_footer(); ?>
