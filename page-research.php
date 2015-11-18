<?php 

/* Template Name: Research */ 

get_header(); ?>
<div class="researchpage">
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<?php if( have_rows('columns') ): ?> 
			<div class="grid columngrid">
			<?php while ( have_rows('columns') ) : the_row(); ?>

				<div class="griditem">
					<div class="padding">
						<div class="inner">

							<?php $link = get_sub_field('link'); ?>
							<?php if ( $link ) : ?>
								<a class="thumbnaillink" href="<?php echo $link; ?>">
							<?php endif; ?>

								<div class="thumbnail">
									<div class="thumbratio"></div>
									<div class="thumbinner">
										<?php 
											$image = get_sub_field('image'); 
											if ($image ) spellerberg_the_image($image,'thumb_phoneplus'); 
										?>

									</div>
									<div class="pattern"></div>
								</div>

								<?php $heading = get_sub_field('heading'); ?>
								<?php if ($heading ) : ?>
									<h3><?php echo $heading; ?></h3>
								<?php endif; ?>

								<?php $excerpt = get_sub_field('excerpt'); ?>
								<?php if ($excerpt ) echo $excerpt; ?>

							<?php if ($link ) : ?>
								</a>
							<?php endif; ?>

						</div>
					</div>
				</div>

			<?php endwhile; ?>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>
</div>
<?php get_footer(); ?>
