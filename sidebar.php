<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package JSA
 */
?>

<?php if ( !in_array( get_theme_mod( 'theme_layout' ), array( 'single-column', 'single-column-narrow' ) ) ) : ?>

	<div id="secondary" class="secondary" role="complementary">
		<?php if ( ! dynamic_sidebar( 'primary' ) ) : ?>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->

<?php endif; ?>
