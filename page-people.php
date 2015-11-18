<?php 

/* Template Name: People */ 

get_header(); ?>
<div class="peoplepage">
<?php if (have_posts()) : ?>
	<div class="edgemargin">
	<?php while (have_posts()) : the_post(); ?>
		<?php if( have_rows('person') ): ?> 
			<?php while ( have_rows('person') ) : the_row(); ?>
				<div class="person">

				<div class="bioimage">
					<div class="padding">
						<div class="ratio"></div>
						<div class="inner">
							<?php 
								$image = get_sub_field('image'); 
								if ($image ) spellerberg_the_image($image,'phoneplus'); 
							?>
						</div>
					</div>
				</div>

				<div class="bio">

					<?php $name = get_sub_field('name'); ?>
					<?php if ($name) : ?>
						<h2><?php echo $name; ?></h2>
					<?php endif; ?>

					<?php $title = get_sub_field('title'); ?>
					<?php if ( $title ) : ?>
						<div class="title"><?php echo $title; ?></div>
					<?php endif; ?>

					<?php $excerpt = get_sub_field('excerpt'); ?>
					<?php if ( $excerpt ) echo $excerpt; ?>

				</div>

			</div>
			<?php endwhile; ?>
		<?php endif; ?>

	<?php endwhile; ?>
	</div>
<?php endif; ?>
</div>
<?php get_footer(); ?>
