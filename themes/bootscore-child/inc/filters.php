<?php
// https://bootscore.me/documentation/filters/#


/**
 * Change path to logos
 */
function change_logo_path() {
  if ( wp_is_mobile() ) {
    return get_stylesheet_directory_uri() . '/assets/images/logo/logo-sm.svg';
  } else {
    return get_stylesheet_directory_uri() . '/assets/images/logo/logo.svg';
  }
  
}

add_filter('bootscore/logo', 'change_logo_path', 10, 2);

/**
 * Header position and bg
 */
function header_bg_class() {
  return "sticky-top bg-dark";
}
add_filter('bootscore/class/header', 'header_bg_class', 10, 2);

/**
 * Header search collapse position and bg
 */
function header_collapse_bg_class() {
  return "bg-dark position-absolute start-0 end-0";
}
add_filter('bootscore/class/header/collapse', 'header_collapse_bg_class', 10, 2);

/**
 * Change single header button
 */
function header_button_class($string, $location) {
  if ($location == 'search-toggler') {
    return "btn btn-outline-secondary";
  }
  return $string;
}
add_filter('bootscore/class/header/button', 'header_button_class', 10, 2);

/**
 * Disable scssphp compiler
 */ 
add_filter('bootscore_scss_disable_compiler', '__return_true');

