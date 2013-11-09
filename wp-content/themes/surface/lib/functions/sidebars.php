<?php
/**
 * Sets up the core sidebars if the theme supports them.
 *
 * @package Surface
 * @subpackage Functions
 */

/** Register widget areas. */
add_action( 'widgets_init', 'surface_register_sidebars' );

/** Registers the the core sidebars */
function surface_register_sidebars() {

	/** Get the theme-supported sidebars. */
	$supported_sidebars = get_theme_support( 'surface-core-sidebars' );
	
	/** If the theme doesn't add support for any sidebars, return. */
	if ( !is_array( $supported_sidebars[0] ) ) {
		return;
	}
	
	/* Get the available core framework sidebars. */
	$core_sidebars = surface_sidebars();
	
	/* Loop through the supported sidebars. */
	foreach ( $supported_sidebars[0] as $sidebar ) {
		
		/* Make sure the given sidebar is one of the core sidebars. */
		if ( isset( $core_sidebars[$sidebar] ) ) {

			/* Set up some default sidebar arguments. */
			$defaults = array(
				'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-wrap widget-inside">',
				'after_widget'	=> '</div></div>',
				'before_title'	=> '<h2 class="widget-title">',
				'after_title'	=> '</h2>'
			);

			/* Parse the sidebar arguments and defaults. */
			$args = wp_parse_args( $core_sidebars[$sidebar], $defaults );

			/* Register the sidebar. */
			register_sidebar( $args );
		}
		
	}

}

/** Returns an array of the core framework's available sidebars for use in theme */
function surface_sidebars() {

	/* Set up an array of sidebars. */
	$sidebars = array(
		
		'surface-primary-sidebar' => array(
			'name' => __( 'Surface Primary Sidebar', 'surface' ),
			'id' => 'surface-primary-sidebar',
			'description' => __( 'The main (primary) widget area, most often used as a sidebar.', 'surface' )
		)
	);

	/* Return the sidebars. */
	return $sidebars;
}
?>