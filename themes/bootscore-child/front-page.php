<?php

/**
 * The template for displaying the home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 */

get_header();
?>

<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container-fluid bg-white', 'page'); ?> <?= apply_filters('bootscore/class/content/spacer', 'px-0', 'page'); ?>">
    <div id="primary" class="content-area">

      <div class="<?= apply_filters('bootscore/class/main/row', 'row px-0 g-0'); ?>">

        <div class="<?= apply_filters('bootscore/class/main/col', 'col'); ?>">

          <main id="main" class="site-main">

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