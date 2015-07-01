<?php
/*-----------------------------------------*/
/* ezyreader Wordpress Theme Setup
/*-----------------------------------------*/ 

if ( ! isset( $content_width ) ) $content_width = 650;

/*-------------------------------------------------*/
/*	Add theme support 
/*-------------------------------------------------*/ 
function ezyreader_setup(){
	//// Make Menu
	  register_nav_menus(
		array(
		  'header-menu' => __( 'Header Menu', 'ezyreader' ),
		)
	  );
	/////////////

	//// Add Image Thumbnail Support in post/blog page
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300, '', true );
	//add_image_size( 'full-width', 500, '' , true );
	
	add_image_size( 'medium', 320, '', true); // Medium Thumbnail
    add_image_size( 'small', 50, 50 , true); // Small Thumbnail
    add_image_size( 'fullwidth', 540, null, true );
    add_image_size( 'slider', 900, 380, true );
	//////////////////

	///// Add support for other media files 
	add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
		) );
	////

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 
		'comment-form',
		'comment-list',
	) );
	
	
	add_theme_support( 'custom-background', array(
		'default-color' => 'eeeeee',
	) );
	
	
}
add_action( 'after_setup_theme', 'ezyreader_setup' );
add_theme_support('woocommerce');


/*-------------------------------------------------*/
/*	Load stylesheet and scripts dynamically
/*-------------------------------------------------*/ 
function ezyreader_scripts() {
	//wp_enqueue_style( $handle, $src, $deps, $ver, $media );
	wp_enqueue_style( 'ezyreader-main', get_stylesheet_uri() );
	wp_enqueue_style( 'ezyreader-navigationCss', get_template_directory_uri() . '/css/dropmenu.css', '1.0' );
	wp_enqueue_style( 'ezyreader-responsive', get_template_directory_uri() . '/css/responsive.css', '1.0' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', '1.0' );
	// Using Google Fonts
	wp_enqueue_style( 'open-google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans', array(), null );
	wp_enqueue_style( 'roboto-google-fonts', 'http://fonts.googleapis.com/css?family=Roboto', array(), null );
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'dropmenu', get_template_directory_uri() . '/js/dropmenu.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ezyreader_scripts' );


/*-------------------------------------------------*/
/*	Sidebar & Widgets
/*-------------------------------------------------*/ 
function ezyreader_widgets(){
	
	
		///// Sidebar left Widgets
	register_sidebar(array(
		'name' => __( 'Sidebar Left', 'ezyreader'),
		'id' => 'sidebar-left',
		'description' => __( 'Widgets in this area will be shown on the Left sidebar.', 'ezyreader' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
	

	///// Sidebar Widgets
	register_sidebar(array(
		'name' => __( 'Sidebar Right', 'ezyreader'),
		'id' => 'sidebar',
		'description' => __( 'Widgets in this area will be shown on the Right sidebar.', 'ezyreader' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
	

	///// Sidebar Widgets
	register_sidebar(array(
		'name' => __( 'Adspace Footer', 'ezyreader'),
		'id' => 'adspacefooter',
		'description' => __( 'Show advertisment banners above the footer after the content.', 'ezyreader' ),
		'before_widget' => '<div id="%1$s" class="adbanners %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
	
	
	// Footer widgets
    register_sidebar(array(
        'name' => __('FooterWidget', 'ezyreader'),
        'description' => __('Add widget to your footer area (max 4 widgets)', 'ezyreader'),
        'id' => 'footer-widget',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
    ));
	////////////////////
   register_widget( 'social_widget' );
}
add_action( 'widgets_init', 'ezyreader_widgets' );
require_once get_template_directory() . '/social-widget.php';

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return ' <a class="linkred" href="'. get_permalink($post->ID) . '">[...more]</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Customizer option to add logo to the site
function ezyreader_theme_customizer( $wp_customize ) {
	
    $wp_customize->add_section( 'ezyreader_logo_section' , array(
    'title'       => __( 'Logo', 'ezyreader' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
	) );
	
	$wp_customize->add_setting( 'ezyreader_logo' );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ezyreader_logo', array(
		'label'    => __( 'Logo', 'ezyreader' ),
		'section'  => 'ezyreader_logo_section',
		'settings' => 'ezyreader_logo',
	) ) );
}
add_action('customize_register', 'ezyreader_theme_customizer');