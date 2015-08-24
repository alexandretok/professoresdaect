<?php
/**
 * Main Loop for the posts
 *
 * @package WordPress
 * @subpackage ezyreader
 */
?>
<div class="post">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
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
      </div>

<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : ?>
       
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail();  ?>
			</a>
       
		<?php endif; ?>
<!-- /post thumbnail -->

<?php the_excerpt(); ?> 

</div>