<?php
/**
 * CE Membership functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CE_Membership
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ce_membership_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on CE Membership, use a find and replace
		* to change 'ce_membership' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ce_membership', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'ce_membership' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'ce_membership_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'ce_membership_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ce_membership_widgets_init() {
	// Top Bar
    register_sidebar(array(
		'name'          => esc_html__('Top Bar', 'bootscore'),
		'id'            => 'top-bar',
		'description'   => esc_html__('Add widgets here.', 'bootscore'),
		'before_widget' => '<div class="widget top-bar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title d-none">',
		'after_title'   => '</div>'
	  ));  
  
	  // Top Nav
	  register_sidebar(array(
		'name'          => esc_html__('Top Nav', 'bootscore'),
		'id'            => 'top-nav',
		'description'   => esc_html__('Add widgets here.', 'bootscore'),
		'before_widget' => '<div class="widget top-nav-widget ms-1 ms-md-2">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title d-none">',
		'after_title'   => '</div>'
	  ));
  
	  // Top Nav 2
	  // Adds a widget next to the Top Nav position but moves to offcanvas on <lg breakpoint
	  register_sidebar(array(
		'name'          => esc_html__('Top Nav 2', 'bootscore'),
		'id'            => 'top-nav-2',
		'description'   => esc_html__('Add widgets here.', 'bootscore'),
		'before_widget' => '<div class="widget top-nav-widget-2 d-lg-flex align-items-lg-center mt-2 mt-lg-0 ms-lg-2">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title d-none">',
		'after_title'   => '</div>'
	  ));
  
	  // Top Nav Search
	  register_sidebar(array(
		'name'          => esc_html__('Top Nav Search', 'bootscore'),
		'id'            => 'top-nav-search',
		'description'   => esc_html__('Add widgets here.', 'bootscore'),
		'before_widget' => '<div class="widget top-nav-search">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title d-none">',
		'after_title'   => '</div>'
	  ));
}
add_action( 'widgets_init', 'ce_membership_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ce_membership_scripts() {
	wp_enqueue_style( 'ce_membership-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'ce_membership-style', 'rtl', 'replace' );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/dist/bootstrap.bundle.min.js', array('jquery'), '4.3.1', true );

	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/custom.css', array(), '4.4.1', 'all' );

	//slick css
	wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.0.0', 'all' );

	//slick js
	wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.0.0', true );

	wp_enqueue_script( 'anchor_scroll', get_template_directory_uri() . '/js/anchorscroll.js', array('jquery'), '20151215', true );

	if(is_page()){
		wp_enqueue_script( 'tab_linking', get_template_directory_uri() . '/js/tab-linking.js', array('jquery'), '20151215', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ce_membership_scripts' );

/**
 * Bootstrap 5 walker
 */
require get_template_directory() . '/inc/navwalker.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

// Custom blocks.
require get_theme_file_path( 'inc/blocks.php' );

// Custom Woo settings.
require get_theme_file_path( 'inc/woocommerce.php' );

// Extend TinyMCE editor
require get_theme_file_path( 'inc/extend-tiny-mce.php' );

// PMP customize
require get_theme_file_path( 'inc/pmp.php' );

// shortcodes
require get_theme_file_path( 'inc/shortcodes.php' );

// search customizations
require get_theme_file_path( 'inc/search.php' );

//Learndash customization
require get_theme_file_path( 'inc/learndash.php' );

//misc
require get_theme_file_path( 'inc/utilities.php' );
