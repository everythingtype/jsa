<?php 

$output = '';

while ( have_rows('list_items') ) : the_row(); 

	$item_title = get_sub_field('item_title');
	$item_subtitle = get_sub_field('item_subtitle');

	if ( $item_title || $item_subtitle ) :

		$item_link_type = get_sub_field('item_link_type');

		if ( $item_link_type == 'internal' ) :
			$item_internal_link = get_sub_field('item_internal_link');
			if ( $item_internal_link ) :
				$link = $item_internal_link;
			else :
				$link = false;
			endif;
		elseif ( $item_link_type == 'external' ) :
			$item_external_link = get_sub_field('item_external_link');
			if ( $item_external_link ) :
				$link = $item_external_link;
			else :
				$link = false;
			endif;
		else:
			$link = false;
		endif;

		if ( $link ) :
			$featured = get_sub_field('featured');
			if ( $featured ) :
				$featured_thumbnail = get_sub_field('featured_thumbnail');
				if ( $featured_thumbnail ) :
					$templatepart = locate_template('parts/listgriditem.php');
					if ( $templatepart != '' ) :
						ob_start();
						include($templatepart);
						$output .= ob_get_contents();
						ob_end_clean();
					endif;
				endif;
			endif;
		endif;

	endif;

endwhile; 

if ( $output != '') : ?>

	<div class="edgemargin">
		<h2>Featured <?php the_title(); ?></h2>
	</div>

    <div class="grid">
		<?php echo $output; ?>
    </div>

<?php endif; ?>