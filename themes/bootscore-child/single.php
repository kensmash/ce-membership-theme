<?php
/**
 * Template Post Type: post
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

    <div class="<?= apply_filters('bootscore/class/main/row', 'row px-0 g-0'); /* g-0 is necessary to prevent horizontal overflow at mobile sizes */ ?>">

        <div class="<?= apply_filters('bootscore/class/main/col', 'col px-2 px-lg-4 px-xl-5 pt-2 pt-lg-4 pb-4'); ?>">

        <?php 
            $post_type = get_post_type( $post->ID );
            //echo $post_type;
            if ($post_type !== "sfwd-courses" && $post_type !== "sfwd-lessons" && $post_type !== "sfwd-topics" && $post_type !== "creative-services"): 
            the_breadcrumb();
            endif;
          ?>

          <main id="main" class="site-main">

          <header class="entry-header">
              <?php the_post(); ?>
              <?php bootscore_category_badge(); ?>
              <h1><?php the_title(); ?></h1>
              <?php if ($post_type !== "sfwd-courses" && $post_type !== "sfwd-lessons" && $post_type !== "sfwd-topics" && $post_type !== "creative-services"): ?>
              <p class="entry-meta">
                <small class="text-body-tertiary">
                  <?php
                  bootscore_date();
                  bootscore_author();
                  bootscore_comment_count();
                  ?>
                </small>
              </p>
              <?php bootscore_post_thumbnail(); ?>
              <?php endif; ?>
            </header>

            <div class="entry-content">
              <?php the_content(); ?>
            </div>

            <div class="entry-footer clear-both">
              <div class="mb-4">
                <?php bootscore_tags(); ?>
              </div>
              <!-- Related posts using bS Swiper plugin -->
              <?php if (function_exists('bootscore_related_posts')) bootscore_related_posts(); ?>
              <nav aria-label="bs page navigation">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <?php previous_post_link('%link'); ?>
                  </li>
                  <li class="page-item">
                    <?php next_post_link('%link'); ?>
                  </li>
                </ul>
              </nav>
              <?php comments_template(); ?>
            </div>

          </main>

        </div>

      </div>

    </div>
  </div>

<?php
get_footer();
