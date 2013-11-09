<?php
/**
 * The menus functions deal with registering nav menus within WordPress for the core framework.
 *
 * @package Surface
 * @subpackage Functions
 */

/** Register nav menus. */
add_action( 'init', 'surface_register_menus' );

/** Registers the the core menus */
function surface_register_menus() {

	/** Get theme-supported menus. */
	$menus = get_theme_support( 'surface-core-menus' );
	
	/** If there is no array of menus IDs, return. */
	if ( !is_array( $menus[0] ) ) {
		return;
	}
	
	/* Register the 'primary' menu. */
	if ( in_array( 'surface-primary-menu', $menus[0] ) ) {
		register_nav_menu( 'surface-primary-menu', __( 'Surface Primary Menu', 'surface' ) );
	}
	
}
?>