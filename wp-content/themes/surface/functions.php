<?php
/** Load the Core Files */
require_once( trailingslashit( get_template_directory() ) . 'lib/init.php' );
new Surface();

/** Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'surface_theme_setup' );

/** Theme setup function. */
function surface_theme_setup() {
	
	/** Add theme support for core framework features. */
	add_theme_support( 'surface-core-menus', array( 'surface-primary-menu' ) );
	add_theme_support( 'surface-core-sidebars', array( 'surface-primary-sidebar' ) );
	add_theme_support( 'surface-core-featured-image' );
	add_theme_support( 'surface-core-custom-header' );
	
	/** Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background', array( 'default-color' => '444' ) );
	
	/** Set content width. */
	surface_set_content_width( 540 );
	
	/** Add custom image sizes. */
	add_action( 'init', 'surface_add_image_sizes' );	

}

/** Adds custom image sizes */
function surface_add_image_sizes() {
	add_image_size( 'featured', 200, 200, true );
}
?>