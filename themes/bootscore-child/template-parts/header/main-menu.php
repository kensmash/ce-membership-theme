<?php

/**
 * Template part to initialize the navbar menu
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 * @version 6.0.0
 */


// Exit if accessed directly
defined('ABSPATH') || exit;


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
} else { 
  
  wp_nav_menu(array(
      'menu'           => 'Courses Links',
      'container'      => false,
      'menu_class'     => '',
      'fallback_cb'    => '__return_false',
      'items_wrap'     => '<ul id="bootscore-navbar" class="navbar-nav ms-auto ms-lg-0 %2$s">%3$s</ul>',
      'depth'          => 2,
      'walker'         => new bootstrap_5_wp_nav_menu_walker()
    ));

} 

//now show main menu
  wp_nav_menu(array(
    'theme_location' => 'main-menu',
    'container'      => false,
    'menu_class'     => '',
    'fallback_cb'    => '__return_false',
    'items_wrap'     => '<ul id="bootscore-navbar" class="navbar-nav ms-auto ms-lg-0 %2$s">%3$s</ul>',
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
//no logged in user, show courses, main menu, signup and login buttons 
   wp_nav_menu(array(
      'menu'           => 'Courses Links',
      'container'      => false,
      'menu_class'     => '',
      'fallback_cb'    => '__return_false',
      'items_wrap'     => '<ul id="bootscore-navbar" class="navbar-nav ms-auto ms-lg-0 %2$s">%3$s</ul>',
      'depth'          => 2,
      'walker'         => new bootstrap_5_wp_nav_menu_walker()
    ));
  
  wp_nav_menu(array(
    'theme_location' => 'main-menu',
    'container'      => false,
    'menu_class'     => '',
    'fallback_cb'    => '__return_false',
    'items_wrap'     => '<ul id="bootscore-navbar" class="navbar-nav ms-auto ms-lg-0 %2$s">%3$s</ul>',
    'depth'          => 2,
    'walker'         => new bootstrap_5_wp_nav_menu_walker()
  ));
?>
  <div class="top-nav-widget-2 d-lg-flex align-items-lg-center mt-2 mt-lg-0 ms-xl-2">
    <a href="<?php echo site_url('login'); ?>">Login</a>
    <a class="btn btn-success ms-lg-3 mt-3 mt-lg-0" href="<?php echo site_url('community'); ?>" role="button">Community Signup</a>
  </div>

  <?php } ?>