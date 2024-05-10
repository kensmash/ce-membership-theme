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

