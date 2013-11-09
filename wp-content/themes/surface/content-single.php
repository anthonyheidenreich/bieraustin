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
  
  <?php endif; ?>
  
</div>

<div class="grid_7 omega">

  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <h1 class="entry-title entry-title-single"><?php the_title(); ?></h1>
    
    <div class="entry-content">
      <?php the_content(); ?>
      <div class="clear"></div>				
    </div> <!-- end .entry-content -->
    
    <?php echo surface_link_pages(); ?>
    
    <?php if ( 'post' == get_post_type() ) : ?>
    <div class="entry-meta-bottom">
    <?php echo surface_post_category() . surface_post_tags(); ?>
    </div><!-- .entry-meta -->
    <?php endif; ?>     
  
  </div> <!-- end #post-<?php the_ID(); ?> .post_class -->
  
  <?php surface_author(); ?> 

  <?php comments_template( '', true ); ?>

</div>
<div class="clear"></div>