<?php
/**
 * The core functions file for the Surface framework. Functions defined here are generally
 * used across the entire framework to make various tasks faster. This file should be loaded
 * prior to any other files because its functions are needed to run the framework.
 *
 * @package Surface
 * @subpackage Functions
 */

/** Function for setting the content width of a theme. */
function surface_set_content_width( $width = '' ) {
	global $content_width;
	$content_width = absint( $width );
}

/** Function for getting the theme's content width. */
function surface_get_content_width() {
	global $content_width;
	return $content_width;
}

/** Gets theme data */
function surface_theme_data( $path = 'template' ) {
	global $surface;
	
	/* If 'template' is requested, get the parent theme data. */
	if ( 'template' == $path ) {

		/* If the parent theme data isn't set, grab it with the wp_get_theme() function. */
		if ( empty( $surface->theme_data ) ) {
			$surface->theme_data = wp_get_theme();
		}

		/* Return the parent theme data. */
		return $surface->theme_data;
	}	

	/* Return false for everything else. */
	return false;
}
?>