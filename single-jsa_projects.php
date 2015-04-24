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

<?php while ( have_posts() ) : the_post(); ?>

<?php if ( have_rows('slides') ): ?>
	<div class="project-gallery js-flickity" data-flickity-options='{ "imagesLoaded": true, "percentPosition": false, "pageDots": false, "wrapAround": true }'>
		<?php while ( have_rows('slides') ) : the_row(); ?>
			<div class="gallery-cell">
				<?php $image = get_sub_field( 'image' ); ?>
				<?php echo wp_get_attachment_image( $image, 'jsa-large-crop' ); ?>
			</div>
		<?php endwhile; ?>
	</div>
<?php endif; ?>

<div class="col-width">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="project-information clearfix">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content clearfix">
						<?php the_content(); ?>

						<?php if ( get_field( 'project_pdf' ) ): ?>
						<div class="project-pdf">
							<a clas="button" href="<?php the_field( 'project_pdf' ); ?>">Download PDF</a>
						</div>
						<?php endif; ?>

					</div><!-- .entry-content -->
				</article><!-- #post-## -->

				<aside class="project-details">
					<?php if ( get_field( 'year' ) ): ?>
					<div class="year">
						<h4>Year</h4>
						<?php the_field( 'year' ); ?>
					</div>
					<?php endif; ?>
					<?php if ( get_field( 'architect' ) ): ?>
					<div class="architect">
						<h4>Architect</h4>
						<?php the_field( 'architect' ); ?>
					</div>
					<?php endif; ?>
					<?php if ( get_field( 'landscape_architect' ) ): ?>
					<div class="architect">
						<h4>Landscape Architect</h4>
						<?php the_field( 'landscape_architect' ); ?>
					</div>
					<?php endif; ?>
				</aside>
			</div>

			<?php jsa_p2p_the_related(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
