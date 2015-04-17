<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package JSA
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'jsa' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php edit_post_link( __( 'Edit', 'jsa' ), '<footer class="entry-meta entry-footer-meta"><span class="edit-meta meta-group">', '</span></span></span></footer>' ); ?>

</article><!-- #post-## -->
