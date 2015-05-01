<?php
/**
 * @package JSA
 */


if ( has_post_thumbnail() ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'jsa-grid', true );
	$image = $image[0];
	$class = 'grid-item';
} else {
	$image = get_template_directory_uri() . '/images/post.svg';
	$class = 'fallback-image grid-item item';
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