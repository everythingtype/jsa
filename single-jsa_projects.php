<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<h2><?php the_title(); ?></h2>

		<?php if( have_rows('slides') ): ?>
			<?php while ( have_rows('slides') ) : the_row(); ?>
				<?php $slide_layout = get_sub_field('slide_layout'); ?>
				<div class="slide slide-<?php echo $slide_layout; ?>">
					<?php $image = get_sub_field('image'); ?>
					<?php if ( $image ) : ?>
						<div class="slideimage">
							<?php spellerberg_the_image($image['id'],'phoneplus'); ?>
							Size: <?php echo tevkori_get_sizes( $image['id']) ?>
						</div>
					<?php endif; ?>

					<?php if ( $slide_layout == 'double' ) : ?>
						<?php $second_image = get_sub_field('second_image'); ?>
						<?php if ( $second_image ) : ?>
							<div class="secondslideimage">
								<?php spellerberg_the_image($second_image['id'],'phoneplus'); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>

		<?php the_content(); ?>

		<?php if( have_rows('project_details') ): 
			while ( have_rows('project_details') ) : the_row(); 
				$label = get_sub_field('label');
				$value = get_sub_field('value'); ?>
				<p>
					<?php echo $label; ?><br />
					<?php echo $value; ?>
				</p>
			<?php endwhile;
		endif; ?>

		<?php jsa_p2p_the_related(); ?>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
