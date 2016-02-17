<div class="griditem">
	<div class="padding">
		<div class="ratio"></div>
		<div class="inner">
			<a class="thumbnaillink" href="<?php the_permalink() ?>">
				<div class="thumbnail <?php if ( !has_post_thumbnail() ) echo 'noimage'; ?>">
					<div class="thumbratio"></div>
					<div class="thumbinner">
						<?php if ( has_post_thumbnail() ) :
							$sizeguidance = '(min-width: 1024px) 390px, (min-width:768px) 390px, (min-width: 480px) 390px, (min-width: 320px) 390px, 390px';
							spellerberg_the_thumbnail($post->ID,'thumb_jsa_2x',$sizeguidance); 
						endif; ?>
					</div>
					<div class="pattern"></div>
				</div>
				<h3><?php the_title_attribute(); ?></h3>
			</a>
		</div>
	</div>
</div>