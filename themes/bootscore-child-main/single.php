<?php
/**
 * Template Post Type: post
 *
 * @version 5.3.1
 */

get_header();
?>

  <div id="content" class="site-content <?= bootscore_container_class(); ?> py-5 mt-5">
    <div id="primary" class="content-area">

      <!-- Hook to add something nice -->
      <?php bs_after_primary(); ?>

      <div class="row pt-4 px-4 bg-white rounded-1">
        <div class="<?= bootscore_main_col_class(); ?>">

          <main id="main" class="site-main">

            <header class="entry-header">
              <?php 
                $post_type = get_post_type( $post->ID );
                //echo $post_type;
                the_post(); ?>
              <?php bootscore_category_badge(); ?>
              <h1><?php the_title(); ?></h1>
              <?php if ($post_type !== "sfwd-courses" && $post_type !== "sfwd-lessons" && $post_type !== "sfwd-topics"): ?>
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

            <?php if ($post_type !== "sfwd-lessons" && $post_type !== "sfwd-topics"): ?>
              <footer class="entry-footer clear-both">
                <div class="mb-4">
                  <?php bootscore_tags(); ?>
                </div>
                <!-- Related posts using bS Swiper plugin -->
                <?php if (function_exists('bootscore_related_posts')) bootscore_related_posts(); ?>
                <nav aria-label="bS page navigation">
                  <ul class="pagination justify-content-center">
                    <li class="page-item">
                      <?php previous_post_link('%link'); ?>
                    </li>
                    <li class="page-item">
                      <?php next_post_link('%link'); ?>
                    </li>
                  </ul>
                </nav>
                <?php  comments_template();  ?>
              </footer>
            <?php endif; ?>

          </main>

        </div>
        <?php get_sidebar(); ?>
      </div>

    </div>
  </div>

<?php
get_footer();
