<?php

/**
 * Template part for displaying the top-nav searchform collapse widget if WooCommerce is installed
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 * @version 6.0.0
 */


// Exit if accessed directly
defined('ABSPATH') || exit;

?>


<!-- Collapse Search -->
<?php if (is_active_sidebar('top-nav-search')) : ?>
  <div class="collapse bg-dark position-absolute start-0 end-0" id="collapse-search">
    <div class="container pb-2">
      <?php dynamic_sidebar('top-nav-search'); ?>
    </div>
  </div>
<?php endif; ?>
