<div class="griditem">
	<div class="padding">
		<div class="ratio"></div>
		<div class="inner">
			<a class="thumbnaillink" href="<?php echo $link; ?>" <?php if ( $item_link_type == 'external' ) echo 'target="_blank"'; ?>>
				<div class="thumbnail">
					<div class="thumbratio"></div>
					<div class="thumbinner">
						<?php spellerberg_the_image($featured_thumbnail,'thumb_phoneplus','(min-width:1024px) 390px, 1024p'); ?>
					</div>
					<div class="pattern"></div>
				</div>
				<h3><?php 

				if ( $item_title ) echo $item_title;

				if ( $item_title && $item_subtitle) echo '<br /><span>';

				if ( $item_subtitle ) echo $item_subtitle;

				if ( $item_title && $item_subtitle) echo '</span>';
				
				?></h3>
			</a>
		</div>
	</div>
</div>