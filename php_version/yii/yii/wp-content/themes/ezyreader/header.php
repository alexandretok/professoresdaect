<?php
/*
 * The Header template for our theme
 * @package WordPress
 * @subpackage ezyreader
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="wrap">
	<div class="container">

     <!-- Header START -->
<div class="header">    
     <!-- Logo START -->
    	<div class="logo">
        <?php if ( get_theme_mod( 'ezyreader_logo' ) ) : ?>
        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'ezyreader_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
<?php else : ?>
        <h2><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h2>
        <?php bloginfo( 'description' ); ?>
<?php endif; ?>
        </div>
    <!-- Logo Ends -->
</div>
     <!-- Header Ends -->

     <!-- navigation START here -->
       <?php
			if(has_nav_menu('header-menu')){
				wp_nav_menu(array(
					'theme_location'  => 'header-menu',
					'container'       => 'div',
					'container_class' => 'nav',
					'container_id'    => 'menu',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu'
					 ));
			}else {
			?>
                <div class="nav" id="menu">
                    <ul>
	                    <?php wp_list_pages('title_li='); ?>
                    </ul>
                </div>
			<?php
			}
			?>
      <!-- navigation Ends here -->     
      <!-- Responsive navigation START here This will not show in normal screens-->
      <div id="menu-icon" class="btnlink">Menu</div>
         <?php
			if(has_nav_menu('header-menu')){
				wp_nav_menu(array(
				'theme_location'  => 'header-menu',
				'menu'            => '',
				'container'       => 'div',
				'container_class' => 'nav-responsive',
				'container_id'    => 'nav-responsive',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu'
				));
			
			}else {
			?>
                <div class="nav-responsive" id="nav-responsive">
                    <ul>
	                    <?php wp_list_pages('title_li='); ?>
                    </ul>
                </div>
			<?php
			}
			?>
       <!-- Responsive navigation Ends here This will not show in normal screens-->
     
<div class="clear"></div>