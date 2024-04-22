<?php

require get_theme_file_path( 'inc/cache-bust.php' );

// style and scripts
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles() {

  // style.css
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

  //slick css
  wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/assets/css/slick.css', array(), '1.0.0', 'all' );

  // Compiled main.css
  $child_styles = get_stylesheet_directory_uri() . '/assets/css/main.css';
  wp_enqueue_style('main', $child_styles, array('parent-style'), ce_cache_bust( $child_styles ));

  //slick js
  wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.0.0', true );

  // custom.js
  //wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom-min.js', false, '', true);

  // global.js
  wp_enqueue_script('global-js', get_stylesheet_directory_uri() . '/assets/js/global-min.js', false, '', true);

  /* if ( is_front_page() && !wp_is_mobile() ) {
    wp_enqueue_script('home-js', get_stylesheet_directory_uri() . '/assets/js/home-min.js', false, '', true);
  } */

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

// Fluid layout
/* function bootscore_container_class() {
  return "container-fluid";
} */

// Custom blocks.
require get_theme_file_path( 'inc/blocks.php' );

// Custom Woo settings.
require get_theme_file_path( 'inc/woocommerce.php' );

// Extend TinyMCE editor
require get_theme_file_path( 'inc/extend-tiny-mce.php' );

// PMP customize
require get_theme_file_path( 'inc/pmp.php' );

//Learndash customization
//require get_theme_file_path( 'inc/learndash.php' );

// shortcodes
require get_theme_file_path( 'inc/shortcodes.php' );

// search customizations
require get_theme_file_path( 'inc/search.php' );

// BBPress customize
require get_theme_file_path( 'inc/bbpress.php' );

//misc
//require get_theme_file_path( 'inc/utilities.php' );


// Add support for responsive embedded content (YouTube, Vimeo, etc.).
add_theme_support( 'responsive-embeds' );