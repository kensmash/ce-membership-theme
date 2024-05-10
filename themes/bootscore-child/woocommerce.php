<?php

/**
 * The template for displaying all WooCommerce pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 * @version 6.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header();
?>

<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container-fluid', 'page'); ?> <?= apply_filters('bootscore/class/content/spacer', 'px-0 py-lg-5 mt-lg-1', 'page'); ?>">

  <div id="primary" class="content-area <?= apply_filters('bootscore/class/container', 'container bg-white', 'page'); ?> <?= apply_filters('bootscore/class/content/spacer', 'px-0', 'page'); ?>">

      <main id="main" class="site-main">

        <?php woocommerce_breadcrumb(); ?>

        <div class="row">
            <div class="<?= apply_filters('bootscore/class/main/col', 'col px-4 px-xl-5 py-4'); ?>">
                <?php woocommerce_content(); ?>
            </div><!-- col -->

        </div><!-- row -->

      </main><!-- #main -->

    </div><!-- #primary -->

  </div><!-- #content -->

<?php
get_footer();
