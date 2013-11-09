        <div class="post clearfix">
          <h2>
            <?php if (is_page() || is_single()) { ?>
              <?php the_title(); ?>
            <?php } else { ?>
              <a href="<?php the_permalink() ?>" title="<?php _e('Permanent Link to', 'default'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            <?php } ?>
          </h2>
          <?php if (!is_page()) { ?>
          <p class="posted">Posted by <?php the_author() ?> | <?php the_category(', ') ?> | <?php _e('Posted on', 'default'); ?> <?php the_time('F jS, Y') ?></p>
          <?php } ?>
          <?php the_content(__('Read full post', 'default')); ?>
          <?php if (!is_page()) { ?>
          <div class="comments">
            <a href="<?php comments_link(); ?>"><?php comments_number( __( 'No comments', 'default' ), __( '1 comment', 'default' ), __( '% comments', 'default' ),  __( 'comments', 'default' )); ?></a>
          </div>
          <?php } ?>
        </div>
