<?php
/*
Template Name: Page-left-sidebar
*/
?>
<?php get_header(); ?>

<div class="pagetitle">
<h1 style=""><?php the_title(); ?></h1>
</div>

<?php get_template_part('sidebarleft'); ?>

<div class="column-three-fourth">
<?php if ( have_posts()): while ( have_posts() ) : the_post(); ?>
<!-- post thumbnail -->

		<?php if ( has_post_thumbnail()) : ?>
<div class="page-featured-img">       
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail();  ?>
			</a>
</div>       
		<?php endif; ?>

<!-- /post thumbnail -->

<?php the_content(); ?>

<?php edit_post_link( __( 'Edit', 'ezyreader' ), '', '' ); ?>

	<?php
    // If comments are open or we have at least one comment, load up the comment template
    if ( comments_open() || '0' != get_comments_number() )  ?>
    <div class="comments">            
    <?php comments_template(); ?>



<?php endwhile; ?>

	<?php else: ?>
	
			<h2><?php _e( 'Sorry, nothing to display.', 'ezyreader' ); ?></h2>
			
	<?php endif; ?>
</div><!-- main -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>