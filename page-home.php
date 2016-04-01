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

			$image_src = wp_get_attachment_image_src($image,'carousel_phoneplus');
			
			if ( $image ) : 

					$heading = get_sub_field('heading'); 

					if ( $heading == 'institutional' ) :
						$href = '/projects/institutional/';
						$label = 'Institutional';
					elseif ( $heading == 'residential' ) : 
						$href = '/projects/residential/';
						$label = 'Residential';
					elseif ( $heading == 'public' ) :
						$href = '/projects/public-space/';
						$label = 'Public Space';
					else : // living
						$href = '/projects/living-working/';
						$label = 'Living and Working';
					endif;

				?>
				<div class="carousel-cell">
					<a href="<?php echo get_site_url() . $href; ?>" style="background-image: url('<?php echo $image_src[0]; ?>');"></a>
					<div class="carousellabel"><?php echo $label; ?></div>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>

		<div class="downlink"><a href="#mission">&darr;</a></div>

		</div>
	<?php endif; ?>

	<a id="mission"></a>
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
		<a class="button" href="/category/news/">Read More News</a>
	</div>

</div>

	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
