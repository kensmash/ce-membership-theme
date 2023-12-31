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
              <?php the_post(); ?>
              <?php bootscore_category_badge(); ?>
              <h1><?php the_title(); ?></h1>
              
            </header>

            <div class="row entry-content">
                <div class="col-4">
                  <?php bootscore_post_thumbnail(); ?>
                </div>
                <div class="col-8">
                  <?php the_content(); 
                    $link = get_field('order_link');
                    if( $link ): 
                      $link_url = $link['url'];
                      $link_title = $link['title'];
                      $link_target = $link['target'] ? $link['target'] : '_self';
                    endif;
                    ?>
                 
                 <p class="fw-bold fs-6"><?php echo esc_html ( get_field('creator_names') ); ?> | <?php echo esc_html ( get_field('format') ); ?> | <?php echo esc_html( get_field('publisher') ); ?></p>
                  <a class="btn btn-success" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" role="button"><?php echo esc_html( get_field('order_button_text') ); ?></a>
                </div>
            </div>

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

          </main>

        </div>
        <?php get_sidebar(); ?>
      </div>

    </div>
  </div>

<?php
get_footer();
