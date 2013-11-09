<?php
/**
 * Additional helper functions that the framework or themes may use.  The functions in this file are functions
 * that don't really have a home within any other parts of the framework.
 *
 * @package Surface
 * @subpackage Functions
 */

/** Surface print_r */
function surface_print_r( $param = '' ) {
	echo '<pre>';
	print_r( $param );
	echo '</pre>';	
}

/** Surface Alpha Numeric Characters Only */
function surface_alpha_num_chars ( $param = '' ) {
	return preg_replace( '|[^a-zA-Z0-9]|', ' ', trim( $param ) );
}

/** Surface Replace White Spaces */
function surface_replace_white_spaces ( $param = '', $replace = '-' ) {
	return preg_replace( '!\s+!', $replace, trim( $param ) );
}

/** Surface Post Date */
function surface_post_date() {
	
	$post_date = esc_html( get_the_date() );
	
	/** Output */
	$output = sprintf( '<li><span class="entry-date" title="%1$s"><a href="%2$s" title="%3$s" rel="bookmark">%1$s</a></span></li>', $post_date, esc_url( get_permalink() ), the_title_attribute( 'echo=0' ) );
	return $output;

}

/** Surface Post Author */
function surface_post_author() {
	
	$output = sprintf( '<li><span class="entry-label entry-author-label">Author: </span><span class="entry-author author vcard"><a href="%1$s" title="'. __( 'by %2$s', 'surface' ) .'" rel="author">%2$s</a></span></li>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) );
	return $output;

}

/** Surface Post Sticky */
function surface_post_sticky() {
	
	if ( is_sticky() ) { 
		$output = sprintf( '<li><span class="entry-meta-featured">%1$s</span></li>', __( 'Featured', 'surface' ) );
		return $output;
	}

}

/** Surface Post Edit Link */
function surface_post_edit_link( $page_single = false ) {

	/** Manipulation */	
	ob_start();
	if ( ( 'post' == get_post_type() || 'page' == get_post_type() || 'attachment' == get_post_type() ) && $page_single == false  ) :
	edit_post_link( __( 'Edit', 'surface' ), '<li><span class="edit-link">', '</span></li>' );
	else:
	edit_post_link( __( 'Edit', 'surface' ), '<span class="edit-link">', '</span>' );
	endif;
	$output = ob_get_clean();
	
	return $output;

}

/** Surface Post Comments */
function surface_post_comments() {
	
	if ( ( ! comments_open() || post_password_required() ) ) {
		return;
	}

	ob_start();
	comments_number( __( 'Leave a Comment', 'surface' ), __( '1 Comment', 'surface' ), __( '% Comments', 'surface' ) );
	$comments = ob_get_clean();
	
	/** Output */
	$comments = sprintf( '<a href="%s">%s</a>', esc_url( get_comments_link() ), $comments );
	$output = sprintf( '<li><span class="comments-link">%1$s</span></li>', $comments );
	return $output;
}

/** Surface Post Categories */
function surface_post_category() {
	
	$categories_list = get_the_category_list( ', ' );
	if ( ! $categories_list ) {
		return;
	}
		
	$output = sprintf( '<span class="cat-links"><span class="%1$s">'. __( 'Posted in:', 'surface' ) .'</span> %2$s</span>', 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
	return $output;
}

/** Surface Post Tags */
function surface_post_tags() {
	
	$tags_list = get_the_tag_list( '', ', ' );
	if ( ! $tags_list ) {
		return;
	}
		
	$output = sprintf( '<span class="entry-meta-sep"> / </span><span class="tag-links"><span class="%1$s">'. __( 'Tagged:', 'surface' ) .'</span> %2$s</span>', 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
	return $output;
}

/** Surface Link Pages */
function surface_link_pages() {
	return wp_link_pages( array( 
		
		'before' => '<div class="page-link"><span class="assistive-text">'. __( 'Pages:', 'surface' ) .'</span>',
		'after' => '</div>',
		'link_before' => '<span>',
		'link_after' => '</span>',
		'echo' => 0
		
		)
	);
}

/** Surface Post Style */
function surface_post_style() {
	
	$surface_options = surface_get_settings();
	
	if( $surface_options['surface_post_style'] == 'excerpt' ):		
		the_excerpt();	
	else:		
		the_content( __( 'Read More', 'surface' ) . ' <span class="meta-nav">&rarr;</span>' );	
	endif;

}

/** Surface Featured Image */
function surface_featured_image() {
	
	$surface_options = surface_get_settings();
	
	if( $surface_options['surface_post_style'] != 'excerpt' ):		
		return;
	endif;
	
	$img = surface_get_image( array( 'format' => 'html', 'size' => 'featured', 'attr' => array( 'class' => 'entry-image' ) ) );
	
	if( empty( $img ) ):		
		return;
	endif;
	
	printf( '<div class="entry-featured-image"><a href="%s" title="%s">%s</a></div>', esc_url( get_permalink() ), the_title_attribute( 'echo=0' ), $img );

}

/** Surface Loop Navigation */
function surface_loop_nav() {

	global $wp_query;	
	
	if ( $wp_query->max_num_pages > 1 ) :
		
		$surface_options = surface_get_settings();
		
		if ( $surface_options['surface_post_nav_style'] == 'numeric' ) :		
			
			surface_loop_nav_numeric();		
		
		else:		
			
			surface_loop_nav_next_prev();		
		
		endif;
	
	endif;

}

/** Surface Loop Navigation Numeric */
function surface_loop_nav_numeric() {
	
	global $wp_query;
	$big = 999999999; // Need an unlikely integer
	$args = array(
		'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages
	);
	
?>
<div id="loop-nav-numeric" class="nav-numeric">
  <h3 class="assistive-text"><?php _e( 'Post Navigation', 'surface' ); ?></h3>
  <?php echo paginate_links( $args ); ?>
  <div class="clear"></div>
</div> <!-- end #loop-nav-numeric -->
<?php	
}

/** Surface Loop Navigation Next/Prev */
function surface_loop_nav_next_prev() {
	
	ob_start();
	next_posts_link( '<span class="meta-nav">&larr;</span> '. __( 'Older Posts', 'surface' ) );
	$next_posts_link = ob_get_clean();
	
	ob_start();
	previous_posts_link( __( 'Newer Posts', 'surface' ) .' <span class="meta-nav">&rarr;</span>' );
	$previous_posts_link = ob_get_clean();
	
	$next_posts_link = ( empty( $next_posts_link ) )? '&nbsp;' : $next_posts_link;
	$previous_posts_link = ( empty( $previous_posts_link ) )? '&nbsp;' : $previous_posts_link;	

?>
<div id="loop-nav-next-prev">
  <h3 class="assistive-text"><?php _e( 'Post Navigation', 'surface' ); ?></h3>
  <div class="loop-nav-previous grid_4 alpha">
    <?php echo $next_posts_link; ?>
  </div>
  <div class="loop-nav-next grid_5 omega">
	<?php echo $previous_posts_link; ?>
  </div>
  <div class="clear"></div>
</div> <!-- end #loop-nav-next-prev -->
<?php
}

/** Surface Loop Navigation Singular Post */
function surface_loop_nav_singular_post() {
	
	ob_start();
	previous_post_link( '%link', '<span class="meta-nav">&larr;</span> '. __( 'Previous Post', 'surface' ) );
	$previous_post_link = ob_get_clean();
	  
	ob_start();
	next_post_link( '%link', __( 'Next Post', 'surface' ) . ' <span class="meta-nav">&rarr;</span>' );
	$next_post_link = ob_get_clean();
	  
	$previous_post_link = ( empty( $previous_post_link ) )? '&nbsp;' : $previous_post_link;	
	$next_post_link = ( empty( $next_post_link ) )? '&nbsp;' : $next_post_link;

?>
<div id="loop-nav-singlular-post">
  <h3 class="assistive-text"><?php _e( 'Post Navigation', 'surface' ); ?></h3>
  <div class="loop-nav-previous grid_4 alpha">
    <?php echo $previous_post_link; ?>
  </div>
  <div class="loop-nav-next grid_5 omega">
	<?php echo $next_post_link; ?>
  </div>
  <div class="clear"></div>    
</div><!-- end #loop-nav-singular-post -->
<?php
}

/** Surface Loop Navigation Singular */
function surface_loop_nav_singular() {
	global $post;
?>
<div id="loop-nav-singular">
  <h3 class="assistive-text"><?php _e( 'Post Navigation', 'surface' ); ?></h3>
  <div class="loop-nav-standard"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"> <?php _e( '&larr; Return to', 'surface' ); ?> <?php echo get_the_title( $post->post_parent ); ?></a></div>
</div><!-- end #loop-nav-singular -->
<?php
}

/** Surface Loop Navigation Singular Attachment */
function surface_loop_nav_singular_attachment() {
	
	ob_start();
	previous_image_link( 'thumbnail' );
	$previous_image_link = ob_get_clean();
	  
	ob_start();
	next_image_link( 'thumbnail' );
	$next_image_link = ob_get_clean();
	  
	$previous_image_link = ( empty( $previous_image_link ) )? '&nbsp;' : '<p>' . $previous_image_link . '</p>';	
	$next_image_link = ( empty( $next_image_link ) )? '&nbsp;' : '<p>' . $next_image_link . '</p>';

?>
<div id="loop-nav-singlular-attachment">
  <h3 class="assistive-text"><?php _e( 'Attachment Navigation', 'surface' ); ?></h3>
  <div class="loop-nav-previous grid_4 alpha">
    <?php echo $previous_image_link; ?>
  </div>
  <div class="loop-nav-next grid_3 omega">
	<?php echo $next_image_link; ?>
  </div>
  <div class="clear"></div>    
</div><!-- end #loop-nav-singular-attachment -->
<?php
}

/** Surface Author */
function surface_author() {
if ( get_the_author_meta( 'description' ) && is_multi_author() ) :	
?>
<div id="author-info">
  
  <div id="author-avatar" class="grid_2 alpha">
    <div id="author-avatar-inside">  
	  <?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
    </div>
  </div> <!-- #author-avatar -->
  
  <div id="author-description" class="grid_7 omega">
    
      <h3><?php printf( __( 'About %s', 'surface' ), get_the_author() ); ?></h3>
      <p><?php the_author_meta( 'description' ); ?></p>
      <div id="author-link">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( __( 'View all posts by %s', 'surface' ) . ' <span class="meta-nav">&rarr;</span>', get_the_author() ); ?></a>
      </div> <!-- #author-link	-->
  
  </div> <!-- #author-description -->
  
  <div class="clear"></div>
</div> <!-- #author-info -->
<?php
endif;
}

/** Surface Footer */
add_action( 'surface_footer', 'surface_footer_init' );
function surface_footer_init() {
	
	$surface_theme_data = surface_theme_data();
	$surface_options = surface_get_settings();	

?>
<div class="surface-blog grid_8">
  <?php echo htmlspecialchars_decode ( esc_html ( $surface_options['surface_copyright'] ) ); ?>
</div>
<div class="surface-project grid_4">
  Designed by <a href="<?php echo $surface_theme_data->get( 'AuthorURI' ); ?>" title="ThemeSurface">ThemeSurface</a><span class="entry-meta-sep"> / </span><a href="http://wordpress.org/" title="WordPress">WordPress</a>
</div>
<div class="clear"></div>
<?php	
}

/** Surface Comment List */
function surface_comment( $comment, $args, $depth ) {
  
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) {
		case 'pingback':
		case 'trackback':
?>
			<li class="post pingback">
				<p><?php _e( 'Pingback:', 'surface' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'surface' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
		break;
		default:
		?>
			
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				
				<div id="comment-<?php comment_ID(); ?>" class="comment">
	    
					<div class="comment-meta">
						<div class="comment-author vcard">
		    
							<?php
                            $avatar_size = 60;
                            if ( '0' != $comment->comment_parent ) {
                            	$avatar_size = 60;
                            }                            
                            echo get_avatar( $comment, $avatar_size );
							?>
                            
                            <?php                            
                            printf( '%1$s on %2$s <span class="says">%3$s</span>',
                            	sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                            	sprintf( '<a href="%1$s"><span pubdate datetime="%2$s">%3$s</span></a>', esc_url( get_comment_link( $comment->comment_ID ) ), get_comment_time( 'c' ), sprintf( '%1$s at %2$s', get_comment_date(), get_comment_time() ) ),
								__( 'said:', 'surface' )
                            );                            
                            ?>

							<?php edit_comment_link( __( 'Edit', 'surface' ), '<span class="edit-link">', '</span>' ); ?>
		  
						</div> <!-- end .comment-author .vcard -->

						<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'surface' ); ?></em><br />
						<?php endif; ?>

					</div> <!-- end .comment-meta -->

					<div class="comment-content">
					  <?php comment_text(); ?>
                    </div> <!-- end .comment-content -->

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'surface' ) . '<span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
		
				</div><!-- end #comment-<?php comment_ID(); ?> -->

		<?php
		break;
	
	} // switch ( $comment->comment_type )

}

/** Filter 'wp_title' to output contextual content. */
add_filter( 'wp_title', 'surface_wp_title', 10, 2 );
function surface_wp_title( $title, $separator ) {
	
	/** Don't affect wp_title() calls in feeds. */
	if ( is_feed() ) {
		return $title;
	}

	/**
	 * The $paged global variable contains the page number of a listing of posts.
	 * The $page global variable contains the page number of a single post that is paged.
	 * We'll display whichever one applies, if we're not looking at the first page.
	 */
	global $paged, $page;

	if ( is_search() ) {		
		
		/** If we're a search, let's start over: */
		$title = sprintf( 'Search results for %s', '"' . get_search_query() . '"' );
		/** Add a page number if we're on page 2 or more: */
		if ( $paged >= 2 ) {
			$title .= " ". $separator ." " . sprintf( 'Page %s', $paged );
		}
		/** Add the site name to the end: */
		$title .= " ". $separator ." " . get_bloginfo( 'name', 'display' );
		/** We're done. Let's send the new title back to wp_title(): */
		return $title;
	
	}

	/** Otherwise, let's start by adding the site name to the end: */
	$title .= get_bloginfo( 'name', 'display' );

	/** If we have a site description and we're on the home/front page, add the description: */
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " ". $separator ." " . $site_description;
	}

	/** Add a page number if necessary: */
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $separator " . sprintf( 'Page %s', max( $paged, $page ) );
	}

	/** Return the new title to wp_title(): */
	return $title;
}

