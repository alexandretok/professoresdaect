<?php
/**
 * This is simple page template
 *
 * @package WordPress
 * @subpackage ezyreader
 */
?>
<?php get_header(); ?>

<div class="pagetitle">
<h1 style=""><?php the_title(); ?></h1>
</div>
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

<div class="clear"></div>

	<?php edit_post_link( __( 'Edit', 'ezyreader' ), '', '' ); ?>

<div class="clear"></div>
	<?php
    // If comments are open or we have at least one comment, load up the comment template
    if ( comments_open() || '0' != get_comments_number() )  ?>
    <div class="comments">            
    <?php comments_template(); ?>

<div class="clear"></div>

	<?php
    wp_link_pages( array(
    'before' => '<div class="nav-links">' . __( 'Pages:', 'ezyreader' ),
    'after'  => '</div>',
    ) );
    ?>





<?php endwhile; ?>

	<?php else: ?>
	
			<h2><?php _e( 'Sorry, nothing to display.', 'ezyreader' ); ?></h2>
	
	<?php endif; ?>



</div><!-- column-three-fourth ends -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>