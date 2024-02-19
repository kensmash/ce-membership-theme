<?php
/**
 * Template Post Type: Professional Service
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
    
              <h1><?php the_title(); ?></h1>
       
            </header>

            <div class="entry-content">
              <?php the_content(); ?>
            </div>

          </main>

        </div>
        <?php get_sidebar(); ?>
      </div>

    </div>
  </div>

<?php
get_footer();
