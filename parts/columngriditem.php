<div class="griditem">
	<div class="padding">
		<div class="inner">
			<a class="thumbnaillink" href="<?php the_permalink() ?>">
				<div class="thumbnail">
					<div class="thumbratio"></div>
					<div class="thumbinner">
						<?php 
							$image = get_sub_field('image'); 
							if ($image ) spellerberg_the_image($image,'thumb_phoneplus','(min-width:1024px) 390px, 1024p'); 
						?>
					</div>
					<div class="pattern"></div>
				</div>

				<?php $heading = get_sub_field('heading'); ?>
				<?php if ($heading ) : ?>
					<h3><?php echo $heading; ?></h3>
				<?php endif; ?>

				<?php $excerpt = get_sub_field('excerpt'); ?>
				<?php if ($excerpt ) : ?>
					<?php echo $excerpt; ?>
				<?php endif; ?>

			</a>
		</div>
	</div>
</div>