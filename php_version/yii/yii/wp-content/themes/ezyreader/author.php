<?php
/**
 * The template for displaying Author archive pages
 *
 * @package WordPress
 * @subpackage ezyreader
 */

get_header(); ?>
	<?php if ( have_posts() ) : ?>

	<div class="pagetitle">
    	<h1 style="">
					<?php
						/*
						 * Queue the first post, that way we know what author
						 * we're dealing with (if that is the case).
						 *
						 * We reset this later so we can run the loop properly
						 * with a call to rewind_posts().
						 */
						the_post();

						printf( __( 'All posts by %s', 'ezyreader' ), get_the_author() );
					?>
		</h1>
	</div>	
<div class="column-three-fourth">

				<?php if ( get_the_author_meta( 'description' ) ) : ?>
					<p><strong><?php the_author_meta( 'description' ); ?></strong></p>
                    
				<?php endif; ?>

			<?php
					/*
					 * Since we called the_post() above, we need to rewind
					 * the loop back to the beginning that way we can run
					 * the loop properly, in full.
					 */
					rewind_posts();

					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part('content');

					endwhile;
					// Previous/next page navigation.
							get_template_part('nav');

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>

</div><!-- column-three-fourth ends -->
<?php
get_sidebar();
get_footer();