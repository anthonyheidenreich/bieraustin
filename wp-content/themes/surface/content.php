<div class="grid_2 alpha">
  
  <?php if ( 'post' == get_post_type() ) : ?>
  
  <ul class="entry-meta-vertical">
	<?php 
    echo surface_post_date();
    echo surface_post_author();
    echo surface_post_comments();
    echo surface_post_sticky();
    echo surface_post_edit_link();
    ?>
  </ul>
  
  <?php elseif ( 'page' == get_post_type() && surface_post_edit_link() != "" ) : ?>
  
  <ul class="entry-meta-vertical">
  <?php
  echo surface_post_edit_link();
  ?> 
  </ul>
  
  <?php else: ?>
  
  <div>&nbsp;</div>
  
  <?php endif; ?>
  
</div>
<div class="grid_7 omega">

  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php $entry_title = ( 'page' == get_post_type() && surface_post_edit_link() == "" )? 'entry-title entry-title-page' : 'entry-title'; ?>
    <h1 class="<?php echo $entry_title; ?>"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
    
    <div class="entry-content">
      <?php surface_featured_image(); ?>
      <?php surface_post_style(); ?>
      <?php echo surface_link_pages(); ?>
    <div class="clear"></div>
    </div> <!-- end .entry-content -->
    
    <div class="entry-meta-bottom">
    <?php if ( 'post' == get_post_type() ) : ?>  
    <?php echo surface_post_category() . surface_post_tags(); ?>  
    <?php endif; ?>
    </div><!-- .entry-meta-bottom -->
  
  </div> <!-- end #post-<?php the_ID(); ?> .post_class -->

</div>
<div class="clear"></div>