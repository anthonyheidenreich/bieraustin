<?php
/**
 * Theme administration functions.
 *
 * @package Surface
 * @subpackage Admin
 */

class SurfaceAdmin {
		
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
			wp_register_style( 'surface-admin-css-style', esc_url( trailingslashit( SURFACE_ADMIN_URI ) . 'style.css' ) );
			wp_register_style( 'surface-admin-css-ui-smoothness', esc_url( trailingslashit( SURFACE_JS_URI ) . 'ui/css/smoothness/jquery-ui-1.8.20.custom.css' ) );
			
			/** Register Admin Scripts */
			wp_register_script( 'surface-admin-js-surface', esc_url( trailingslashit( SURFACE_ADMIN_URI ) . 'surface.js' ), array( 'jquery-ui-tabs' ) );
			wp_register_script( 'surface-admin-js-jquery-cookie', esc_url( trailingslashit( SURFACE_JS_URI ) . 'jquery.cookie.js' ), array( 'jquery' ) );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for the framework. */
		function admin_enqueue_scripts() {			
		}
		
		/** Initializes all the theme settings page functionality. This function is used to create the theme settings page */
		function settings_page_init() {
			
			global $surface;
			
			/** Register theme settings. */
			register_setting( 'surface_options_group', 'surface_options', array( &$this, 'surface_options_validate' ) );
			
			/* Create the theme settings page. */
			$surface->settings_page = add_theme_page( 
				esc_html( __( 'Surface Options', 'surface' ) ),	/** Settings page name. */
				esc_html( __( 'Surface Options', 'surface' ) ),	/** Menu item name. */
				$this->settings_page_capability(),				/** Required capability */
				'surface-options', 								/** Screen name */
				array( &$this, 'settings_page' )				/** Callback function */
			);
			
			/* Check if the settings page is being shown before running any functions for it. */
			if ( !empty( $surface->settings_page ) ) {
				
				/** Add contextual help to the theme settings page. */
				add_action( 'load-'. $surface->settings_page, array( &$this, 'settings_page_contextual_help' ) );
				
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
			require( trailingslashit( SURFACE_ADMIN_DIR ) . 'page.php' );
		}
		
		/** Text for the contextual help for the theme settings page in the admin. */
		function settings_page_contextual_help() {
			
			/** Get the parent theme data. */
			$theme = surface_theme_data();
			$AuthorURI = $theme->get( 'AuthorURI' );
			$ThemeURI = $theme->get( 'ThemeURI' );
		
			/** Get the current screen */
			$screen = get_current_screen();
			
			/** Help Tab */
			$screen->add_help_tab( array(
				
				'id' => 'theme-settings-support',
				'title' => __( 'Theme Support', 'surface' ),
				'content' => implode( '', file( trailingslashit( SURFACE_ADMIN_DIR ) . 'help/support.html' ) ),				
				
				)
			);
			
			/** Help Sidebar */
			$sidebar = '<p><strong>' . __( 'For more information:', 'surface' ) . '</strong></p>';
			if ( !empty( $AuthorURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $AuthorURI ) . '" target="_blank">' . __( 'Surface Project', 'surface' ) . '</a></p>';
			}
			if ( !empty( $ThemeURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $ThemeURI ) . '" target="_blank">' . __( 'Surface Official Page', 'surface' ) . '</a></p>';
			}			
			$screen->set_help_sidebar( $sidebar );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for displaying the theme settings page in the WordPress admin. */
		function settings_page_enqueue_scripts() {
			
			/** Load Admin Stylesheet */
			wp_enqueue_style( 'surface-admin-css-style' );
			wp_enqueue_style( 'surface-admin-css-ui-smoothness' );
			
			/** Load Admin Scripts */
			wp_enqueue_script( 'surface-admin-js-surface' );
			wp_enqueue_script( 'surface-admin-js-jquery-cookie' );
				
		}
		
		/** Configure settings Sections and Fileds */		
		function settings_sections() {
		
			/** Blog Section */
			add_settings_section( 'surface_section_blog', 'Blog Options', array( &$this, 'surface_section_blog_fn' ), 'surface_section_blog_page' );			
			
			add_settings_field( 'surface_field_post_style', __( 'Post Style', 'surface' ), array( &$this, 'surface_field_post_style_fn' ), 'surface_section_blog_page', 'surface_section_blog' );
			add_settings_field( 'surface_field_post_nav_style', __( 'Post Navigation Style', 'surface' ), array( &$this, 'surface_field_post_nav_style_fn' ), 'surface_section_blog_page', 'surface_section_blog' );
			
			/** General Section */
			add_settings_section( 'surface_section_general', 'General Options', array( &$this, 'surface_section_general_fn' ), 'surface_section_general_page' );
			
			add_settings_field( 'surface_field_analytic', __( 'Use Analytic', 'surface' ), array( &$this, 'surface_field_analytic_fn' ), 'surface_section_general_page', 'surface_section_general' );
			add_settings_field( 'surface_field_analytic_code', __( 'Enter Analytic Code', 'surface' ), array( &$this, 'surface_field_analytic_code_fn' ), 'surface_section_general_page', 'surface_section_general' );
			add_settings_field( 'surface_field_copyright', __( 'Enter Copyright Text', 'surface' ), array( &$this, 'surface_field_copyright_fn' ), 'surface_section_general_page', 'surface_section_general' );
			add_settings_field('surface_field_reset', __( 'Reset Theme Options', 'surface' ), array( &$this, 'surface_field_reset_fn' ), 'surface_section_general_page', 'surface_section_general' );
		
		}
		
		/** Configure default settings. */		
		function settings_default() {
			global $surface;
			
			$surface_reset = false;
			$surface_options = surface_get_settings();
			
			/** Surface Reset Logic */
			if ( !is_array( $surface_options ) ) {			
				$surface_reset = true;			
			} 						
			elseif ( $surface_options['surface_reset'] == 1 ) {			
				$surface_reset = true;			
			}			
			
			/** Let Reset Surface */
			if( $surface_reset == true ) {
				
				$default = array(
					
					'surface_post_style' => 'content',
					'surface_post_nav_style' => 'numeric',
					
					'surface_analytic' => 0,
					'surface_analytic_code' => 'Analytic Code',
					
					'surface_copyright' => '&copy; Copyright '. date( 'Y' ) .' - <a href="'. home_url( '/' ) .'">'. get_bloginfo( 'name' ) .'</a>',
					
					'surface_reset' => 0,
					
				);
				
				update_option( 'surface_options' , $default );
			
			}
		
		}
		
		/** Surface Pre-defined Range */
		
		/* Boolean Yes | No */		
		function surface_pd_boolean() {			
			return array( 1 => __( 'yes', 'surface' ), 0 => __( 'no', 'surface' ) );		
		}
		
		/* Post Style Range */		
		function surface_pd_post_style() {			
			return array( 'content' => __( 'Content', 'surface' ), 'excerpt' => __( 'Excerpt (Magazine Style)', 'surface' ) );			
		}
		
		/* Post Navigation Style Range */		
		function surface_pd_post_nav_style() {			
			return array( 'numeric' => __( 'Numeric', 'surface' ), 'older-newer' => __( 'Older / Newer', 'surface' ) );			
		}
		
		/** Surface Options Validation */				
		function surface_options_validate( $input ) {
			
			/* Validation: surface_post_style */
			$surface_pd_post_style = $this->surface_pd_post_style();
			if ( ! array_key_exists( $input['surface_post_style'], $surface_pd_post_style ) ) {
				 $input['surface_post_style'] = 'excerpt';
			}
			
			/* Validation: surface_post_nav_style */
			$surface_pd_post_nav_style = $this->surface_pd_post_nav_style();
			if ( ! array_key_exists( $input['surface_post_nav_style'], $surface_pd_post_nav_style ) ) {
				 $input['surface_post_nav_style'] = 'numeric';
			}								
			
			/* Validation: surface_analytic */
			$surface_pd_boolean = $this->surface_pd_boolean();
			if ( ! array_key_exists( $input['surface_analytic'], $surface_pd_boolean ) ) {
				 $input['surface_analytic'] = 0;
			}
			
			/* Validation: surface_analytic_code */
			if( !empty( $input['surface_analytic_code'] ) ) {
				$input['surface_analytic_code'] = htmlspecialchars ( $input['surface_analytic_code'] );
			}
			
			/* Validation: surface_copyright */
			if( !empty( $input['surface_copyright'] ) ) {
				$input['surface_copyright'] = esc_html ( $input['surface_copyright'] );
			}
			
			/* Validation: surface_reset */
			$surface_pd_boolean = $this->surface_pd_boolean();
			//if ( ! array_key_exists( surface_undefined_index_fix ( $input['surface_reset'] ), $surface_pd_boolean ) ) {
			if ( ! array_key_exists( $input['surface_reset'], $surface_pd_boolean ) ) {
				 $input['surface_reset'] = 0;
			}
			
			add_settings_error( 'surface_options', 'surface_options', __( 'Settings Saved.', 'surface' ), 'updated' );
			
			return $input;
		
		}
		
		/** Blog Section Callback */				
		function surface_section_blog_fn() {
			_e( 'Surface Blog Options', 'surface' );
		}
		
		/* Post Style Callback */		
		function surface_field_post_style_fn() {
			
			$surface_options = get_option('surface_options');
			$items = $this->surface_pd_post_style();			
			
			foreach( $items as $key => $val ) {
			?>
            <label><input type="radio" id="surface_post_style[]" name="surface_options[surface_post_style]" value="<?php echo $key; ?>" <?php checked( $key, $surface_options['surface_post_style'] ); ?> /> <?php echo $val; ?></label><br />
            <?php
			}		
		
		}
		
		/* Post Style Navigaiton Callback */		
		function surface_field_post_nav_style_fn() {
			
			$surface_options = get_option('surface_options');
			$items = $this->surface_pd_post_nav_style();			
			
			foreach( $items as $key => $val ) {
			?>
            <label><input type="radio" id="surface_post_nav_style[]" name="surface_options[surface_post_nav_style]" value="<?php echo $key; ?>" <?php checked( $key, $surface_options['surface_post_nav_style'] ); ?> /> <?php echo $val; ?></label><br />
            <?php
			}
		
		}
		
		/** General Section Callback */				
		function surface_section_general_fn() {
			_e( 'Surface General Options', 'surface' );
		}
		
		/* Analytic Callback */		
		function  surface_field_analytic_fn() {
			
			$surface_options = get_option( 'surface_options' );
			$items = $this->surface_pd_boolean();
			
			echo '<select id="surface_analytic" name="surface_options[surface_analytic]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $surface_options['surface_analytic'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select yes to add your Analytic code.', 'surface' ) .'</small></div>';
		
		}
		
		function surface_field_analytic_code_fn() {
			
			$surface_options = get_option('surface_options');
			echo '<textarea type="textarea" id="surface_analytic_code" name="surface_options[surface_analytic_code]" rows="7" cols="50">'. htmlspecialchars_decode ( $surface_options['surface_analytic_code'] ) .'</textarea>';
			echo '<div><small>'. __( 'Enter the Analytic code.', 'surface' ) .'</small></div>';
		
		}
		
		/* Copyright Text Callback */		
		function surface_field_copyright_fn() {
			
			$surface_options = get_option('surface_options');
			echo '<textarea type="textarea" id="surface_copyright" name="surface_options[surface_copyright]" rows="7" cols="50">'. esc_html ( $surface_options['surface_copyright'] ) .'</textarea>';
			echo '<div><small>'. __( 'Enter Copyright Text.', 'surface' ) .'</small></div>';
			echo '<div><small>Example: <strong>&amp;copy; Copyright '.date('Y').' - &lt;a href="'. home_url( '/' ) .'"&gt;'. get_bloginfo('name') .'&lt;/a&gt;</strong></small></div>';
		
		}		
		
		/* Theme Reset Callback */		
		function surface_field_reset_fn() {
			
			$surface_options = get_option('surface_options');			
			$items = $this->surface_pd_boolean();			
			echo '<label><input type="checkbox" id="surface_reset" name="surface_options[surface_reset]" value="1" /> '. __( 'Reset Theme Options.', 'surface' ) .'</label>';
		
		}
}

/** Initiate Admin */
new SurfaceAdmin();
?>