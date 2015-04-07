<?php

// Version: 2015.04.03

// The why: http://ericportis.com/posts/2014/srcset-sizes/
// The how: https://mattwilcox.net/web-development/keeping-srcset-and-sizes-under-control

function spellerberg_get_image($imageid,$fallbacksize = 'full',$sizeguidance = '') {

	$sizeset = spellerberg_size_set($fallbacksize);
	
	$fallback = wp_get_attachment_image_src( $imageid, $fallbacksize);
	
	$alt_text = get_post_meta($imageid, '_wp_attachment_image_alt', true);
	
	if ( !$alt_text || $alt_text == "" ) :
		$attachment = get_post($imageid);
		$alt_text = $attachment->post_title;
	endif;

	if ( $sizeguidance != '' ) :
	 	$sizesattr = 'sizes="' . $sizeguidance . '" ';
	else :
		$sizesattr = spellerberg_sizesattr($imageid,$fallbacksize);
	endif;

	$output = '<img ';	
	$output .= $sizesattr;
	$output .= spellerberg_srcsetattr( $imageid,$fallbacksize);
	$output .= 'src="' . $fallback[0] . '" ';
	$output .= 'alt="' . $alt_text . '">';
	
	return $output;

}


function spellerberg_the_image($imageid,$fallbacksize = 'full',$sizeguidance = '') {
	echo spellerberg_get_image($imageid,$fallbacksize,$sizeguidance);
}

function spellerberg_get_thumbnail($post_id, $fallbacksize = 'full',$sizeguidance = '') {
	$imageid = get_post_thumbnail_id( $post_id );
	if ( $imageid ) :
		return spellerberg_get_image($imageid,$fallbacksize,$sizeguidance);
	endif;
}

function spellerberg_the_thumbnail($post_id, $fallbacksize = 'full',$sizeguidance = '') {
	echo spellerberg_get_thumbnail($post_id, $fallbacksize,$sizeguidance);
}


function spellerberg_sizesattr($imageid,$fallbacksize) {

	/* 
		Using the RICG approach, which is:
		The sizes attribute will be declared as 100% of the viewport 
		width when the viewport width is smaller than the width of the image, 
		or to the width of the image itself when the viewport is larger than the image.
	*/

	$sizes = spellerberg_size_set($fallbacksize);
//	$availablesizes = array_reverse($availablesizes);

	$largestinset = end($sizes);

	$attributes = wp_get_attachment_image_src($imageid, $largestinset);
	$thiswidth = $attributes[1];

	if ( $attributes ) :
		return 'sizes="(max-width: ' . $thiswidth . 'px) 100vw, ' . $thiswidth . 'px" ';
	endif;

}


function spellerberg_srcsetattr( $imageid, $fallbacksize) {

	$output == '';

	$sizes = spellerberg_size_set($fallbacksize);

	foreach ( $sizes as $size ) :

		$attachment = wp_get_attachment_image_src( $imageid,$size);
		$output .= $attachment[0] . ' ' . $attachment[1] . 'w, ';

	endforeach;

	if ( $output != '' ) return 'srcset="' . $output . '" ';

}

function spellerberg_size_set($keyword) {

	$sets = spellerberg_this_sites_sizesets();

	foreach ( $sets as $set ) :
		if ( in_array( $keyword, $set ) ) :
		    return $set;
		endif;
	endforeach;

}

?>
