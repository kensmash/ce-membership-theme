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
 */

get_header();
?>

<?php $avoid_fluid_container_post_types = array('forum', 'topic', 'reply'); ?>

  <div id="content" class="site-content container-fluid py-5 mt-5">
    <div id="primary" class="content-area container bg-white rounded-1 px-0">

    <?php get_template_part( 'template-parts/content', 'topimage' ); ?>

      <!-- Hook to add something nice -->
      <?php bs_after_primary(); ?>

      <div class="row px-4">
        <div class="<?php echo bootscore_main_col_class(); ?> px-0">

          <main id="main" class="site-main px-3">

            <header class="entry-header pt-4 ps-2">
              <?php 
                the_post();
                if (!get_field('hide_page_title')): ?>
                  <h1><?php the_title(); ?></h1>
               <?php endif; ?>
            </header>

            <div class="entry-content">
              <?php the_content(); ?>
            </div>

            <!-- tabs -->
		        <?php get_template_part( 'template-parts/tabs/tabs', 'page' ); ?>

          </main>

        </div>
        <?php get_sidebar(); ?>
      </div>

    </div>
  </div>

<?php
get_footer();
