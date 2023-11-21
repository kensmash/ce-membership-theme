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

  <div id="content" class="site-content <?php echo bootscore_container_class(); ?> py-5 mt-5">
    <div id="primary" class="content-area">

      <!-- Hook to add something nice -->
      <?php bs_after_primary(); ?>

      <div class="row">
        <div class="<?php echo bootscore_main_col_class(); ?> px-0">

          <main id="main" class="site-main">

            <header class="entry-header">
              <?php 
                the_post();
                if (!get_field('hide_page_title')):
                  echo '<h1>' . the_title() . '</h1>'; 
                endif; 
                bootscore_post_thumbnail();
              ?>
            </header>

            <div class="entry-content">
              <?php the_content(); ?>
            </div>

            <footer class="entry-footer">
              <?php comments_template(); ?>
            </footer>

          </main>

        </div>
        <?php get_sidebar(); ?>
      </div>

    </div>
  </div>

<?php
get_footer();
