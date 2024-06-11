<?php

/**
 * @package Bootscore Child
 *
 * @version 6.0.0
 */


// Exit if accessed directly
defined('ABSPATH') || exit;

function enqueue_wc_cart_fragments() { wp_enqueue_script( 'wc-cart-fragments' ); }
add_action( 'wp_enqueue_scripts', 'enqueue_wc_cart_fragments' );



/**
 * Enqueue scripts and styles
 */
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');

function bootscore_child_enqueue_styles() {

  // Compiled main.css
  $modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/css/main.css'));
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/css/main.css', array('parent-style'), $modified_bootscoreChildCss);

  // style.css
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

  //slick css
  wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/assets/css/slick.css', array(), '1.0.0', 'all' );

  //slick js
  wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.0.0', true );
  
  // custom.js
  // Get modification time. Enqueue file with modification date to prevent browser from loading cached scripts when file content changes. 
  $modificated_CustomJS = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/js/custom.js'));
  wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), $modificated_CustomJS, false, true);
}

/* 
remove archive from title on archive pages
solution from https://developer.wordpress.org/reference/functions/get_the_archive_title/
*/

function my_theme_archive_title( $title ) {
  if ( is_category() ) {
    $title = single_cat_title( 'Category: ', false );
  } elseif ( is_post_type_archive('podcast') ) {
    $title = "Podcast Episodes";
  } elseif ( is_post_type_archive('scripts') ) {
    $title = "Scripts";
  } elseif ( is_tag() ) {
    $title = single_tag_title( 'Posts Tagged: ', false );
  } elseif ( is_author() ) {
    $title = 'Posts by <span class="vcard">' . get_the_author() . '</span>';
  } elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
  } elseif ( is_tax() ) {
    $title = single_term_title( '', false );
  }
  
  return $title;
}
  
add_filter( 'get_the_archive_title', 'my_theme_archive_title' );

// Bootscore filters
require get_theme_file_path( 'inc/filters.php' );

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

// BBPress customize
require get_theme_file_path( 'inc/bbpress.php' );

//misc
require get_theme_file_path( 'inc/utilities.php' );

//Learndash customization
require get_theme_file_path( 'inc/learndash.php' );


// Add support for responsive embedded content (YouTube, Vimeo, etc.).
add_theme_support( 'responsive-embeds' );
