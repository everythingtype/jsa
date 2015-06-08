<?php get_header(); ?>
<?php if (have_posts()) : ?>
	<div class="pagetemplate">
		<div class="edgemargin">
		<?php while (have_posts()) : the_post(); ?>
			<div class="pagecontent">

				<h2><?php the_title(); ?></h2>

				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>
<?php get_footer(); ?>
