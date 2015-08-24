<div class="clear"></div>
<?php if( is_active_sidebar('adspacefooter' )) dynamic_sidebar( 'adspacefooter' ); ?>
	</div> <!-- Container ends -->
</div> <!-- Wrap ends-->

<div class="clear"></div>
<!--Full width footer starts here-->
<div id="footer">
	<div class="footerwrap">
		<?php if( is_active_sidebar('footer-widget' )) dynamic_sidebar( 'footer-widget' );?>
<div class="clear"></div>

    <div class="footercopyright">
     Copyright &copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. <?php _e('Powered by', 'ezyreader'); ?> 
                        <a href="//wordpress.org" title="WordPress"><?php _e('WordPress', 'ezyreader'); ?></a> &amp; <a href="http://www.techtivesolutions.com/wpthemes/ezyreader/" title="<?php _e('ezyreader', 'ezyreader'); ?>"><?php _e('ezyreader', 'ezyreader'); ?></a>
    
    </div>

	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>