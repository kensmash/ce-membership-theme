<?php
// https://bootscore.me/documentation/filters/#


/**
 * Header position and bg
 */
function header_bg_class() {
    return "position-relative bg-dark shadow-sm";
  }
  add_filter('bootscore/class/header', 'header_bg_class', 10, 2);