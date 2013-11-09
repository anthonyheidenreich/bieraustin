<?php
/** Primary Menu Callback */
function alkane_primary_menu_cb() {
	wp_page_menu();		 
}
?>
<div class="grid_11">
  <div class="menu1">
    <div class="menu1-data">
      <?php
      if ( has_nav_menu( 'alkane-primary-menu' ) ):
    
        $args = array(
        
            'container' => 'div', 
            'container_class' => 'primary-container', 
            'theme_location' => 'alkane-primary-menu',
            'menu_class' => 'sf-menu1',
            'depth' => 0,
            'fallback_cb' => 'alkane_primary_menu_cb'
                    
        );
    
        wp_nav_menu( $args );
    
      else:
    
        alkane_primary_menu_cb();	
  
      endif;
      ?>
    </div>
  </div>
</div>  <!-- end .grid_11 -->