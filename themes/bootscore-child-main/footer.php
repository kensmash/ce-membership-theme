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

<footer class="container-fluid ce-footer border-top <?php echo !is_front_page() ? "mt-5" : ""; ?>">

  <div class="bootscore-footer pt-5 pb-3">
    
    <div class="container">

        <div class="row">

            <div class="col-lg-3">
                <div class="py-4 pe-4">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/logo/ce-logo-footer.svg" alt="Comics Experience logo">
                    </a>
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
                
            </div><!-- .col -->

        </div><!-- .row -->

    </div><!-- .container -->

    <div class="container mt-4">

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

            <!-- Footer 5 Widget -->
            <div class="col-md-6 col-lg">
            <?php if (is_active_sidebar('footer-5')) : ?>
                <?php dynamic_sidebar('footer-5'); ?>
            <?php endif; ?>
            </div>

        </div><!-- .row -->

      </div><!-- .container -->

    </div><!--  .container -->

</footer>

<!-- To top button -->
<a href="#" class="btn btn-primary shadow top-button position-fixed zi-1020"><i class="fa-solid fa-chevron-up"></i><span class="visually-hidden-focusable">To top</span></a>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
