<?php
/**
 * Template Post Type: Staff
 *
 * @package Bootscore
 * @version 6.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header();
?>

<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container-fluid', 'page'); ?> <?= apply_filters('bootscore/class/content/spacer', 'px-0 py-lg-5 mt-lg-1', 'page'); ?>">
  <div id="primary" class="content-area <?= apply_filters('bootscore/class/container', 'container bg-white rounded-lg-1', 'page'); ?> <?= apply_filters('bootscore/class/content/spacer', 'px-0', 'page'); ?>">

    <div class="<?= apply_filters('bootscore/class/main/row', 'row px-0 g-0'); ?>">

        <div class="<?= apply_filters('bootscore/class/main/col', 'col px-3 px-lg-4 px-xl-5 pt-2 pt-lg-4 pb-4'); ?>">

        <?php the_breadcrumb(); ?>

          <main id="main" class="site-main">

            <div class="entry-header ps-2">
              <?php the_post(); ?>
        
              <h1><?php the_title(); ?></h1>
             
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
