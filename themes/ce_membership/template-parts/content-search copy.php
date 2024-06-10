<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* @package Bootscore
 * @version 6.0.0
 */


// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="card horizontal mb-4">
    <div class="row g-0">

      <?php if (has_post_thumbnail()) : ?>
        <div class="col-lg-6 col-xl-5 col-xxl-4">
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium', array('class' => 'card-img-lg-start')); ?>
          </a>
        </div>
      <?php endif; ?>

      <div class="col">
        <div class="card-body">

          <?php bootscore_category_badge(); ?>

          <a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
            <?php the_title('<h2 class="blog-post-title h5">', '</h2>'); ?>
          </a>

          <?php $post_type =  get_post_type(get_the_ID()); ?>

          <?php 
                switch ($post_type) {
                    case 'post':
                        echo '<p class="meta small mb-2 text-body-tertiary">Posted in the Comics Experience Blog on ' . get_the_time('F j, Y') . '</p>';
                        break;
                    case 'podcast':
                        echo '<p class="meta small mb-2 text-body-tertiary">Posted in Podcasts on ' . get_the_time('F j, Y') . '</p>';
                        break;
                    case 'courses':
                        echo '<p class="meta small mb-2 text-body-tertiary">Posted in Courses</p>';
                        break;
                    case 'scripts':
                        echo '<p class="meta small mb-2 text-body-tertiary">Posted in Scripts</p>';
                        break;
                    case 'videos':
                        echo '<p class="meta small mb-2 text-body-tertiary">Posted in Videos</p>';
                        break;
                }
            ?>

          <p class="card-text">
            <a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
              <?php echo strip_tags(search_excerpt_highlight()); ?>
            </a>
          </p>

          <p class="card-text">
            <a class="read-more" href="<?php the_permalink(); ?>">
              <?php _e('Read more »', 'bootscore'); ?>
            </a>
          </p>

          <?php bootscore_tags(); ?>

        </div>
      </div>
    </div>
  </div>

</article>
<!-- #post-<?php the_ID(); ?> -->