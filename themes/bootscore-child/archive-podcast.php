<?php

/**
 * The template for displaying the podcast archive page
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

<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container-fluid', 'page'); ?> <?= apply_filters('bootscore/class/content/spacer', 'px-0 py-xxl-4 mt-xxl-1', 'page'); ?>">
  <div id="primary" class="content-area <?= apply_filters('bootscore/class/container', 'container bg-white rounded-xxl-1', 'page'); ?> <?= apply_filters('bootscore/class/content/spacer', 'px-0', 'page'); ?>">

    <?php if (!wp_is_mobile()): get_template_part( 'template-parts/content', 'topimage' ); endif; ?>

      <div class="<?= apply_filters('bootscore/class/main/row', 'row px-0 g-0'); /* g-0 is necessary to prevent horizontal overflow at mobile sizes */ ?>">

        <div class="<?= apply_filters('bootscore/class/main/col', 'col px-3 px-lg-4 px-xl-5 py-4'); ?>">

          <main id="main" class="site-main">

            <div class="page-header ps-1 ps-lg-2 mb-4">
              <?php /* the_archive_title('<h1>', '</h1>');  */?>
              <h1>Comics Experience Podcast</h1>
              <?php the_field('podcast_description', 'option'); ?>
            </div>

            <?php if ( have_posts() ) : 
        
                $page = get_query_var('paged'); // get which page number we are on
                $counter = 0;
                $queried_object = get_queried_object();

                set_query_var('podcast', true); 
                $prevText = "Older episodes &raquo;";
                $nextText = "&laquo; Newer episodes"; 
		
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    $counter++; // add +1 to count for each post
                    /*
                    * Include the Post-Type-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                    */
                    if ($counter === 1 AND $paged <= 1) {
                        get_template_part( 'template-parts/content', get_post_type() );
                    } else {
                        get_template_part( 'template-parts/content-excerpt' );
                    }

                endwhile;
			?>

                <nav aria-label="Page navigation" class="container-fluid">
                    <div class="row px-4">
                        <div class="col-md-6 text-center text-md-start"><?php previous_posts_link( $nextText ); ?></div>
                        <div class="col-md-6 text-center text-md-end"><?php next_posts_link( $prevText ); ?></div>
                    </div>
                </nav>

	    <?php else :

		    get_template_part( 'template-parts/content', 'none' );

		    endif;

		?>

          </main>

        </div>
      
      </div>

    </div>
  </div>

<?php
get_footer();
