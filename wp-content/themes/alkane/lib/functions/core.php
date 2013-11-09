<?php
/**
 * The core functions file for the Alkane framework. Functions defined here are generally
 * used across the entire framework to make various tasks faster. This file should be loaded
 * prior to any other files because its functions are needed to run the framework.
 *
 * @package Alkane
 * @subpackage Functions
 */

/** Function for setting the content width of a theme. */
function alkane_set_content_width( $width = '' ) {
	global $content_width;
	$content_width = absint( $width );
}

/** Function for getting the theme's content width. */
function alkane_get_content_width() {
	global $content_width;
	return $content_width;
}

/** Function for getting the theme's data */
function alkane_theme_data( $path = 'template' ) {
	global $alkane;
	
	/** If 'template' is requested, get the parent theme data. */
	if ( 'template' == $path ) {

		/** If the parent theme data isn't set, let grab it. */
		if ( empty( $alkane->theme_data ) ) {
			
			$alkane_theme_data = array();
			$theme_data = wp_get_theme();
			$alkane_theme_data['Name'] = $theme_data->get( 'Name' );
			$alkane_theme_data['ThemeURI'] = $theme_data->get( 'ThemeURI' );
			$alkane_theme_data['AuthorURI'] = $theme_data->get( 'AuthorURI' );
			$alkane_theme_data['Description'] = $theme_data->get( 'Description' );
			
			$alkane->theme_data = $alkane_theme_data;
		
		}

		/** Return the parent theme data. */
		return $alkane->theme_data;
	}	

	/* Return false for everything else. */
	return false;
}
?>