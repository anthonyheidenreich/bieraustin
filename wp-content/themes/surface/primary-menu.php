<?php
/** Primary Menu Callback */
function surface_primary_menu_cb() {
	wp_page_menu();		 
}
?>
<div class="grid_8 omega">
  <div class="menu1">
    <div class="menu1-data">
      <?php
      if ( has_nav_menu( 'surface-primary-menu' ) ):
    
        $args = array(
        
            'container' => 'div', 
            'container_class' => 'primary-container', 
            'theme_location' => 'surface-primary-menu',
            'menu_class' => 'sf-menu1',
            'depth' => 0,
            'fallback_cb' => 'surface_primary_menu_cb'
                    
        );
    
        wp_nav_menu( $args );
    
      else:
    
        surface_primary_menu_cb();	

      endif;
      ?>
      <div class="clear"></div>
    </div>
  </div>  <!-- end .menu1 --> 
</div>