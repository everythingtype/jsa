<?php
/**
 * Search form template
 *
 * @package JSA
 */
?>

<form role="search" method="get" class="search-form clearfix" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php _e( 'Search for:', 'jsa' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php _e( 'Search...', 'jsa' ); ?>" value="" name="s" title="<?php _e( 'Search for:', 'jsa' ); ?>" />
	</label>
	<button type="submit" class="search-submit">
		<div class="jsa-icon-search"></div>
		<span class="screen-reader-text"><?php _e( 'Search...', 'jsa' ); ?></span>
	</button>
</form>
