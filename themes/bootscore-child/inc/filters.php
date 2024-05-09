<?php
// https://bootscore.me/documentation/filters/#


/**
 * Header position and bg
 */
function header_bg_class() {
    return "position-relative bg-dark shadow-sm";
  }
  add_filter('bootscore/class/header', 'header_bg_class', 10, 2);


/**
 * Change container class in a single file
 */
function container_class($string) {
  if ( is_front_page()) {
    return "container-fluid";
  }
  return $string;
}
add_filter('bootscore/class/container', 'container_class', 10, 2);