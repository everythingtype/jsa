<div class="item">
	<div class="padding">
		<div class="ratio"></div>
		<div class="inner">
		<a href="<?php the_permalink() ?>">
			<div class="thumbnail">
				<?php if ( has_post_thumbnail() ) the_post_thumbnail('thumb-2x'); ?>
				<div class="pattern"></div>
			</div>
			<h2><?php the_title_attribute(); ?></h2>
		</a>
		</div>
	</div>
</div>