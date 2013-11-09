<?php get_header();	?>

  <div class="container_12">
    <div id="content" class="grid_9">
    
      <?php while ( have_posts() ) : the_post(); ?>
      
        <?php get_template_part( 'content', 'page' ); ?>
      
      <?php endwhile; ?>
      
      <?php get_template_part( 'loop-nav' ); ?>
    
    </div> <!-- end #content -->
    <?php get_sidebar(); ?>
  </div>

<?php get_footer(); ?>