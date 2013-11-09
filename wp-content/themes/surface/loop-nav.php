<?php
if ( !is_singular() ):

	surface_loop_nav();
	
elseif ( is_singular( 'post' ) ) :

	surface_loop_nav_singular_post();

endif;
?>