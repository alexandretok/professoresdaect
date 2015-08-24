<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required()) { ?>
		<p class="fontred">This post is password protected. Enter the password to view comments.</p></div>
	<?php	return; }
?>

<?php if ( have_comments() ) : ?>
	
	<h2 id=""><?php comments_number('No Responses', 'One Response', '% Responses' ); ?></h2>

	<ol class="commentlist">
	<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 34, 
			) );
		?>
	</ol>
   
   <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
    <div class="navigation">
		<div class="next-posts"><?php previous_comments_link( __( '&larr; Older Comments', 'ezyreader' ) ); ?></div>
		<div class="prev-posts"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ezyreader' ) ); ?></div>
	</div>
<?php  endif; ?>

<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) )  : ?>

	<p class="no-comments fontred">
	<?php _e( 'Comments are closed.', 'ezyreader' ); ?></p> 
    
	<?php endif; // have_comments() ?>

<?php comment_form(); ?></div>