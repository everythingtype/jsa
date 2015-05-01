<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package JSA
 */
?>

	</div><!-- #content -->
</div><!-- #page -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="col-width">

		<div class="company-info clearfix">
			<address>
				106 East 19th Street, 2nd Floor<br>
				New York, NY 10003
			</address>
			<div class="contact">
				<?php $email = 'info@joelsandersarchitect.com'; ?>
				<a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo antispambot( $email ); ?></a><br>
				<span class="tel">212.431.8751</span>
			</div>
		</div><!-- .site-info -->

	</div><!-- .col-width -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
