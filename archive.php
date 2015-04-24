<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package JSA
 */

get_header(); ?>

<div class="col-width">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( is_category() || is_tag() || is_author() || is_day() || is_year() ) : ?>
			<header class="page-header">
				<h1 class="page-title">
				<?php
				if ( is_category() ) :
					single_cat_title();

				elseif ( is_tag() ) :
					single_tag_title();

				elseif ( is_author() ) :
					printf( __( 'Author: %s', 'jsa' ), '<span class="vcard">' . get_the_author() . '</span>' );

				elseif ( is_day() ) :
					printf( __( 'Day: %s', 'jsa' ), '<span>' . get_the_date() . '</span>' );

				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'jsa' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'jsa' ) ) . '</span>' );

				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'jsa' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'jsa' ) ) . '</span>' );

				else :
					_e( 'Archives', 'jsa' );

				endif;
				?>
				</h1>
			</header><!-- .page-header -->
			<?php endif; ?>

			<?php if ( have_posts() ) : ?>

				<div id="posts-wrap">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content' ); ?>

				<?php endwhile; ?>
				</div>

				<?php jsa_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php get_footer(); ?>
