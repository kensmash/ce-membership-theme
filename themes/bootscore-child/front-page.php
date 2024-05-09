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

<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container', 'page'); ?> <?= apply_filters('bootscore/class/content/spacer', 'pt-4 pb-5 px-0', 'page'); ?>">
    <div id="primary" class="content-area">

      <div class="row">
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