<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<div class="projectsingle">

	<?php while (have_posts()) : the_post(); ?>
		<?php if( have_rows('slides') ): ?>
			<div class="slides">
			<?php $i = 0; ?>
			<?php while ( have_rows('slides') ) : the_row(); ?>

				<?php $slide_layout = get_sub_field('slide_layout'); ?>
<a id="slide<?php echo $i; ?>" class="slideanchor"></a>
				<div class="slide slide-<?php echo $slide_layout; ?>">

					<?php if ( $slide_layout != 'double' ) : ?>

						<?php $image = get_sub_field('image'); ?>
						<?php if ( $image ) : ?>
								<?php $i++; ?>
								<a href="#slide<?php echo $i; ?>" class="nextslide">
									<?php spellerberg_the_image($image,'phoneplus'); ?>
								</a>
						<?php endif; ?>

					<?php else : ?>

						<?php $image = get_sub_field('image'); ?>
						<?php $second_image = get_sub_field('second_image'); ?>

						<?php if ( $image && $second_image) : ?>

								<?php $i++; ?>

								<a href="#slide<?php echo $i; ?>" class="nextslide">
									<span class="half"><?php spellerberg_the_image($image,'phoneplus'); ?></span>
									<span class="half secondhalf"><?php spellerberg_the_image($second_image,'phoneplus'); ?></span>
								</a>

						<?php endif; ?>

					<?php endif; ?>

				</div>
			<?php endwhile; ?>
			</div>
		<?php endif; ?>

		<div id="slide<?php echo $i; ?>" class="projectdetails"><a id="info"></a>

			<div class="projectdescription">
				<?php 
					the_content(); 

					$project_pdf = get_field('project_pdf'); 
					if ( $project_pdf ) : ?> 
						<p><a href="<?php echo $project_pdf; ?>">Download Project PDF</a></p>
				<?php endif; ?>
			</div>

		<?php if( have_rows('project_info') ): ?>
			<div class="projectmeta">
			<?php while ( have_rows('project_info') ) : the_row(); 
				$label = get_sub_field('label');

				if ( $label == 'year' ) :
					 $displaylabel = 'Year';
				elseif ( $label == 'architect' ) :
					 $displaylabel = 'Architect';
				elseif ( $label == 'landscape' ) :
					$displaylabel = 'Landscape Architect';
				elseif ( $label == 'location' ) :
					$displaylabel = 'Location';
				elseif ( $label == 'size' ) :
					 $displaylabel = 'Size';
				elseif ( $label == 'scope' ) :
					 $displaylabel = 'Scope';
				endif;

				$value = get_sub_field('value'); ?>
				<h3><?php echo $displaylabel; ?></h3>
				<ul>
					<li><?php echo $value; ?></li>
				</ul>
			<?php endwhile; ?>
			</div>
		<?php endif; ?>

		</div>

		<?php 
			$related = p2p_type('jsa_projects_to_jsa_projects')->get_connected(); 

			if ( $related->have_posts() ) : ?>
				<h2>Related Projects</h2>
				<div class="grid">
				<?php while ( $related->have_posts() ) : 
					$related->the_post();
					get_template_part('parts/griditem');
				endwhile;

				wp_reset_postdata(); 
		?>
				</div>
		<?php endif; ?>

		<?php get_template_part('parts/backtoprojects'); ?>

	<?php endwhile; ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
