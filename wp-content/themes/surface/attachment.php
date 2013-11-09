<?php get_header();	?>

  <div class="container_12">
    <div id="content" class="grid_9">
      
      <?php if ( have_posts() ) : ?>
      
        <?php while ( have_posts() ) : the_post(); ?>
        
          <?php get_template_part( 'content', 'attachment' ); ?>
        
        <?php endwhile; ?>
      
      <?php else : ?>
                  
        <?php get_template_part( 'loop-error' ); ?>
      
      <?php endif; ?>
      
    </div> <!-- end #content -->
    <?php get_sidebar(); ?>
  </div>

<?php get_footer(); ?>