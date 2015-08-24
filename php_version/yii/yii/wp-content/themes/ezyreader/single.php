<?php
/**
 * The template for displaying single posts
 *
 * @package WordPress
 * @subpackage ezyreader
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="pagetitle"><h1 style=""><?php the_title(); ?></h1></div>

<div class="column-three-fourth">

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
        <div class="postdetails">
            <i class="fa fa-calendar"></i> <?php the_time('M j, Y'); ?> | 
            <i class="fa fa-user"></i> <?php the_author_posts_link(); ?>
            
      <?php
	  /// Check if comments are open
	   if ( comments_open() ) :
  echo ' | <i class="fa fa-comments"></i> ';
  comments_popup_link( 'Say something', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
endif;
           ?> 
		<?php
		/// Check if the post is sticky
		 if( is_sticky() ) : ?>
        | <i class="fa fa-paperclip"></i> <i><?php _e( 'Sticky post', 'ezyreader' ); ?></i>
        <?php endif; ?>
            
        </div>

	<?php the_content(); ?>
    
    <p>
        Posted in: <?php the_category(', ', ' '); ?>
        <?php the_tags('  | <i class="fa fa-tags"></i> Tags: ',', ',''); ?>
    </p>
    
    <div class="clear"></div>
<?php edit_post_link( __( 'Edit', 'ezyreader' ), '', '' ); ?>
    
</div><!-- .post -->

<div class="clear"></div>
    <div class="nav-links">
          <?php previous_post_link( '<div class="floatleft">%link</div>', '&laquo; %title' ); ?>
          <?php next_post_link( '<div class="floatright">%link</div>', '%title &raquo; ' ); ?>
    </div>
    
 <div class="clear"></div>   
   <?php
			wp_link_pages( array(
				'before' => '<div class="nav-links">' . __( 'Pages:', 'ezyreader' ),
				'after'  => '</div>',
			) );
		?>
    
    
<div class="clear"></div>

    <div class="comments">
    <?php 
     //   if ( comments_open() || get_comments_number() ) {
	        comments_template(); //}
    ?>
	<?php endwhile; 
    
		else :
	?>
		<h2>Page not found.</h2>
        
<?php endif; ?>

</div><!-- column-three-fourth ends -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>