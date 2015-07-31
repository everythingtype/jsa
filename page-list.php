<?php 

/* Template Name: List */ 

get_header(); ?>
<div class="listpage">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php if( have_rows('list_items') ): ?> 

				<?php get_template_part('parts/listfeatures'); ?>

				<div class="edgemargin">

					<?php $list_title = get_field('list_title'); ?>
					<?php if ( $list_title ) : ?>
						<h2><?php echo $list_title; ?></h2>
					<?php endif; ?>

					<div class="listitems">

					<?php 

					$currentitemdate = null;

					while ( have_rows('list_items') ) : the_row();

						$item_title = get_sub_field('item_title');
						$item_subtitle = get_sub_field('item_subtitle'); 

						if ( $item_title || $item_subtitle ) :

							$item_date = get_sub_field('item_date');

							if ( $item_date ) :

								if ( $item_date == $currentitemdate ) :
									// Do nothing
								else :
									echo '<h3>' . $item_date . '</h3>'; 
								endif; 

								$currentitemdate = $item_date;

							else : 
								$currentitemdate = null;
							endif;

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

							echo '<p>';

								if ( $link ) :
									echo '<a href="'. $link .'" ';
									if ( $item_link_type == 'external' ) echo 'target="_blank"';
									echo '>';
								endif;

								if ( $item_title ) echo '<span>' . $item_title . '</span>';

								if ( $item_title && $item_subtitle) echo '<br />';

								if ( $item_subtitle ) echo $item_subtitle;

								if ( $link ) echo '</a>';

							echo '</p>';

						endif;
					endwhile; ?>

				</div>

			<?php endif; ?>

		<?php endwhile; ?>
	<?php endif; ?>
</div></div>
<?php get_footer(); ?>
