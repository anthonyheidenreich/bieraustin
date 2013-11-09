<div class="wrap">
  
  <?php 
  /** Get the parent theme data. */
  $surface_theme_data = surface_theme_data();
  screen_icon();
  ?>
  <h2><?php echo sprintf( __( '%1$s Theme Settings', 'surface' ), $surface_theme_data->get( 'Name' ) ); ?></h2>    
  
  <?php settings_errors( 'surface_options' ); ?>
  
  <form action="options.php" method="post">
    
    <?php settings_fields('surface_options_group'); ?>
    
    <div id="surface_tabs" class="surface-tabs">
    
      <ul>
        <li><a href="#surface_section_blog_tab"><?php _e( 'Blog Options', 'surface' ); ?></a></li>
        <li><a href="#surface_section_general_tab"><?php _e( 'General Options', 'surface' ); ?></a></li>        
      </ul>
      
      <div id="surface_section_blog_tab"><?php do_settings_sections( 'surface_section_blog_page' ); ?></div>
      <div id="surface_section_general_tab"><?php do_settings_sections( 'surface_section_general_page' ); ?></div>      
    
    </div>
    
    <p class="submit">
      <input name="Submit" type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'surface' ); ?>" />
    </p>
  
  </form>

</div>