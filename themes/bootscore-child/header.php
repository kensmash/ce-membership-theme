<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 * @version 6.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site">
  
  <a class="skip-link visually-hidden-focusable" href="#primary"><?php esc_html_e( 'Skip to content', 'bootscore' ); ?></a>

  <!-- Top Bar Widget -->
  <?php if (is_active_sidebar('top-bar')) : ?>
    <?php dynamic_sidebar('top-bar'); ?>
  <?php endif; ?>  

  <header id="masthead" class="<?= apply_filters('bootscore/class/header', 'sticky-top bg-dark'); ?> site-header">

    <nav id="nav-main" class="navbar <?= apply_filters('bootscore/class/header/navbar/breakpoint', 'navbar-expand-lg'); ?>">

      <div class="<?= apply_filters('bootscore/class/container', 'container', 'header'); ?>">
        
        <!-- Navbar Brand -->
        <a class="navbar-brand" href="<?= esc_url(home_url()); ?>">
          <img src="<?= esc_url(apply_filters('bootscore/logo', get_stylesheet_directory_uri() . '/assets/img/logo/logo.svg', 'default')); ?>" alt="<?php bloginfo('name'); ?> Logo" class="d-td-none me-2">
          <img src="<?= esc_url(apply_filters('bootscore/logo', get_stylesheet_directory_uri() . '/assets/img/logo/logo-theme-dark.svg', 'theme-dark')); ?>" alt="<?php bloginfo('name'); ?> Logo" class="d-tl-none me-2">
        </a>  

        <!-- Offcanvas Navbar -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-navbar">
          <div class="offcanvas-header">
            <span class="h5 offcanvas-title"><?= apply_filters('bootscore/offcanvas/navbar/title', __('Menu', 'bootscore')); ?></span>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body justify-content-xl-center">

          <?php 
              if ( is_user_logged_in() ) {
                        
               if (learndash_user_get_enrolled_courses(get_current_user_id())) {
                //if user has purchased courses, show dropdown courses menu
                  wp_nav_menu(array(
                    'menu'           => 'Learndash Courses Links',
                    'container'      => false,
                    'menu_class'     => '',
                    'fallback_cb'    => '__return_false',
                    'items_wrap'     => '<ul id="bootscore-navbar" class="navbar-nav ms-auto ms-lg-0 %2$s">%3$s</ul>',
                    'depth'          => 2,
                    'walker'         => new bootstrap_5_wp_nav_menu_walker()
                  ));
                  //else just show Courses link
              } else { ?>
                
                <div class="top-nav-widget-2 d-lg-flex align-items-lg-center my-2 ms-xl-2">
                  <a href="<?php echo site_url('courses'); ?>">Courses</a>
                </div>

              <?php } 

              //now show main menu
                wp_nav_menu(array(
                  'theme_location' => 'main-menu',
                  'container'      => false,
                  'menu_class'     => '',
                  'fallback_cb'    => '__return_false',
                  'items_wrap'     => '<ul id="bootscore-navbar" class="navbar-nav ms-auto ms-xl-0 %2$s">%3$s</ul>',
                  'depth'          => 2,
                  'walker'         => new bootstrap_5_wp_nav_menu_walker()
                ));
              
              //if user not a member, show signup button
              $pmp_member = pmpro_getMembershipLevelForUser(get_current_user_id());
              //echo "member level: " . var_dump($pmp_member);
              if( !$pmp_member ) { ?>
                <div class="top-nav-widget-2 d-lg-flex align-items-lg-center mt-2 mt-lg-0 ms-lg-2">
                  <a class="btn btn-success ms-lg-3 mt-3 mt-lg-0" href="<?php echo site_url('community'); ?>" role="button">Community Signup</a>
                </div>
                <?php 
              } else if ($pmp_member->name == 'Community Pro') { 
                 //we have a Community Pro member, show them a custom membership menu (not applicable for Community)
                  wp_nav_menu(array(
                    'menu'           => 'Tier 2 Community Links',
                    'container'      => false,
                    'menu_class'     => '',
                    'fallback_cb'    => '__return_false',
                    'items_wrap'     => '<ul id="bootscore-navbar" class="navbar-nav ms-auto ms-lg-0 %2$s">%3$s</ul>',
                    'depth'          => 2,
                    'walker'         => new bootstrap_5_wp_nav_menu_walker()
                  ));
               }
            } else { 
              //no logged in user, show courses, main menu, signup and login buttons ?>
                <div class="top-nav-widget-2 d-lg-flex align-items-lg-center my-2 ms-xl-2">
                  <a href="<?php echo site_url('courses'); ?>">Courses</a>
                </div>
                
               <?php  
               wp_nav_menu(array(
                  'theme_location' => 'main-menu',
                  'container'      => false,
                  'menu_class'     => '',
                  'fallback_cb'    => '__return_false',
                  'items_wrap'     => '<ul id="bootscore-navbar" class="navbar-nav ms-auto ms-xl-0 %2$s">%3$s</ul>',
                  'depth'          => 2,
                  'walker'         => new bootstrap_5_wp_nav_menu_walker()
                ));
              ?>
                <div class="top-nav-widget-2 d-xl-flex align-items-lg-center mt-2 mt-lg-0 ms-xl-2">
                  <a href="<?php echo site_url('login'); ?>">Login</a>
                  <a class="btn btn-success ms-lg-3 mt-3 mt-lg-0" href="<?php echo site_url('community'); ?>" role="button">Community Signup</a>
                </div>

                <?php } ?>

          </div>
        </div>

        <div class="header-actions d-flex align-items-center">

          <!-- Top Nav Widget -->
          <?php if (is_active_sidebar('top-nav')) : ?>
            <?php dynamic_sidebar('top-nav'); ?>
          <?php endif; ?>

          <?php
          if (class_exists('WooCommerce')) :
            get_template_part('template-parts/header/actions', 'woocommerce');
          else :
            get_template_part('template-parts/header/actions');
          endif;
          ?>

          <!-- Navbar Toggler -->
          <button class="<?= apply_filters('bootscore/class/header/button', 'btn btn-outline-secondary', 'nav-toggler'); ?> <?= apply_filters('bootscore/class/header/navbar/toggler/breakpoint', 'd-lg-none'); ?> ms-1 ms-md-2 nav-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar" aria-controls="offcanvas-navbar">
            <i class="fa-solid fa-bars"></i><span class="visually-hidden-focusable">Menu</span>
          </button>

        </div><!-- .header-actions -->

      </div><!-- .container -->

    </nav><!-- .navbar -->

    <?php
    if (class_exists('WooCommerce')) :
      get_template_part('template-parts/header/collapse-search', 'woocommerce');
    else :
      get_template_part('template-parts/header/collapse-search');
    endif;
    ?>

    <!-- Offcanvas User and Cart -->
    <?php
    if (class_exists('WooCommerce')) :
      get_template_part('template-parts/header/offcanvas', 'woocommerce');
    endif;
    ?>

  </header><!-- #masthead -->
