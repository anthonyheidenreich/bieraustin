<?php
/** Core Theme Framework */
class Surface {
	
	/** Constructor Method */
	function __construct() {

		/** Define a Global variable Standard Class */
		global $surface;
		$surface = new stdClass;
		
		/* Define framework, parent theme, and child theme constants. */
		add_action( 'after_setup_theme', array( &$this, 'constants' ), 1 );
		
		/* Load the core functions required by the rest of the framework. */
		add_action( 'after_setup_theme', array( &$this, 'core' ), 2 );
		
		/* Language functions and translations setup. */
		add_action( 'after_setup_theme', array( &$this, 'i18n' ), 3 );
		
		/* Load the framework functions. */
		add_action( 'after_setup_theme', array( &$this, 'functions' ), 12 );
		
		/* Load admin files. */
		add_action( 'wp_loaded', array( &$this, 'admin' ) );		

	}
	
	/** Define Constant Paths */
	function constants() {

		/** Directory Location Constants */
		
		/** Sets the path to the parent theme directory. */
		define( 'SURFACE_DIR', get_template_directory() );
		define( 'SURFACE_LIB_DIR', trailingslashit( SURFACE_DIR ) . 'lib' );
		
		define( 'SURFACE_FUNCTIONS_DIR', trailingslashit( SURFACE_LIB_DIR ) . 'functions' );
		define( 'SURFACE_ADMIN_DIR', trailingslashit( SURFACE_LIB_DIR ) . 'admin' );
		define( 'SURFACE_JS_DIR', trailingslashit( SURFACE_LIB_DIR ) . 'js' );
		define( 'SURFACE_CSS_DIR', trailingslashit( SURFACE_LIB_DIR ) . 'css' );
		
		/** URI Location Constants */
		
		/** Sets the path to the parent theme directory URI. */
		define( 'SURFACE_URI', get_template_directory_uri() );
		define( 'SURFACE_LIB_URI', trailingslashit( SURFACE_URI ) . 'lib' );
		define( 'SURFACE_IMAGES_URI', trailingslashit( SURFACE_URI ) . 'images' );
		
		define( 'SURFACE_ADMIN_URI', trailingslashit( SURFACE_LIB_URI ) . 'admin' );		
		define( 'SURFACE_JS_URI', trailingslashit( SURFACE_LIB_URI ) . 'js' );
		define( 'SURFACE_CSS_URI', trailingslashit( SURFACE_LIB_URI ) . 'css' );
		
	}
	
	/** Loads the core framework functions. */
	function core() {
		
		/* Load the core framework functions. */
		require_once( trailingslashit( SURFACE_FUNCTIONS_DIR ) . 'core.php' );
	
	}
	
	/** Loads translation files */
	function i18n() {

		/** Translations can be filed in the /languages/ directory */
		load_theme_textdomain( 'surface', trailingslashit( SURFACE_DIR ) . 'languages' );
		
		/* Get the user's locale. */
		$locale = get_locale();
		
		/* Locate a locale-specific functions file. */
		$locale_functions = trailingslashit( SURFACE_DIR ) . 'languages/$locale.php';
		
		/* If the locale file exists and is readable, load it. */
		if ( !empty( $locale_functions ) && is_readable( $locale_functions ) ) {
			require_once( $locale_functions );
		}
		
	}
	
	/** Loads the framework functions. */
	function functions() {

		/* Load media-related functions. */
		require_once( trailingslashit( SURFACE_FUNCTIONS_DIR ) . 'media.php' );
		
		/* Load the utility functions. */
		require_once( trailingslashit( SURFACE_FUNCTIONS_DIR ) . 'utility.php' );
		
		/* Load the theme settings functions if supported. */
		require_once( trailingslashit( SURFACE_FUNCTIONS_DIR ) . 'settings.php' );
		
		/* Load the menus functions if supported. */
		require_if_theme_supports( 'surface-core-menus', trailingslashit( SURFACE_FUNCTIONS_DIR ) . 'menus.php' );
		
		/* Load the sidebars if supported. */
		require_if_theme_supports( 'surface-core-sidebars', trailingslashit( SURFACE_FUNCTIONS_DIR ) . 'sidebars.php' );
		
		/* Load the featured image if supported. */
		require_if_theme_supports( 'surface-core-featured-image', trailingslashit( SURFACE_FUNCTIONS_DIR ) . 'featured-image.php' );
		
		/* Load the custom header if supported. */
		require_if_theme_supports( 'surface-core-custom-header', trailingslashit( SURFACE_FUNCTIONS_DIR ) . 'custom-header.php' );
		
	}
	
	/** Load admin files for the framework. */
	function admin() {

		/* Check if in the WordPress admin. */
		if ( is_admin() ) {

			/* Load the main admin file. */
			require_once( trailingslashit( SURFACE_ADMIN_DIR ) . 'admin.php' );

		}
	}	
	
}
?>