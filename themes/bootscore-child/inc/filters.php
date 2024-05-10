<?php
// https://bootscore.me/documentation/filters/#


/**
 * Change path to logos
 */
function change_logo_path($logo, $color) {
  if ($color === 'theme-dark') {
    return get_stylesheet_directory_uri() . '/assets/images/logo/logo.svg';
  }
  return get_stylesheet_directory_uri() . '/assets/images/logo/logo.svg';
}

add_filter('bootscore/logo', 'change_logo_path', 10, 2);

