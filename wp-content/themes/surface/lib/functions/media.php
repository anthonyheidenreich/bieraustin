<?php
/**
 * Functions file for loading scripts and stylesheets.
 *
 * @package Surface
 * @subpackage Functions
 */

/** Register Surface Core scripts. */
add_action( 'wp_enqueue_scripts', 'surface_register_scripts', 1 );

/** Load Surface Core scripts. */
add_action( 'wp_enqueue_scripts', 'surface_enqueue_scripts' );

/** Register JavaScript and Stylesheet files for the framework. */
function surface_register_scripts() {

	/* Register the 'drop-downs' scripts if the current theme supports 'surface-core-menus'. */
	if ( current_theme_supports( 'surface-core-menus' ) ) {
		wp_register_script( 'surface-js-hoverintent', esc_url( trailingslashit( SURFACE_JS_URI ) . 'hoverintent.min.js' ), array( 'jquery' ), '5', true );
		wp_register_script( 'surface-js-superfish', esc_url( trailingslashit( SURFACE_JS_URI ) . 'superfish.min.js' ), array( 'jquery' ), '1.4.8', true );
		wp_register_script( 'surface-js-supersubs', esc_url( trailingslashit( SURFACE_JS_URI ) . 'supersubs.min.js' ), array( 'jquery' ), '0.2', true );
		wp_register_script( 'surface-js-drop-downs', esc_url( trailingslashit( SURFACE_JS_URI ) . 'drop-downs.js' ), array( 'jquery' ), '1.0', true );
	}
	
	/** Register '960.css' for grid. */
	wp_register_style( 'surface-css-960', esc_url( trailingslashit( SURFACE_CSS_URI ) . '960.css' ) );
	
	/** Register Google Fonts. */
	wp_register_style( 'surface-google-fonts', esc_url( 'http://fonts.googleapis.com/css?family=Droid+Sans|Imprima|Oswald' ) );
}

/** Tells WordPress to load the scripts needed for the framework using the wp_enqueue_script() function. */
function surface_enqueue_scripts() {

	/** Load the comment reply script on singular posts with open comments if threaded comments are supported. */
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/** Load the 'drop-downs' script if the current theme supports 'surface-drop-downs'. */
	if ( current_theme_supports( 'surface-core-menus' ) ) {
		wp_enqueue_script( 'surface-js-hoverintent' );
		wp_enqueue_script( 'surface-js-superfish' );
		wp_enqueue_script( 'surface-js-supersubs' );
		wp_enqueue_script( 'surface-js-drop-downs' );
	}
	
	/** Load '960.css' for grid. */
	wp_enqueue_style( 'surface-css-960' );
	
	/** Load Google Fonts. */
	wp_enqueue_style( 'surface-google-fonts' );
}

/** Analytic Code */
add_action( 'wp_footer', 'surface_analytic_code_init' );
function surface_analytic_code_init() {
	
	$surface_options = surface_get_settings();
	
	if( $surface_options['surface_analytic'] == 1 ) :	
	echo htmlspecialchars_decode ( $surface_options['surface_analytic_code'] );	
	echo '<!-- end analytic-code -->';	
	endif;

}
?>