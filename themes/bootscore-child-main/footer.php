<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 *
 * @version 5.3.0
 */

?>

<footer class="container-fluid ce-footer border-top">

  <div class="container bootscore-footer pt-5 pb-3">
    <div class="<?= bootscore_container_class(); ?>">

      <!-- Top Footer Widget -->
      <?php if (is_active_sidebar('top-footer')) : ?>
        <?php dynamic_sidebar('top-footer'); ?>
      <?php endif; ?>

      <div class="row">
        <div class="col">
            <div>

            </div>
            <div>
                <small class="bootscore-copyright"><span class="cr-symbol">&copy;</span>&nbsp;<?= date('Y'); ?> <?php bloginfo('name'); ?></small>
            </div>
            <div>
                <?php if (is_active_sidebar('footer-social-media')) : ?>
                    <?php dynamic_sidebar('footer-social-media'); ?>
                <?php endif; ?>
            </div>
        </div><!-- .col -->
        <div class="col">
            
        </div>
      </div><!-- .col -->

      <div class="row justify-content-space-between">

        <!-- Footer 1 Widget -->
        <div class="col-md-6 col-lg">
          <?php if (is_active_sidebar('footer-1')) : ?>
            <?php dynamic_sidebar('footer-1'); ?>
          <?php endif; ?>
        </div>

        <!-- Footer 2 Widget -->
        <div class="col-md-6 col-lg">
          <?php if (is_active_sidebar('footer-2')) : ?>
            <?php dynamic_sidebar('footer-2'); ?>
          <?php endif; ?>
        </div>

        <!-- Footer 3 Widget -->
        <div class="col-md-6 col-lg">
          <?php if (is_active_sidebar('footer-3')) : ?>
            <?php dynamic_sidebar('footer-3'); ?>
          <?php endif; ?>
        </div>

        <!-- Footer 4 Widget -->
        <div class="col-md-6 col-lg">
          <?php if (is_active_sidebar('footer-4')) : ?>
            <?php dynamic_sidebar('footer-4'); ?>
          <?php endif; ?>
        </div>

        <!-- Footer 4 Widget -->
        <div class="col-md-6 col-lg">
          <?php if (is_active_sidebar('footer-5')) : ?>
            <?php dynamic_sidebar('footer-5'); ?>
          <?php endif; ?>
        </div>

      </div>

    

    </div>
  </div>

</footer>

<!-- To top button -->
<a href="#" class="btn btn-primary shadow top-button position-fixed zi-1020"><i class="fa-solid fa-chevron-up"></i><span class="visually-hidden-focusable">To top</span></a>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
