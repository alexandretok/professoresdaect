<?php
/**
 * The template for displaying Sidebar Widgets
 *
 * @package ezyreader
 */
?>
<!--Right Sidebar Starts--> 
<div class="sidebar">
	<?php do_action( 'before_sidebar' ); ?>
        <?php 
        if( is_active_sidebar('sidebar') ) :
            dynamic_sidebar( 'sidebar' );
        else: ?>
	    <div class="widget">
          <h2 class="widget-title">Search</h2>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</div>
<!--Right Sidebar Ends--> 