<?php
/**
 * Theme administration functions.
 *
 * @package Alkane
 * @subpackage Admin
 */

class AlkaneAdmin {
		
		/** Constructor Method */
		function __construct() {
	
			/** Load the admin_init functions. */
			add_action( 'admin_init', array( &$this, 'admin_init' ) );
			
			/* Hook the settings page function to 'admin_menu'. */
			add_action( 'admin_menu', array( &$this, 'settings_page_init' ) );		
	
		}
		
		/** Initializes any admin-related features needed for the framework. */
		function admin_init() {
			
			/** Registers admin JavaScript and Stylesheet files for the framework. */
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_register_scripts' ), 1 );
		
			/** Loads admin JavaScript and Stylesheet files for the framework. */
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );
			
		}
		
		/** Registers admin JavaScript and Stylesheet files for the framework. */
		function admin_register_scripts() {
			
			/** Register Admin Stylesheet */
			wp_register_style( 'alkane-admin-css-style', esc_url( ALKANE_ADMIN_URI . 'style.css' ) );
			wp_register_style( 'alkane-admin-css-ui-smoothness', esc_url( ALKANE_JS_URI . 'ui/css/smoothness/jquery-ui-1.9.2.custom.min.css' ) );
			
			/** Register Admin Scripts */
			wp_register_script( 'alkane-admin-js-alkane', esc_url( ALKANE_ADMIN_URI . 'common.js' ), array( 'jquery-ui-tabs' ) );
			wp_register_script( 'alkane-admin-js-jquery-cookie', esc_url( ALKANE_JS_URI . 'jquery.cookie.js' ), array( 'jquery' ) );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for the framework. */
		function admin_enqueue_scripts() {			
		}
		
		/** Initializes all the theme settings page functionality. This function is used to create the theme settings page */
		function settings_page_init() {
			
			global $alkane;
			
			/** Register theme settings. */
			register_setting( 'alkane_options_group', 'alkane_options', array( &$this, 'alkane_options_validate' ) );
			
			/* Create the theme settings page. */
			$alkane->settings_page = add_theme_page( 
				esc_html( __( 'Alkane Options', 'alkane' ) ),	/** Settings page name. */
				esc_html( __( 'Alkane Options', 'alkane' ) ),	/** Menu item name. */
				$this->settings_page_capability(),				/** Required capability */
				'alkane-options', 								/** Screen name */
				array( &$this, 'settings_page' )				/** Callback function */
			);
			
			/* Check if the settings page is being shown before running any functions for it. */
			if ( !empty( $alkane->settings_page ) ) {
				
				/** Add contextual help to the theme settings page. */
				add_action( 'load-'. $alkane->settings_page, array( &$this, 'settings_page_contextual_help' ) );
				
				/* Load the JavaScript and stylesheets needed for the theme settings screen. */
				add_action( 'admin_enqueue_scripts', array( &$this, 'settings_page_enqueue_scripts' ) );
				
				/** Configure settings Sections and Fileds. */
				$this->settings_sections();
				
				/** Configure default settings. */
				$this->settings_default();				
				
			}
			
		}
		
		/** Returns the required capability for viewing and saving theme settings. */
		function settings_page_capability() {
			return 'edit_theme_options';
		}
		
		/** Displays the theme settings page. */
		function settings_page() {
			require( ALKANE_ADMIN_DIR . 'page.php' );
		}
		
		/** Text for the contextual help for the theme settings page in the admin. */
		function settings_page_contextual_help() {
			
			/** Get the parent theme data. */
			$theme = alkane_theme_data();
			$AuthorURI = $theme['AuthorURI'];
			$ThemeURI = $theme['ThemeURI'];
		
			/** Get the current screen */
			$screen = get_current_screen();
			
			/** Help Tab */
			$screen->add_help_tab( array(
				
				'id' => 'theme-settings-support',
				'title' => __( 'Theme Support', 'alkane' ),
				'content' => implode( '', file( ALKANE_ADMIN_DIR . 'help/support.html' ) ),				
				
				)
			);
			
			/** Help Sidebar */
			$sidebar = '<p><strong>' . __( 'For more information:', 'alkane' ) . '</strong></p>';
			if ( !empty( $AuthorURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $AuthorURI ) . '" target="_blank">' . __( 'Alkane Project', 'alkane' ) . '</a></p>';
			}
			if ( !empty( $ThemeURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $ThemeURI ) . '" target="_blank">' . __( 'Alkane Official Page', 'alkane' ) . '</a></p>';
			}			
			$screen->set_help_sidebar( $sidebar );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for displaying the theme settings page in the WordPress admin. */
		function settings_page_enqueue_scripts( $hook ) {
			
			/** Load Scripts For Alkane Options Page */
			if( $hook === 'appearance_page_alkane-options' ) {
				
				/** Load Admin Stylesheet */
				wp_enqueue_style( 'alkane-admin-css-style' );
				wp_enqueue_style( 'alkane-admin-css-ui-smoothness' );
				
				/** Load Admin Scripts */
				wp_enqueue_script( 'alkane-admin-js-alkane' );
				wp_enqueue_script( 'alkane-admin-js-jquery-cookie' );
				
			}
				
		}
		
		/** Configure settings Sections and Fileds */		
		function settings_sections() {
		
			/** Blog Section */
			add_settings_section( 'alkane_section_blog', 'Blog Options', array( &$this, 'alkane_section_blog_fn' ), 'alkane_section_blog_page' );			
			
			add_settings_field( 'alkane_field_post_style', __( 'Post Style', 'alkane' ), array( &$this, 'alkane_field_post_style_fn' ), 'alkane_section_blog_page', 'alkane_section_blog' );
			add_settings_field( 'alkane_field_post_nav_style', __( 'Post Navigation Style', 'alkane' ), array( &$this, 'alkane_field_post_nav_style_fn' ), 'alkane_section_blog_page', 'alkane_section_blog' );
			
			/** General Section */
			add_settings_section( 'alkane_section_general', 'General Options', array( &$this, 'alkane_section_general_fn' ), 'alkane_section_general_page' );
			
			add_settings_field( 'alkane_field_analytic', __( 'Use Analytic', 'alkane' ), array( &$this, 'alkane_field_analytic_fn' ), 'alkane_section_general_page', 'alkane_section_general' );
			add_settings_field( 'alkane_field_analytic_code', __( 'Enter Analytic Code', 'alkane' ), array( &$this, 'alkane_field_analytic_code_fn' ), 'alkane_section_general_page', 'alkane_section_general' );
			add_settings_field( 'alkane_field_copyright', __( 'Enter Copyright Text', 'alkane' ), array( &$this, 'alkane_field_copyright_fn' ), 'alkane_section_general_page', 'alkane_section_general' );
			add_settings_field('alkane_field_reset', __( 'Reset Theme Options', 'alkane' ), array( &$this, 'alkane_field_reset_fn' ), 'alkane_section_general_page', 'alkane_section_general' );
		
		}
		
		/** Configure default settings. */		
		function settings_default() {
			global $alkane;
			
			$alkane_reset = false;
			$alkane_options = alkane_get_settings();
			
			/** Alkane Reset Logic */
			if ( !is_array( $alkane_options ) ) {			
				$alkane_reset = true;			
			} 						
			elseif ( $alkane_options['alkane_reset'] == 1 ) {			
				$alkane_reset = true;			
			}			
			
			/** Let Reset Alkane */
			if( $alkane_reset == true ) {
				
				$default = array(
					
					'alkane_post_style' => 'content',
					'alkane_post_nav_style' => 'numeric',
					
					'alkane_analytic' => 0,
					'alkane_analytic_code' => 'Analytic Code',
					
					'alkane_copyright' => '&copy; Copyright '. date( 'Y' ) .' - <a href="'. home_url( '/' ) .'">'. get_bloginfo( 'name' ) .'</a>',
					
					'alkane_reset' => 0,
					
				);
				
				update_option( 'alkane_options' , $default );
			
			}
		
		}
		
		/** Alkane Pre-defined Range */
		
		/* Boolean Yes | No */		
		function alkane_pd_boolean() {			
			return array( 1 => __( 'yes', 'alkane' ), 0 => __( 'no', 'alkane' ) );		
		}
		
		/* Post Style Range */		
		function alkane_pd_post_style() {			
			return array( 'content' => __( 'Content', 'alkane' ), 'excerpt' => __( 'Excerpt (Magazine Style)', 'alkane' ) );			
		}
		
		/* Post Navigation Style Range */		
		function alkane_pd_post_nav_style() {			
			return array( 'numeric' => __( 'Numeric', 'alkane' ), 'older-newer' => __( 'Older / Newer', 'alkane' ) );			
		}
		
		/** Alkane Options Validation */				
		function alkane_options_validate( $input ) {
			
			/* Validation: alkane_post_style */
			$alkane_pd_post_style = $this->alkane_pd_post_style();
			if ( ! array_key_exists( $input['alkane_post_style'], $alkane_pd_post_style ) ) {
				 $input['alkane_post_style'] = 'excerpt';
			}
			
			/* Validation: alkane_post_nav_style */
			$alkane_pd_post_nav_style = $this->alkane_pd_post_nav_style();
			if ( ! array_key_exists( $input['alkane_post_nav_style'], $alkane_pd_post_nav_style ) ) {
				 $input['alkane_post_nav_style'] = 'numeric';
			}								
			
			/* Validation: alkane_analytic */
			$alkane_pd_boolean = $this->alkane_pd_boolean();
			if ( ! array_key_exists( $input['alkane_analytic'], $alkane_pd_boolean ) ) {
				 $input['alkane_analytic'] = 0;
			}
			
			/* Validation: alkane_analytic_code */
			if( !empty( $input['alkane_analytic_code'] ) ) {
				$input['alkane_analytic_code'] = htmlspecialchars ( $input['alkane_analytic_code'] );
			}
			
			/* Validation: alkane_copyright */
			if( !empty( $input['alkane_copyright'] ) ) {
				$input['alkane_copyright'] = esc_html ( $input['alkane_copyright'] );
			}
			
			/* Validation: alkane_reset */
			$alkane_pd_boolean = $this->alkane_pd_boolean();
			//if ( ! array_key_exists( alkane_undefined_index_fix ( $input['alkane_reset'] ), $alkane_pd_boolean ) ) {
			if ( ! array_key_exists( $input['alkane_reset'], $alkane_pd_boolean ) ) {
				 $input['alkane_reset'] = 0;
			}
			
			add_settings_error( 'alkane_options', 'alkane_options', __( 'Settings Saved.', 'alkane' ), 'updated' );
			
			return $input;
		
		}
		
		/** Blog Section Callback */				
		function alkane_section_blog_fn() {
			_e( 'Alkane Blog Options', 'alkane' );
		}
		
		/* Post Style Callback */		
		function alkane_field_post_style_fn() {
			
			$alkane_options = get_option('alkane_options');
			$items = $this->alkane_pd_post_style();			
			
			foreach( $items as $key => $val ) {
			?>
            <label><input type="radio" id="alkane_post_style[]" name="alkane_options[alkane_post_style]" value="<?php echo $key; ?>" <?php checked( $key, $alkane_options['alkane_post_style'] ); ?> /> <?php echo $val; ?></label><br />
            <?php
			}		
		
		}
		
		/* Post Style Navigaiton Callback */		
		function alkane_field_post_nav_style_fn() {
			
			$alkane_options = get_option('alkane_options');
			$items = $this->alkane_pd_post_nav_style();			
			
			foreach( $items as $key => $val ) {
			?>
            <label><input type="radio" id="alkane_post_nav_style[]" name="alkane_options[alkane_post_nav_style]" value="<?php echo $key; ?>" <?php checked( $key, $alkane_options['alkane_post_nav_style'] ); ?> /> <?php echo $val; ?></label><br />
            <?php
			}
		
		}
		
		/** General Section Callback */				
		function alkane_section_general_fn() {
			_e( 'Alkane General Options', 'alkane' );
		}
		
		/* Analytic Callback */		
		function  alkane_field_analytic_fn() {
			
			$alkane_options = get_option( 'alkane_options' );
			$items = $this->alkane_pd_boolean();
			
			echo '<select id="alkane_analytic" name="alkane_options[alkane_analytic]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $alkane_options['alkane_analytic'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select yes to add your Analytic code.', 'alkane' ) .'</small></div>';
		
		}
		
		function alkane_field_analytic_code_fn() {
			
			$alkane_options = get_option('alkane_options');
			echo '<textarea type="textarea" id="alkane_analytic_code" name="alkane_options[alkane_analytic_code]" rows="7" cols="50">'. htmlspecialchars_decode ( $alkane_options['alkane_analytic_code'] ) .'</textarea>';
			echo '<div><small>'. __( 'Enter the Analytic code.', 'alkane' ) .'</small></div>';
		
		}
		
		/* Copyright Text Callback */		
		function alkane_field_copyright_fn() {
			
			$alkane_options = get_option('alkane_options');
			echo '<textarea type="textarea" id="alkane_copyright" name="alkane_options[alkane_copyright]" rows="7" cols="50">'. esc_html ( $alkane_options['alkane_copyright'] ) .'</textarea>';
			echo '<div><small>'. __( 'Enter Copyright Text.', 'alkane' ) .'</small></div>';
			echo '<div><small>Example: <strong>&amp;copy; Copyright '.date('Y').' - &lt;a href="'. home_url( '/' ) .'"&gt;'. get_bloginfo('name') .'&lt;/a&gt;</strong></small></div>';
		
		}		
		
		/* Theme Reset Callback */		
		function alkane_field_reset_fn() {
			
			$alkane_options = get_option('alkane_options');			
			$items = $this->alkane_pd_boolean();			
			echo '<label><input type="checkbox" id="alkane_reset" name="alkane_options[alkane_reset]" value="1" /> '. __( 'Reset Theme Options.', 'alkane' ) .'</label>';
		
		}
}

/** Initiate Admin */
new AlkaneAdmin();
?>