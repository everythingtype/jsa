<?php
/**
 * Template Name: Home
 *
 * @package JSA
 */

get_header(); ?>

	<div class="main-gallery js-flickity" data-flickity-options='{ "imagesLoaded": true, "percentPosition": false, "pageDots": false, "wrapAround": true }'>
		<?php while ( have_rows('carousel') ) : the_row(); ?>
		<div class="gallery-cell">
			<div class="project">
				<?php echo wp_get_attachment_image( get_sub_field( 'image' ), 'jsa-large-crop' ); ?>
				<h3><span><?php echo get_sub_field( 'heading' ); ?></span></h3>
			</div>
		</div>
		<?php endwhile; ?>
	</div>

	<div class="col-width">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<div class="statement">
					<p>Our comprehensive design approach merges three disciplines—architecture, interiors and landscape—with the goal of creating innovative buildings and environments that respond to today’s rapidly changing culture. We specialize in residential and institutional commissions, as well as ecological projects that integrate people, buildings and landscapes.</p>
				</div>

				<div class="featured-projects">
					<h2>Featured Projects</h2>
					<div class="grid clearfix">
					<?php
						$projects = get_field( 'featured_projects' );
						$ids = array();
						foreach ( $projects as $project => $value ) :
							foreach ( $value as $id ) :
								$ids[] = $id;
							endforeach;
						endforeach;
						$args = array(
							'post_type' => 'jsa_projects',
							'posts_per_page' => 6,
							'post__in' => $ids,
							'orderby' => 'post__in'
						);
						$loop = new WP_Query( $args );
						$count = 0;
						if ( $loop->have_posts() ) :
							while ( $loop->have_posts() ) : $loop->the_post();
								$count++;
								if ( has_post_thumbnail() ) {
									$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'jsa-grid', true );
									$image = $image[0];
									$class = 'grid-item item-' . $count;
								} else {
									$image = get_template_directory_uri() . '/images/post.svg';
									$class = 'fallback-image grid-item item-' . $count;
								}
								?>
								<div <?php post_class( $class ); ?>>
									<a href="<?php the_permalink(); ?>">
										<figure class="entry-image">
											<img src="<?php echo esc_url( $image ); ?>" width="600" height="400" >
										</figure>
									</a>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								</div>
							<?php
							endwhile;
							wp_reset_postdata();
						endif;
					?>
					</div>
					<a class="button" href="<?php echo site_url( 'projects' ); ?>">View More Projects</a>
				</div>

				<div class="recent-news">
					<h2>Recent News</h2>
					<div class="grid clearfix">
					<?php
						$args = array(
							'post_type' => 'post',
							'posts_per_page' => 6
						);
						$loop = new WP_Query( $args );
						$count = 0;
						if ( $loop->have_posts() ) :
							while ( $loop->have_posts() ) : $loop->the_post();
								$count++;
								if ( has_post_thumbnail() ) {
									$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'jsa-grid', true );
									$image = $image[0];
									$class = 'grid-item item-' . $count;
								} else {
									$image = get_template_directory_uri() . '/images/post.svg';
									$class = 'fallback-image grid-item item-' . $count;
								}
								?>
								<div <?php post_class( $class ); ?>>
									<a href="<?php the_permalink(); ?>">
										<figure class="entry-image">
											<img src="<?php echo esc_url( $image ); ?>" width="600" height="400" >
										</figure>
									</a>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								</div>
							<?php
							endwhile;
							wp_reset_postdata();
						endif;
					?>
					</div>
					<a class="button" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Read More News</a>
				</div>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .col-width -->

<?php get_footer(); ?>
