<div class="wrap">
  
  <?php 
  /** Get the parent theme data. */
  $alkane_theme_data = alkane_theme_data();
  screen_icon();
  ?>
  <h2><?php echo sprintf( __( '%1$s Theme Settings', 'alkane' ), $alkane_theme_data['Name'] ); ?></h2>    
  
  <?php settings_errors( 'alkane_options' ); ?>
  
  <form action="options.php" method="post">
    
    <?php settings_fields('alkane_options_group'); ?>
    
    <div id="alkane_tabs" class="alkane-tabs">
    
      <ul>
        <li><a href="#alkane_section_blog_tab"><?php _e( 'Blog Options', 'alkane' ); ?></a></li>
        <li><a href="#alkane_section_general_tab"><?php _e( 'General Options', 'alkane' ); ?></a></li>        
      </ul>
      
      <div id="alkane_section_blog_tab"><?php do_settings_sections( 'alkane_section_blog_page' ); ?></div>
      <div id="alkane_section_general_tab"><?php do_settings_sections( 'alkane_section_general_page' ); ?></div>      
    
    </div>
    
    <p class="submit">
      <input name="Submit" type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'alkane' ); ?>" />
    </p>
  
  </form>

</div>