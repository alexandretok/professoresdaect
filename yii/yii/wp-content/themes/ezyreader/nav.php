<?php
			if(function_exists('wp_pagenavi')) :
				wp_pagenavi(); 
			else :
?>
<div class="nav-links">
	<div class="floatleft"><?php next_posts_link('&lArr; Previous Post'); ?></div>
    <div class="floatright"><?php previous_posts_link('Next Post &rArr;'); ?></div>
</div>
<?php endif; ?>