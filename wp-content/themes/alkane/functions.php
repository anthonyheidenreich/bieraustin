<?php
/** Load the Core Files */
require_once( trailingslashit( get_template_directory() ) . 'lib/init.php' );
new Alkane();

/** Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'alkane_theme_setup' );

/** Theme setup function. */
function alkane_theme_setup() {
	
	/** Add theme support for Feed Links. */
	add_theme_support( 'automatic-feed-links' );
	
	/** Add theme support for Custom Background. */
	add_theme_support( 'custom-background', array( 'default-color' => 'fff' ) );
	
	/** Set content width. */
	alkane_set_content_width( 640 );
	
	/** Add custom image sizes. */
	add_action( 'init', 'alkane_add_image_sizes' );	

}

/** Adds custom image sizes */
function alkane_add_image_sizes() {
	add_image_size( 'featured', 200, 200, true );
}
?>