<?php
if ( !is_singular() ):

	alkane_loop_nav();
	
elseif ( is_singular( 'post' ) ) :

	alkane_loop_nav_singular_post();

endif;
?>