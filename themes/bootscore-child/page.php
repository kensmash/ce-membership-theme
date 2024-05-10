<?php

/**
 * The template for displaying all pages
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

  <div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container-fluid', 'page'); ?> <?= apply_filters('bootscore/class/content/spacer', 'py-5 mt-lg-21', 'page'); ?>">
    <div id="primary" class="content-area container bg-white rounded-1 px-0">
    <?php get_template_part( 'template-parts/content', 'topimage' ); ?>
      <div class="row">
        <div class="<?= apply_filters('bootscore/class/main/col', 'col'); ?>">

          <main id="main" class="site-main px-0 px-lg-3 pb-3">

            <div class="entry-header">
              <?php 
              the_post(); 
              if (!get_field('hide_page_title')): ?>
                  <h1><?php the_title(); ?></h1>
              <?php endif; ?>
            </div>

            <div class="entry-content">
              <?php the_content(); ?>
            </div>

          </main>

        </div>

      </div>

    </div>
  </div>

<?php
get_footer();
