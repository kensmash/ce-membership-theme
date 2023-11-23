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

}

// Fluid layout
function bootscore_container_class() {
  return "container-fluid";
}

// Custom blocks.
require get_theme_file_path( 'inc/blocks.php' );

// Custom widgets.
require get_theme_file_path( 'inc/widgets.php' );

// Extend TinyMCE editor
require get_theme_file_path( 'inc/extend-tiny-mce.php' );

