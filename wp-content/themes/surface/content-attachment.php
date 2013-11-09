<div class="grid_2 alpha">
  
  <?php if ( 'attachment' == get_post_type() ) : ?>
  
  <ul class="entry-meta-vertical">
	<?php 
    echo surface_post_date();
    echo surface_post_author();
    echo surface_post_comments();
    echo surface_post_sticky();
    echo surface_post_edit_link();
    ?>
  </ul>
  
  <?php endif; ?>
  
</div>

<div class="grid_7 omega">

  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <h1 class="entry-title entry-title-single"><?php the_title(); ?></h1>
    
    <?php surface_loop_nav_singular(); ?>
    
    <div class="entry-content entry-attachment">
      <p><a href="<?php echo wp_get_attachment_url( $post->ID ); ?>"><?php echo wp_get_attachment_image( $post->ID, 'large', false, array( 'class' => 'attachment-large aligncenter' ) ); ?></a></p>
      <?php the_excerpt(); ?>
      <div class="clear"></div>				
    </div> <!-- end .entry-content -->
    
    <?php echo surface_link_pages(); ?>
  
  </div> <!-- end #post-<?php the_ID(); ?> .post_class -->
  
  <?php surface_loop_nav_singular_attachment(); ?>
  
  <?php comments_template( '', true ); ?>

</div>
<div class="clear"></div>