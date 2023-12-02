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

<footer class="container-fluid ce-footer <?php echo !is_front_page() ? "mt-5" : ""; ?>">

  <div class="bootscore-footer pt-3 pb-3">
    
    <div class="container pb-5">

        <div class="row justify-content-between">

            <div class="col-lg-3">
                <div class="py-4 pe-1">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <img class="footer-logo" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/logo/ce-logo-footer.svg" alt="Comics Experience logo">
                    </a>
                </div>
                <div class="text-center">
                    <small class="bootscore-copyright"><span class="cr-symbol">&copy;</span>&nbsp;<?php echo date('Y'); ?> Andy Schmidt. All rights reserved.</small>
                </div>
                <div class="mt-4 px-2">
                    <?php
                        wp_nav_menu(array(
                            'menu' => 'Footer Social Media',
                            'menu_id' => 'menu-footer-social-media',
                            'menu_class' => 'd-flex flex-row justify-content-between',
                            'fallback_cb' => '__return_false',
                            'items_wrap' => '<ul id="%1$s" class="navbar-nav mb-2 mb-md-0 %2$s">%3$s</ul>',
                            'depth' => 1,
                        )); 
                     ?>
                </div>
            </div><!-- .col -->
            
            <div class="col-lg-5 text-light pt-3">
                <h3>Get Our Newsletter</h3>
                <p>Sign up for our <b>monthly email newsletter</b> to receive updates on courses, information on making comics, and community news!</p>
                <?php echo do_shortcode("[gravityform id='1' title='false']"); ?>
            </div><!-- .col -->

        </div><!-- .row -->

    </div><!-- .container -->

    <div class="container py-4">

      <div class="row justify-content-space-between">

            <!-- Footer 1 Widget -->
            <div class="col-md-6 col-lg">
                <?php
                    wp_nav_menu(array(
                        'menu' => 'Footer 1 Nav',
                        'container' => false,
                        'menu_id' => '',
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav mb-2 mb-md-0 %2$s">%3$s</ul>',
                        'depth' => 2,
                    )); 
                ?>
            </div>

            <!-- Footer 2 Widget -->
            <div class="col-md-6 col-lg">
            <?php
                    wp_nav_menu(array(
                        'menu' => 'Footer 2 Nav',
                        'container' => false,
                        'menu_id' => '',
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav mb-2 mb-md-0 %2$s">%3$s</ul>',
                        'depth' => 2,
                    )); 
                ?>
            </div>

            <!-- Footer 3 Widget -->
            <div class="col-md-6 col-lg">
            <?php
                    wp_nav_menu(array(
                        'menu' => 'Footer 3 Nav',
                        'container' => false,
                        'menu_id' => '',
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav mb-2 mb-md-0 %2$s">%3$s</ul>',
                        'depth' => 2,
                    )); 
                ?>
            </div>

            <!-- Footer 4 Widget -->
            <div class="col-md-6 col-lg">
            <?php
                    wp_nav_menu(array(
                        'menu' => 'Footer 4 Nav',
                        'container' => false,
                        'menu_id' => '',
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav mb-2 mb-md-0 %2$s">%3$s</ul>',
                        'depth' => 2,
                    )); 
                ?>
            </div>

            <!-- Footer 5 Widget -->
            <div class="col-md-6 col-lg">
            <?php
                    wp_nav_menu(array(
                        'menu' => 'Footer 5 Nav',
                        'container' => false,
                        'menu_id' => '',
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav mb-2 mb-md-0 %2$s">%3$s</ul>',
                        'depth' => 2,
                    )); 
                ?>
            </div>

        </div><!-- .row -->

      </div><!-- .container -->

    </div><!--  .container -->

    <?php
        // load random photo from header-images folder
        // http://zzamboni.org/new/brt/2008/11/03/how-to-display-random-header-images-in-a-wordpress-theme/index.html
        $curdir=getcwd(); chdir(get_stylesheet_directory() . "/assets/images/footer");
        $files=glob("*.{gif,png,jpg}", GLOB_BRACE);
        chdir($curdir);
        $file=$files[array_rand($files)];
    ?>

    <div class="footer-art container-fluid p-0" style="background-image: url(<?php echo(get_stylesheet_directory_uri() ."/assets/images/footer/$file"); ?>);">
        
    </div>

</footer>

<!-- To top button -->
<a href="#" class="btn btn-primary shadow top-button position-fixed zi-1020"><i class="fa-solid fa-chevron-up"></i><span class="visually-hidden-focusable">To top</span></a>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
