<?php
/**
 * WP Foundation Six functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://github.com/squizlabs/PHP_CodeSniffer/wiki/Advanced-Usage#ignoring-files-and-folders
 *
 * @package comics-experience
 */

// Include functions for the theme.
// Custom utility functions.
require get_theme_file_path( '/inc/utility-functions.php' );

// Initialize ACF logic for the theme.
require get_theme_file_path( '/inc/acf-utilities.php' );

// Custom theme blocks.
require get_template_directory() . '/blocks/blocks.php';

// Include components.
require_once get_theme_file_path( '/inc/includes.php' );

if ( ! function_exists( 'comics-experience_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function comics-experience_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'comics-experience', get_theme_file_path( '/languages' ) );

		// Add default posts and comments RSS feed links to head.
		// add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Custom thumbnail sizes.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_image_size/
		 *
		 * Ex:
		 * add_image_size( 'unique_name', 490, 240, array( 'center', 'top' ) );
		 */

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		// register_nav_menus(
		// array(
		// 'primary' => __( 'Primary Menu', 'comics-experience' ),
		// 'footer'  => __( 'Footer Menu', 'comics-experience' ),
		// )
		// );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		// add_theme_support(
		// 'html5',
		// array(
		// 'search-form',
		// 'comment-form',
		// 'comment-list',
		// 'gallery',
		// 'caption',
		// )
		// );

		add_theme_support( 'wp-block-styles' );

		/**
		 * Remove wp_header meta
		 */
		remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds.
		remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed.
		remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link.
		remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
		remove_action( 'wp_head', 'index_rel_link' ); // index link.
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link.
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link.
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Display relational links for the posts adjacent to the current post.
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // Injects rel=shortlink into the head if a shortlink is defined for the current page.
		remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version.

		add_theme_support( 'editor-styles' );
		/**
		 * Add callback for custom TinyMCE editor stylesheets.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_editor_style/
		 */
		add_editor_style( './assets/css/editor-styles.min.css' );
	}

	/**
	 * If you don't want to see inline debug code for
	 * what file generated a region of a page, set this
	 * constant to false.
	 */
	define( 'WPFS_INLINE_DEBUG', true );
}
add_action( 'after_setup_theme', 'comics-experience_setup' );


/**
 * Remove wp version meta tag and from rss feed
 *
 * @link https://thomasgriffin.io/hide-wordpress-meta-generator-tag/
 */
add_filter( 'the_generator', '__return_false' );


/**
 * Add callback for custom TinyMCE editor stylesheets.
 *
 * @link https://developer.wordpress.org/reference/functions/add_editor_style/
 */
add_editor_style( get_theme_file_uri( '/assets/css/editor-styles.min.css' ) );


if ( ! function_exists( 'comics-experience_scripts' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function comics-experience_scripts() {
		/* Asset file paths set to variables */
		$modern_jquery  = get_theme_file_uri( '/assets/js/vendors/jquery.min.js' );
		$global_styles  = get_theme_file_uri( '/assets/css/global-styles.min.css' );
		$global_scripts = get_theme_file_uri( '/assets/js/bundle.global-scripts.js' );
		$modernizr      = get_theme_file_uri( '/assets/js/vendors/modernizr.js' );

		/* Import CSS (Sass files are in the theme-components folder) */
		wp_enqueue_style( 'comics-experience-style', $global_styles, array(), wpfs_cache_bust( $global_styles ) );

		/* Import Scripts (Keep to a minimum or import into global-scripts.js file) */
		wp_enqueue_script( 'comics-experience-global', $global_scripts, array( 'jquery', 'comics-experience-modernizr' ), wpfs_cache_bust( $global_scripts ), true );
		wp_enqueue_script( 'comics-experience-modernizr', $modernizr, array(), wpfs_cache_bust( $modernizr ), true );
	}
}
add_action( 'wp_enqueue_scripts', 'comics-experience_scripts' );

add_action(
	'enqueue_block_editor_assets',
	function () {
		$editor_styles = get_theme_file_uri( '/assets/css/editor-styles.min.css' );
		wp_enqueue_style( 'comics-experience-editor-style', $editor_styles, array(), wpfs_cache_bust( $editor_styles ), 'all' );
	}
);

// If you need to add anything to the opening body, you can use the wp_body_open filter.
