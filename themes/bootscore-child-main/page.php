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
    <div id="primary" class="content-area <?php echo is_cart() || in_array( get_post_type( get_the_id() ), $avoid_fluid_container_post_types ) ? "container" : "container"; ?>">

      <!-- Hook to add something nice -->
      <?php bs_after_primary(); ?>

      <div class="row">
        <div class="<?php echo bootscore_main_col_class(); ?> px-0">

          <main id="main" class="site-main">

            <header class="entry-header pt-3 ps-2">
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
