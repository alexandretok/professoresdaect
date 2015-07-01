<?php
/**
 * This template will show when nothing is found
 *
 * @package WordPress
 * @subpackage ezyreader
 */
?>
<div class="pagetitle"><h1 style=""><?php _e( 'Nothing Found', 'ezyreader' ); ?></h1></div>

<div class="column-three-fourth">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ezyreader' ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ezyreader' ); ?></p>
	<?php get_search_form(); ?>

	<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ezyreader' ); ?></p>
	<?php get_search_form(); ?>

	<?php endif; ?>
