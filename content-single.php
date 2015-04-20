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

	<footer class="entry-meta entry-footer-meta">
		<?php jsa_posted_on(); ?>
		<?php jsa_post_meta(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
