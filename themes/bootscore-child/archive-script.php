<?php

/**
 * The template for displaying the script archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
    
    <?php if (!wp_is_mobile()): get_template_part( 'template-parts/content', 'topimage' ); endif; ?>

      <div class="row">

        <div class="<?= apply_filters('bootscore/class/main/col', 'col px-4 px-xl-5 py-4'); ?>">

          <main id="main" class="site-main">

            <div class="page-header mb-4">
              <?php the_archive_title('<h1>', '</h1>'); ?>
              <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
            </div>

            <?php 

                $args = array( 'post_type' => 'script','orderby'=> 'title', 'order' => 'ASC','posts_per_page' => -1 ); 

                $the_query = new WP_Query( $args );
                
                if( $the_query->have_posts() ): ?>

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne">
                                    The Comics Experience Script Template
                                </button>
                                </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body scripts">
                                    <ul>
                                        <li>
                                            <a href="<?php bloginfo('template_directory'); ?>/media/Comic-Experience-Script-Template-2021-11-24.doc">
                                                Suggested script format template from Comics Experience (Word)
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?php the_ID(); ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php the_ID(); ?>" aria-expanded="false" aria-controls="collapse<?php the_ID(); ?>">
                                    <?php the_title(); ?>
                                </button>
                            </h2>
                            <div id="collapse<?php the_ID(); ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php the_ID(); ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body scripts">
                                    <?php remove_filter ('the_content',  'wpautop'); ?>
                                    <?php the_content();?>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>

                    <?php else:  ?>
                        <p><?php  _e( 'Sorry, no scripts to display.' );  ?></p>
                    <?php endif; ?>
                    
                </div><!-- accordion -->

          </main>

        </div>
      
      </div>

    </div>
  </div>

<?php
get_footer();
