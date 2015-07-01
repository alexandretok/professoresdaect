<?php
/**
 * The template for displaying Sidebar Widgets
 *
 * @package ezyreader
 */
?>
<!--Left Sidebar Starts--> 
<div class="sidebar">
	<?php do_action( 'before_sidebar' ); ?>
        <?php 
        if( is_active_sidebar('sidebar-left') ) :
            dynamic_sidebar( 'sidebar-left' );
        else: ?>
	    <div class="widget">
          <h2 class="widget-title">Archives</h2>
             <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
             </ul>
        </div>
    <?php endif; ?>
</div>
<!--Left Sidebar Ends--> 