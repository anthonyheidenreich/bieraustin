<?php
/**
 * Functions for dealing with theme settings on both the front end of the site and the admin.
 *
 * @package Surface
 * @subpackage Functions
 */

/** Loads the Surface theme setting. */
function surface_get_settings() {
	global $surface;

	/* If the settings array hasn't been set, call get_option() to get an array of theme settings. */
	if ( !isset( $surface->settings ) ) {
		$surface->settings = get_option( 'surface_options' );
	}
	
	/** return settings. */
	return $surface->settings;
}
?>