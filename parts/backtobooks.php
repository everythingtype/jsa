<?php

if ( in_category('books') || in_category('essays') ) : 

	if ( in_category('books') ) :
		$theslug = 'books';
		$backlabel = 'Books';
	elseif ( in_category('essays') ):
		$theslug = 'essays';
		$backlabel = 'Essays';
	endif;

	$idObj = get_category_by_slug($theslug); 
    $backlink = get_category_link( $idObj->term_id );

	?>

	<div class="backto">
		<a class="button" href="<?php echo $backlink; ?>"><span>&larr;</span> Back to <?php echo $backlabel; ?></a>
	</div>

<?php endif; ?>

