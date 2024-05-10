<?php
/**
 * Template Post Type: Connection Comic
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

        <div class="<?= apply_filters('bootscore/class/main/col', 'col px-4 px-xl-5 pt-2 pt-lg-4 pb-4'); ?>">

        <?php the_breadcrumb(); ?>

        <main id="main" class="site-main">

            <header class="entry-header">
            <?php the_post(); ?>
  
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
      
            </footer>

            </main>

        </div>

      </div>

    </div>
  </div>

<?php
get_footer();
