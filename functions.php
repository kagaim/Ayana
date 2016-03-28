<?php
/**
 * Ayana functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Ayana
 */

if ( ! function_exists( 'kgm_ayana_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kgm_ayana_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Ayana, use a find and replace
	 * to change 'kgm_ayana' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'kgm_ayana', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
    add_image_size('large-thumb', 1180, 650, true);
    add_image_size('featured-thumb', 1180, 550, true);
    add_image_size( 'tiled-thumb', 250, 250, true );
    add_image_size( 'rposts-thumb', 500, 380, true );
    add_image_size( 'lposts-thumb', 390, 430, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'kgm_ayana' ),
		'social' => esc_html__( 'Social Menu', 'kgm_ayana' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'gallery',
		'audio',
		'video',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'kgm_ayana_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // kgm_ayana_setup
add_action( 'after_setup_theme', 'kgm_ayana_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kgm_ayana_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kgm_ayana_content_width', 640 );
}
add_action( 'after_setup_theme', 'kgm_ayana_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kgm_ayana_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'kgm_ayana' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widgets', 'kgm_ayana' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Instagram Widget', 'kgm_ayana' ),
        'id'            => 'sidebar-3',
        'description'   => esc_html__( 'Instagram widget area appears in the footer of the site. Use the "Text" widget to display the Instagram Feed using the "Instagram Feed Plugin" shortcode.', 'kgm_ayana' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<div id="instagram-title"><h2 class="widget-title">',
        'after_title'   => '</h2></div>',
    ) );
}
add_action( 'widgets_init', 'kgm_ayana_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kgm_ayana_scripts() {
	wp_enqueue_style( 'kgm_ayana-style', get_stylesheet_uri() );
    
    if ( is_page() ) {
        if ( is_page_template( 'page-templates/page-nosidebar.php' ) ) {
            wp_enqueue_style( 'kgm_ayana-layout-style' , get_template_directory_uri() . '/layouts/no-sidebar.css');
        } else if ( is_page_template( 'page-templates/page-leftsidebar.php' ) ) {
            wp_enqueue_style( 'kgm_ayana-layout-style' , get_template_directory_uri() . '/layouts/sidebar-content.css');
        } else {
            wp_enqueue_style( 'kgm_ayana-layout-style' , get_template_directory_uri() . '/layouts/content-sidebar.css');
        }
    } 
    
    if ( !get_theme_mod( 'kgm_ayana_website_layout' ) && !is_page() ) {
        wp_enqueue_style( 'kgm_ayana-layout-style' , get_template_directory_uri() . '/layouts/content-sidebar.css');
    }

        
    wp_enqueue_style( 'kgm_ayana-slicknav-style' , get_template_directory_uri() . '/css/slicknav.css');
    
    wp_enqueue_style( 'kgm_ayana-bxslider-style' , get_template_directory_uri() . '/css/bxslider.css');
    
    wp_enqueue_style( 'kgm_ayana-magnific-popup-style' , get_template_directory_uri() . '/css/magnific-popup.css');
    
    wp_enqueue_style( 'kgm_ayana-google-fonts', 'https://fonts.googleapis.com/css?family=Ovo|Muli:400,300,300italic,400italic' );
    
    wp_enqueue_style( 'kgm_ayana-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css' );

	wp_enqueue_script( 'kgm_ayana-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
    wp_enqueue_script( 'kgm_ayana-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), '20150905', true );
	
	wp_enqueue_script( 'kgm_ayana-slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array('jquery'), '20150801', true );
	
	wp_enqueue_script( 'kgm_ayana-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '20150902', true );
    
	wp_enqueue_script( 'kgm_ayana-bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), '20150901', true );
    
	wp_enqueue_script( 'kgm_ayana-sticky-anything', get_template_directory_uri() . '/js/jq-sticky-anything.min.js', array('jquery'), '20150909', true );
    
	wp_enqueue_script( 'kgm_ayana-scripts', get_template_directory_uri() . '/js/ayana.js', array('jquery'), '20150831', true );
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kgm_ayana_scripts' );

/**
 * Enqueue admin scripts.
 */
if (! function_exists('kgm_ayana_admin_scripts')) {
    function kgm_ayana_admin_scripts() {
        wp_enqueue_script( 'kgm_ayana-meta-boxes', get_template_directory_uri() . '/js/meta-boxes.js', array('jquery'), '', true );
    }

    add_action('admin_enqueue_scripts', 'kgm_ayana_admin_scripts');
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Register TGM Plugin.
 */
require get_template_directory() . '/inc/tgm-setup.php';

/**
 * Register metaboxes.
 */
require get_template_directory() . '/inc/meta-boxes.php';
