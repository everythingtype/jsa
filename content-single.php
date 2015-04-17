<?php
/**
 * @package JSA
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="entry-image">
		<?php the_post_thumbnail(); ?>
	</figure>
	<?php } ?>

	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'jsa' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_the_author_meta( 'description' ) ) :
	// If a user has filled out their description, show a bio on their entries ?>
	<div class="author-meta">
		<div class="author-box clearfix">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'jsa_author_bio_avatar_size', 60 ) ); ?>
			</div><!-- #author-avatar -->
			<div class="author-description">
				<h3><?php printf( esc_attr__( 'About %s', 'jsa' ), get_the_author() ); ?></h3>
				<?php the_author_meta( 'description' ); ?>
			</div><!-- #author-description -->
		</div>
	</div><!-- #author-meta-->
	<?php endif; ?>

	<footer class="entry-meta entry-footer-meta">
		<?php jsa_posted_on(); ?>
		<?php jsa_post_meta(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
