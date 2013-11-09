<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content-container and the #container div.
 * Also contains the footer widget area.
 *
 * @file      footer.php
 * @package   max-magazine
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */
 ?>
 
</div> <!-- /content-container -->

    <div id="footer">
        <div class="footer-widgets">
            
			<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>				
				
				<div class="widget">
					<h4><?php _e( 'Popular Categories', 'max-magazine' ); ?></h4>
					<ul><?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'title_li' => '', 'number' => 5 ) ); ?></ul>
				</div>
				
				<?php the_widget('WP_Widget_Recent_Posts', 'number=5', 'before_title=<h4>&after_title=</h4>'); ?>
				<?php the_widget('WP_Widget_Recent_Comments', 'number=5', 'before_title=<h4>&after_title=</h4>'); ?> 
			
			<?php endif; // end footer widget area ?>		
			
		</div>
        
		<div class="footer-info">
            </div>
        </div>        
	</div>

</div> <!-- /container -->
<?php wp_footer(); ?>
</body>
</html>