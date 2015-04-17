<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package JSA
 */

get_header(); ?>

<div class="col-width">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<?php while ( have_posts() ) : the_post(); ?>

				<?php if ( have_rows('slides') ): ?>
					<div class="main-gallery js-flickity" data-flickity-options='{ "imagesLoaded": true, "percentPosition": false, "pageDots": false, "wrapAround": true }'>
						<?php while ( have_rows('slides') ) : the_row(); ?>
							<div class="gallery-cell">
								<?php $image = get_sub_field( 'image' ); ?>
								<?php echo wp_get_attachment_image( $image, 'jsa-large-crop' ); ?>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content clearfix">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->

				<?php if ( have_rows('project_details') ):
					while ( have_rows('project_details') ) : the_row();
					$label = get_sub_field('label');
					$value = get_sub_field('value'); ?>
					<p>
						<?php echo $label; ?><br />
						<?php echo $value; ?>
					</p>
					<?php endwhile;
				endif; ?>

			<?php jsa_p2p_the_related(); ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
