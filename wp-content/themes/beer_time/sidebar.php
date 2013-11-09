<a href="<?php bloginfo('rss2_url'); ?>" id="rss">Subscribe to RSS</a>
<div class="cbox">
     <div class="inner">
     <h2>Recent Posts</h2>
        <ul class="first">
          <?php get_archives('postbypost','5','html','','',FALSE); ?>
        </ul>
      <h2>Categories</h2>
        <ul>
          <?php wp_list_categories('show_count=1&title_li='); ?>
        </ul>
      <h2>Archives</h2>
        <ul>
          <?php wp_get_archives('type=monthly'); ?>
        </ul>
</div>
 <div class="cboxbottom"></div>
</div>
