<?php 

/* Template Name: Home */ 

get_header(); ?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

<div class="homepage">

	<?php 
		if( have_rows('carousel') ):  
			$choice = mt_rand(0, 1);
		?>
		<div class="carousel">
		<?php while ( have_rows('carousel') ) : the_row(); ?>

		<?php 
			if ( $choice == 0 ) :
				$image = get_sub_field('image'); 
			else :
				$image = get_sub_field('image_alternate'); 
			endif;

			if ( $image ) : ?>
				<div class="carousel-cell">
					<?php $heading = get_sub_field('heading'); ?>

					<?php if ( $heading == 'institutional' ) : ?>
						<a href="<?php echo get_site_url(); ?>/projects/institutional/">
							<?php spellerberg_the_image($image,'carousel_phoneplus'); ?>
							<div class="carousellabel"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/label-institutional.svg" alt="Institutional" /></div>
						</a>
					<?php elseif ( $heading == 'residential' ) : ?>
						<a href="<?php echo get_site_url(); ?>/projects/residential/">
							<?php spellerberg_the_image($image,'carousel_phoneplus'); ?>
							<div class="carousellabel"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/label-residential.svg" alt="Residential" /></div>
						</a>
					<?php elseif ( $heading == 'public' ) : ?>
						<a href="<?php echo get_site_url(); ?>/projects/public-space/">
							<?php spellerberg_the_image($image,'carousel_phoneplus'); ?>
							<div class="carousellabel"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/label-publicspace.svg" alt="Public Space" /></div>
						</a>
					<?php else : // living ?>
						<a href="<?php echo get_site_url(); ?>/research/living-working/">
							<?php spellerberg_the_image($image,'carousel_phoneplus'); ?>
							<div class="carousellabel"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/label-living.svg" alt="Living and Working" /></div>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
		</div>
	<?php endif; ?>

	<div class="edgemargin">
		<div class="homemission">
			<?php the_content(); ?>
		</div>
	</div>

	<h2>Featured Projects</h2>

	<div class="grid">
	<?php

		$projects = get_field( 'featured_projects' );
		$ids = array();

		foreach ( $projects as $project => $value ) :
			foreach ( $value as $id ) :
				$ids[] = $id;
			endforeach;
		endforeach;

		$args = array(
			'post_type' => 'jsa_projects',
			'posts_per_page' => -1,
			'post__in' => $ids,
			'orderby' => 'post__in'
		);

		$loop = new WP_Query( $args );
		$count = 0;

		if ( $loop->have_posts() ) :
			while ( $loop->have_posts() ) : 
				$loop->the_post();
				get_template_part('parts/griditem');
			endwhile;
			wp_reset_postdata();
		endif; ?>

		</div>

		<div class="edgemargin">
			<a class="button" href="<?php echo site_url( 'projects' ); ?>">View More Projects</a>
		</div>

	<h2>Recent News</h2>

	<div class="grid">

	<?php

		$args = array(
			'post_type' => 'post',
			'category_name' => 'news',
			'posts_per_page' => 3
		);
		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) :
			while ( $loop->have_posts() ) : 
				$loop->the_post();
				get_template_part('parts/griditem');
			endwhile;
			wp_reset_postdata();
		endif;
	?>

	</div>

	<div class="edgemargin">
		<a class="button" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Read More News</a>
	</div>

</div>

<?php if ( is_home() || is_front_page() ) : ?>
<div class="splash">
	<div class="tagline">
		<span class="line">Architecture for</span>
		<span class="line">Institutions, Residences</span>
		<span class="line">and Public Space</span>
	</div>
</div>
<?php endif; ?>

	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
