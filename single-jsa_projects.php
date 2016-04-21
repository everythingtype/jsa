<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<div class="projectsingle">

	<h2 class="mobiletitle"><?php the_title(); ?></h2>

	<?php while (have_posts()) : the_post(); ?>
		<?php if( have_rows('slides') ): ?>
			<div class="slides">
			<?php 
				$i = 0; 
				$firstslide = true; 
				$sizeguidance = '(min-width: 1024px) 2048px, 1024px';

				while ( have_rows('slides') ) : the_row();
					if ( $firstslide == true ) :
						include(locate_template('parts/slidelayout.php'));
						$firstslide = false; 
					endif;
				endwhile; 
			?>
			</div>
		<?php endif; ?>

		<a id="slide-1" class="slideanchor"></a>
		<div class="projectdetails">

			<div class="projectdescription">
				<?php 
					the_content(); 

					$project_pdf = get_field('project_pdf'); 
					if ( $project_pdf ) : ?> 
						<p><a href="<?php echo $project_pdf; ?>">Download Project PDF</a></p>
				<?php endif; ?>

				<?php $project_details_format = get_field('project_details_format'); 
					if ( $project_details_format == 'predefined' ) : ?>

						<?php if( have_rows('project_info') ): ?>
							<table class="projectmeta">
							<?php while ( have_rows('project_info') ) : the_row(); 
								$label = get_sub_field('label');

								if ( $label == 'year' ) :
									 $displaylabel = 'Year';
								elseif ( $label == 'architect' ) :
									 $displaylabel = 'Architect';
								elseif ( $label == 'associate' ) :
									 $displaylabel = 'Associate Architect';
								elseif ( $label == 'with' ) :
									 $displaylabel = 'With';
								elseif ( $label == 'landscape' ) :
									$displaylabel = 'Landscape Architect';
								elseif ( $label == 'structural' ) :
									 $displaylabel = 'Structural Engineer';
								elseif ( $label == 'mep' ) :
									 $displaylabel = 'MEP Engineer';
								elseif ( $label == 'photos' ) :
									 $displaylabel = 'Photos';
								elseif ( $label == 'location' ) :
									$displaylabel = 'Location';
								elseif ( $label == 'size' ) :
									 $displaylabel = 'Size';
								elseif ( $label == 'scope' ) :
									 $displaylabel = 'Scope';
								endif;

								$value = get_sub_field('value'); ?>
								<tr>
									<th><?php echo $displaylabel; ?></th>
									<td><?php echo $value; ?></td>
								</tr>
							<?php endwhile; ?>
							</table>
						<?php endif; ?>

					<?php else : // Freeform ?>

						<?php if( have_rows('project_details_freeform') ): ?>
							<table class="projectmeta">
								<?php while ( have_rows('project_details_freeform') ) : the_row();
									$label = get_sub_field('label');
									$value = get_sub_field('value'); ?>
									<tr>
										<th><?php echo $label; ?></th>
										<td><?php echo $value; ?></td>
									</tr>
								<?php endwhile; ?>
							</table>
						<?php endif; ?>
					<?php endif; ?>
			</div>

			<?php $i++; ?>
			<?php $description_image = get_field('description_image'); ?>
			<?php if ( $description_image ) : ?>
			<div class="descriptionimage">
				<div class="imagebox">
					<div class="ratio"></div>
					<div class="inner">
						<a href="#slide-<?php echo $i; ?>" class="nextslide"><?php spellerberg_the_image($description_image,'phoneplus'); ?></a>
					</div>
				</div>
			</div>
			<?php endif; ?>

		</div>

		<?php if( have_rows('slides') ): ?>
			<div class="slides">
			<?php 
				$firstslide = true;
				$sizeguidance = '(min-width: 1024px) 2048px, 1024px';

				while ( have_rows('slides') ) : the_row(); 
					if ( $firstslide == true ) :
						// Skip, don't show
						$firstslide = false;
					else :
						include(locate_template('parts/slidelayout.php'));
					endif; 
				endwhile; 
			?>
			</div>
		<?php endif; ?>

		<?php 
			$related = p2p_type('jsa_projects_to_jsa_projects')->get_connected(); 
			if ( $related->have_posts() ) : ?>
			<div class="relatedprojects">
				<div class="edgemargin">
				<a id="slide-<?php echo $i; ?>" class="slideanchor"></a>
				<h2>Related Projects</h2>
				<?php get_template_part('parts/backtoprojects'); ?>
				</div>
				<div class="grid">
				<?php while ( $related->have_posts() ) : 
					$related->the_post();
					get_template_part('parts/griditem');
				endwhile;

				wp_reset_postdata(); 
		?>
				</div>
			</div>
		<?php endif; ?>

	<?php endwhile; ?>
	</div>
	<div class="projectcue"></div>
<?php endif; ?>

<?php get_footer(); ?>
