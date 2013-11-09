<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head>
        <?php get_header(); ?>
</head>
<body>

<div id="container">
   <div id="header">

        <?php include (TEMPLATEPATH . "/head.php"); ?>

   </div>
   <div id="content" class="clearfix">

        <div id="column1">
        
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <?php include (TEMPLATEPATH . "/item.php"); ?>
            <div class="navigation">
              <div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
              <div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
            </div>
            <?php comments_template(); ?>
          <?php endwhile; ?>
          <?php else : ?>
            <?php include (TEMPLATEPATH . "/missing.php"); ?>
        <?php endif; ?>
        
          <?php include (TEMPLATEPATH . "/footer.php"); ?>
      
      </div> <!-- #column1 -->

                <div id="column2">

                        <?php get_sidebar(); ?>

                </div> <!-- #column2 -->

    </div> <!-- #content -->


  </div> <!-- #container -->

</body>
</html>
