<?php

// Image linking in content is lame
update_option('image_default_link_type','none');

// Featured Images

add_theme_support( 'post-thumbnails' );

// Sets of sizes appropriate for srcset

add_image_size( 'padmini', 1024 );
add_image_size( 'phone', 1136 );
add_image_size( 'phoneplus', 1334 );
add_image_size( 'padretina', 2048 );

add_image_size( 'thumb', 285, 180, true );
add_image_size( 'thumb_jsa_1x', 390, 245, true );
add_image_size( 'thumb_jsa_2x', 780, 490, true );
add_image_size( 'thumb_padmini', 1024, 646, true  );
add_image_size( 'thumb_phone', 1136, 717, true  );

add_image_size( 'carousel', 285, 121, true );
add_image_size( 'carousel_padmini', 1024, 435, true  );
add_image_size( 'carousel_phone', 1136, 483, true  );
add_image_size( 'carousel_phoneplus', 1334, 567, true  );
add_image_size( 'carousel_padretina', 2048, 870, true  );


function spellerberg_this_sites_sizesets() {

	$sets = Array();

	// WordPress Default Sizes
	$sets[] = Array('thumbnail','medium','large','full');

	// Custom sizes as defined via add_image_size, 
	// grouped into sets appropriate for srcset,
	// ordered from smallest to largest.
	$sets[] = Array('thumb','thumb_jsa_1x','thumb_jsa_2x','thumb_padmini','thumb_phone');
	$sets[] = Array('carousel','carousel_padmini','carousel_phone','carousel_phoneplus','carousel_padretina');	
	$sets[] = Array('padmini','phone','phoneplus','padretina');	

	return $sets;
}

function spellerberg_featuredimage_caption($post_id) {

	$thumbnail_id = get_post_thumbnail_id($post_id);
	$images = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

	if ( count($images) > 0 ) :
		foreach ($images as $attachment_id => $image) :

			$img_caption = $image->post_excerpt; // caption.
	//		$img_description = $image->post_content; // description, unused

			if ($img_caption) : 
				$output .= '<div class="featuredimagecaption wp-caption">' . wpautop($img_caption) . '</div>';
			endif; 

		endforeach;
	endif;

	return $output;

}

// http://speakinginbytes.com/2012/11/responsive-images-in-wordpress/
// https://gist.github.com/stuntbox/4557917
function remove_thumbnail_dimensions( $html ) {

	if (preg_match_all('/<img[^>]+>/ims', $html, $matches)) {
		foreach ($matches as $match) {
			$clean = preg_replace('/(width|height)=["\'\d%\s]+/ims', "", $match); // Replace all occurences of width/height
			$html = str_replace($match, $clean, $html); // Replace with result within html
		}
	}

    return $html;
}

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
add_filter( 'category_description', 'remove_thumbnail_dimensions', 10 );


// http://alxmedia.se/code/2013/10/thumbnail-upscale-correct-crop-in-wordpress/
function alx_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
    if ( !$crop ) return null; // let the wordpress default function handle this
 
    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
 
    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);
 
    $s_x = floor( ($orig_w - $crop_w) / 2 );
    $s_y = floor( ($orig_h - $crop_h) / 2 );
 
    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter( 'image_resize_dimensions', 'alx_thumbnail_upscale', 10, 6 );

?>
