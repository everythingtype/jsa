<?php $slide_layout = get_sub_field('slide_layout'); ?>

<a id="slide-<?php echo $i; ?>" class="slideanchor"></a>

<div class="slide slide-<?php echo $slide_layout; ?>">

	<?php $i++; ?>

	<?php if ( $slide_layout == 'double' ) : ?>

		<?php $image = get_sub_field('image'); ?>
		<?php $second_image = get_sub_field('second_image'); ?>

		<?php if ( $image && $second_image) : ?>

				<a href="#slide-<?php echo $i; ?>" class="nextslide">
					<div class="doublemargin">
						<span class="half"><span class="ff"><?php spellerberg_the_image($image,'phoneplus'); ?></span></span>
						<span class="half secondhalf"><span class="ff"><?php spellerberg_the_image($second_image,'phoneplus'); ?></span></span>
					</div>
				</a>

		<?php endif; ?>

	<?php elseif ( $slide_layout == 'video' ) : ?>
		<?php $embed = get_sub_field('embed'); ?>
		<?php $image = get_sub_field('image'); ?>

		<?php if ( $image && $embed ) : ?>
			<div class="videocontainer">
				<div class="ratio"></div>
				<?php //echo do_shortcode('[fve]' . $embed . '[/fve]'); ?>
				<?php echo $embed; ?>
			</div>
			<div class="covercontainer">
			<?php 
				$sizeguidance = '(min-width: 1024px) 2048px, 1024px';
				spellerberg_the_image($image,'phoneplus',$sizeguidance); 
			?>
				<div class="playbutton"></div>
			</div>
		<?php endif; ?>

	<?php else : ?>

		<?php $image = get_sub_field('image'); ?>

		<?php if ( $image ) : ?>
				<a href="#slide-<?php echo $i; ?>" class="nextslide">
					<?php 
						$sizeguidance = '(min-width: 1024px) 2048px, 1024px';
						spellerberg_the_image($image,'phoneplus',$sizeguidance); 
					?>
				</a>
		<?php endif; ?>

	<?php endif; ?>

</div>
