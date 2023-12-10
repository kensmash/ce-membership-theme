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
 */

get_header();
?>

  <div id="content" class="site-content <?= bootscore_container_class(); ?> py-5 mt-4">
    <div id="primary" class="content-area">

      <!-- Hook to add something nice -->
      <?php bs_after_primary(); ?>

      <main id="main" class="site-main">

        <div class="row px-0">
          <div class="<?= bootscore_main_col_class(); ?> px-0">
                <!-- Breadcrumb -->
                <?php woocommerce_breadcrumb(); ?>
            </div>
        </div>

        <div class="row">
          <div class="<?= bootscore_main_col_class(); ?> bg-white p-4">
            <?php woocommerce_content(); ?>
          </div>
          <!-- sidebar -->
          <?php get_sidebar(); ?>
          <!-- row -->
        </div>
      </main><!-- #main -->
    </div><!-- #primary -->
  </div><!-- #content -->
<?php
get_footer();
