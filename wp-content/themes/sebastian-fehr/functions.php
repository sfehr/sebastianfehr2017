<?php
/**
 * sebastian fehr functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sebastian_fehr
 */



if ( ! function_exists( 'sebastian_fehr_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sebastian_fehr_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on sebastian fehr, use a find and replace
	 * to change 'sebastian-fehr' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sebastian-fehr', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'sebastian-fehr' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sebastian_fehr_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'sebastian_fehr_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sebastian_fehr_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sebastian_fehr_content_width', 640 );
}
add_action( 'after_setup_theme', 'sebastian_fehr_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sebastian_fehr_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sebastian-fehr' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sebastian-fehr' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'sebastian_fehr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sebastian_fehr_scripts() {
	wp_enqueue_style( 'sebastian-fehr-style', get_stylesheet_uri() );

	wp_enqueue_script( 'sebastian-fehr-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'sebastian-fehr-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	// Top anchor script for footer
	wp_enqueue_script( 'top-anchor-js', get_template_directory_uri() . '/js/top-anchor.js', array('jquery'), '', true );
	
	// Load the JS script (container width in %) not on the index page
	if ( is_page( 'index' ) != true ) {
		//Image Slider script on front page 
		wp_enqueue_script( 'sebastian-fehr-w3-slider', get_template_directory_uri() . '/js/w3-slider.js', array('jquery'), '', $in_footer = true);
		
		//Hammer Script for Swipe function on mobile site
		wp_enqueue_script( 'hammer-swipe', 'http://hammerjs.github.io/dist/hammer.min.js', array(), '', $in_footer = true);
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
	
}
add_action( 'wp_enqueue_scripts', 'sebastian_fehr_scripts' );


//SF: Scripts for the Admin Panel
/*
function sebastian_fehr_admin_load_scripts($hook) {
	//SF: JS for CMB2 Metabox (only in the admin panel). Conditional Media Selection Field.
	if( $hook != 'post.php' && $hook != 'post-new.php' ){
		return;
	}
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/cmb2_media_selection.js' );
}
add_action('admin_enqueue_scripts', 'sebastian_fehr_admin_load_scripts');
*/

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


/** SF:
 * Load CMB2 functions
 */
require_once( dirname(__FILE__) . '/inc/sebastianfehr-cmb2-functions.php');

/** SF:
 * Load CMB2-Flexible-Content Plugin
 */
require '/home/httpd/vhosts/sebastianfehr.com/httpdocs/wp-content/plugins/cmb2-flexible-content/cmb2-flexible-content-field.php';

/** SF:
 * remove width & height attributes from images
 */
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

/** SF:
 * Player Controls Filter
 */
function imp_custom_youtube_querystring( $html, $url, $args ) {
	if(strpos($html, 'youtube')!= FALSE) {
		$args = [
			'rel' => 0,
			'controls' => 0,
			'showinfo' => 0,
			'modestbranding' => 1,
			'autoplay' => 1,
			'disablekb' => 1,
			'loop' => 1,
			'iv_load_policy' => 3,
			'start' => 0,
		];
		$params = '?feature=oembed&';
		foreach($args as $arg => $value){
			$params .= $arg;
			$params .= '=';
			$params .= $value;
			$params .= '&';
		}
		
//		$result = str_replace( '?feature=oembed', $params, $html );
		$html = str_replace( '?feature=oembed', $params, $html );
	}
	return $html;
}
add_filter('oembed_result', 'imp_custom_youtube_querystring', 10, 3);
