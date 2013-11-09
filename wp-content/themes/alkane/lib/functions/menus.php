<?php
/**
 * The menus functions deal with registering nav menus within WordPress for the core framework.
 *
 * @package Alkane
 * @subpackage Functions
 */

/** Register nav menus. */
add_action( 'init', 'alkane_register_menus' );

/** Registers the the core menus */
function alkane_register_menus() {

	/* Register the 'primary' menu. */
	register_nav_menu( 'alkane-primary-menu', __( 'Alkane Primary Menu', 'alkane' ) );
	
}
?>