/** Sets the post excerpt length. */
add_filter( 'excerpt_length', 'surface_excerpt_length' );
function surface_excerpt_length( $length ) {
	return 35;
}

/** Returns a "Read more" link for content */
add_filter( 'the_content_more_link', 'surface_content_more_link', 10, 2 );
function surface_content_more_link( $more_link, $more_link_text ) {
	return str_replace( $more_link_text, '<span>'. __( 'Read More ...', 'surface' ) .'</span>', $more_link );
}

/** Returns a "Read more" link for excerpts */
function surface_continue_reading_link() {
	return '<span class="more-link-wrap"><a href="'. esc_url( get_permalink() ) . '" class="more-link"><span>'. __( 'Read More ...', 'surface' ) .'</span></a></span>';
}

/** Replaces "[...]" (appended to automatically generated excerpts) with surface_continue_reading_link(). */
add_filter( 'excerpt_more', 'surface_auto_excerpt_more' );
function surface_auto_excerpt_more( $more ) {
	return ' <span class="ellipsis">&hellip;</span> ' . surface_continue_reading_link();
}	

/** Adds a pretty "Read more" link to custom post excerpts. */
add_filter( 'get_the_excerpt', 'surface_custom_excerpt_more' );
function surface_custom_excerpt_more( $output ) {
	
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= ' <span class="ellipsis">&hellip;</span> ' . surface_continue_reading_link();
	}
	return $output;

}

/** Remove WP Gallery CSS */
add_filter( 'use_default_gallery_style', '__return_false' );
?>