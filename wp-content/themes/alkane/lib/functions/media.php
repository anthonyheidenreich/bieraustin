<?php
/**
 * Functions file for loading scripts and stylesheets.
 *
 * @package Alkane
 * @subpackage Functions
 */

/** Register Alkane Core scripts. */
add_action( 'wp_enqueue_scripts', 'alkane_register_scripts', 1 );

/** Load Alkane Core scripts. */
add_action( 'wp_enqueue_scripts', 'alkane_enqueue_scripts' );

/** Register JavaScript and Stylesheet files for the framework. */
function alkane_register_scripts() {

	/** Register the 'common' scripts. */
	wp_register_script( 'alkane-js-common', esc_url( ALKANE_JS_URI . 'common.js' ), array( 'jquery' ), '1.0', true );
	
	/** Register '960.css' for grid. */
	wp_register_style( 'alkane-css-960', esc_url( ALKANE_CSS_URI . '960.css' ) );
	
	/** Register Google Fonts. */
	wp_register_style( 'alkane-google-fonts', esc_url( 'http://fonts.googleapis.com/css?family=Signika' ) );
}

/** Tells WordPress to load the scripts needed for the framework using the wp_enqueue_script() function. */
function alkane_enqueue_scripts() {

	/** Load the comment reply script on singular posts with open comments if threaded comments are supported. */
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/** Load the 'common' scripts. */
	wp_enqueue_script( 'alkane-js-common' );
	
	/** Load '960.css' for grid. */
	wp_enqueue_style( 'alkane-css-960' );
	
	/** Load Google Fonts. */
	wp_enqueue_style( 'alkane-google-fonts' );
}

/** Analytic Code */
add_action( 'wp_footer', 'alkane_analytic_code_init' );
function alkane_analytic_code_init() {
	
	$alkane_options = alkane_get_settings();
	
	if( $alkane_options['alkane_analytic'] == 1 ) :	
	echo htmlspecialchars_decode ( $alkane_options['alkane_analytic_code'] );	
	echo '<!-- end analytic-code -->';	
	endif;

}
?>