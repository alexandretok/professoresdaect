<?php
/**
 * Main Index template
 *
 * @package WordPress
 * @subpackage ezyreader
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>

<div class="pagetitle">
	<h1 style="">Blog</h1>
</div>

<?php get_template_part('sidebarleft'); ?>

<div class="column-content">

<?php while (have_posts()) : the_post();
		
			get_template_part('content'); /// Get the posts

		endwhile;
	
	get_template_part('nav'); //// Get the posts navigation
	
	else : 
    
 get_template_part('content', 'none'); /// This will show when nothing is found ?> 

<?php endif; ?>

</div><!-- column-three-fourth ends -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>