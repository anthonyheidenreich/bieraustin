<?php
/**
 * Functions for dealing with theme settings on both the front end of the site and the admin.
 *
 * @package Alkane
 * @subpackage Functions
 */

/** Loads the Alkane theme setting. */
function alkane_get_settings() {
	global $alkane;

	/* If the settings array hasn't been set, call get_option() to get an array of theme settings. */
	if ( !isset( $alkane->settings ) ) {
		$alkane->settings = get_option( 'alkane_options' );
	}
	
	/** return settings. */
	return $alkane->settings;
}
?>