<?php
/**
 * The template is for displaying search results
 *
 * @package WordPress
 * @subpackage ezyreader
 */

get_header(); ?>

<?php if (have_posts()) : ?>

<div class="pagetitle"><h1 style="">Search results for: <?php the_search_query(); ?></h1></div>

<div class="column-three-fourth">

<?php get_search_form(); ?>

<?php while (have_posts()) : the_post(); 

		get_template_part('content'); 

 endwhile;
 
	get_template_part('nav');
 
		
else : 
		
		get_template_part( 'content', 'none' ); 

endif; ?>

</div><!-- column-three-fourth ends -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>