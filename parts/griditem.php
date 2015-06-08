<div class="griditem">
	<div class="padding">
		<div class="ratio"></div>
		<div class="inner">
			<a class="thumbnaillink" href="<?php the_permalink() ?>">
				<div class="thumbnail">
					<div class="thumbratio"></div>
					<div class="thumbinner">
						<?php if ( has_post_thumbnail() ) spellerberg_the_thumbnail($post->ID,'thumb_phoneplus','(min-width:1024px) 390px, 1024p'); ?>
					</div>
					<div class="pattern"></div>
				</div>
				<h3><?php the_title_attribute(); ?></h3>
			</a>
		</div>
	</div>
</div>